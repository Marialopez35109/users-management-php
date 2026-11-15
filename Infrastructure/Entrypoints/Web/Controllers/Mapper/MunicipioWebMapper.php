<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateMunicipioRequest.php';
require_once __DIR__ . '/../Dto/UpdateMunicipioRequest.php';
require_once __DIR__ . '/../Dto/MunicipioResponse.php';

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreateMunicipioCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdateMunicipioCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeleteMunicipioCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetMunicipioByIdQuery.php';

require_once __DIR__ . '/../../../../../Domain/Models/MunicipioModel.php';

final class MunicipioWebMapper
{
    public function fromCreateRequestToCommand(CreateMunicipioWebRequest $request): CreateMunicipioCommand
    {
        return new CreateMunicipioCommand(
            $request->getNombre(),
            $request->getDepartamento(),
            $request->getPais(),
            $request->getAlcalde(),
            $request->getGobernador(),
            $request->getPatronoReligioso(),
            $request->getNumHabitantes(),
            $request->getNumCasas(),
            $request->getNumParques(),
            $request->getNumColegios(),
            $request->getDescripcion()
        );
    }

    public function fromUpdateRequestToCommand(UpdateMunicipioWebRequest $request): UpdateMunicipioCommand
    {
        return new UpdateMunicipioCommand(
            $request->getId(),
            $request->getNombre(),
            $request->getDepartamento(),
            $request->getPais(),
            $request->getAlcalde(),
            $request->getGobernador(),
            $request->getPatronoReligioso(),
            $request->getNumHabitantes(),
            $request->getNumCasas(),
            $request->getNumParques(),
            $request->getNumColegios(),
            $request->getDescripcion()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetMunicipioByIdQuery
    {
        return new GetMunicipioByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteMunicipioCommand
    {
        return new DeleteMunicipioCommand($id);
    }

    public function fromModelToResponse(MunicipioModel $municipio): MunicipioResponse
    {
        return new MunicipioResponse(
            $municipio->id()->value(),
            $municipio->nombre()->value(),
            $municipio->departamento(),
            $municipio->pais(),
            $municipio->alcalde(),
            $municipio->gobernador(),
            $municipio->patronoReligioso(),
            $municipio->numHabitantes(),
            $municipio->numCasas(),
            $municipio->numParques(),
            $municipio->numColegios(),
            $municipio->descripcion()
        );
    }

    /**
     * @param MunicipioModel[] $municipios
     * @return MunicipioResponse[]
     */
    public function fromModelsToResponses(array $municipios): array
    {
        $responses = array();

        foreach ($municipios as $municipio) {
            $responses[] = $this->fromModelToResponse($municipio);
        }

        return $responses;
    }
}
