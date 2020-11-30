<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $data = "Spotify";
        $params = [
            'title' => 'Home',
            'song' => 'Song1',
            'songTitle' => $data
        ];
        return $this->render('home', $params);
    }

    public function about()
    {
        return $this->render('about');
    }

    public function team()
    {
        return $this->render('team');
    }

    public function midi()
    {
        return $this->render('midi');
    }
    
    public function lyrics()
    {
        return $this->render('lyrics');
    }

    public function personalized()
    {
        $tracks_json = file_get_contents("../temp-json/tracks.json");
        $tracks = json_decode($tracks_json, true);
        $artists_json = file_get_contents("../temp-json/artists.json");
        $artists = json_decode($artists_json, true);
        $params = [
            'tracks' => $tracks,
            'artists' => $artists
        ];
        var_dump($tracks['items'][0]['name'], $tracks['items'][0]['artists'][0]['name'], $tracks['items'][0]['album']['name']);
        echo '<br>';
        var_dump($artists['items'][0]['name'], $artists['items'][0]['genres']);
        return $this->render('personalized', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function error()
    {
        return $this->render('error404');
    }

    public function handleContact($request)
    {
        $body = $request->getBody();
        var_dump($body);
        return 'Handling Content';
    }
}
