<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstadoPartidaModel;
use CodeIgniter\HTTP\Request;

class EstadoPartidaController extends BaseController
{
    public function __construct()
    {
        $this->estadoPartida = new EstadoPartidaModel();
    }
}