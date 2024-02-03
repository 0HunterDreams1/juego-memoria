<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\PartidaModel;
use App\Models\EstadoPartidaModel;
use App\Models\DificultadModel;
use App\Models\CartaModel;
use App\Models\CartaPartidaModel;
use CodeIgniter\HTTP\Request;
use CodeIgniter\I18n\Time;

class GestionController extends BaseController
{
    protected $request;
    public function __construct()
    {
        helper('url');
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->usuario = new UsuarioModel();
        $this->partida = new PartidaModel();
        $this->estadoPartida = new EstadoPartidaModel();
        $this->dificultad = new DificultadModel();
        $this->carta = new CartaModel();
        $this->cartaPartida = new CartaPartidaModel();
    }
    
    public function index()
    {
        if (!isset($this->session->idUsuario)) {
            return redirect()->to(base_url());
        } else {
            echo view('index-cliente');
            }
        
    }
    public function mostrarRegistro()
    {
        echo view('register');
    }
    public function modificarUsuario()
    {
        $datos = ['usuario' => $this->usuario->buscarUsuario($this->session->correo)];
        echo view('layouts/modificar-usuario', $datos);
    }
    public function bajaUsuario()
    {
        echo view('layouts/baja-usuario');
    }
    public function opcionesPartida()
    {
        echo view('layouts/opciones-partida');
    }
    public function empezarJuego()
    {
        $datos = ['variable' => 'algo'];
        echo view('layouts/empezar-juego', $datos);
    }
    public function subirOpcionesPartida()
    {
        $tipoDificultad = $this->request->getPost('tipo-dificultad');
        $tipoCartas = $this->request->getPost('tipo-cartas');
        $cantTiempo = $this->request->getPost('cant-tiempo');
        if ($tipoDificultad==='---'||$tipoCartas==='---'||$cantTiempo==='---') {
            $arr = ["code" => "400", "msg" => "error"];
        }else{
            $dificultad = $this->dificultad->buscarDificultad($tipoDificultad);
            $cartas=$this->carta->buscarCartas($dificultad['cantCartas']/2,$tipoCartas);
            if ($cantTiempo === 'sin_tiempo'){
                $tiempoLimite = null;
            }else{
                $tiempoLimite = "00:".$cantTiempo.":00";
            }
            $this->partida->insert([
                'fecha_Inicio' => Time::now('America/Argentina/Ushuaia'),
                'tiempoLimite' => $tiempoLimite,
                'intentosRestantes' => $dificultad['cantIntentos'],
                'idUsuario' => $this->session->idUsuario,
                'idEstadoPartida' => '1',
                'idDificultad' => $dificultad['idDificultad'],
                ]);
            $arr = ["code" => "400", "msg" => "clear"];
        }
        

        

        // $this->usuario->insert([
        //     'usu_nametag' => $this->request->getPost('usu_nametag'),
        //     'usu_fecha_nacimiento' => $this->request->getPost('usu_fecha'),
        //     'usu_correo' => $this->request->getPost('usu_correo'),
        //     'usu_code_activacion' => $codigo,
        //     'usu_password' => base64_encode($this->request->getPost('usu_password')),
        //     'usu_fecha_registro' => date('Y-m-d H:i:s', now()),
        //     'usu_estado' => 'P'
                           
        // ]);
        echo json_encode($arr);
        die();
    }
    
}
