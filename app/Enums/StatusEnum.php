<?php
namespace App\Enums;

enum StatusEnum:int
{
    case Active = 1;

    case Inactive = 2;

    public static function availableTypes(): array
    {
        return [

            self::Active->value,

            self::Inactive->value,
        ];
    }
}
