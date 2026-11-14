<?php

require_once __DIR__ . '/../Exceptions/InvalidMunicipioIdException.php';

class MunicipioId
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidMunicipioIdException::becauseValueIsEmpty();
        }

        $this->value = $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(MunicipioId $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value;
    }
}
