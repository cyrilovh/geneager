<?php
    namespace class;

    class ancestor{
        private int $id;
        private ?string $firstNameList;
        private ?string $lastName;
        private ?string $maidenNameList;
        private ?string $birthNameList;
        private ?string $nickNameList;
        private ?string $otherLastNameList;
        private ?string $otherNameList;
        private ?string $fullIdentity;


        private ?string $photo;
        private ?int $gender; // check for use EnumList INT ?

        private ?int $birthdayY;
        private ?int $birthdayM;
        private ?int $birthdayD;
        private ?int $fullBirthDate;

        private ?int $birthCity; // id city
        private ?string $birthAccuracyLocation;
        private ?string $fullBirthLocation;

        private ?int $deathdayY;
        private ?int $deathdayM;
        private ?int $deathdayD;
        private ?int $fullDeathDate;

        private ?int $deathCity; // id city
        private ?string $deathAccuracyLocation;
        private ?string $fullDeathLocation;

        private ?int $cemeteryCity;
        private ?string $cemeteryAccuracyLocation;

        private ?string $biography;

        private string $author;
        private string $lastUpdate;
        private string $createDate;

        private ?array $relationList; // ????
        private ?array $eventList; // ????
        private ?array $documentList; // ????
        private ?array $pictureList; // ????
        private ?array $videoList; // ????

        
    }