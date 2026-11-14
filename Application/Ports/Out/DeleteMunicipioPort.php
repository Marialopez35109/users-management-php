<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/MunicipioId.php';

interface DeleteMunicipioPort
{
    public function delete(MunicipioId $municipioId): void;
}
