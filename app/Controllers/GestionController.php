<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PartidaModel;
use App\Models\EstadoPartidaModel;

class GestionController extends BaseController
{
    protected $request;
    public function __construct()
    {
        helper('url');
        $this->session = session();
        $this->partida = new PartidaModel();
        $this->estadoPartida = new EstadoPartidaModel();
    }
    
    public function index()
    {
        if (isset($this->session->idUsuario)) {
            $idUsuario = $this->session->idUsuario;
            $ultimaPartida=$this->partida->buscarUltimaPartida($idUsuario);
            if(isset($ultimaPartida)){
                $datos = [
                    'ultimaPartida' => $ultimaPartida,
                    'estadoPartida' => $this->estadoPartida->buscarEstadoPartida($ultimaPartida['idEstadoPartida'])
                ];
                echo view('index', $datos);
            }else{
                echo view('index');
            }
        } else {
            return redirect()->to(base_url());
        }
        
    }
    public function mostrarRegistro()
    {
        echo view('register');
    }
}
