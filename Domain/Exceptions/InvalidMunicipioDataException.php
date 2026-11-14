<?php

class InvalidMunicipioDataException extends InvalidArgumentException
{
    public static function becauseFieldIsEmpty($field)
    {
        return new self('The municipio field "' . $field . '" must not be empty.');
    }

    public static function becauseNumberIsNegative($field)
    {
        return new self('The municipio field "' . $field . '" must not be negative.');
    }
}
