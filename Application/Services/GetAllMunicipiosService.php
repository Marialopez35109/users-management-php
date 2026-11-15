<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllMunicipiosUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllMunicipiosPort.php';

final class GetAllMunicipiosService implements GetAllMunicipiosUseCase
{
    private GetAllMunicipiosPort $getAllMunicipiosPort;

    public function __construct(GetAllMunicipiosPort $getAllMunicipiosPort)
    {
        $this->getAllMunicipiosPort = $getAllMunicipiosPort;
    }

    /**
     * @return MunicipioModel[]
     */
    public function execute(GetAllMunicipiosQuery $query): array
    {
        return $this->getAllMunicipiosPort->getAll();
    }
}
