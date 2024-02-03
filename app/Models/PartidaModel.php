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
                                'intentosRestantes', 
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
}