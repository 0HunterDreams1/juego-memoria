<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartaModel;
use CodeIgniter\HTTP\Request;

class CartaController extends BaseController
{
    public function __construct()
    {
        $this->carta = new CartaModel();
    }
}