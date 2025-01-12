<?php

namespace project\Controller;
require '../../vendor/autoload.php';
use project\Service\ServiceReparation;
use project\View\ViewReparation;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["searchReparation"])) {
    getReparation();
}

if (isset($_POST["createReparation"])) {
    insertReparation();
}
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
        $reparation = $service->insertReparation($id, $name, $date, $license, $picture);
        $view = new ViewReparation();
        //$view->render($reparation);
    }
}

function getReparation()
{
    if (isset($_POST["searchReparation"])) {
        $uuid = $_POST['UUID'];
        $rol = $_SESSION['rol'];
        $service = new ServiceReparation();
        $reparation = $service->getReparation($uuid,$rol);
        $view = new ViewReparation();
        $view->render($reparation);
    }
}
