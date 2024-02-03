<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DificultadModel;
use CodeIgniter\HTTP\Request;

class DificultadController extends BaseController
{
    public function __construct()
    {
        $this->dificultad = new DificultadModel();
    }
}