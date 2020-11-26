<?php

    // Tests Spotify Connection
    // Send Client ID and Secret to Spotify to receive a Bearer Token
    // Uses Token to Request top new release song on Spotify

    $config = [
        'client_id' => '',
        'client_secret' => ''
    ];

    // Initialize cURL Session
    $curl_init = curl_init();

    // Get Shopify API Bearer Token
    curl_setopt_array($curl_init, array(
        CURLOPT_URL => "https://accounts.spotify.com/api/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic " . base64_encode($config['client_id'] . ":" .  $config['client_secret']),
            "Content-Type: application/x-www-form-urlencoded"
        ),
    ));

    $token_json = curl_exec($curl_init);
    $token_response = json_decode($token_json, true);
    curl_close($curl_init);

    echo "Bearer Token: ";
    var_dump($token_json);

    echo "<br><br>";
    // Requests Top New Release Song from Spotify

    $curl_spotify = curl_init();

    curl_setopt_array($curl_spotify, array(
        CURLOPT_URL => "https://api.spotify.com/v1/browse/new-releases?country=CA&limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer " . $token_response['access_token']
        ),
    ));

    $new_releases = curl_exec($curl_spotify);
    $new_release_response = json_decode($new_releases, true);
    curl_close($curl_spotify);

    echo "Top New Release: ";
    echo '<pre>';
    var_dump($new_release_response);
    echo '</pre>';

    exit;
?>
