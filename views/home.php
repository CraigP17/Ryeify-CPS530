<?php ?>

<!--<h3>Welcome <?php if (Application::$app->loggedIn()) {
        echo Application::$app->user->userName(); } ?>



<div class="row">
    <div class="col-md-4 col-12"><p>Hello <?php echo $params['title']?></p></div>
    <div class="col-md-4 col-12"><p> <?php echo $params['song']?></p></div>
    <div class="col-md-4 col-12"><p> <?php echo $params['songTitle']?></p></div>
</div>-->

<div class="text-center">
    <img src="/img/landing.png" class="img-fluid centred animate__animated animate__fadeInDown" width="400"
        alt="Person 3D">
    <h2>A new way to discover and interact with Music.</h2>
    <h3>Check out our features!</h3>
    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="25" height="25">
            <path fill="white" fill-rule="evenodd"
                d="M13.03 8.22a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06 0L3.47 9.28a.75.75 0 011.06-1.06l2.97 2.97V3.75a.75.75 0 011.5 0v7.44l2.97-2.97a.75.75 0 011.06 0z">
            </path>
        </svg></a>
</div>
<div id="goto" class="row">
    <div class="col-sm">
        <div class="card">
            <img class="card-img-top" src="/img/midi.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Midi Piano</h5>
                <p class="card-text">Bring out your inner musician and fuel those ideas into the midi inspired piano
                    which gives you a whole octave to play and experiment with ideas and notes</p>
                <a href="#" class="btn btn-primary">Play Some Notes</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card">
            <img class="card-img-top img-fluid" src="/img/trending.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Trending Music</h5>
                <p class="card-text">Want to know the latest songs that are trending around the globe? We have you covered with a bonus 30 seconds preview! All retrieved from accurate Spotify API Data</p>
                <a href="#" class="btn btn-primary">Discover Trending Music</a>
            </div>
        </div>
    </div>
</div>