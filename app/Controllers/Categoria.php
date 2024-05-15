<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\PeliculaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Categoria extends BaseController
{
    public function index()
    {
        $categoriaModelo = new CategoriaModel();

        echo view('categoria/index', [
            'categoria' => $categoriaModelo->findAll()
        ]);
    }

    public function new()
    {
        echo view('categoria/new', [
            "categoria" => [
                'titulo' => ''
            ]
        ]);
    }

    public function create()
    {
        $categoriaModelo = new CategoriaModel();

        $categoriaModelo->insert([
            'titulo' => $this->request->getPost('titulo'),
        ]);

        echo "Creado";
    }

    public function show($id)
    {
        $categoriaModelo = new CategoriaModel();

        echo view('categoria/show', [
            'categoria' => $categoriaModelo->find($id)
        ]);
    }

    public function edit($id)
    {
        $categoriaModelo = new CategoriaModel();

        echo view('categoria/edit', [
            'categoria' => $categoriaModelo->find($id),
        ]);
    }

    public function update($id)
    {
        $categoriaModelo = new CategoriaModel();

        $categoriaModelo->update($id, [
            'titulo' => $this->request->getPost('titulo'),
        ]);

        echo "Actualizado";
    }

    public function delete($id)
    {
        $categoriaModelo = new CategoriaModel();

        $categoriaModelo->delete($id);

        echo "Eliminado";
    }
}
