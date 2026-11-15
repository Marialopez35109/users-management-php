<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/MunicipioPersistenceDto.php';
require_once __DIR__ . '/../Entity/MunicipioEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/MunicipioModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/MunicipioId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/MunicipioName.php';

final class MunicipioPersistenceMapper
{
    public function fromModelToDto(MunicipioModel $municipio): MunicipioPersistenceDto
    {
        return new MunicipioPersistenceDto(
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

    public function fromRowToEntity(array $row): MunicipioEntity
    {
        return new MunicipioEntity(
            (string) $row['id'],
            (string) $row['nombre'],
            (string) $row['departamento'],
            (string) $row['pais'],
            (string) $row['alcalde'],
            (string) $row['gobernador'],
            (string) $row['patrono_religioso'],
            (int) $row['num_habitantes'],
            (int) $row['num_casas'],
            (int) $row['num_parques'],
            (int) $row['num_colegios'],
            (string) ($row['descripcion'] ?? ''),
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(MunicipioEntity $entity): MunicipioModel
    {
        return new MunicipioModel(
            new MunicipioId($entity->id()),
            new MunicipioName($entity->nombre()),
            $entity->departamento(),
            $entity->pais(),
            $entity->alcalde(),
            $entity->gobernador(),
            $entity->patronoReligioso(),
            $entity->numHabitantes(),
            $entity->numCasas(),
            $entity->numParques(),
            $entity->numColegios(),
            $entity->descripcion()
        );
    }

    public function fromRowToModel(array $row): MunicipioModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return MunicipioModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}
