<?php

namespace validation;

class NumberValidator implements Validator
{
    public static function isValid($input): bool
    {
        return is_numeric($input);
    }
}