<?php

namespace Controllers;

class IndexController extends Controller
{
    public function index()
    {
        header ('location: http://195.154.118.169/john/unnatural/index.php?c=user&t=login');
    }
}