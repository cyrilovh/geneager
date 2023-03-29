<?php
  namespace enumList;

  trait getYesNo
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

  enum yesNo:string
  {

    use getYesNo;
    case Oui = "1";
    case Non = '0';
  }

?>