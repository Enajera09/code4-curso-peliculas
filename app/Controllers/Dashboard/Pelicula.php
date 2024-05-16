<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\Pelicula as ModelsPelicula;
use App\Models\PeliculaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pelicula extends BaseController
{

    public function show($id)
    {
        $peliculaModelo = new PeliculaModel();

        echo view('dashboard/pelicula/show', [
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

        session()->setFlashdata('mensaje', 'Registro creado con exito');

        return redirect()->to('/dashboard/pelicula');
    }

    public function edit($id)
    {
        $peliculaModelo = new PeliculaModel();

        echo view('dashboard/pelicula/edit', [
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

        session()->setFlashdata('mensaje', 'Registro actualizado correctamente.');

        return redirect()->back();
        //return redirect()->to('/dashboard/pelicula');
    }

    public function delete($id)
    {
        $peliculaModelo = new PeliculaModel();

        $peliculaModelo->delete($id);

        session()->setFlashdata('mensaje', 'Registro eliminado correctamente.');

        return redirect()->back();
    }

    public function index()
    {

        $peliculaModelo = new PeliculaModel();

        echo view('dashboard/pelicula/index', [
            'pelicula' => $peliculaModelo->findAll(),
        ]);
    }

    public function new()
    {
        echo view('dashboard/pelicula/new', [
            'pelicula' => [
                'titulo' => '',
                'descripcion' => ''
            ]
        ]);
    }
}
