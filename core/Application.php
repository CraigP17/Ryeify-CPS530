<?php

use app\core\Database;
use app\core\Session;

require_once __DIR__.'/Router.php';
require_once __DIR__.'/Request.php';
require_once __DIR__.'/Response.php';
require_once __DIR__.'/Session.php';

/**
 * 
 */
class Application
{
    public static $ROOT_DIR;

    public $userClass;
    public $router;
    public $request;
    public $response;
    public static $app;
    public $controller;
    public $session;
    public $db;
    public $user;
    public $config;
    function __construct($rootPath)
    {
        $this->userClass = \app\models\RegisterModel::class;
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->config = parse_ini_file('../private/config.ini');;
        $this->db = new Database($this->config);

        $this->checkShopifyToken();

        // Get logged in user from session
        $primaryValue = $this->session->get('user');
        if ($primaryValue)
        {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findUserByKey([$primaryKey => $primaryValue]);
            // Later change to this and get rid of getting userClass from string in config
            // \app\models\RegisterModel::findOne([$primaryKey => $primaryValue]);
        }
        else
        {
            $this->user = null;
        }

    }


    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function checkShopifyToken()
    {
        // Check if access tokens are set
        if (isset($_SESSION['access_token']) && isset($_SESSION['access_token_time']))
        {
            $last_time = $_SESSION['access_token_time'];

            // Check if token expired (60 mins)
            if (time() - $last_time < 3600)
            {
                // Good to go
                return true;
            }
        }

        // Needs new token
        $success = $this->getShopifyBearerToken();
        if (!$success)
        {
            // Redirect to error page, with Internal Server Error 500
            $this->response->setStatusCode(500);
            $this->response->redirect('/error');
            return false;
        }
        return true;
    }

    protected function getShopifyBearerToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://accounts.spotify.com/api/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . base64_encode($this->config['client_id'] . ":" .  $this->config['client_secret']),
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        // Save token to session to be available on all pages
        $arr_response = json_decode($response, true);

        if (isset($arr_response['access_token']))
        {
            // Save access token to session
            $_SESSION['access_token'] = $arr_response['access_token'];
            $_SESSION['access_token_time'] = time();
            return true;
        }

        // Return error for redirection
        return false;
    }

    public function getSpotifyUserToken($user_id, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://accounts.spotify.com/api/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=refresh_token&refresh_token=" . $token,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . base64_encode(Application::$app->config['client_id'] . ":" .  Application::$app->config['client_secret']),
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $spotify_response = curl_exec($curl);
        curl_close($curl);

        // Save user token to view Spotify pages
        $array_response = json_decode($spotify_response, true);

        if (isset($array_response['access_token']))
        {
            // Save user access token to session
            $_SESSION['user_token'] = $array_response['access_token'];
            $_SESSION['user_token_time'] = time();

            if (isset($array_response['refresh_token']))
            {
                $_SESSION['refresh_token'] = $array_response['refresh_token'];
                $this->db->updateSpotifyRefreshToken($user_id, $token);
            }
            return true;
        }

        // Return error for redirection
        return false;
    }

    public function login($user)
    {
        // Save user in session
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $_SESSION['user'] = $primaryValue;

        // Check if user has connected Spotify and grab spotify tokens
        $spotifyConnection = $this->db->getSpotifyConnection($primaryValue);
        $connected = $spotifyConnection['spotify_connected'] === "1";
        if ($connected)
        {
            $_SESSION['spotify_active'] = true;
            $refresh_token = $this->db->getSpotifyRefreshToken($primaryValue);
            $this->getSpotifyUserToken($primaryValue, $refresh_token['spotify_refresh_token']);
        }
        return true;
    }

    public function loggedIn()
    {
        if ($this->user != null)
        {
            return true;
        }
        return false;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
