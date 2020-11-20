<?php

require_once 'core/Application.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'core/Model.php';
require_once 'controllers/SiteController.php';
require_once 'controllers/AuthController.php';
require_once 'models/RegisterModel.php';

//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

use app\controllers\AuthController;
use app\controllers\SiteController;

$app = new Application(__DIR__);

$app->db->applyMigrations();
