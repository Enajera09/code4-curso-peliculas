<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>

<body>
    <h1>Listado de peliculas</h1>

    <?= view('partials/_session') ?>

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

</body>

</html>