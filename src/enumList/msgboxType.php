<?php
namespace enumList;

abstract class msgboxType
{
    use \trait\enumList;

    public const SUCCESS = 'Succès';
    public const WARNING = 'Avertissement';
    public const ERROR = 'Erreur';
    public const INFO = 'Information';

    public static function cases(): array
    {
        return [
            ['name' => 'SUCCESS', 'value' => self::SUCCESS],
            ['name' => 'WARNING', 'value' => self::WARNING],
            ['name' => 'ERROR', 'value' => self::ERROR],
            ['name' => 'INFO', 'value' => self::INFO]
        ];
    }
}

?>


