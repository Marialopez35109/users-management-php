<?php

class MunicipioNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound($id)
    {
        return new self('The municipio with id ' . $id . ' was not found.');
    }
}
