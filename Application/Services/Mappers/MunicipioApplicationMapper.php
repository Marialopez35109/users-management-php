<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateMunicipioCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateMunicipioCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteMunicipioCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetMunicipioByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/MunicipioModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/MunicipioId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/MunicipioName.php';

final class MunicipioApplicationMapper
{
    public static function fromCreateCommandToModel(CreateMunicipioCommand $command): MunicipioModel
    {
        return new MunicipioModel(
            new MunicipioId(self::generateId()),
            new MunicipioName($command->getNombre()),
            $command->getDepartamento(),
            $command->getPais(),
            $command->getAlcalde(),
            $command->getGobernador(),
            $command->getPatronoReligioso(),
            $command->getNumHabitantes(),
            $command->getNumCasas(),
            $command->getNumParques(),
            $command->getNumColegios(),
            $command->getDescripcion()
        );
    }

    public static function fromUpdateCommandToModel(UpdateMunicipioCommand $command): MunicipioModel
    {
        return new MunicipioModel(
            new MunicipioId($command->getId()),
            new MunicipioName($command->getNombre()),
            $command->getDepartamento(),
            $command->getPais(),
            $command->getAlcalde(),
            $command->getGobernador(),
            $command->getPatronoReligioso(),
            $command->getNumHabitantes(),
            $command->getNumCasas(),
            $command->getNumParques(),
            $command->getNumColegios(),
            $command->getDescripcion()
        );
    }

    public static function fromGetByIdQueryToMunicipioId(GetMunicipioByIdQuery $query): MunicipioId
    {
        return new MunicipioId($query->getId());
    }

    public static function fromDeleteCommandToMunicipioId(DeleteMunicipioCommand $command): MunicipioId
    {
        return new MunicipioId($command->getId());
    }

    private static function generateId(): string
    {
        $data = random_bytes(16);
        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
