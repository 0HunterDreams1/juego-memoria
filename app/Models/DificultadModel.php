<?php
namespace App\Models;

use CodeIgniter\Model;

class DificultadModel extends Model
{
    protected $table = 'dificultad';
    protected $primaryKey = 'idDificultad';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nivelDificultad', 'cantIntentos', 'cantCartas'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    
    function buscarDificultad($nivelDificultad){
        $dificultad = $this->where('nivelDificultad', $nivelDificultad)->first();
        return $dificultad;
    }
    function buscarDificultadId($idDificultad){
        $dificultad = $this->where('idDificultad', $idDificultad)->first();
        return $dificultad;
    }
}