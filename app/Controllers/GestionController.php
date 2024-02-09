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
        if (isset($this->session->idUsuario)) {
            $idUsuario = $this->session->idUsuario;
            $ultimaPartida=$this->partida->buscarUltimaPartida($idUsuario);
            if(isset($ultimaPartida)){
                $datos = [
                    'ultimaPartida' => $ultimaPartida,
                    'estadoPartida' => $this->estadoPartida->buscarEstadoPartida($ultimaPartida['idEstadoPartida'])
                ];
                echo view('index-cliente', $datos);
            }else{
                echo view('index-cliente');
            }
        } else {
            return redirect()->to(base_url());
        }
        
    }
    public function mostrarRegistro()
    {
        echo view('register');
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
        $dificultad = $this->dificultad->buscarDificultadId($partida['idDificultad']);
        /**
        * $timeString= tiene que ser string y tener este formato 00:00:00
        * esto devuelve la suma de sus partes en una cantidad de segundos
        */
        $timeString=$partida['tiempoEnCurso'];
        $horas = substr($timeString,0,2);
        $minutos = substr($timeString,3,2);
        $segundos = substr($timeString,6,2);
        $cantSegundos = (int)$horas*3600 + (int)$minutos*60 + (int) $segundos;
        /**
         * Verifico la cantidad de partidas del usuario
         */
        if ($partidas!= NULL) {
            $cantPartidas=sizeof($partidas);
        }else{
            $cantPartidas=1;
        }
        /**
         * Consulto si la partida esta pausada(1) y si no es igual quiere decir que no tiene partida pausada
         */
        if($partida['idEstadoPartida'] === '1'){
            /**
            * Busco en la base de datos las cartas que estaban guardadas de la partida pausada
            */
            $cartasGuardadas = $this->cartaPartida->buscarCartas($partida['idPartida']);
            /**
             * Busco carta por id y la voy agregando al array
             */
            $cartas=NULL;
            // foreach ($cartasGuardadas as $index => $cartaGuardada) {
            //     $cartas[] = $this->carta->buscarCartasPorId($cartaGuardada['idCarta']);
            // }
        }else{
            $cartasGuardadas = NULL;
            $cartas = $this->carta->buscarCartas($dificultad['cantCartas']/2,$partida['tipoCarta']);
        }
        /**
         * Agrego la cantidad de partidas al usuario.
         */
        $datos = [
            'usu_cantidad_partidas' => $cantPartidas
        ];
        $this->usuario->actualizarCantPartidas($idUsuario,$datos);
        /**
         * Busco las 5 mejores partidas
         */
        $mejoresPartidas=$this->partida->buscarTop5($idUsuario);
        /**
         * Le paso a la vista la informacion necesaria para que funcione la partida
         */
        $datosPartida = ['cartas' => $cartas,
        'dificultad'=> $dificultad,
        'partida' => $partida,
        'cantSegundos' => $cantSegundos,
        'cartasGuardadas' => $cartasGuardadas,
        'mejoresPartidas' => $mejoresPartidas,
        'cantPartidas' => $cantPartidas];
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
                'tiempoEnCurso' => '00:00:00',
                'tipoCarta' => $tipoCartas,
                'idUsuario' => $this->session->idUsuario,
                'idEstadoPartida' => '2',
                'idDificultad' => $dificultad['idDificultad'],
                ]);
                $arr = ["code" => "400", "msg" => "clear"];
            }
            echo json_encode($arr);
            die();
        }
        public function finalizoJuego(){
        $intentos = $_POST['intentos'];
        $resultado = $_POST['resultado'];
        $tiempoEnCurso = $_POST['tiempoEnCurso'];
        $aciertos = $_POST['aciertos'];
        if ($resultado==='perdio') {
            $idEstadoPartida='3';
        }else if($resultado==='gano'){
            $idEstadoPartida='4';
        }else if($resultado==='abandono'){
            $idEstadoPartida='2';
        }else{
            $idPartida = $_POST['idPartida'];
            $idEstadoPartida='1';
            if (!empty($_POST['posiciones'])) {
                $jsonString = $_POST['posiciones'];
                error_log($jsonString);
                $items = json_decode($jsonString, TRUE);
                $cartasGuardadas = $this->cartaPartida->buscarCartas($idPartida);
                if($cartasGuardadas != NULL){
                    foreach ($items as $index => $item) {
                        $dataCartas=['idPartida' => $idPartida,
                        'idCarta' => $item['idCarta'],
                        'encontrado' => $item['encontrado'],
                        'indexArray' => $index];
                        $this->cartaPartida->update($cartasGuardadas[$index]['idCartaPartida'],$dataCartas);
                    }
                }else{
                    foreach ($items as $index => $item) {
                        $this->cartaPartida->insert([
                            'idPartida' => $idPartida,
                            'idCarta' => $item['idCarta'],
                            'encontrado' => $item['encontrado'],
                            'indexArray' => $index
                        ]);
                    }
                }
            } 
         }
        $idUsuario = $this->session->idUsuario;
        $partida = $this->partida->buscarUltimaPartida($idUsuario);
        $datos = [
            'intentos' => $intentos,
            'tiempoEnCurso' => $tiempoEnCurso,
            'aciertos' => $aciertos,
            'fecha_Finalizado' => Time::now('America/Argentina/Ushuaia'),
            'idEstadoPartida' => $idEstadoPartida,
        ];
        $this->partida->update($partida['idPartida'],$datos);
        die();
    }
}
