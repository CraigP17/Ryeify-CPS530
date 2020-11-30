<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="author" content="Hitarth Chudgar, Homayra Mussarrat, Craig Pinto, Manpreet Rajpal">

        <link rel="stylesheet" href="/css/main.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <title><?= isset($title) ? $title : "PROJECT NAME"?></title>
    </head>
    <body>
        
        <nav class="site-header navbar navbar-expand-lg sticky-top navbar-dark nav-color">
            <a class="navbar-brand" href="#">
                <img src="/public/img/ryeify-logo.png" alt="Ryeify Logo">
            </a>
            
            <!-- Responsive Nav Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="#"> Home </a>
                    </li>
                    <li class="nav-item dropdown text-center">
                        <a class="nav-link text-light text-center" href="#"> Midi </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="#"> Trending Songs </a>
                    </li>
                    <li class="nav-item dropdown text-center">
                        <a class="nav-link text-light text-center" href="#"> Lyrics </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="#"> Past Hits </a>
                    </li>
                    <li class="nav-item dropdown text-center">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Personalized Spotify
                        </a>
                        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown" id="dropdown-color">
                            <a class="dropdown-item text-light dropdown-hover" href="#"> Spotify 1 </a>
                            <a class="dropdown-item text-light dropdown-hover" href="#"> Spotify 2 </a>
                            <div class="dropdown-divider"></div>
                            <!-- Use PHP to check Session or Cookie for being looged in -->
                            <!-- If logged in, display account name, else sign in button -->
                            <a class="dropdown-item text-light dropdown-hover" href="#">Sign In CookieCheck</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="#"> Team </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="#"> About </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="container-fluid text-light main-container">
            
            <div class="content pt-3">
