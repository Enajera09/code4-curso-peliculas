<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Categoria extends BaseController
{
    public function index()
    {
        $categoriaModelo = new CategoriaModel();

        echo view('dashboard/categoria/index', [
            'categoria' => $categoriaModelo->findAll()
        ]);
    }

    public function new()
    {
        echo view('dashboard/categoria/new', [
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

        return redirect()->to('/dashboard/categoria');
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

        $categoriaModelo->update($id, [
            'titulo' => $this->request->getPost('titulo'),
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $categoriaModelo = new CategoriaModel();

        $categoriaModelo->delete($id);

        return redirect()->back();
    }
}
