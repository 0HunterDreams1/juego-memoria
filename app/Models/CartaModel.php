<?php
namespace App\Models;

use CodeIgniter\Model;

class CartaModel extends Model
{
    protected $table = 'carta';
    protected $primaryKey = 'idCarta';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['tipoCarta', 'nombreCarta'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    function buscarCartas($cantCartas, $tipoCartas){
        $cartas = $this->where('tipoCarta', $tipoCartas)->findAll();
        shuffle($cartas);
        $dividido_cartas = array_slice($cartas, 0, $cantCartas);
        $duplicado_cartas = array_merge($dividido_cartas, $dividido_cartas);
        shuffle($duplicado_cartas);
        return $duplicado_cartas;
    }
}