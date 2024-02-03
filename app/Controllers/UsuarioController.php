<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\Request;
use CodeIgniter\I18n\Time;
class UsuarioController extends BaseController
{
    private $reglasRegistro;
    public $encrypter;
    public function __construct()
    {
        helper(array('sistema','url','form'));
        date_default_timezone_set('America/Argentina/Ushuaia');
        $this->encrypter = \Config\Services::encrypter();
        $this->usuario = new UsuarioModel();
        $this->session = session();

        $this->reglasRegistro = [
            'r_usu_password' => [
                'rules' => 'matches[usu_password]',
                'errors' => [
                    'matches' => 'Las contraseñas no coinciden',
                ],
            ],
            'usu_nametag' => [
                'rules' => 'is_unique[usuario.usu_nametag]',
                'errors' => [
                    'matches' => 'Ese nametag ya fue utilizado',
                ],
            ],
            'usu_correo' => [
                'rules' => 'is_unique[usuario.usu_correo]|valid_email[usu_correo]',
                'errors' => [
                    'is_unique' => 'El correo electronico ya existe',
                    'valid_email' => 'El correo electronico no es valido',
                ],
            ],
            'usu_password' => [
                'rules' => 'min_length[8]',
                'errors' => [
                    'min_length' => 'La contraseña tiene que tener como minimo 8 caracteres',
                ],
            ],
        ];
        $this->reglasModificar = [
            'r_usu_password' => [
                'rules' => 'matches[usu_password]',
                'errors' => [
                    'matches' => 'Las contraseñas no coinciden',
                ],
            ],
            'usu_password' => [
                'rules' => 'min_length[8]',
                'errors' => [
                    'min_length' => 'La contraseña tiene que tener como minimo 8 caracteres',
                ],
            ]
        ];
    }
    public function ingresarAlSistema()
    {
        if ($this->request->getMethod() == "post") {

            $usu_correo = $this->request->getPost('usu_correo');
            $usu_password = $this->request->getPost('usu_password');
            $usu = $this->usuario->buscarUsuario($usu_correo);

            if ($usu != null) {

                if (base64_decode($usu['usu_password']) == $usu_password) {

                    if ($usu['deleted_at'] != null) {
                        $modal = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Esta cuenta se encuentra desactivada. Haz clic aquí para reactivarla </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reactivar cuenta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form method="POST" class="user"
                        action="' . base_url() . 'UsuarioController/reactivarCuenta">
                        <div class="modal-body">
                         ¿Está seguro de que quiere reactivar su cuenta?
                        </div>

                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                        </div>
                        <input type="hidden" name="ocultoUsuario" value="' . $usu['idUsuario'] . '">
                        </form>
                        </div>
                        </div>';
                        $dato = ['modal' => $modal];
                        echo view('login', $dato);

                    } else {

                        $datosSesion = [
                            'idUsuario' => $usu['idUsuario'],
                            'usu_nametag' => $usu['usu_nametag'],
                            'usu_correo' => $usu['usu_correo'],
                            'usu_estado' => $usu['usu_estado']
                        ];
                        $sesion = session();
                        $sesion->set($datosSesion);
                        return redirect()->to(base_url() . 'GestionController/index');
                    }
                } else {
                    $data['error'] = 'La contraseña no coincide';
                    echo view('login', $data);
                }
            } else {
                $data['error'] = 'El cliente no existe';
                echo view('login', $data);
            }
        } else {
            $data = ['validation' => $this->validator];
            echo view('login', $data);
        }
    }
    public function salirDelSistema()
    {
        $usu_session = session();
        $usu_session->destroy();
        return redirect()->to(base_url());
    }

    public function registrarUsuario()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasRegistro)) {
            $codigo = generar_codigo(70);
            $this->usuario->insert([
                'usu_nametag' => $this->request->getPost('usu_nametag'),
                'usu_fecha_nacimiento' => $this->request->getPost('usu_fecha'),
                'usu_correo' => $this->request->getPost('usu_correo'),
                'usu_code_activacion' => $codigo,
                'usu_password' => base64_encode($this->request->getPost('usu_password')),
                'usu_fecha_registro' => Time::now('America/Argentina/Ushuaia'),
                'usu_estado' => 'P'
                               
            ]);

            $usu = $this->usuario->buscarUsuario($this->request->getPost('usu_correo'));
            $idUsuario = $usu['idUsuario'];

            $datosSesion = [
                'idUsuario' => $idUsuario,
                'usu_nametag' => $usu['usu_nametag'],
                'usu_correo' => $usu['usu_correo'],
                'usu_estado' => $usu['usu_estado'],
            ];

            $sesion = session();
            $sesion->set($datosSesion);
            $mensaje = ['msj' => '¡Te has registrado de manera exitosa!'];

            echo view('login', $mensaje);
        } else {
            $data = [
                'validation' => $this->validator,
                'usu_nametag' => $this->request->getPost('usu_nametag'),
                'usu_correo' => $this->request->getPost('usu_correo'),
                'usu_password' => $this->request->getPost('usu_password'),
                'usu_fecha' => $this->request->getPost('usu_fecha'),
            ];
            echo view('register', $data);
        }
    }
}