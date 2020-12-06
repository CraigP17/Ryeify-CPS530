<?php
/** @var $model RegisterModel */

use app\models\RegisterModel;

// Requires $model (RegisterModel) to be passed to view,
// in order to verify user inputs

?>

<!--<link rel="stylesheet" type="text/css" href="../css/loginregis.css">-->

<div class="row text-dark no-gutters my-0 py-0">
    <div class="col-12 text-center">
        <h1 class="mb-4">Registration</h1>
    </div>
</div>

<div class="row no-gutter text-dark">
    <div class="col-12 col-lg-4 col-md-5 col-sm-8 mx-auto px-0">
        <div class="card m-0">

            <div class="card-header text-center p-2">
                <h3 class="mb-0">Register</h3>
            </div>

            <div class="card-body">
                <form action="/register" method="post">

                    <!-- First Name -->
                    <label for="fname">First Name:</label>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="fname" name="fname" placeholder="First Name"
                               value="<?= $model->fname ?>"
                               class="form-control <?= $model->hasError('fname') ? ' is-invalid': '' ?>"
                               style = "border-radius: 0">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('fname') ?>
                        </div>
                    </div>

                    <!-- last Name -->
                    <label for="lname">Last Name:</label>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="lname" name="lname" placeholder="Last Name"
                               value="<?= $model->lname ?>"
                               class="form-control <?= $model->hasError('lname') ? ' is-invalid': '' ?>"
                               style = "border-radius: 0">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('lname') ?>
                        </div>
                    </div>

                    <!-- Email -->
                    <label for="email">Email: </label>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="text" id="email" name="email" placeholder="email@email.ca"
                               value="<?= $model->email ?>"
                               class="form-control <?= $model->hasError('email') ? ' is-invalid': '' ?>">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('email') ?>
                        </div>
                    </div>

                    <!-- Password -->
                    <label for="password">Password</label>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" id="password" placeholder="Password" name="password" value=""
                               class="form-control <?= $model->hasError('password') ? ' is-invalid': '' ?>">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('password') ?>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" id="confirmPassword" placeholder="Confirm Password"
                               name="confirmPassword" value=""
                               class="form-control <?= $model->hasError('confirmPassword') ? ' is-invalid': '' ?>">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('confirmPassword') ?>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="input-group form-group justify-content-center mb-0">
                        <input type="submit" value="Register" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
