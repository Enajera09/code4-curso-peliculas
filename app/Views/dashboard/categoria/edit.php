<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>
<?= view('partials/_session') ?>
<form action="/dashboard/categoria/update/<?= $categoria['id'] ?>" method="post">
    <?= view('dashboard/categoria/_form', ['op' => "Actualizar"]) ?>
</form>
<?= $this->endSection() ?>