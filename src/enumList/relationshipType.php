<?php

namespace enumList;

trait getRelationshipType
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

    public function getValue():string
    {
        return $this->value;
    }

    public static function getStringFromRelationshipType(relationshipType $relationshipType): string
    {
        return $relationshipType->getValue();
    }


}

enum relationshipType: string
{

    use getRelationshipType;

    case PARENT = "Parent";
    case CHILD = "Enfant";
    case SPOUSE = "Conjoint(e)";
    case SIBLING = "Fraterie";
    case GRANDPARENT = "Grand-parent";
    case GRANDCHILD = "Petit-enfant";
    case COUSIN = "Cousin";
    case AUNT_UNCLE = "Oncle/Tante";
    case NIECE_NEPHEW = "Nièce/Neveu";
    case PARENT_INLAW = "Beau-parent";
    case OTHER = "AUTRE";
}
