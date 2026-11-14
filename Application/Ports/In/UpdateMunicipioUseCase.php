<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateMunicipioCommand.php';
require_once __DIR__ . '/../../../Domain/Models/MunicipioModel.php';

interface UpdateMunicipioUseCase
{
    public function execute(UpdateMunicipioCommand $command): MunicipioModel;
}
