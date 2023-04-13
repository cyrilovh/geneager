<?php

    namespace class;

    class relationship
    {
        private int $id;
        private int $idAncestor1;
        private string $identyiAncestor1;
        private int $idAncestor2;
        private string $identyiAncestor2;
        private \enumlist\relationshipType $relationshipType;

        public function __construct(int $id, int $idAncestor1, string $identyiAncestor1, int $idAncestor2, string $identyiAncestor2, \enumlist\relationshipType $relationshipType)
        {
            $this->id = $id;
            $this->idAncestor1 = $idAncestor1;
            $this->identyiAncestor1 = $identyiAncestor1;
            $this->idAncestor2 = $idAncestor2;
            $this->identyiAncestor2 = $identyiAncestor2;
            $this->relationshipType = $relationshipType;
            $this->relationshipTypeStr = \enumlist\RelationshipType::getStringFromRelationshipType($relationshipType);
        }

        public function getAll(): array
        {
            return [
                "id" => $this->id,
                "idAncestor1" => $this->idAncestor1,
                "identyiAncestor1" => $this->identyiAncestor1,
                "idAncestor2" => $this->idAncestor2,
                "identyiAncestor2" => $this->identyiAncestor2,
                "relationshipType" => $this->relationshipType,
                "relationshipTypeStr" => $this->relationshipTypeStr
            ];
        }
        
    }