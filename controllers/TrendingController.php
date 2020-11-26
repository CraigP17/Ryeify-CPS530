<?php


namespace app\controllers;


use app\core\Controller;

class TrendingController extends Controller
{
    public function trending()
    {
        $data = [
           'songs' => 'data'
        ];
       return $this->render('trending', $data);
    }

    public function pasthits()
    {
        return $this->render('pasthits');
    }
}