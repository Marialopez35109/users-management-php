<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateMunicipioUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdateMunicipioPort.php';
require_once __DIR__ . '/../Ports/Out/GetMunicipioByIdPort.php';
require_once __DIR__ . '/Mappers/MunicipioApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/MunicipioNotFoundException.php';

final class UpdateMunicipioService implements UpdateMunicipioUseCase
{
    private UpdateMunicipioPort $updateMunicipioPort;
    private GetMunicipioByIdPort $getMunicipioByIdPort;

    public function __construct(
        UpdateMunicipioPort $updateMunicipioPort,
        GetMunicipioByIdPort $getMunicipioByIdPort
    ) {
        $this->updateMunicipioPort = $updateMunicipioPort;
        $this->getMunicipioByIdPort = $getMunicipioByIdPort;
    }

    public function execute(UpdateMunicipioCommand $command): MunicipioModel
    {
        $municipio = MunicipioApplicationMapper::fromUpdateCommandToModel($command);

        $existing = $this->getMunicipioByIdPort->getById($municipio->id());

        if ($existing === null) {
            throw MunicipioNotFoundException::becauseIdWasNotFound($municipio->id()->value());
        }

        return $this->updateMunicipioPort->update($municipio);
    }
}
