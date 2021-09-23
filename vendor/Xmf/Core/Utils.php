<?php

namespace Xmf\Core;

class Utils
{
    public static function convertToPascalCase(string $string): string
    {
        return lcfirst(self::convertToCamelCase($string));
    }

    public static function convertToCamelCase(string $string): string
    {
        $string = str_replace('-', ' ', $string);
        $string = ucwords($string);
        return str_replace(' ', '', $string);
    }
}