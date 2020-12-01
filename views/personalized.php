<?php ?>

<head>
    <link rel="stylesheet" href="/HTML5-Audio-Player-maudio/css/maudio.css">
</head>


<body>

    <h1 class="pt-2 pb-3 user-heading">Your Favourite Tracks</h1>

    <div class="container personalized-albums">
        <div class="row">
            <?php foreach($params['tracks']['items'] as $tracks) { ?>
            <div class="col-md-3 col-sm-6 col-12 text-center text-dark mb-2">
            <?php
                $albumCover = $tracks['album']['images'][0]['url'];
                $preview = $tracks[0]['preview_url']; 
            ?>
            <img src="<?= $albumCover ?>" class="img-fluid rounded mb-3">
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
    </script>
    <script src="HTML5-Audio-Player-maudio/js/maudio.js"></script>
    <script src="/js/playertrending.js"></script>
    
</body>
