<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetMunicipioByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetMunicipioByIdPort.php';
require_once __DIR__ . '/Mappers/MunicipioApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/MunicipioNotFoundException.php';

final class GetMunicipioByIdService implements GetMunicipioByIdUseCase
{
    private GetMunicipioByIdPort $getMunicipioByIdPort;

    public function __construct(GetMunicipioByIdPort $getMunicipioByIdPort)
    {
        $this->getMunicipioByIdPort = $getMunicipioByIdPort;
    }

    public function execute(GetMunicipioByIdQuery $query): MunicipioModel
    {
        $municipioId = MunicipioApplicationMapper::fromGetByIdQueryToMunicipioId($query);

        $municipio = $this->getMunicipioByIdPort->getById($municipioId);

        if ($municipio === null) {
            throw MunicipioNotFoundException::becauseIdWasNotFound($municipioId->value());
        }

        return $municipio;
    }
}
