<?php ?>

<div class="row">
    <div class="col-12">
        <h1 class="pt-2 mb-4">Made For You</h1>
    </div>
    <?php
    if (!$params['connected'])
    {
        // If User is logged in and connected, display their top tracks
        // Else display option to connect to Spotify and display our top tracks
        ?>
        <div class="col-12 col-md-2 col-sm-1"></div>
        <div class="col-12 col-md-8 col-sm-10 mb-4">
            <div class="card text-center mx-auto bg-success mt-0">
                <div class="card-header text-dark">
                    <h3 class="my-1 text-light"><i class="fab fa-spotify"></i> Connect your Spotify Account</h3>
                </div>
                <div class="card-body">
                    <h6 class="card-title mb-3 text-light">
                        <b>You haven't connected to Spotify yet!</b>
                        Connecting your Spotify account to your Ryeify profile allows you to view recommended music
                        catered by your favourite genres and artists
                        <b>Until then, here's our favourite genres and artists to listen to.</b>
                    </h6>
                    <a href="/profile" class="btn btn-dark"><i class="fab fa-spotify"></i> Profile </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2 col-sm-1"></div>
        <div class="col-12">
            <h1 class="pt-2 mt-3 mb-3">Our Favourites</h1>
        </div>
    <?php } ?>

    <!--  Buttons to Scroll to Different Sections (Genres and Artists)  -->
    <div class="col-12 text-center pb-4 mb-4">
        <h2 class="title-color">
            <?php foreach ($params['music'] as $type => $playlists) { ?>
                <button type="button" class="btn btn-info" id="<?=$type?>-button">
                    <?= $type ?>
                </button>
            <?php } ?>
        </h2>
    </div>

    <div class="col-12 col-md-1"></div>
    <div class="col-12 col-md-10 personalized-albums">
        <div class="row">
            <!-- Iterate through 'music', either genres or artists playlists -->
            <?php foreach ($params['music'] as $type => $playlists) { ?>
                <div class="col-12 mt-4" id="<?=$type?>-section">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="mb-4"><?= $type ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-10 mx-auto">
                            <!-- Iterate through playlist, for 1 genre in list of genres, or per artist -->
                            <?php foreach($playlists as $p_name => $p_tracks) { ?>
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="study-music-album text-center mb-4">
                                            <b><?= $p_name ?></b>
                                        </h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Iterate through tracks, per genre or per artist -->
                                    <?php foreach ($p_tracks['tracks'] as $tracks) {?>
                                        <div class="col-md-3 col-sm-6 col-12 text-center text-dark mb-4">
                                            <?php
                                                $external = $tracks['external_urls']['spotify'];
                                                $albumCover = $tracks['album']['images'][0]['url'];
                                                $preview = $tracks['preview_url'];
                                            ?>
                                            <a href="<?= $external ?>" target="_blank">
                                                <img src="<?= $albumCover ?>"
                                                     class="cover-art img-fluid rounded mb-3"
                                                     alt="<?= $tracks['album']['name'] ?> Album Cover">
                                            </a>
                                            <h5>
                                                <?= $tracks['name'] ?>
                                            </h5>
                                            <h6 class="text-secondary">
                                                <?= $tracks['album']['artists'][0]['name']?>
                                            </h6>
                                            <div>
                                                <audio controls>
                                                    <source src="<?= $preview ?>" type="audio/mpeg">
                                                </audio>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="col-12 col-md-1"></div>
</div>
