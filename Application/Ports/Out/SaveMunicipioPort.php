<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/MunicipioModel.php';

interface SaveMunicipioPort
{
    public function save(MunicipioModel $municipio): MunicipioModel;
}
