<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Categoria extends BaseController
{
    public function index()
    {
        //session()->set('key', 9);
        $categoriaModelo = new CategoriaModel();

        echo view('dashboard/categoria/index', [
            'categoria' => $categoriaModelo->findAll()
        ]);
    }

    public function new()
    {
        //var_dump(session()->destroy());
        echo view('dashboard/categoria/new', [
            "categoria" => [
                'titulo' => ''
            ]
        ]);
    }

    public function create()
    {
        $categoriaModelo = new CategoriaModel();

        if ($this->validate('categorias')) {
            $categoriaModelo->insert([
                'titulo' => $this->request->getPost('titulo'),
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator->listErrors(),
            ]);
            return redirect()->back()->withInput();
        }

        return redirect()->to('/dashboard/categoria')->with('mensaje', 'Registro gestionado de manera exitosa');
    }

    public function show($id)
    {
        $categoriaModelo = new CategoriaModel();

        echo view('dashboard/categoria/show', [
            'categoria' => $categoriaModelo->find($id)
        ]);
    }

    public function edit($id)
    {
        $categoriaModelo = new CategoriaModel();

        echo view('dashboard/categoria/edit', [
            'categoria' => $categoriaModelo->find($id),
        ]);
    }

    public function update($id)
    {
        $categoriaModelo = new CategoriaModel();

        if ($this->validate('categorias')) {
            $categoriaModelo->update($id, [
                'titulo' => $this->request->getPost('titulo'),
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator->listErrors(),
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->back()->with('mensaje', 'Registro gestionado de manera exitosa');
    }

    public function delete($id)
    {
        $categoriaModelo = new CategoriaModel();

        $categoriaModelo->delete($id);

        session()->setFlashdata('mensaje', 'Registro eliminado de manera exitosa');

        return redirect()->back();

        //return redirect()->back()->with('mensaje', 'Registro gestionado de manera exitosa');
    }
}
