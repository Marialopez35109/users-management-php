<?php

declare(strict_types=1);

/**
 * Acciones web del CRUD de Municipio.
 *
 * Las invoca el front controller (public/index.php) cuando la acción de la ruta
 * no pertenece a Usuario ni a autenticación. Devuelve true si la acción fue atendida.
 * Las rutas de Municipio exigen sesión iniciada (el index.php ya lo valida).
 */
function handleMunicipioAction(string $action): bool
{
    $municipioActions = array(
        'municipios.index',
        'municipios.create',
        'municipios.store',
        'municipios.show',
        'municipios.edit',
        'municipios.update',
        'municipios.delete',
    );

    if (!in_array($action, $municipioActions, true)) {
        return false;
    }

    try {
        dispatchMunicipioAction($action);
    } catch (Throwable $exception) {
        Flash::setMessage($exception->getMessage());

        switch ($action) {
            case 'municipios.store':
                Flash::setOld(getCreateMunicipioFormData());
                View::redirect('municipios.create');
                break;

            case 'municipios.update':
                $updateId = trim((string) ($_POST['id'] ?? ''));
                Flash::setOld(getUpdateMunicipioFormData());
                header('Location: ?route=municipios.edit&id=' . urlencode($updateId));
                exit;

            case 'municipios.index':
                View::render('home', buildHomeViewData($exception->getMessage()));
                break;

            default:
                View::redirect('municipios.index');
                break;
        }
    }

    return true;
}

function dispatchMunicipioAction(string $action): void
{
    $controller = DependencyInjection::getMunicipioController();

    switch ($action) {
        case 'municipios.index':
            View::render(
                'municipios/list',
                buildListMunicipiosViewData($controller->index())
            );
            break;

        case 'municipios.create':
            View::render('municipios/create', buildCreateMunicipioViewData());
            break;

        case 'municipios.store':
            $form = getCreateMunicipioFormData();
            $errors = validateMunicipioForm($form);

            if (!empty($errors)) {
                Flash::setOld($form);
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                View::redirect('municipios.create');
            }

            $request = new CreateMunicipioWebRequest(
                $form['nombre'],
                $form['departamento'],
                $form['pais'],
                $form['alcalde'],
                $form['gobernador'],
                $form['patronoReligioso'],
                $form['numHabitantes'],
                $form['numCasas'],
                $form['numParques'],
                $form['numColegios'],
                $form['descripcion']
            );

            $controller->store($request);

            Flash::setSuccess('Municipio registrado correctamente.');
            View::redirect('municipios.index');
            break;

        case 'municipios.show':
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            View::render('municipios/show', array(
                'pageTitle' => 'Detalle de municipio',
                'municipio' => $controller->show($id),
                'message' => Flash::message(),
            ));
            break;

        case 'municipios.edit':
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            View::render(
                'municipios/edit',
                buildEditMunicipioViewData($controller->show($id))
            );
            break;

        case 'municipios.update':
            $form = getUpdateMunicipioFormData();
            $errors = validateMunicipioForm($form);

            if (!empty($errors)) {
                Flash::setOld($form);
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                header('Location: ?route=municipios.edit&id=' . urlencode($form['id']));
                exit;
            }

            $request = new UpdateMunicipioWebRequest(
                $form['id'],
                $form['nombre'],
                $form['departamento'],
                $form['pais'],
                $form['alcalde'],
                $form['gobernador'],
                $form['patronoReligioso'],
                $form['numHabitantes'],
                $form['numCasas'],
                $form['numParques'],
                $form['numColegios'],
                $form['descripcion']
            );

            $controller->update($request);

            Flash::setSuccess('Municipio actualizado correctamente.');
            View::redirect('municipios.index');
            break;

        case 'municipios.delete':
            $id = isset($_POST['id']) ? trim((string) $_POST['id']) : '';
            $controller->delete($id);
            Flash::setSuccess('Municipio eliminado correctamente.');
            View::redirect('municipios.index');
            break;
    }
}

/**
 * @param MunicipioResponse[] $municipios
 * @return array<string, mixed>
 */
function buildListMunicipiosViewData(array $municipios): array
{
    return array(
        'pageTitle' => 'Lista de municipios',
        'municipios' => $municipios,
        'message' => Flash::message(),
        'success' => Flash::success(),
    );
}

/**
 * @return array<string, mixed>
 */
function buildCreateMunicipioViewData(): array
{
    return array(
        'pageTitle' => 'Registrar municipio',
        'message' => Flash::message(),
        'success' => Flash::success(),
        'errors' => Flash::errors(),
        'old' => Flash::old(),
    );
}

/**
 * @return array<string, mixed>
 */
function buildEditMunicipioViewData(MunicipioResponse $municipio): array
{
    return array(
        'pageTitle' => 'Editar municipio',
        'municipio' => $municipio,
        'message' => Flash::message(),
        'errors' => Flash::errors(),
        'old' => Flash::old(),
    );
}

/**
 * @return array<string, string>
 */
function getCreateMunicipioFormData(): array
{
    $fields = array(
        'nombre', 'departamento', 'pais', 'alcalde', 'gobernador',
        'patronoReligioso', 'numHabitantes', 'numCasas', 'numParques',
        'numColegios', 'descripcion',
    );

    $form = array();

    foreach ($fields as $field) {
        $form[$field] = isset($_POST[$field]) ? trim((string) $_POST[$field]) : '';
    }

    return $form;
}

/**
 * @return array<string, string>
 */
function getUpdateMunicipioFormData(): array
{
    $form = getCreateMunicipioFormData();
    $form['id'] = isset($_POST['id']) ? trim((string) $_POST['id']) : '';

    return $form;
}

/**
 * @param array<string, string> $form
 * @return array<string, string>
 */
function validateMunicipioForm(array $form): array
{
    $errors = array();

    if ($form['nombre'] === '') {
        $errors['nombre'] = 'El nombre es obligatorio.';
    } elseif (mb_strlen($form['nombre']) < 2) {
        $errors['nombre'] = 'El nombre debe tener al menos 2 caracteres.';
    }

    if ($form['departamento'] === '') {
        $errors['departamento'] = 'El departamento es obligatorio.';
    }

    if ($form['pais'] === '') {
        $errors['pais'] = 'El país es obligatorio.';
    }

    $numericFields = array(
        'numHabitantes' => 'El número de habitantes',
        'numCasas' => 'El número de casas',
        'numParques' => 'El número de parques',
        'numColegios' => 'El número de colegios',
    );

    foreach ($numericFields as $field => $label) {
        $value = $form[$field];

        if ($value === '') {
            continue;
        }

        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            $errors[$field] = $label . ' debe ser un número entero.';
        } elseif ((int) $value < 0) {
            $errors[$field] = $label . ' no puede ser negativo.';
        }
    }

    return $errors;
}
