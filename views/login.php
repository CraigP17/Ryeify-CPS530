<?php
/** @var $model LoginModel */

// Uses the LoginModel to verify email and password of the user by making calls to the DB
use app\models\LoginModel;

?>

<!--<head>-->
<!--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"-->
<!--        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" type="text/css" href="../css/loginregis.css">-->
<!--</head>-->

<div class="row text-dark no-gutters my-0 py-0">
    <div class="col-12 text-center">
        <h1 class="mb-4">Login</h1>
    </div>
</div>

<div class="row no-gutter text-dark">
    <div class="col-12 col-md-5 col-sm-8 mx-auto px-0">
        <div class="card m-0">

            <div class="card-header text-center p-2">
                <h3 class="mb-0">Sign In</h3>
            </div>

            <div class="card-body">
                <form action="/login" method="post">

                    <!-- Email -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <label for="email"></label><br>
                        <input type="text" id="email" name="email" placeholder="email@email.ca"
                               value="<?= $model->email ?>"
                               class="form-control <?= $model->hasError('email') ? ' is-invalid': '' ?>">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('email') ?>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <label for="password"></label><br>
                        <input type="password" id="password" name="password" placeholder="Password"
                               value=""
                               class="form-control <?= $model->hasError('password') ? ' is-invalid': '' ?>">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('password') ?>
                        </div>
                    </div>

                    <!-- Remember -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <!-- Submit -->
                    <div class="input-group form-group justify-content-center mb-0">
                        <input type="submit" value="Log In" class="btn btn-info">
                    </div>
                </form>
            </div>

            <div class="card-footer text-dark text-center">
                Don't have an account? <a href="/register">Sign Up</a>
            </div>

        </div>
    </div>
</div>