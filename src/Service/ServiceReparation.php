<?php

namespace workshop\Service;

require '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;
use workshop\Model\Reparation;
use Intervention\Image\ImageManagerStatic as Image;
use mysqli;
use mysqli_sql_exception;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ServiceReparation
{
    /*function addWatermark($imagePath)
    {
        // Cargar la imagen
        $image = Image::make($imagePath);

        // Ruta de la marca de agua
        $watermarkPath = 'ruta/a/tu/marca/de/agua.png';

        // Añadir la marca de agua en la esquina inferior derecha
        $image->insert($watermarkPath, 'bottom-right', 10, 10);

        // Guardar la imagen con la marca de agua
        $image->save('ruta/de/salida/con_marca_' . basename($imagePath));
    }*/

    public $mysqli;
    public $log;
    public function __construct()
    {
        $this->initializeLogger();
    }

    private function initializeLogger()
    {
        $this->log = new Logger('workshop_log');
        $this->log->pushHandler(new StreamHandler('../logs/app_workshop.log', Level::Info));
    }
    function connect()
    {
        $db = parse_ini_file("../../conf/db_conf.ini");
        // Crear la conexión
        try {
            //$connection = new mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]);
            $this->mysqli = new mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]);
            $this->log->info("Connection to DDBB success");
        } catch (mysqli_sql_exception $x) {
            $this->log->error("Connection to DDBB failed");
        }
        //return $connection;
    }

    function insertReparation($id, $name, $registerDate, $license, $picture)
    {
        // Conexion a la base de datos
        $this->connect();
        // Genero la ID aleatoria y genero la reparacion
        $uuid = Uuid::uuid4()->toString();
        $reparation = new Reparation($id, $uuid, $name, $registerDate, $license, $picture);
        // Creacion de la query
        $sql = "INSERT INTO reparation VALUES ('
        " . $reparation->getID() . ",
        " . $reparation->getUUID() . ", 
        " . $reparation->getName() . ",
        " . $reparation->getRegisterDate() . ",
        " . $reparation->getLicense() . ",
        " . $reparation->getPicture() . "')";
        try {
            $this->mysqli->query($sql);
            $this->log->info("Record inserted successfully");
            return $reparation;
        } catch (mysqli_sql_exception $x) {
            $this->log->error("Error inserting a record");
        }
    }

    function getReparation($uuid, $rol)
    {
        $this->connect();
        try {
            $stmt = $this->mysqli->prepare("SELECT * FROM reparation WHERE UUID = '$uuid'");
            $stmt->execute();

            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            // Verificar si hay resultados
            // Obtener los datos de la reparación
            $reparation = new Reparation(
                $result['ID'],
                $result['UUID'],
                $result['Name'],
                $result['RegisterDate'],
                $result['License'],
                $result['Picture']
            );
            return $reparation;
        } catch (mysqli_sql_exception $x) {
            $this->log->warning("getReparation Query failed");
        }


    }
}