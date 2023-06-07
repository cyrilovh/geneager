<?php
namespace enumList;

trait getPictureOrderBy
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
        return array_combine(self::values(), self::names());
    }
}

abstract class pictureOrderBy
{
    use getPictureOrderBy;

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
