<?php

namespace validation;

interface Validator
{
    public static function isValid($input): bool;
}