<?php ?>

<!--<h3>Welcome <?php if (Application::$app->loggedIn()) {
        echo Application::$app->user->userName(); } ?>



<div class="row">
    <div class="col-md-4 col-12"><p>Hello <?php echo $params['title']?></p></div>
    <div class="col-md-4 col-12"><p> <?php echo $params['song']?></p></div>
    <div class="col-md-4 col-12"><p> <?php echo $params['songTitle']?></p></div>
</div>-->

<div class="row mt-0 pb-5">
    <div class="col-12 px-1">
        <div class="text-center">
            <img src="/img/landing.png" class="img-fluid centred animate__animated animate__fadeInDown" id="dropdownimg"
                 alt="Person 3D">
            <h1 class="my-3 img-fluid centred animate__animated animate__fadeInDown" id="home">Ryeify</h1>
            <h4>A new way to discover and interact with Music.</h4>
            <h4 class="mt-2 mb-3">Check out our features!</h4>
            <div id="scroll-button">
                <i class="fas fa-arrow-circle-down fa-2x"></i>
            </div>
        </div>
    </div>
</div>

<div id="goto" class="row mt-5 pt-5">
    <div class="col-sm">
        <div class="card">
            <img class="card-img-top" src="/img/midi.jpg" alt="Card image cap">
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
            <img class="card-img-top img-fluid" src="/img/trending.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Trending Music</h5>
                <p class="card-text">Want to know the latest songs that are trending around the globe? We have you covered with a bonus 30 seconds preview! All retrieved from accurate Spotify API Data</p>
                <a href="#" class="btn btn-primary">Discover Trending Music</a>
            </div>
        </div>
    </div>
</div>

<div id="goto" class="row mt-5 pt-5" data-aos="fade-up">
    <div class="col-sm">
        <div class="card">
            <img class="card-img-top" src="/img/lyricsearch.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Lyric Search</h5>
                <p class="card-text">Ever listen to that one song that you really like but somehow manage to forget the lyrics? We have you covered with our simple yet efficient lyric search app</p>
                <a href="#" class="btn btn-primary">Find Lyrics</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card">
            <img class="card-img-top img-fluid" src="/img/studymusic.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Study Music</h5>
                <p class="card-text">Exam season can get stressful, but we have your back by curating the best spotify playlist to help you study and unwind. A 30 seconds sneak peek makes it even better</p>
                <a href="#" class="btn btn-primary">Relax with Study Music</a>
            </div>
        </div>
    </div>
</div>

<div id="goto" class="row mt-5 pt-5" data-aos="fade-up">
    <div class="col-sm">
        <div class="card">
            <img class="card-img-top" src="/img/personalized.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Personalized Spotify</h5>
                <p class="card-text">Want a more personalized feel by fetching your trends from Spotify? We have a feature just for that! Learn more by clicking the button below</p>
                <a href="#" class="btn btn-primary">Tailor Experience</a>
            </div>
        </div>
    </div>
    <div class="col-sm" style="opacity : 0">
        <div class="card">
            <img class="card-img-top img-fluid" src="/img/studymusic.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Study Music</h5>
                <p class="card-text">Exam season can get stressful, but we have your back by curating the best spotify playlist to help you study and unwind. A 30 seconds sneak peek makes it even better</p>
                <a href="#" class="btn btn-primary">Relax with Study Music</a>
            </div>
        </div>
    </div>
</div>
