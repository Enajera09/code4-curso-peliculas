<label for="titulo">Título</label>
<input type="text" name="titulo" placeholder="Titulo" id="titulo" value="<?= old('titulo', $etiqueta->titulo) ?>">

<label for="categoria_id">Categoría</label>

<select name="categoria_id" id="categoria_id">
    <option value="">Seleccione una opción</option>
    <?php foreach ($categorias as  $c) : ?>
        <option <?= $c->id !== old('categoria_id', $etiqueta->categoria_id) ? true : 'Selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
    <?php endforeach ?>
</select>

<button type="submit"><?= $op ?></button>