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

  enum sortBy: string
  {

    use getSortBy;

    case ASC = 'Croissant';
    case DESC = 'Décroissant';

  }

?>


