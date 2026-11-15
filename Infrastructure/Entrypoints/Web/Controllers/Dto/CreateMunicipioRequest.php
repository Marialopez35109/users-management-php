<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Domain/Exceptions/InvalidMunicipioDataException.php';

final class CreateMunicipioWebRequest
{
    private string $nombre;
    private string $departamento;
    private string $pais;
    private string $alcalde;
    private string $gobernador;
    private string $patronoReligioso;
    private string $numHabitantes;
    private string $numCasas;
    private string $numParques;
    private string $numColegios;
    private string $descripcion;

    public function __construct(
        string $nombre,
        string $departamento,
        string $pais,
        string $alcalde,
        string $gobernador,
        string $patronoReligioso,
        string $numHabitantes,
        string $numCasas,
        string $numParques,
        string $numColegios,
        string $descripcion
    ) {
        $this->nombre = trim($nombre);
        $this->departamento = trim($departamento);
        $this->pais = trim($pais);
        $this->alcalde = trim($alcalde);
        $this->gobernador = trim($gobernador);
        $this->patronoReligioso = trim($patronoReligioso);
        $this->numHabitantes = trim($numHabitantes);
        $this->numCasas = trim($numCasas);
        $this->numParques = trim($numParques);
        $this->numColegios = trim($numColegios);
        $this->descripcion = trim($descripcion);
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDepartamento(): string
    {
        return $this->departamento;
    }

    public function getPais(): string
    {
        return $this->pais;
    }

    public function getAlcalde(): string
    {
        return $this->alcalde;
    }

    public function getGobernador(): string
    {
        return $this->gobernador;
    }

    public function getPatronoReligioso(): string
    {
        return $this->patronoReligioso;
    }

    public function getNumHabitantes(): int
    {
        return self::toInt($this->numHabitantes, 'numHabitantes');
    }

    public function getNumCasas(): int
    {
        return self::toInt($this->numCasas, 'numCasas');
    }

    public function getNumParques(): int
    {
        return self::toInt($this->numParques, 'numParques');
    }

    public function getNumColegios(): int
    {
        return self::toInt($this->numColegios, 'numColegios');
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    private static function toInt(string $value, string $field): int
    {
        if ($value === '') {
            return 0;
        }

        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw InvalidMunicipioDataException::becauseNumberIsInvalid($field);
        }

        return (int) $value;
    }
}
