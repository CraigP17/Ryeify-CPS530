<?php


namespace app\controllers;

use app\core\Controller;
use app\models\LoginModel;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login($request, $response)
    {
        $loginForm = new LoginModel();
        if ($_POST)
        {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login())
            {
                $response->redirect('/');
                return 0;
            }
        }
        // GET request
        // return login view
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function logout($request, $response)
    {
        \Application::$app->logout();
        $response->redirect('/');
    }

    public function register($request)
    {
        $registerModel = new RegisterModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register())
            {
                \Application::$app->session->setFlash('success', 'Thanks for registering!');
                \Application::$app->response->redirect('/');
                return 0;
            }

            return $this->render('register', [
                'model' => $registerModel
            ]);
        }
        // GET request
        // return register view
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
}
