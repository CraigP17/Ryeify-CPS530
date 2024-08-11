<?php ?>

<h1 class="pt-2 pb-3">Study Music</h1>

<div class="row d-flex justify-content-center">


</div>

    <?php
        foreach ($params as $playlist)
        {
    ?>
            <div class="row">
                <div class="col-12 text-center mt-2 mb-3">
                   <!-- <h2 style = "color: #848ccf"> <?= $playlist['title'] ?> </h2> -->
                    <a target="_blank" href="<?= $playlist['playlistlink'] ?>" class="study-playlist-anchor">
                        <h2 class="study-music-album">
                            <?= $playlist['title'] ?>
                        </h2>
                    </a>
                    <p><?= $playlist['about'] ?></p>
                </div>
            </div>
            <div id="<?= 'carouselExampleControls' . $playlist['order'] ?>" class="carousel slide mb-4" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div style = "padding: 0 100px" class="container">
                            <div class="row">
                                <?php for ($x = 0; $x <= 3; $x++) { ?>
                                    <div class="col-md-3 col-sm-6 col-12 text-center text-dark mb-2" data-aos="fade-up" data-aos-duration="1000">
                                        <?php
                                        $source = $playlist['songs']['items'][$x]['track']['album']['images'][0]['url'];
                                        $source2 = $playlist['songs']['items'][$x]['track']['preview_url'];
                                        $source3 = $playlist['songs']['items'][$x]['track']['external_urls']['spotify'];
                                        ?>
                                        <a href="<?= $source3 ?>" target="_blank"><img src="<?= $source ?>" alt="Track Album Art" class="albumimg img-fluid rounded mb-3"></a>
                                        <h5> <?= $playlist['songs']['items'][$x]['track']['name'] ?> </h5>
                                        <h6 class="text-secondary"> <?= $playlist['songs']['items'][$x]['track']['album']['artists'][0]['name'] ?> </h6>
                                        <div>
                                            <audio controls>
                                                <source src="<?= $source2 ?>" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>


                    </div>
                    <div class="carousel-item">
                        <div style = "padding: 0 100px" class="container">
                            <div class="row">
                                <?php for ($x = 4; $x <= 7; $x++) { ?>
                                    <div class="col-md-3 col-sm-6 col-12 text-center text-dark mb-2">
                                        <?php
                                        $source = $playlist['songs']['items'][$x]['track']['album']['images'][0]['url'];
                                        $source2 = $playlist['songs']['items'][$x]['track']['preview_url'];
                                        $source3 = $playlist['songs']['items'][$x]['track']['external_urls']['spotify'];
                                        ?>
                                        <a href="<?= $source3 ?>"><img src="<?= $source ?>" alt="Track Album Art" class="albumimg img-fluid rounded mb-3"></a>
                                        <h5> <?= $playlist['songs']['items'][$x]['track']['name'] ?> </h5>
                                        <h6 class="text-secondary"> <?= $playlist['songs']['items'][$x]['track']['album']['artists'][0]['name'] ?> </h6>
                                        <div>
                                            <audio controls>
                                                <source src="<?= $source2 ?>" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="<?= '#carouselExampleControls' . $playlist['order'] ?>" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="<?= '#carouselExampleControls' . $playlist['order'] ?>" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
    <?php } ?>
