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

    public function personalized()
    {
        $params = [
            'title' => 'Home',
            'song' => 'Song1',
            'tracks' => ['track1' => 'track']
        ];
        return $this->render('personalized', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function handleContact($request)
    {
        $body = $request->getBody();
        var_dump($body);
        return 'Handling Content';
    }
}
