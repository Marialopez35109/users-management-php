<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de municipios</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (empty($municipios)): ?>
    <p>No hay municipios registrados todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>País</th>
                <th>Alcalde</th>
                <th>Habitantes</th>
                <th>Colegios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($municipios as $municipio): ?>
                <tr>
                    <td><?= htmlspecialchars($municipio->getNombre(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($municipio->getDepartamento(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($municipio->getPais(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($municipio->getAlcalde(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= number_format($municipio->getNumHabitantes(), 0, ',', '.') ?></td>
                    <td><?= number_format($municipio->getNumColegios(), 0, ',', '.') ?></td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=municipios.show&amp;id=<?= urlencode($municipio->getId()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm"
                            href="?route=municipios.edit&amp;id=<?= urlencode($municipio->getId()) ?>">Editar</a>
                        <form method="POST" action="?route=municipios.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);"
                            data-name="<?= htmlspecialchars($municipio->getNombre(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($municipio->getId(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
