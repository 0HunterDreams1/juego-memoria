<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PartidaModel;
use CodeIgniter\HTTP\Request;

class PartidaController extends BaseController
{
    public function __construct()
    {
        $this->partida = new PartidaModel();
    }
}