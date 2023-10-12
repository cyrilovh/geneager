<?php
namespace enumList;

use class\validator;

trait getGender
{
    /**
     * Retourne le genre en tant que chaîne de caractères correspondant à la valeur (int)
     *
     * @param integer $n
     * @return string
     */
    public static function getByID(int $n): string
    {
        $gender = array_search($n, self::array());
        return (!empty($gender)) ? $gender : "???";
    }
}

abstract class gender
{
    use getGender, \trait\enumList;

    public const INCONNU = 2;
    public const FEMME = 0;
    public const HOMME = 1;

    public static function cases(): array
    {
        return [
            ['name' => 'inconnu', 'value' => self::INCONNU],
            ['name' => 'femme', 'value' => self::FEMME],
            ['name' => 'homme', 'value' => self::HOMME],
        ];
    }
}

?>


