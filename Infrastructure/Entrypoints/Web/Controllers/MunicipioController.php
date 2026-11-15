<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/MunicipioWebMapper.php';

require_once __DIR__ . '/../../../../Application/Ports/In/CreateMunicipioUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateMunicipioUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetMunicipioByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllMunicipiosUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteMunicipioUseCase.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllMunicipiosQuery.php';

final class MunicipioController
{
    private CreateMunicipioUseCase $createMunicipioUseCase;
    private UpdateMunicipioUseCase $updateMunicipioUseCase;
    private GetMunicipioByIdUseCase $getMunicipioByIdUseCase;
    private GetAllMunicipiosUseCase $getAllMunicipiosUseCase;
    private DeleteMunicipioUseCase $deleteMunicipioUseCase;
    private MunicipioWebMapper $mapper;

    public function __construct(
        CreateMunicipioUseCase $createMunicipioUseCase,
        UpdateMunicipioUseCase $updateMunicipioUseCase,
        GetMunicipioByIdUseCase $getMunicipioByIdUseCase,
        GetAllMunicipiosUseCase $getAllMunicipiosUseCase,
        DeleteMunicipioUseCase $deleteMunicipioUseCase,
        MunicipioWebMapper $mapper
    ) {
        $this->createMunicipioUseCase = $createMunicipioUseCase;
        $this->updateMunicipioUseCase = $updateMunicipioUseCase;
        $this->getMunicipioByIdUseCase = $getMunicipioByIdUseCase;
        $this->getAllMunicipiosUseCase = $getAllMunicipiosUseCase;
        $this->deleteMunicipioUseCase = $deleteMunicipioUseCase;
        $this->mapper = $mapper;
    }

    /**
     * @return MunicipioResponse[]
     */
    public function index(): array
    {
        $municipios = $this->getAllMunicipiosUseCase->execute(new GetAllMunicipiosQuery());

        return $this->mapper->fromModelsToResponses($municipios);
    }

    public function show(string $id): MunicipioResponse
    {
        $query = $this->mapper->fromIdToGetByIdQuery($id);
        $municipio = $this->getMunicipioByIdUseCase->execute($query);

        return $this->mapper->fromModelToResponse($municipio);
    }

    public function store(CreateMunicipioWebRequest $request): MunicipioResponse
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $municipio = $this->createMunicipioUseCase->execute($command);

        return $this->mapper->fromModelToResponse($municipio);
    }

    public function update(UpdateMunicipioWebRequest $request): MunicipioResponse
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $municipio = $this->updateMunicipioUseCase->execute($command);

        return $this->mapper->fromModelToResponse($municipio);
    }

    public function delete(string $id): void
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteMunicipioUseCase->execute($command);
    }
}
