<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('header') ?>
Listado de etiquetas
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<a href="/dashboard/etiqueta/new">Crear</a>
<table>
    <tr>
        <th>
            Id
        </th>
        <th>
            Categoría
        </th>
        <th>
            Titulo
        </th>
        <th>
            Opciones
        </th>
    </tr>
    <?php foreach ($etiqueta as $key => $value) : ?>
        <tr>
            <td><?= $value->id ?></td>
            <td><?= $value->categoria ?></td>
            <td><?= $value->titulo ?></td>
            <td>
                <a href="/dashboard/etiqueta/show/<?= $value->id ?>">Show</a>
                <a href="/dashboard/etiqueta/edit/<?= $value->id ?>">Edit</a>
                <form action="/dashboard/etiqueta/delete/<?= $value->id ?>" method="post">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>
<?= $this->endSection() ?>