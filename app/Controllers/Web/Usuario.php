<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Usuario extends BaseController
{

    public function crear_usuario()
    {
        $usuarioModelo = new UsuarioModel();

        $usuarioModelo->insert([
            'usuario' => 'admin',
            'email' => 'admin@gmail.com',
            'contrasena' => $usuarioModelo->contrasenaHash('12345')
        ]);
    }

    public function probarContrasena()
    {
        $usuarioModelo = new UsuarioModel();

        var_dump($usuarioModelo->contrasenaVerificar('12345', '$2y$10$6uANq.wYIWhjAL2gfOMMUeJR6p2RdmnLhizwBaNYpyZOAv473xtwe'));
    }

    public function login()
    {
        echo view('web/usuario/login');
    }

    public function login_post()
    {
        $usuarioModelo = new UsuarioModel();

        //Recojiendo los datos del formulario
        $email = $this->request->getPost('email');
        $contrasena = $this->request->getPost('contrasena');

        //Query a la BD
        $usuario = $usuarioModelo->select('id,usuario,email,contrasena,tipo')
            ->orwhere('email', $email)
            ->orWhere('usuario', $email)
            ->first();

        //Verificamos si el usuario existe en la BD
        if (!$usuario) {
            return redirect()->back()->with('mensaje', 'Usuario y/o contraseña invalida');
        }

        if ($usuarioModelo->contrasenaVerificar($contrasena, $usuario->contrasena)) {
            //Elimina un campo de nuestra consulta, ya que la contraseña no la vamos a necesitar en el resto de nuestra aplicación, solo para login.
            unset($usuario->contrasena);
            session()->set('usuario', $usuario);

            return redirect()->to('/dashboard/categoria')->with('mensaje', "Bienvenid@ $usuario->usuario");
        } else {
            return redirect()->back()->with('mensaje', 'Usuario y/o contraseña invalidasssss');
        }
    }


    public function register()
    {
        echo view('web/usuario/register');
    }

    public function register_post()
    {
        $usuarioModelo = new UsuarioModel();

        if ($this->validate('usuarios')) {
            $usuarioModelo->insert([
                'usuario' => $this->request->getPost('usuario'),
                'email' => $this->request->getPost('email'),
                'contrasena' => $usuarioModelo->contrasenaHash($this->request->getPost('contrasena')),
            ]);
            return redirect()->to('/login')->with('mensaje', "Login exito");
        }

        session()->setFlashdata([
            'validation' => $this->validator->listErrors()
        ]);
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
