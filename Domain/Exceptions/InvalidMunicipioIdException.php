<?php

class InvalidMunicipioIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The municipio id must not be empty.');
    }
}
