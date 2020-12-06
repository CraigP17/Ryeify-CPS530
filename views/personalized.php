<?php ?>

<div class="row">

    <?php
        if (!$params['connected'])
        {
            // If User is logged in and connected, display their top tracks
            // Else display option to connect to Spotify and display our top tracks
    ?>
            <div class="col-12">
                <h1 class="pt-2 pb-3">Personalized Favourites</h1>
            </div>

            <div class="col-12 col-md-2 col-sm-1"></div>
            <div class="col-12 col-md-8 col-sm-10 mb-4">
                <div class="card text-center mx-auto bg-success mt-0">
                    <div class="card-header text-dark">
                        <h3 class="my-1"><i class="fab fa-spotify"></i> Connect your Spotify Account</h3>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title mb-3 text-dark">
                            <b>You haven't connected to Spotify yet!</b>
                            Connecting your Spotify account to your Ryeify profile allows you to view your top artists
                            and tracks.
                            <b>Until then, here's our top tracks and artists to listen to.</b>
                        </h6>
                        <a href="/profile" class="btn btn-dark"><i class="fab fa-spotify"></i> Profile </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-2 col-sm-1"></div>
    <?php } ?>


    <?php
        if ($params['connected']) {
    ?>
        <div class="col-12">
            <h1 class="pt-2 pb-3 user-heading">Your Favourite Tracks</h1>
        </div>
    <?php } else { ?>
        <div class="col-12">
            <h1 class="pt-2 pb-3 user-heading">Our Favourite Tracks</h1>
        </div>
    <?php } ?>

    <div class="col-12 col-md-1"></div>
    <div class="col-12 col-md-10 personalized-albums">
        <div class="row">
            <?php foreach($params['tracks']['items'] as $tracks) { ?>
                <div class="col-md-3 col-sm-6 col-12 text-center text-dark mb-4">
                    <?php
                        $albumCover = $tracks['album']['images'][0]['url'];
                        $preview = $tracks['preview_url'];
                    ?>
                    <img src="<?= $albumCover ?>" class="img-fluid rounded mb-3" alt="<?= $tracks['album']['name'] ?> Album Cover">
                    <h5> <?= $tracks['name'] ?> </h5>
                    <h6 class="text-secondary"><?= $tracks['album']['artists'][0]['name']?> </h6>
                    <div>
                        <audio controls>
                            <source src="<?= $preview ?>" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-12 col-md-1"></div>

</div>
