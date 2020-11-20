<?php ?>

<h1>Home Page</h1>
<h3>Welcome <?php if (Application::$app->loggedIn()) {
        echo Application::$app->user->userName(); } ?>



    <div class="row">
        <div class="col-md-4 col-12"><p>Hello <?php echo $params['title']?></p></div>
        <div class="col-md-4 col-12"><p> <?php echo $params['song']?></p></div>
        <div class="col-md-4 col-12"><p> <?php echo $params['songTitle']?></p></div>

    </div>
