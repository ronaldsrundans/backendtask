<?php

namespace validation;

class CardValidator implements Validator
{
    public static function isValid($input): bool
    {
        return StringValidator::isValid($input) && strlen($input) === 8;
    }
}