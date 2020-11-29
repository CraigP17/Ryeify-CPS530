<?php


namespace app\controllers;


use app\core\Controller;

class TrendingController extends Controller
{
    public function trending()
    {

        \Application::$app->checkShopifyToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/playlists/37i9dQZEVXbKj23U1GF4IR/tracks?limits=20',
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


       // echo "<pre>";
       // var_dump($decoded);
       // echo "</pre>";




        $params = [
           'songs' => $decoded

        ];
       return $this->render('trending', $params);
    }

    public function pasthits()
    {
        \Application::$app->checkShopifyToken();
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


       // echo "<pre>";
       // var_dump($decoded);
       // echo "</pre>";




        $params = [
            'songs' => $decoded

        ];

        return $this->render('pasthits', $params);
    }
}