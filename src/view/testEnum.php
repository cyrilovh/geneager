<?php
/*
https://stackoverflow.com/questions/69793557/how-to-get-all-values-of-an-enum-in-php
*/
trait getOrderBy
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

enum OrderBy: string
{

  use getOrderBy;

  case lastUpdate = 'Date de mise à jour';
  case createDate = 'Date de creation';

}

print_r(OrderBy::array());
?>