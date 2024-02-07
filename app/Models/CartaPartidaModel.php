<?php
namespace App\Models;

use CodeIgniter\Model;

class CartaPartidaModel extends Model
{
    protected $table = 'cartapartida';
    protected $primaryKey = 'idCartaPartida';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPartida', 'idCarta', 'encontrado', 'indexArray'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    function buscarCartas($idPartida){
        $cartas = $this->where('idPartida', $idPartida)->findAll();
        return $cartas;
    }
}