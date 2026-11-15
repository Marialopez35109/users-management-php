<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateMunicipioUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveMunicipioPort.php';
require_once __DIR__ . '/Mappers/MunicipioApplicationMapper.php';

final class CreateMunicipioService implements CreateMunicipioUseCase
{
    private SaveMunicipioPort $saveMunicipioPort;

    public function __construct(SaveMunicipioPort $saveMunicipioPort)
    {
        $this->saveMunicipioPort = $saveMunicipioPort;
    }

    public function execute(CreateMunicipioCommand $command): MunicipioModel
    {
        $municipio = MunicipioApplicationMapper::fromCreateCommandToModel($command);

        return $this->saveMunicipioPort->save($municipio);
    }
}
