<?php
  namespace enumList;

use class\validator;

  trait getGender
  {
    /**
     * Return values (int) as array
     *
     * @return array
     */
    public static function names():array{
      return array_column(self::cases(), 'name');
    }

    /**
    * Return gender names as array
    * @return array
    */
    public static function values():array{
      return array_column(self::cases(), 'value');
    }

    /**
    * Return an array with the name of the enum as key and the value as value
    * n => gender
    * @return array
    */
    public static function array():array{
      return array_combine(self::values(), self::names());
    }
    
    /**
     * Return gender as string since the value (int)
     *
     * @param integer $n
     * @return string
     */
    public static function getByID(int $n):string{
      $gender = array_search($n, array_flip(self::array()));
      return (!validator::isNullOrEmpty($gender)) ? $gender : "???";
    }

  }

  enum gender:int
  {

    use getGender;
    case inconnu = 2;
    case femme = 0;
    case homme = 1;
  }

?>


