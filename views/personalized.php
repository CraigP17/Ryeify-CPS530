<?php ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h1>Personalized Page for Logged In User</h1>
<p>Hello User</p>

<?php foreach($params['tracks']['items'] as $tracks) {
    echo '<div class="personalized-albums">';
    $albumCover = $tracks['album']['images'][0]['url'];
    echo "<img src='".$albumCover."' height = '640'>";
    echo "<h5>".$tracks['album']['name']."</h5>";
    echo "<h5>".$tracks['album']['artists'][0]['name']."</h5>";
    echo '</div>';
} ?>
