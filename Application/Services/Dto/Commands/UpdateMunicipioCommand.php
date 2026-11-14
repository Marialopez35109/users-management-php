<?php

declare(strict_types=1);

final class UpdateMunicipioCommand
{
    private string $id;
    private string $nombre;
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
        string $id,
        string $nombre,
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
        $this->id = trim($id);
        $this->nombre = trim($nombre);
        $this->departamento = trim($departamento);
        $this->pais = trim($pais);
        $this->alcalde = trim($alcalde);
        $this->gobernador = trim($gobernador);
        $this->patronoReligioso = trim($patronoReligioso);
        $this->numHabitantes = $numHabitantes;
        $this->numCasas = $numCasas;
        $this->numParques = $numParques;
        $this->numColegios = $numColegios;
        $this->descripcion = trim($descripcion);
    }

    public function getId(): string
    {
        return $this->id;
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
        return $this->numHabitantes;
    }

    public function getNumCasas(): int
    {
        return $this->numCasas;
    }

    public function getNumParques(): int
    {
        return $this->numParques;
    }

    public function getNumColegios(): int
    {
        return $this->numColegios;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
}
