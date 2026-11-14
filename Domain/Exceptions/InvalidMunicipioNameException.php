<?php

class InvalidMunicipioNameException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The municipio name must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The municipio name must contain at least ' . $minLength . ' characters.');
    }
}
