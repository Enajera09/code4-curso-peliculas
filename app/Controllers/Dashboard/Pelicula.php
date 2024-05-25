<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Database\Migrations\PeliculaEtiquetas;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\Pelicula as ModelsPelicula;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pelicula extends BaseController
{

    public function show($id)
    {
        $peliculaModelo = new PeliculaModel();
        $imagenModel = new ImagenModel();

        //var_dump($peliculaModelo->find($id));

        // var_dump($imagenModel->getPeliculasById($id));

        echo view('dashboard/pelicula/show', [
            'pelicula' => $peliculaModelo->find($id),
            'imagenes' => $peliculaModelo->getImagesById($id),
            'etiquetas' => $peliculaModelo->getEtiquetasById($id)
        ]);
    }

    public function create()
    {
        $peliculaModelo = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModelo->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator->listErrors(),
            ]);
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('mensaje', 'Registro creado con exito');

        return redirect()->to('/dashboard/pelicula');
    }

    public function edit($id)
    {
        $peliculaModelo = new PeliculaModel();
        $categoriaModelo = new CategoriaModel();

        echo view('dashboard/pelicula/edit', [
            'pelicula' => $peliculaModelo->find($id),
            'categorias' => $categoriaModelo->find()
        ]);
    }

    public function update($id)
    {
        $peliculaModelo = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModelo->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator->listErrors(),
            ]);
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('mensaje', 'Registro actualizado correctamente.');
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

        //$this->generar_imagen();
        $this->asignar_imagen();


        $data = [
            'pelicula' => $peliculaModelo->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_id')->find(),
        ];

        echo view('dashboard/pelicula/index', $data);
    }

    public function new()
    {
        $categoriaModelo = new CategoriaModel();

        echo view('dashboard/pelicula/new', [
            'pelicula' => new PeliculaModel(),
            'categorias' => $categoriaModelo->find()
        ]);
    }

    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModelo = new PeliculaEtiquetaModel();

        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModelo->where('etiqueta_id', $etiquetaId)->where('pelicula_id', $peliculaId)->first();

        if (!$peliculaEtiqueta) {
            $peliculaEtiquetaModelo->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);
        }

        return redirect()->back();
    }

    public function etiqueta_delete($id, $etiqueta_id)
    {
        $peliculaEtiquetaModelo = new PeliculaEtiquetaModel();
        $peliculaEtiquetaModelo->where('etiqueta_id', $etiqueta_id)->where('pelicula_id', $id)->delete();
        echo '{"mensaje":"Eliminado"}';
        //session()->setFlashdata('mensaje', 'Borrado correctamente');
        //return redirect()->back()->withInput();
    }

    private function generar_imagen()
    {
        $imagenModelo = new ImagenModel();

        $imagenModelo->insert([
            'imagen' => date('Y-m-d H:m:s'),
            'extension' => 'Pendiente',
            'data' => 'Pendiente'
        ]);
    }

    private function asignar_imagen()
    {
        $peliculaimagenModelo = new PeliculaImagenModel();

        $peliculaimagenModelo->insert([
            'imagen_id' => 2,
            'pelicula_id' => 5,
        ]);
    }

    public function etiquetas($id)
    {
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();


        $etiquetas = [];

        if ($this->request->getGet('categoria_id')) {
            $etiquetas = $etiquetaModel->where('categoria_id', $this->request->getGet('categoria_id'))->findAll();
        }


        echo view('dashboard/pelicula/etiquetas', [
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->find(),
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiquetas' => $etiquetas
        ]);
    }
}
