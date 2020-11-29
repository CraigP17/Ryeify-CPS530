<?php ?>

<<<<<<< HEAD
<div class="container">
<h1>Trending Songs</h1>
=======
<h1 class="pt-2 pb-3">Trending Songs</h1>

>>>>>>> b5b434c2e315ce182be5b042d2d811bde8c0649a
<div class="row d-flex justify-content-center">

    <!--  TESTING
<h1><?php echo $params['songs']['items'][0]['track']['name']; ?></h1>
<h1><?php echo $params['songs']['items'][0]['track']['album']['artists'][0]['name']; ?></h1>
<img src="<?php echo $params['songs']['items'][0]['track']['album']['images'][0]['url']; ?>"  height="300px">
<img src="<?php echo $params['tracks']['items'][0]['album']['images'][0]['url']; ?>"  height="300px">
-->
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
            <div class="col-md-3 col-sm-6 col-12 text-center text-dark mb-2">
                <?php
                    $source = $song['track']['album']['images'][0]['url'];
                    $source2 = $song['track']['preview_url'];
                ?>
                <img src="<?= $source ?>" alt="Track Album Cover" class="img-fluid rounded mb-3">
                <h5> <?= $song['track']['name'] ?> </h5>
                <h6 class="text-secondary"> <?= $song['track']['album']['artists'][0]['name'] ?> </h6>
                <div>
                    <video width="250" height="75" controls="">
                        <source src="<?= $source2 ?>" type="audio/mpeg">
                    </video>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<<<<<<< HEAD
</div>
=======

>>>>>>> b5b434c2e315ce182be5b042d2d811bde8c0649a
