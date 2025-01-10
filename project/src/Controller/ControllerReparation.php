<?php

class ControllerReparation
{
    function insertReparation()
    {
        // recojo la informacion del formulario
        if (isset($_POST["createReparation"])) {
            $id = $_POST["ID"];
            $name = $_POST["name"];
            $date = $_POST["date"];
            $license = $_POST["license"];

            $service = new ServiceReparation();
            $reparation = $service->insertReparation();
        }
    }

    function getReparation()
    {

    }
}