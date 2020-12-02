<?php
/** @var $model LoginModel */

use app\models\LoginModel;

?>

<head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/loginregis.css">

</head>

<h1>Login Page</h1>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
            </div>
            <div class="card-body">
                <form action="/login" method="post">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <label for="email"></label><br>
                        <input type="text" id="email" name="email" class="form-control" placeholder="email" value="<?= $model->email ?>"
                            class="form-control <?= $model->hasError('email') ? ' is-invalid': '' ?>">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('email') ?>
                        </div>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <label for="password"></label><br>
                        <input type="password" id="password" placeholder="password" name="password" value=""
                            class="form-control <?= $model->hasError('password') ? ' is-invalid': '' ?>">
                        <div class="invalid-feedback">
                            <?= $model->getFirstError('password') ?>
                        </div>
                    </div>
                    <div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
                    <input type="submit" value="Submit" class="btn float-right login_btn">
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Don't have an account?<a href="/register">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</div>

