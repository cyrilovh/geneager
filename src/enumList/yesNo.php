<?php
namespace enumList;

abstract class YesNo
{
    use \trait\enumList;

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