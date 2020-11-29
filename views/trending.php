<?php ?>

<div class="container">
<h1>Trending Songs</h1>
<div class="row d-flex justify-content-center">

<!--  TESTING
<h1><?php echo $params['songs']['items'][0]['track']['name']; ?></h1>
<h1><?php echo $params['songs']['items'][0]['track']['album']['artists'][0]['name']; ?></h1>
<img src="<?php echo $params['songs']['items'][0]['track']['album']['images'][0]['url']; ?>"  height="300px">
<img src="<?php echo $params['tracks']['items'][0]['album']['images'][0]['url']; ?>"  height="300px">
-->

echo"<div class = 'row'>";
    <?php foreach($params['songs']['items'] as $songs){
        echo'<div class = “col-md-3”>';
        echo '<div class = "trending-div">';
            echo "<h5>".$songs['track']['name']."</h5>";
            echo "<h5>".$songs['track']['album']['artists'][0]['name']."</h5>";
            $source= $songs['track']['album']['images'][0]['url'];
            echo "<img src='".$source."' height='250'>";
        $source2 = $songs['track']['preview_url'];
        echo "<br>";
        echo "<video width = '250' height='75' controls=''  name='media'><source src='".$source2."' type='audio/mpeg'></video>";
        echo '</div>';
    } ?>
</div>
</div>
