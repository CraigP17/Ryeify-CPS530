<?php 
    
require_once '../core/Application.php';
require_once '../core/Controller.php';
require_once '../core/Database.php';
require_once '../core/Model.php';
require_once '../core/DBModel.php';
require_once '../controllers/SiteController.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/TrendingController.php';
require_once '../models/RegisterModel.php';
require_once '../models/LoginModel.php';

//$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
//$dotenv->load();

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\TrendingController;


$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/team', [SiteController::class, 'team']);

$app->router->get('/about', [SiteController::class, 'about']);

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/trending', [TrendingController::class, 'trending']);

$app->router->get('/pasthits', [TrendingController::class, 'pasthits']);

// Spotify Login Routes
$app->router->get('/spotify-login', [AuthController::class, 'spotifyAuth']);
$app->router->get('/callback', [AuthController::class, 'spotifyCallback']);
$app->router->get('/spotify-connected', [AuthController::class, 'spotifyConnected']);

$app->router->get('/personalized', [SiteController::class, 'personalized']);

$app->run();
