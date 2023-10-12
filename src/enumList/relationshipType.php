<?php

namespace enumList;

trait getRelationshipType
{
    public function getValue(): string
    {
        return $this->value;
    }

    public static function getStringFromRelationshipType(relationshipType $relationshipType): string
    {
        return $relationshipType->getValue();
    }
}

abstract class relationshipType
{
    use getRelationshipType, \trait\enumList;

    public const PARENT = "Parent";
    public const CHILD = "Enfant";
    public const SPOUSE = "Conjoint(e)";
    public const SIBLING = "Fraterie";
    public const GRANDPARENT = "Grand-parent";
    public const GRANDCHILD = "Petit-enfant";
    public const COUSIN = "Cousin";
    public const AUNT_UNCLE = "Oncle/Tante";
    public const NIECE_NEPHEW = "Nièce/Neveu";
    public const PARENT_INLAW = "Beau-parent";
    public const OTHER = "AUTRE";

    public static function cases(): array
    {
        return [
            ['name' => 'PARENT', 'value' => self::PARENT],
            ['name' => 'CHILD', 'value' => self::CHILD],
            ['name' => 'SPOUSE', 'value' => self::SPOUSE],
            ['name' => 'SIBLING', 'value' => self::SIBLING],
            ['name' => 'GRANDPARENT', 'value' => self::GRANDPARENT],
            ['name' => 'GRANDCHILD', 'value' => self::GRANDCHILD],
            ['name' => 'COUSIN', 'value' => self::COUSIN],
            ['name' => 'AUNT_UNCLE', 'value' => self::AUNT_UNCLE],
            ['name' => 'NIECE_NEPHEW', 'value' => self::NIECE_NEPHEW],
            ['name' => 'PARENT_INLAW', 'value' => self::PARENT_INLAW],
            ['name' => 'OTHER', 'value' => self::OTHER],
        ];
    }
}

// Exemple d'utilisation
// $names = RelationshipType::names();
// $values = RelationshipType::values();
// $array = RelationshipType::array();

// print_r($names);
// print_r($values);
// print_r($array);

?>