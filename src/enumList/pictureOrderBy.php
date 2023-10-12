<?php
namespace enumList;

abstract class pictureOrderBy
{
    use \trait\enumList;

    public const LAST_UPDATE = 'Date de mise à jour';
    public const CREATE_DATE = 'Date de création';

    public static function cases(): array
    {
        return [
            ['name' => 'lastUpdate', 'value' => self::LAST_UPDATE],
            ['name' => 'createDate', 'value' => self::CREATE_DATE],
        ];
    }
}

?>
