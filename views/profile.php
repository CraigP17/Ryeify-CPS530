<?php ?>

<!-- Profile Title -->
<div class="row">
    <div class="col-12">
        <h1 class="my-2">Profile</h1>
    </div>
</div>
<!-- End Profile Title -->

<!-- Profile Data Form -->
<!--<div class="row mb-4">-->
<!--    <div class="col-12 col-md-2 col-sm-1"></div>-->
<!--    <div class="col-12 col-md-8 col-sm-10 text-center">-->
<!--        Form-->
<!--    </div>-->
<!--    <div class="col-12 col-md-2 col-sm-1"></div>-->
<!--</div>-->
<!-- End Profile Data Form -->

<!-- Spotify Connect Account to Profile -->
<div class="row pt-0 mt-0">
    <div class="col-12 col-md-2 col-sm-1"></div>

    <div class="col-12 col-md-8 col-sm-10">
        <div class="card text-center mx-auto bg-success">
            <?php
            if (isset($params['spotify_active']) && $params['spotify_active'] == true) {
                // Connected Spotify Account
                ?>
                <div class="card-header text-white">
                    <h3 class="my-1"><i class="fab fa-spotify"></i> Your Spotify Profile </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-1 col-12"></div>
                        <div class="col-sm-3 col-12 text-center">
                            <img src="<?= $params['spotify_profile_img'] ?>" class="img-fluid rounded-circle mb-3 px-auto" id="spotify-profile-pic">
                        </div>
                        <div class="col-sm-8 col-12 text-sm-left text-center my-auto">
                            <h2 class="card-title mb-2 pb-0">
                                <?= $params['spotify_name'] ?>
                                <span class="text-secondary">(<?= $params['spotify_product'] ?>)</span>
                            </h2>
                            <h4 class="card-body p-0">
                                Followers: <?= $params['spotify_followers'] ?>
                            </h4>
                            <h4 class="card-body p-0 text-light">
                                <a href="<?= $params['spotify_account_url'] ?>" target="_blank" class="text-dark">Account</a>
                            </h4>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="card-header text-dark">
                    <h3 class="my-1 text-light"><i class="fab fa-spotify text-light"></i> Connect your Spotify Account</h3>
                </div>
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        Connecting your Spotify account to your Ryeify profile allows you to view your top artists
                        and tracks, as well as provides you personalized music recommendations.
                    </h6>
                    <a href="/spotify-login" class="btn btn-dark"><i class="fab fa-spotify"></i> Connect Account </a>
                </div>
            <?php } ?>
        </div>

    </div>

    <div class="col-12 col-md-2 col-sm-1"></div>

</div>
<!-- End Spotify Connect Account to Profile -->
