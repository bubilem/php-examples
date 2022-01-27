<?php

namespace SimpleOrmExample\Util;

class Str
{
    public static function snakeCaseToCamelCase(string $value): string
    {
        return lcfirst(str_replace('_', '', ucwords($value, '_')));
    }

    public static function camelCaseToSnakeCase(string $value): string
    {
        return strtolower(implode('_', preg_split('/(?=[A-Z])/', lcfirst($value))));
    }
}
