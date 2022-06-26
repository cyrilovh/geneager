<?php
  namespace enumList;

  trait getVisibility
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

  enum visibility: int
  {

    use getVisibility;
    case public = 0;
    case privé = 1;
  }

?>