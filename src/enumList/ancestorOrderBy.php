<?php
  namespace enumList;

  trait getAncestorOrderBy
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

  enum ancestorOrderBy: string
  {

    use getAncestorOrderBy;

    case lastUpdate = 'Date de mise à jour';
    case createDate = 'Date de creation';
    case birthDay = 'Date de naissance';
    case deathDate = 'Date de décès';

  }

?>


