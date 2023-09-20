<?php
namespace enumList;

trait getYesNo
{
    public static function names(): array
    {

        return array_column(self::cases(), 'value');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name'); 
    }

    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }
}

abstract class YesNo
{
    use getYesNo;

    public const YES = "1";
    public const NO = "0";

    public static function cases(): array
    {
        return [
            ['name' => 'Oui', 'value' => self::YES],
            ['name' => 'Non', 'value' => self::NO],
        ];
    }
}

?>