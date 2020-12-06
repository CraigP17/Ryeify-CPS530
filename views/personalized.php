<?php ?>

<div class="row">

    <div class="col-12">
        <h1 class="pt-2 pb-3 user-heading">Your Favourite Tracks</h1>
    </div>

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
                    <h5> <?= $tracks['album']['name'] ?> </h5>
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
