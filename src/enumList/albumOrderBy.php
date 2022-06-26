<?php
  namespace enumList;

  trait getAlbumOrderBy
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

  enum albumOrderBy: string
  {

    use getAlbumOrderBy;

    case lastUpdate = 'Date de mise à jour';
    case createDate = 'Date de creation';
    case title = 'Nom de d\'album';
  }

?>


