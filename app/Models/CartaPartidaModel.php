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
    
    //SELECT cartapartida.*, c.tipoCarta, c.nombreCarta FROM cartapartida
    //INNER JOIN carta as c ON cartapartida.idCarta=c.idCarta
    //WHERE cartapartida.idPartida=11;
    function buscarCartas($idPartida){
        $this->select('cartapartida.*, c.tipoCarta, c.nombreCarta');
        $this->join('carta as c','cartapartida.idCarta=c.idCarta');
        $this->where('idPartida', $idPartida);
        $cartas = $this->findAll();
        return $cartas;
    }
}