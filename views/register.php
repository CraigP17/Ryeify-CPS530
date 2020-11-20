<?php ?>

<h1>Registration Page</h1>

<form action="" method="post">
    <div class="form-group">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" value="<?= $model->fname ?>"
               class="form-control <?= $model->hasError('fname') ? ' is-invalid': '' ?>">
        <div class="invalid-feedback">
            <?= $model->getFirstError('fname') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" value="<?= $model->lname ?>"
               class="form-control <?= $model->hasError('lname') ? ' is-invalid': '' ?>">
        <div class="invalid-feedback">
            <?= $model->getFirstError('lname') ?>
        </div>
    </div>

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

    <div class="form-group">
        <label for="confirmPassword">Confirm Password:</label><br>
        <input type="password" id="confirmPassword" name="confirmPassword" value=""
               class="form-control <?= $model->hasError('confirmPassword') ? ' is-invalid': '' ?>">
        <div class="invalid-feedback">
            <?= $model->getFirstError('confirmPassword') ?>
        </div>
    </div>

    <br><br>

    <input type="submit" value="Submit">
</form>


