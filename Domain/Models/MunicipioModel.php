<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/MunicipioId.php';
require_once __DIR__ . '/../ValueObjects/MunicipioName.php';
require_once __DIR__ . '/../Exceptions/InvalidMunicipioDataException.php';

final class MunicipioModel
{
    private MunicipioId $id;
    private MunicipioName $nombre;
    private string $departamento;
    private string $pais;
    private string $alcalde;
    private string $gobernador;
    private string $patronoReligioso;
    private int $numHabitantes;
    private int $numCasas;
    private int $numParques;
    private int $numColegios;
    private string $descripcion;

    public function __construct(
        MunicipioId $id,
        MunicipioName $nombre,
        string $departamento,
        string $pais,
        string $alcalde,
        string $gobernador,
        string $patronoReligioso,
        int $numHabitantes,
        int $numCasas,
        int $numParques,
        int $numColegios,
        string $descripcion
    ) {
        $departamento = trim($departamento);
        $pais = trim($pais);

        if ($departamento === '') {
            throw InvalidMunicipioDataException::becauseFieldIsEmpty('departamento');
        }

        if ($pais === '') {
            throw InvalidMunicipioDataException::becauseFieldIsEmpty('pais');
        }

        self::ensureNotNegative($numHabitantes, 'numHabitantes');
        self::ensureNotNegative($numCasas, 'numCasas');
        self::ensureNotNegative($numParques, 'numParques');
        self::ensureNotNegative($numColegios, 'numColegios');

        $this->id = $id;
        $this->nombre = $nombre;
        $this->departamento = $departamento;
        $this->pais = $pais;
        $this->alcalde = trim($alcalde);
        $this->gobernador = trim($gobernador);
        $this->patronoReligioso = trim($patronoReligioso);
        $this->numHabitantes = $numHabitantes;
        $this->numCasas = $numCasas;
        $this->numParques = $numParques;
        $this->numColegios = $numColegios;
        $this->descripcion = trim($descripcion);
    }

    private static function ensureNotNegative(int $value, string $field): void
    {
        if ($value < 0) {
            throw InvalidMunicipioDataException::becauseNumberIsNegative($field);
        }
    }

    public function id(): MunicipioId
    {
        return $this->id;
    }

    public function nombre(): MunicipioName
    {
        return $this->nombre;
    }

    public function departamento(): string
    {
        return $this->departamento;
    }

    public function pais(): string
    {
        return $this->pais;
    }

    public function alcalde(): string
    {
        return $this->alcalde;
    }

    public function gobernador(): string
    {
        return $this->gobernador;
    }

    public function patronoReligioso(): string
    {
        return $this->patronoReligioso;
    }

    public function numHabitantes(): int
    {
        return $this->numHabitantes;
    }

    public function numCasas(): int
    {
        return $this->numCasas;
    }

    public function numParques(): int
    {
        return $this->numParques;
    }

    public function numColegios(): int
    {
        return $this->numColegios;
    }

    public function descripcion(): string
    {
        return $this->descripcion;
    }

    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'nombre' => $this->nombre->value(),
            'departamento' => $this->departamento,
            'pais' => $this->pais,
            'alcalde' => $this->alcalde,
            'gobernador' => $this->gobernador,
            'patronoReligioso' => $this->patronoReligioso,
            'numHabitantes' => $this->numHabitantes,
            'numCasas' => $this->numCasas,
            'numParques' => $this->numParques,
            'numColegios' => $this->numColegios,
            'descripcion' => $this->descripcion
        );
    }
}
