<?php

namespace validation;

class CountValidator implements Validator
{
    public static function isValid($input): bool
    {
        return NumberValidator::isValid($input) && (int)$input !== 0;
    }
}