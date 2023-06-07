<?php
namespace enumList;

trait getSortBy
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

abstract class sortBy
{
    use getSortBy;

    public const ASC = 'Croissant';
    public const DESC = 'Décroissant';

    public static function cases(): array
    {
        return [
            ['name' => 'ASC', 'value' => self::ASC],
            ['name' => 'DESC', 'value' => self::DESC],
        ];
    }
}

?>


