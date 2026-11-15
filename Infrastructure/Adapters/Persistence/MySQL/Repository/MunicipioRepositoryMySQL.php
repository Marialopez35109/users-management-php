<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveMunicipioPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateMunicipioPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetMunicipioByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllMunicipiosPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteMunicipioPort.php';

require_once __DIR__ . '/../Mapper/MunicipioPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/MunicipioModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/MunicipioId.php';

final class MunicipioRepositoryMySQL implements
    SaveMunicipioPort,
    UpdateMunicipioPort,
    GetMunicipioByIdPort,
    GetAllMunicipiosPort,
    DeleteMunicipioPort
{
    private PDO $pdo;
    private MunicipioPersistenceMapper $mapper;

    public function __construct(PDO $pdo, MunicipioPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(MunicipioModel $municipio): MunicipioModel
    {
        $dto = $this->mapper->fromModelToDto($municipio);

        $sql = '
            INSERT INTO municipios (
                id,
                nombre,
                departamento,
                pais,
                alcalde,
                gobernador,
                patrono_religioso,
                num_habitantes,
                num_casas,
                num_parques,
                num_colegios,
                descripcion,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :nombre,
                :departamento,
                :pais,
                :alcalde,
                :gobernador,
                :patrono_religioso,
                :num_habitantes,
                :num_casas,
                :num_parques,
                :num_colegios,
                :descripcion,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->dtoToParams($dto));

        $saved = $this->getById(new MunicipioId($dto->id()));

        if ($saved === null) {
            throw new RuntimeException('The municipio could not be recovered after save.');
        }

        return $saved;
    }

    public function update(MunicipioModel $municipio): MunicipioModel
    {
        $dto = $this->mapper->fromModelToDto($municipio);

        $sql = '
            UPDATE municipios
               SET nombre = :nombre,
                   departamento = :departamento,
                   pais = :pais,
                   alcalde = :alcalde,
                   gobernador = :gobernador,
                   patrono_religioso = :patrono_religioso,
                   num_habitantes = :num_habitantes,
                   num_casas = :num_casas,
                   num_parques = :num_parques,
                   num_colegios = :num_colegios,
                   descripcion = :descripcion,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->dtoToParams($dto));

        $updated = $this->getById(new MunicipioId($dto->id()));

        if ($updated === null) {
            throw new RuntimeException('The municipio could not be recovered after update.');
        }

        return $updated;
    }

    public function getById(MunicipioId $municipioId): ?MunicipioModel
    {
        $sql = '
            SELECT
                id,
                nombre,
                departamento,
                pais,
                alcalde,
                gobernador,
                patrono_religioso,
                num_habitantes,
                num_casas,
                num_parques,
                num_colegios,
                descripcion,
                created_at,
                updated_at
            FROM municipios
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $municipioId->value(),
        ));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return MunicipioModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT
                id,
                nombre,
                departamento,
                pais,
                alcalde,
                gobernador,
                patrono_religioso,
                num_habitantes,
                num_casas,
                num_parques,
                num_colegios,
                descripcion,
                created_at,
                updated_at
            FROM municipios
            ORDER BY nombre ASC
        ';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(MunicipioId $municipioId): void
    {
        $sql = 'DELETE FROM municipios WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $municipioId->value(),
        ));
    }

    /**
     * @return array<string, mixed>
     */
    private function dtoToParams(MunicipioPersistenceDto $dto): array
    {
        return array(
            ':id' => $dto->id(),
            ':nombre' => $dto->nombre(),
            ':departamento' => $dto->departamento(),
            ':pais' => $dto->pais(),
            ':alcalde' => $dto->alcalde(),
            ':gobernador' => $dto->gobernador(),
            ':patrono_religioso' => $dto->patronoReligioso(),
            ':num_habitantes' => $dto->numHabitantes(),
            ':num_casas' => $dto->numCasas(),
            ':num_parques' => $dto->numParques(),
            ':num_colegios' => $dto->numColegios(),
            ':descripcion' => $dto->descripcion(),
        );
    }
}
