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
        $this->render('trending', $data);
    }
}