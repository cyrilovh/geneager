<?php

namespace enumList;

abstract class ancestorOrderBy
{
    use \trait\enumList;

    public const LAST_UPDATE = 'Date de mise à jour';
    public const CREATE_DATE = 'Date de création';
    public const BIRTHDAY = 'Date de naissance';
    public const DEATH_DATE = 'Date de décès';

    public static function cases(): array
    {
        return [
            ['name' => 'lastUpdate', 'value' => self::LAST_UPDATE],
            ['name' => 'createDate', 'value' => self::CREATE_DATE],
            ['name' => 'birthDay', 'value' => self::BIRTHDAY],
            ['name' => 'deathDate', 'value' => self::DEATH_DATE],
        ];
    }
}

?>


