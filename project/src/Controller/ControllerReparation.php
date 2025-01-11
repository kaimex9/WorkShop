<?php

namespace WorkShop\Project\Src\Controller;

require '..\..\vendor\autoload.php';
use WorkShop\Project\src\Service\ServiceReparation;
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
        if (isset($_POST["searchReparation"])) {
            $uuid = $_POST['UUID'];
            $service = new ServiceReparation();
            $reparation = $service->getReparation($uuid);
            $view = new ViewReparation();
            $view->render($reparation);
        }
    }
}