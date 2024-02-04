<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['usu_nametag', 'usu_password', 'usu_fecha_nacimiento' , 'usu_correo', 'usu_code_activacion', 'usu_fecha_registro', 'deleted_at', 'usu_estado', 'usu_cantidad_partidas'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function actualizarCantPartidas($id, $datos){
        $confirma = $this->update($id, $datos);
        return $confirma;
    }

    public function buscarUsuario($correo)
    {
        $this->where('usu_correo', $correo);
        $datosUsuario = $this->first();
        return $datosUsuario;
    }
    public function buscarUsuarioId($id)
    {
        $datosUsuario = $this->where('idUsuario', $id)->first();
        return $datosUsuario;
    }
    public function modificarDatosUsuario($id, $datos)
    {
        $confirma = $this->update($id, $datos);
        return $confirma;
    }
    public function bajaLogica($id)
    {
        date_default_timezone_set('America/Argentina/Ushuaia');
        $fechaActual = date("Y-m-d H:i:s");
        $deleted = ['deleted_at' => $fechaActual];
        $this->update($id, $deleted);
    }

    public function altaLogica($id)
    {
        $deleted = ['deleted_at' => null];
        $this->update($id, $deleted);
    }
}