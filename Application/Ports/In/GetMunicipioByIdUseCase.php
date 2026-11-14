<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetMunicipioByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/MunicipioModel.php';

interface GetMunicipioByIdUseCase
{
    public function execute(GetMunicipioByIdQuery $query): MunicipioModel;
}
