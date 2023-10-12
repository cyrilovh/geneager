<?php
namespace enumList;

abstract class visibility
{
    use \trait\enumList;

    public const PUBLIC = "1";
    public const PRIVATE = "0";

    public static function cases(): array
    {
        return [
            ['value' => 'Public', 'name' => self::PUBLIC],
            ['value' => 'Privé', 'name' => self::PRIVATE],
        ];
    }
}

?>