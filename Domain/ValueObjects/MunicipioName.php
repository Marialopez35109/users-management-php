<?php

require_once __DIR__ . '/../Exceptions/InvalidMunicipioNameException.php';

class MunicipioName
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidMunicipioNameException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < 2) {
            throw InvalidMunicipioNameException::becauseLengthIsTooShort(2);
        }

        $this->value = $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(MunicipioName $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value;
    }
}
