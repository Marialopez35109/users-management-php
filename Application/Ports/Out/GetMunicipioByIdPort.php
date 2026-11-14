<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/MunicipioModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/MunicipioId.php';

interface GetMunicipioByIdPort
{
    public function getById(MunicipioId $municipioId): ?MunicipioModel;
}
