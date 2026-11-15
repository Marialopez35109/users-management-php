<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteMunicipioUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteMunicipioPort.php';
require_once __DIR__ . '/../Ports/Out/GetMunicipioByIdPort.php';
require_once __DIR__ . '/Mappers/MunicipioApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/MunicipioNotFoundException.php';

final class DeleteMunicipioService implements DeleteMunicipioUseCase
{
    private DeleteMunicipioPort $deleteMunicipioPort;
    private GetMunicipioByIdPort $getMunicipioByIdPort;

    public function __construct(
        DeleteMunicipioPort $deleteMunicipioPort,
        GetMunicipioByIdPort $getMunicipioByIdPort
    ) {
        $this->deleteMunicipioPort = $deleteMunicipioPort;
        $this->getMunicipioByIdPort = $getMunicipioByIdPort;
    }

    public function execute(DeleteMunicipioCommand $command): void
    {
        $municipioId = MunicipioApplicationMapper::fromDeleteCommandToMunicipioId($command);

        $existing = $this->getMunicipioByIdPort->getById($municipioId);

        if ($existing === null) {
            throw MunicipioNotFoundException::becauseIdWasNotFound($municipioId->value());
        }

        $this->deleteMunicipioPort->delete($municipioId);
    }
}
