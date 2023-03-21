<?php
  namespace enumList;

  trait getGender
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

  enum gender:int
  {

    use getGender;
    case inconnu = 2;
    case femme = 0;
    case homme = 1;
  }

?>


