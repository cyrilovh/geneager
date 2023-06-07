<?php
namespace enumList;

use class\validator;

trait getGender
{
    /**
     * Retourne les noms (string) en tant qu'array
     *
     * @return array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retourne les valeurs (int) en tant qu'array
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Retourne un array avec le nom de l'énumération comme clé et la valeur comme valeur
     *
     * @return array
     */
    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }

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
    use getGender;

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


