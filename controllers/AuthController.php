<?php


namespace app\controllers;

use app\core\Controller;
use app\models\LoginModel;
use app\models\RegisterModel;
use Application;

class AuthController extends Controller
{

    public function register($request)
    {
        $registerModel = new RegisterModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register())
            {
                Application::$app->session->setFlash('success', 'Thanks for registering!');
                Application::$app->response->redirect('/login');
                return 0;
            }

            return $this->render('register', [
                'model' => $registerModel
            ]);
        }

        // GET request
        // return register view
        // $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function login($request, $response)
    {
        $loginForm = new LoginModel();
        if ($_POST)
        {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login())
            {
                $response->redirect('/profile');
                return 0;
            }
        }
        // GET request
        // return login view
        // $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function logout($request, $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile($request, $response)
    {
        // GET request
        // return profile view
        $params = array();

        // If not logged in, return to login page
        if (!isset($_SESSION['user']))
        {
            $response->redirect('/login');
            return 0;
        }

        $params['spotify_active'] = false;

        if (isset($_SESSION['spotify_active']) && $_SESSION['spotify_active'] == true)
        {
            $user_data = $this->getSpotifyProfile();
            if (isset($user_data['display_name']))
            {
                $params['spotify_active'] = true;
                $params['spotify_name'] = $user_data['display_name'];
                $params['spotify_followers'] = $user_data['followers']['total'];
                $params['spotify_product'] = ucfirst($user_data['product']);
                $params['spotify_account_url'] = $user_data['external_urls']['spotify'];
                $params['spotify_profile_img'] = $user_data['images'][0]['url'] ?? 'img/profile-picture.png';
            }
        }

        return $this->render('profile', $params);
    }

    public function personalized()
    {
        $params = array();

        $spotify_connected = isset($_SESSION['spotify_active']);
        $params['connected'] = $spotify_connected;

        if (isset($_SESSION['user']) && $spotify_connected)
        {
            // User is logged in and connected their Spotify account, use their actual data
            $params['tracks'] = $this->getTopTracks();
        }
        else
        {
            // Spotify Account not Account, use defaults
            $tracks_json = file_get_contents("../temp-json/tracks.json");
            $tracks = json_decode($tracks_json, true);
            $artists_json = file_get_contents("../temp-json/artists.json");
            $artists = json_decode($artists_json, true);

            $params['tracks'] = $tracks;
            $params['artists'] = $artists;
        }
        return $this->render('personalized', $params);
    }

    protected function getTopTracks()
    {
        Application::$app->checkShopifyToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/me/top/tracks',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['user_token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }


    // ===== ===== Spotify OAuth2 ===== =====

    public function spotifyAuth($request, $response)
    {
        $url      = "https://accounts.spotify.com/authorize";
        $client   = "client_id=" . Application::$app->config['client_id'];
        $resp     = "response_type=code";
        $redirect = "redirect_uri=" . Application::$app->config['client_redirect'];
        $scope    = "scope=user-read-private%20user-read-email%20user-top-read";
        $state    = "state=" . Application::$app->config['client_redirect'];;

        return $response->redirect("$url?$client&$resp&$redirect&$scope&$state");
    }

    public function spotifyCallback($request, $response)
    {
        if (isset($_GET['error']) && trim($_GET['error']) == 'access_denied')
        {
            $response->redirect('/profile');
        }

        $state = $_GET['state'] ?? '';
        if ($state == "STATE")
        {
            Application::$app->response->redirect('/error');
        }

        $code = $_GET['code'] ?? '';
        $redirect = "redirect_uri=" . Application::$app->config['client_redirect'];

        $auth = base64_encode(Application::$app->config['client_id'] . ":" .  Application::$app->config['client_secret']);

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
            CURLOPT_POSTFIELDS => "grant_type=authorization_code&code=$code&$redirect",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . $auth,
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
            $user_id = $_SESSION['user'];
            $_SESSION['user_token'] = $arr_response['access_token'];
            $_SESSION['user_token_time'] = time();
            $_SESSION['refresh_token'] = $arr_response['refresh_token'];

            // Save token to database
            Application::$app->db->connectSpotify($arr_response['refresh_token'], $user_id);
            $activated = Application::$app->db->getSpotifyConnection($user_id);

            $_SESSION['spotify_active'] = $activated['spotify_connected'] == 1;
            Application::$app->response->redirect('/profile');
            return;
        }
        Application::$app->response->redirect('/error');
    }

    public function spotifyConnected($request, $response)
    {
        Application::$app->checkShopifyToken();
        if (isset($_SESSION['spotify_active']) && isset($_SESSION['refresh_token']))
        {
            echo "Access Token: " . $_SESSION['access_token'];
            echo "<br>";
            echo "Refresh Token: " . $_SESSION['refresh_token'];
            echo "<br>";
            var_dump($_SESSION);
            echo "<br>";
            $activated = Application::$app->db->getSpotifyConnection($_SESSION['user']);
            var_dump($activated['spotify_connected']);
            return $this->render('spotify-connected');
        }
        var_dump($_SESSION);
//        Application::$app->response->redirect('/error');
//        return 1;
        return $this->render('spotify-connected');
    }

    private function getSpotifyProfile()
    {
        Application::$app->checkShopifyToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/me',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['user_token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

}
