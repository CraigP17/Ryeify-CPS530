<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    // ===== SiteController is used for static pages, with methods for each endpoint =====

    /**
     * /home
     * Home page
     *
     * @return string|string[]
     */
    public function home()
    {
        return $this->render('home');
    }

    /**
     * /about
     * About Page
     *
     * @return string|string[]
     */
    public function about()
    {
        return $this->render('about');
    }

    /**
     * /team
     * Team Page
     *
     * @return string|string[]
     */
    public function team()
    {
        return $this->render('team');
    }

    /**
     * /midi
     * Midi Piano Page
     *
     * @return string|string[]
     */
    public function midi()
    {
        // Use midi layout because it does not require the audio player stylesheet that is loaded on every page
        $this->layout = 'midi';
        return $this->render('midi');
    }

    /**
     * /lyrics
     * Lyrics Searcher Page
     *
     * @return string|string[]
     */
    public function lyrics()
    {
        return $this->render('lyrics');
    }

    /**
     * /error
     * Error 404 Page
     *
     * @return string|string[]
     */
    public function error()
    {
        return $this->render('error404');
    }

}
