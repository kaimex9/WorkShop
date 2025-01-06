<?php
class Reparation
{
    private $UUID;
    private $name;
    private $registerDate;
    private $license;
    private $picture;

    public function __construct($UUID, $name, $registerDate, $license, $picture)
    {
        $this->UUID = $UUID;
        $this->name = $name;
        $this->registerDate = $registerDate;
        $this->license = $license;
        $this->picture = $picture;
    }

    public function getUUID()
    {
        return $this->UUID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    public function getLicense()
    {
        return $this->license;
    }

    public function getPicture()
    {
        return $this->picture;
    }
}