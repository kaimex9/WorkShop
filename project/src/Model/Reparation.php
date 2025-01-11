<?php

namespace WorkShop\Project\Src\Model;
require '..\..\vendor\autoload.php';
class Reparation
{
    private $id;
    private $UUID;
    private $name;
    private $registerDate;
    private $license;
    private $picture;

    public function __construct($id, $UUID, $name, $registerDate, $license, $picture)
    {
        $this->id = $id;
        $this->UUID = $UUID;
        $this->name = $name;
        $this->registerDate = $registerDate;
        $this->license = $license;
        $this->picture = $picture;
    }

    public function getID(){
        return $this->id;
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