<?php ?>

<head>
    <link rel="stylesheet" href="/HTML5-Audio-Player-maudio/css/maudio.css">
</head>

<body>
    <h1 class="pt-2 pb-3">Trending Songs</h1>

    <div class="row d-flex justify-content-center">


    </div>

    <!--<div class="container">-->
    <!--    <div class="row">;-->
    <!--        --><?php //foreach($params['songs']['items'] as $songs) {
//            echo "<div class='col-md-4 text-center>'";
//            echo "<div class=''>";
//            echo "<h5>".$songs['track']['name']."</h5>";
//            echo "<h5>".$songs['track']['album']['artists'][0]['name']."</h5>";
//            $source= $songs['track']['album']['images'][0]['url'];
//            echo "<img src='".$source."' height='250'>";
//            $source2 = $songs['track']['preview_url'];
//            echo "<br>";
//            echo "<video width = '250' height='75' controls=''  name='media'><source src='".$source2."' type='audio/mpeg'></video>";
//            echo "</div>";
//        }
//        ?>
    <!--    </div>-->
    <!--</div>-->

    <div class="container">
        <div class="row">
            <?php foreach ($params['songs']['items'] as $song) { ?>
            <div class="col-md-3 col-sm-6 col-12 text-center text-dark mb-2" data-aos="fade-up">
                <?php
                    $source = $song['track']['album']['images'][0]['url'];
                    $source2 = $song['track']['preview_url'];
                    $source3 = $song['track']['external_urls']['spotify'];
                ?>
                <a href="<?= $source3 ?>"><img src="<?= $source ?>" alt="Track Album Art" class=" albumimg img-fluid rounded mb-3"></a>
                <h5> <?= $song['track']['name'] ?> </h5>
                <h6 class="text-secondary"> <?= $song['track']['album']['artists'][0]['name'] ?> </h6>
                <div>
                    <audio controls>
                        <source src="<?= $source2 ?>" type="audio/mpeg">
                    </audio>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
    </script>
    <script src="HTML5-Audio-Player-maudio/js/maudio.js"></script>
    <script src="/js/playertrending.js"></script>
</body>