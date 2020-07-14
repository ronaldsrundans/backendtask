<?php

namespace validation;

class StringValidator implements Validator
{
    public static function isValid($input): bool
    {
        return is_string($input);
    }
}