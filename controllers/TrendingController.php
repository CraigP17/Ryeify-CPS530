<?php


namespace app\controllers;


use app\core\Controller;
use Application;

class TrendingController extends Controller
{
    // ===== TrendingController is used for trending and study music pages, uses Spotify API =====


    /**
     * /trending
     * Uses the Spotify API to find the top 40 trending songs
     *
     * @return string|string[]
     */
    public function trending()
    {

        Application::$app->checkShopifyToken();

        // Makes cURL request to Spotify API
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/playlists/37i9dQZEVXbKj23U1GF4IR/tracks?limit=40',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['access_token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $decoded = json_decode($response, true);

        $params = [
           'songs' => $decoded
        ];
        return $this->render('trending', $params);
    }

    /**
     * /pasthits
     * Uses the Spotify API to query songs from Study Music Playlists
     *
     * @return string|string[]
     */
    public function pasthits()
    {
        Application::$app->checkShopifyToken();

        // Lo-Fi Study Beats
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/playlists/37i9dQZF1DX8Uebhn9wzrS/tracks?limits=10',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['access_token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $decoded = json_decode($response, true);

        // Deep Focus Music
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/playlists/37i9dQZF1DWZeKCadgRdKQ/tracks?limits=10',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['access_token']
            ),
        ));
        $response = curl_exec($curl1);
        curl_close($curl1);
        $decoded1 = json_decode($response, true);

        // All Nighter Music
        $curl2 = curl_init();
        curl_setopt_array($curl2, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/playlists/37i9dQZF1DX692WcMwL2yW/tracks?limits=10',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['access_token']
            ),
        ));
        $response = curl_exec($curl2);
        curl_close($curl2);
        $decoded2 = json_decode($response, true);

        // Brain Food Playlist
        $curl3 = curl_init();
        curl_setopt_array($curl3, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/playlists/37i9dQZF1DWXLeA8Omikj7/tracks?limits=10',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['access_token']
            ),
        ));
        $response = curl_exec($curl3);
        curl_close($curl3);
        $decoded3 = json_decode($response, true);

        // Combine Playlist tracks to pass $params to /pasthits view
        $params = array();
        $params[] = array('title' => 'Lofi Study Beats',
                          'about' => 'This playlist offers chill study beats to relax to.',
                          'playlistlink' => 'https://open.spotify.com/playlist/37i9dQZF1DX8Uebhn9wzrS?si=xVwyMszdSw2oa1m6rTQzvg',
                          'order' => '1',
                          'songs' => $decoded);
        $params[] = array('title' => 'Deep Focus Music',
                          'about' => 'This playlist offers music that allows you to deeply focus on your studies.',
                          'playlistlink' => 'https://open.spotify.com/playlist/37i9dQZF1DWZeKCadgRdKQ?si=K5aasHI8TEGdOtbWAVgLpA',
                          'order' => '2',
                          'songs' => $decoded1);
        $params[] = array('title' => 'All Nighter Music',
                          'about' => 'Up all night and need a little boost to keep you going? Stay focused with these electronic and trap beats!',
                          'playlistlink' => 'https://open.spotify.com/playlist/37i9dQZF1DX692WcMwL2yW?si=MAnLXtqUTB6WrfByN1X1FA',
                          'order' => '3',
                          'songs' => $decoded2);
        $params[] = array('title' => 'Brain Food',
                          'about' => 'Feed your brain with hypnotic electronic beats for studies and a relaxing time.',
                          'playlistlink' => 'https://open.spotify.com/playlist/37i9dQZF1DWXLeA8Omikj7?si=sRuJavKERWmrVsBljehY5g',
                          'order' => '4',
                          'songs' => $decoded3);

        return $this->render('pasthits', $params);
    }
}