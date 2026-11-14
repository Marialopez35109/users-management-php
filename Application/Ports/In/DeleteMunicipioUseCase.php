<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteMunicipioCommand.php';

interface DeleteMunicipioUseCase
{
    public function execute(DeleteMunicipioCommand $command): void;
}
