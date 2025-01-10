<?php
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer

use Ramsey\Uuid\Uuid;
use Intervention\Image\ImageManagerStatic as Image;

class ServiceReparation
{
    function generateUUID()
    {
        // Crear un UUID versión 4 (aleatorio)
        $uuid = Uuid::uuid4();
        // Retornar el UUID como cadena de texto
        return $uuid->toString();
    }

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


    function connect()
    {
        // Parametros de la base de datos
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $bbdd = 'workbench';

        // Crear la conexión
        $conexion = new mysqli($host, $user, $password, $bbdd);

        // Verificar si hay errores en la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        return $conexion;
    }
    function insertReparation($id, $name, $registerDate, $license, $picture)
    {
        // Conexion a la base de datos
        $connection = $this->connect();
        // Genero la ID aleatoria y genero la reparacion
        $uuid = $this->generateUUID();
        $reparation = new Reparation($id, $uuid, $name, $registerDate, $license, $picture);
        // Creacion de la query
        $sql = "INSERT INTO reparation VALUES ('
        " . $reparation->getID() . ",
        " . $reparation->getUUID() . ", 
        " . $reparation->getName() . ",
        " . $reparation->getRegisterDate() . ",
        " . $reparation->getLicense() . ",
        " . $reparation->getPicture() . "')";
        // Control de posible error
        if ($connection->query($sql) === TRUE) {
            echo "Registro insertado correctamente.";
        } else {
            echo "Error al insertar el registro: " . $connection->error;
        }
        // Cierro la conexion a la base de datos
        $connection->close();
    }
    function getReparation($uuid)
    {
        // Conexión a la base de datos
        $connection = $this->connect();

        // Creación de la consulta
        $sql = "SELECT * FROM reparation WHERE UUID = '$uuid'";

        // Ejecución de la consulta
        $result = $connection->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Obtener los datos de la reparación
            $row = $result->fetch_assoc();
            $reparation = new Reparation(
                $row['ID'],
                $row['UUID'],
                $row['Name'],
                $row['RegisterDate'],
                $row['License'],
                $row['Picture']
            );

            // Cerrar conexión y devolver la reparación
            $connection->close();
            return $reparation;
        } else {
            // Si no se encuentra, cerrar conexión y devolver null
            $connection->close();
            return null;
        }
    }

}