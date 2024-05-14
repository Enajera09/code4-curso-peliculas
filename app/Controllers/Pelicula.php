<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pelicula as ModelsPelicula;
use App\Models\PeliculaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pelicula extends BaseController
{
    public function show($id)
    {
        $peliculaModelo = new PeliculaModel();

        echo view('pelicula/show', [
            'pelicula' => $peliculaModelo->find($id)
        ]);
    }

    public function create()
    {
        $peliculaModelo = new PeliculaModel();

        $peliculaModelo->insert([
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);

        echo "creado";
    }

    public function edit($id)
    {
        $peliculaModelo = new PeliculaModel();

        echo view('pelicula/edit', [
            'pelicula' => $peliculaModelo->find($id)
        ]);
    }

    public function update($id)
    {
        $peliculaModelo = new PeliculaModel();

        $peliculaModelo->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
        ]);
        echo "Actualizado";
    }

    public function delete($id)
    {
        $peliculaModelo = new PeliculaModel();

        $peliculaModelo->delete($id);

        echo "Borrado";
    }

    public function index()
    {

        $peliculaModelo = new PeliculaModel();

        echo view('pelicula/index', [
            'pelicula' => $peliculaModelo->findAll(),
        ]);
    }

    public function new()
    {
        echo view('pelicula/new', [
            'pelicula' => [
                'titulo' => '',
                'descripcion' => ''
            ]
        ]);
    }
}
