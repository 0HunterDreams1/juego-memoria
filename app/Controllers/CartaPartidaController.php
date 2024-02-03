<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartaPartidaModel;
use CodeIgniter\HTTP\Request;

class CartaPartidaController extends BaseController
{
    public function __construct()
    {
        $this->cartaPartida = new CartaPartidaModel();
    }
}