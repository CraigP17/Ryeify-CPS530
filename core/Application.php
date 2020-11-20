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

        $config = parse_ini_file('../private/config.ini');
        $this->db = new Database($config);

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

    public function login($user)
    {
        // Save user in session
        $this->user = $user;
//        $SpotifyToken = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
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
