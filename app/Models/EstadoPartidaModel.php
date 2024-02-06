<?php
namespace App\Models;

use CodeIgniter\Model;

class EstadoPartidaModel extends Model
{
    protected $table = 'estadopartida';
    protected $primaryKey = 'idEstado';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['descripcion'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    function buscarEstadoPartida($idEstadoPartida){
        $estadoPartida=$this->where('idEstado', $idEstadoPartida)->first();
        return $estadoPartida;
    }
}