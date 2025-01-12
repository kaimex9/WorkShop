<?php
namespace workshop\View;
use workshop\Model\Reparation;
use workshop\Controller\ControllerReparation;
require '..\..\vendor\autoload.php';

if (isset($_POST['rol'])) {
    session_start();
    $_SESSION['rol'] = $_POST['rol'];
    $rol = $_SESSION['rol'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    class ViewReparation
    {
        
        public function render($reparation)
        {
            
            echo '<ul>
                <h2>Reparation Info</h2>
                <li>ID: ' . $reparation->getID() . '</li>
                <li>UUID: ' . $reparation->getUUID() . '</li>
                <li>Name: ' . $reparation->getName() . '</li>
                <li>RegisterDate: ' . $reparation->getRegisterDate() . '</li>
                <li>License: ' . $reparation->getLicense() . '</li>
                <li>Picture: ' . $reparation->getPicture() . '</li>
            </ul>';
        }
    }
    if (isset($_POST["send"])) { ?>
        <form action="../Controller/ControllerReparation.php" method="POST">
            <h2>Search Reparation</h2>
            <label>
                ReparationID: <input type="text" name="UUID">
            </label><br><br>
            <input type="submit" value="Enviar" name="searchReparation">
        </form>
        <?php
        if ($_POST["rol"] == "employee") { ?>

            <form action="../Controller/ControllerReparation.php" method="POST">
                <h2>Create Car Reparation</h2>
                <label>
                    WorkShopID: <input name="ID" type="text" placeholder="4827" maxlength="4" required>
                </label><br><br>
                <label>
                    Name: <input name="name" type="text" placeholder="Juan" required>
                </label><br><br>
                <label>
                    Register date: <input name="date" type="date" required>
                </label><br><br>
                <label>
                    License: <input name="license" type="text" pattern="^\d{4}[A-Za-z]{3}$" placeholder="9999AAA" required>
                </label><br><br>
                <label>
                    Picture(test): <input name="picture" type="text" placeholder="example" required>
                </label><br><br>
                <input type="submit" value="Enviar" name="createReparation">
            </form>
            <?php
        }
    }
    ?>
</body>

</html>