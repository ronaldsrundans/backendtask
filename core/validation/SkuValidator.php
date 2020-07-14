<?php

namespace validation;

class SkuValidator implements Validator
{
    public static function isValid($input): bool
    {
        return StringValidator::isValid($input) && strlen($input) === 8;
    }
}