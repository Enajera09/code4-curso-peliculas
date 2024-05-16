<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('header') ?>
Listado de peliculas
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<a href="/dashboard/pelicula/new">Crear</a>
<table>
    <tr>
        <th>
            Id
        </th>
        <th>
            Titulo
        </th>
        <th>
            Descripción
        </th>
        <th>
            Opciones
        </th>
    </tr>
    <?php foreach ($pelicula as $key => $value) : ?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['titulo'] ?></td>
            <td><?= $value['descripcion'] ?></td>
            <td>
                <a href="/dashboard/pelicula/show/<?= $value['id'] ?>">Show</a>
                <a href="/dashboard/pelicula/edit/<?= $value['id'] ?>">Edit</a>
                <form action="/dashboard/pelicula/delete/<?= $value['id'] ?>" method="post">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>
<?= $this->endSection() ?>