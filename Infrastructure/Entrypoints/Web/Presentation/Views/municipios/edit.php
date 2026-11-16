<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<?php
$textFields = array(
    'nombre' => 'Nombre',
    'departamento' => 'Departamento',
    'pais' => 'País',
    'alcalde' => 'Alcalde',
    'gobernador' => 'Gobernador',
    'patronoReligioso' => 'Patrono religioso',
);

$numberFields = array(
    'numHabitantes' => 'Número de habitantes',
    'numCasas' => 'Número de casas',
    'numParques' => 'Número de parques',
    'numColegios' => 'Número de colegios',
);
?>

<h1>Editar municipio</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=municipios.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($old['id'] ?? $municipio->getId()), ENT_QUOTES, 'UTF-8') ?>">

    <?php foreach ($textFields as $field => $label): ?>
        <?php $current = $municipio->{'get' . ucfirst($field)}(); ?>
        <div class="form-group">
            <label for="<?= $field ?>"><?= $label ?></label><br>
            <input type="text" id="<?= $field ?>" name="<?= $field ?>"
                value="<?= htmlspecialchars((string) ($old[$field] ?? $current), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors[$field])): ?>
                <div class="field-error"><?= htmlspecialchars($errors[$field], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <?php foreach ($numberFields as $field => $label): ?>
        <?php $current = $municipio->{'get' . ucfirst($field)}(); ?>
        <div class="form-group">
            <label for="<?= $field ?>"><?= $label ?></label><br>
            <input type="number" min="0" step="1" id="<?= $field ?>" name="<?= $field ?>"
                value="<?= htmlspecialchars((string) ($old[$field] ?? $current), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors[$field])): ?>
                <div class="field-error"><?= htmlspecialchars($errors[$field], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <label for="descripcion">Descripción</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="40"><?= htmlspecialchars((string) ($old['descripcion'] ?? $municipio->getDescripcion()), ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    &nbsp;
    <a class="btn" href="?route=municipios.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
