<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>

<body>
    <h1>Listado de categorias</h1>

    <a href="/dashboard/categoria/new">Crear</a>
    <table>
        <tr>
            <th>
                Id
            </th>
            <th>
                Titulo
            </th>
            <th>
                Opciones
            </th>
        </tr>
        <?php foreach ($categoria as $key => $value) : ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['titulo'] ?></td>
                <td>
                    <a href="/dashboard/categoria/show/<?= $value['id'] ?>">Show</a>
                    <a href="/dashboard/categoria/edit/<?= $value['id'] ?>">Edit</a>
                    <form action="/dashboard/categoria/delete/<?= $value['id'] ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

</body>

</html>