<?php

use WorkShop\Project\Src\View\ViewReparation;

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
            $picture = $_POST["picture"];
            $service = new ServiceReparation();
            $reparation = $service->insertReparation($id,$name,$date,$license,$picture);
            $view = new ViewReparation();
            //$view->render($reparation);
        }
    }

    function getReparation()
    {

    }
}