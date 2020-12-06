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
        // Use midi layout because it does not require the audio player stylesheet that is loaded on every page
        $this->layout = 'midi';
        return $this->render('midi');
    }
    
    public function lyrics()
    {
        return $this->render('lyrics');
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
