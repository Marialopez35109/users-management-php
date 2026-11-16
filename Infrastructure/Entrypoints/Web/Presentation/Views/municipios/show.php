<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de municipio</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<table class="detail-table">
    <tr>
        <th>ID</th>
        <td><?= htmlspecialchars($municipio->getId(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><?= htmlspecialchars($municipio->getNombre(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Departamento</th>
        <td><?= htmlspecialchars($municipio->getDepartamento(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>País</th>
        <td><?= htmlspecialchars($municipio->getPais(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Alcalde</th>
        <td><?= htmlspecialchars($municipio->getAlcalde(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Gobernador</th>
        <td><?= htmlspecialchars($municipio->getGobernador(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Patrono religioso</th>
        <td><?= htmlspecialchars($municipio->getPatronoReligioso(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Habitantes</th>
        <td><?= number_format($municipio->getNumHabitantes(), 0, ',', '.') ?></td>
    </tr>
    <tr>
        <th>Casas</th>
        <td><?= number_format($municipio->getNumCasas(), 0, ',', '.') ?></td>
    </tr>
    <tr>
        <th>Parques</th>
        <td><?= number_format($municipio->getNumParques(), 0, ',', '.') ?></td>
    </tr>
    <tr>
        <th>Colegios</th>
        <td><?= number_format($municipio->getNumColegios(), 0, ',', '.') ?></td>
    </tr>
    <tr>
        <th>Descripción</th>
        <td><?= nl2br(htmlspecialchars($municipio->getDescripcion(), ENT_QUOTES, 'UTF-8')) ?></td>
    </tr>
</table>

<p style="margin-top: 16px;">
    <a class="btn btn-warning" href="?route=municipios.edit&amp;id=<?= urlencode($municipio->getId()) ?>">Editar</a>
    &nbsp;
    <a class="btn" href="?route=municipios.index">Volver al listado</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
