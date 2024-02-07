<?php
namespace App\Models;

use CodeIgniter\Model;

class PartidaModel extends Model
{
    protected $table = 'partida';
    protected $primaryKey = 'idPartida';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fecha_Inicio', 
                                'fecha_Finalizado', 
                                'tiempoLimite', 
                                'tiempoEnCurso', 
                                'intentos',
                                'aciertos',
                                'tipoCarta', 
                                'idUsuario', 
                                'idEstadoPartida', 
                                'idDificultad'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    
    /**
     * Buscar Partida con el idUsuario y el idEstadoPartida
     * idEstadoPartida:
     * 1= En ejecucion
     * 2= pausado
     * 3= finalizado
     */
    function buscarPartida($idUsuario, $idEstadoPartida){
        $partida = $this->where('idUsuario', $idUsuario)->where('idEstadoPartida', $idEstadoPartida)->first();
        return $partida;
    }
    function buscarUltimaPartida($idUsuario){
        $partida = $this->where('idUsuario', $idUsuario)->orderBy('idPartida', 'DESC')->first();
        return $partida;
    }
    function buscarTodasPartidas($idUsuario){
        $partidas = $this->where('idUsuario', $idUsuario)->findAll();
        return $partidas;
    }
}