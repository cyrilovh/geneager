<?php
namespace enumList;

trait getVisibility
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }
}

abstract class Visibility
{
    use getVisibility;

    public const PUBLIC = "1";
    public const PRIVATE = "0";

    public static function cases(): array
    {
        return [
            ['name' => 'public', 'value' => self::PUBLIC],
            ['name' => 'privé', 'value' => self::PRIVATE],
        ];
    }
}

?>