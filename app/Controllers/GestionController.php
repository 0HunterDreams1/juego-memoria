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
            $idUsuario = $this->session->idUsuario;
            $datos = [
                'partidaPausada' => $this->partida->buscarPartida($idUsuario,1),
                'partidaAbandonada' => $this->partida->buscarPartida($idUsuario,2)
            ];
            echo view('index-cliente', $datos);
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
        $idUsuario = $this->session->idUsuario;
        $partida = $this->partida->buscarUltimaPartida($idUsuario);
        $partidas = $this->partida->buscarTodasPartidas($idUsuario);
        if ($partidas!= NULL) {
            $cantPartidas=sizeof($partidas);
        }else{
            $cantPartidas=1;
        }
        $dificultad = $this->dificultad->buscarDificultadId($partida['idDificultad']);
        $cartas = $this->carta->buscarCartas($dificultad['cantCartas']/2,$partida['tipoCarta']);
        $datosPartida = ['cartas' => $cartas,
                'dificultad'=> $dificultad,
                'partida' => $partida,
                'cantPartidas' => $cantPartidas];
        $datos = [
            'usu_cantidad_partidas' => $cantPartidas
        ];
        $this->usuario->actualizarCantPartidas($idUsuario,$datos);
        echo view('layouts/empezar-juego', $datosPartida);
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
            if ($cantTiempo === 'sin_tiempo'){
                $tiempoLimite = null;
            }else{
                $tiempoLimite = "00:".$cantTiempo.":00";
            }
            $this->partida->insert([
                'fecha_Inicio' => Time::now('America/Argentina/Ushuaia'),
                'tiempoLimite' => $tiempoLimite,
                'tipoCarta' => $tipoCartas,
                'idUsuario' => $this->session->idUsuario,
                'idEstadoPartida' => '3',
                'idDificultad' => $dificultad['idDificultad'],
                ]);
            $arr = ["code" => "400", "msg" => "clear"];
        }
        echo json_encode($arr);
        die();
    }
    
}
