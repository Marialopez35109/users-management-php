<?php

declare(strict_types=1);

final class MunicipioResponse
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
        $this->id = $id;
        $this->nombre = $nombre;
        $this->departamento = $departamento;
        $this->pais = $pais;
        $this->alcalde = $alcalde;
        $this->gobernador = $gobernador;
        $this->patronoReligioso = $patronoReligioso;
        $this->numHabitantes = $numHabitantes;
        $this->numCasas = $numCasas;
        $this->numParques = $numParques;
        $this->numColegios = $numColegios;
        $this->descripcion = $descripcion;
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

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'departamento' => $this->departamento,
            'pais' => $this->pais,
            'alcalde' => $this->alcalde,
            'gobernador' => $this->gobernador,
            'patronoReligioso' => $this->patronoReligioso,
            'numHabitantes' => $this->numHabitantes,
            'numCasas' => $this->numCasas,
            'numParques' => $this->numParques,
            'numColegios' => $this->numColegios,
            'descripcion' => $this->descripcion,
        );
    }
}
