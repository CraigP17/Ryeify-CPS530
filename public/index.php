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

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\TrendingController;
echo 'Testing';
$app = new Application(dirname(__DIR__));

// ROUTES

// Static Routes
// SiteController
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/midi', [SiteController::class, 'midi']);
$app->router->get('/lyrics', [SiteController::class, 'lyrics']);
$app->router->get('/team', [SiteController::class, 'team']);
$app->router->get('/about', [SiteController::class, 'about']);

// Error page
$app->router->get('/error', [SiteController::class, 'error']);

// AuthController for login/registration and personalized spotify endpoints

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

// Personalized Spotify Route
$app->router->get('/personalized', [AuthController::class, 'personalized']);
$app->router->get('/recommendations', [AuthController::class, 'recommendations']);

// User Profile Page
$app->router->get('/profile', [AuthController::class, 'profile']);

// Spotify Login Routes for OAuth2
$app->router->get('/spotify-login', [AuthController::class, 'spotifyAuth']);
$app->router->get('/callback', [AuthController::class, 'spotifyCallback']);

// TrendingController
// For trending music and study music
$app->router->get('/trending', [TrendingController::class, 'trending']);
$app->router->get('/study-music', [TrendingController::class, 'study']);

$app->run();
