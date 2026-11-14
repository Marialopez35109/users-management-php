<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllMunicipiosQuery.php';
require_once __DIR__ . '/../../../Domain/Models/MunicipioModel.php';

interface GetAllMunicipiosUseCase
{
    /**
     * @return MunicipioModel[]
     */
    public function execute(GetAllMunicipiosQuery $query): array;
}
