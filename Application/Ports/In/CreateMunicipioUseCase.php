<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateMunicipioCommand.php';
require_once __DIR__ . '/../../../Domain/Models/MunicipioModel.php';

interface CreateMunicipioUseCase
{
    public function execute(CreateMunicipioCommand $command): MunicipioModel;
}
