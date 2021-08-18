<?php

namespace App\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home/index');
    }
}