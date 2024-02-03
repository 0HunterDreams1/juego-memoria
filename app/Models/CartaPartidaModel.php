<?php
namespace App\Models;

use CodeIgniter\Model;

class CartaPartidaModel extends Model
{
    protected $table = 'cartapartida';
    protected $primaryKey = 'idCartaPartida';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idPartida', 'idCarta', 'encontrado'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}