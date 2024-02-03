<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class LoginController extends BaseController
{
    public function __construct(){
        helper('url');
    }
    public function index()
    {
        echo view('login');
    }
   
}
