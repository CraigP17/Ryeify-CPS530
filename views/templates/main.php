<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="author" content="Craig Pinto, Hitarth Chudgar, Homayra Mussarrat, Manpreet Rajpal">

        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/trending.css">
        <script type="text/javascript" src="/js/main.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title><?= isset($title) ? $title : "Ryeify"?></title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg sticky-top navbar-dark nav-color">
            <a class="navbar-brand" href="/">RYEIFY</a>

            <!-- Responsive Nav Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="/"> Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="/trending"> Trending Songs </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="/pasthits"> Past Hits </a>
                    </li>
                    <li class="nav-item dropdown text-center">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Personalized Spotify
                        </a>
                        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown" id="dropdown-color">
                            <a class="dropdown-item text-light dropdown-hover" href="/personalized"> Personalized </a>
                            <a class="dropdown-item text-light dropdown-hover" href="#"> Spotify 2 </a>
                            <div class="dropdown-divider"></div>
                            <!-- Use PHP to check Session or Cookie for being looged in -->
                            <!-- If logged in, display account name, else sign in button -->
                            <?php if (Application::$app->loggedIn()) {
                                echo "<p class='text-light'>". Application::$app->user->userName(). "</p>";
                            ?>
                                <a class="dropdown-item text-light dropdown-hover" href="/logout">Logout</a>
                            <?php } else {?>
                                <a class="dropdown-item text-light dropdown-hover" href="/login">Sign In</a>
                            <?php } ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="/team"> Team </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center" href="/about"> About </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid bg-dark text-light main-container">

            <div class="content pt-3">
                <?php if (Application::$app->session->getFlash('success')): ?>
                <div class="alert alert-success">
                    <?php echo Application::$app->session->getFlash('success') ?>
                </div>
                <?php endif; ?>

                {{content}}

            </div>

            <footer class="footer">
                <div class="row no-gutters text-center text-secondary mt-3">
                    <div class="col-12">
                        <hr style="color: ghostwhite">
                    </div>
                    <div class="col-12 d-none d-md-block">
                        <p class="mb-0">&#169; 2020 RYEIFY. Made for CPS530 at Ryerson University.</p>
                    </div>
                    <div class="col-md-6 d-block d-md-none text-center">
                        <p class="mb-0">&#169; 2020 RYEIFY.</p>
                    </div>
                    <div class="col-md-6 d-block d-md-none text-center">
                        <p class="pl-md-1"> Made for CPS530 at Ryerson University.</p>
                    </div>
                </div>
            </footer>

        </div>


        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
