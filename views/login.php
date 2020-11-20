<?php
/** @var $model LoginModel */

use app\models\LoginModel;

?>

<h1>Login Page</h1>

<form action="/login" method="post">
    <div class="form-group">
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?= $model->email ?>"
               class="form-control <?= $model->hasError('email') ? ' is-invalid': '' ?>">
        <div class="invalid-feedback">
            <?= $model->getFirstError('email') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value=""
               class="form-control <?= $model->hasError('password') ? ' is-invalid': '' ?>">
        <div class="invalid-feedback">
            <?= $model->getFirstError('password') ?>
        </div>
    </div>

    <input type="submit" value="Submit">
</form>
<br>
<a href="/register" class="btn btn-secondary">Register</a>

