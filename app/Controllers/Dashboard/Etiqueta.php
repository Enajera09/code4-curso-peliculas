<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Etiqueta extends BaseController
{
    public function index()
    {
        $etiquetaModelo = new EtiquetaModel();

        echo view('dashboard/etiqueta/index', [
            'etiqueta' => $etiquetaModelo->select('etiquetas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id=etiquetas.categoria_id')->find(),
        ]);
    }

    public function new()
    {
        $categoriaModelo = new CategoriaModel();

        echo view('/dashboard/etiqueta/new', [
            'etiqueta' => new EtiquetaModel(),
            'categorias' => $categoriaModelo->find()
        ]);
    }

    public function create()
    {
        $etiquetaModelo = new EtiquetaModel();

        if ($this->validate('etiquetas')) {
            $etiquetaModelo->insert([
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator->listErrors(),
            ]);
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('mensaje', 'Registro creado con exito');

        return redirect()->to('/dashboard/etiqueta');
    }

    public function show($id)
    {
        $etiquetaModelo = new EtiquetaModel();

        echo view('dashboard/etiqueta/show', [
            'etiqueta' => $etiquetaModelo->find($id),
        ]);
    }

    public function edit($id)
    {
        $etiquetaModelo = new EtiquetaModel();
        $categoriaModelo = new CategoriaModel();

        echo view('dashboard/etiqueta/edit', [
            'etiqueta' => $etiquetaModelo->find($id),
            'categorias' => $categoriaModelo->find()
        ]);
    }

    public function update($id)
    {
        $etiquetaModelo = new EtiquetaModel();

        if ($this->validate('etiquetas')) {
            $etiquetaModelo->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator->listErrors(),
            ]);
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('mensaje', 'Registro actualizado correctamente.');
    }

    public function delete($id)
    {
        $etiquetaModelo = new EtiquetaModel();

        $etiquetaModelo->delete($id);

        session()->setFlashdata('mensaje', 'Registro eliminado correctamente.');

        return redirect()->back();
    }
}
