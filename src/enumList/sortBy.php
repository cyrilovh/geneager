<?php
namespace enumList;

abstract class sortBy
{
    use \trait\enumList;

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


