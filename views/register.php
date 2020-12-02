<?php ?>

<link rel="stylesheet" type="text/css" href="../css/loginregis.css">


<h1>Registration Page</h1>
<div class="register-container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
            <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="fname"></label><br>
                    <h6>First Name:</h6>
                    <input type="text" id="fname" name="fname" placeholder="first name" value="<?= $model->fname ?>"
                        class="form-control <?= $model->hasError('fname') ? ' is-invalid': '' ?>">
                    <div class="invalid-feedback">
                        <?= $model->getFirstError('fname') ?>
                    </div>
                </div>
                <h6>Last Name:</h6>
                <div class="input-group form-group">
                    <label for="lname"></label><br>
                    <input type="text" id="lname" name="lname" placeholder="last name" value="<?= $model->lname ?>"
                        class="form-control <?= $model->hasError('lname') ? ' is-invalid': '' ?>">
                    <div class="invalid-feedback">
                        <?= $model->getFirstError('lname') ?>
                    </div>
                </div>

                <h6>Email:</h6>
                <div class="input-group form-group">
                    <label for="email"></label><br>
                    <input type="text" id="email" name="email" placeholder="email" value="<?= $model->email ?>"
                        class="form-control <?= $model->hasError('email') ? ' is-invalid': '' ?>">
                    <div class="invalid-feedback">
                        <?= $model->getFirstError('email') ?>
                    </div>
                </div>

                <h6>Password</h6>
                <div class="input-group form-group">
                    <label for="password"></label><br>
                    <input type="password" id="password" placeholder="password" name="password" value=""
                        class="form-control <?= $model->hasError('password') ? ' is-invalid': '' ?>">
                    <div class="invalid-feedback">
                        <?= $model->getFirstError('password') ?>
                    </div>
                </div>

                <h6>Confirm Password</h6>
                <div class="input-group form-group">
                    <label for="confirmPassword"></label><br>
                    <input type="password" id="confirmPassword" placeholder="Confirm Password" name="confirmPassword" value=""
                        class="form-control <?= $model->hasError('confirmPassword') ? ' is-invalid': '' ?>">
                    <div class="invalid-feedback">
                        <?= $model->getFirstError('confirmPassword') ?>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <input type="submit" value="Submit" class="submit">
                    </div>
                </div>
             </form>
            </div>  
        </div>
    </div>
</div>


