<?php
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer

use Ramsey\Uuid\Uuid;
class ServiceReparation
{
    function generateUUID()
    {
        // Crear un UUID versión 4 (aleatorio)
        $uuid = Uuid::uuid4();
        // Retornar el UUID como cadena de texto
        return $uuid->toString();
    }
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
    function insertReparation($name, $registerDate, $license, $picture)
    {
        // Conexion a la base de datos
        $connection = $this->connect();
        // Genero la ID aleatoria y genero la reparacion
        $id = $this->generateUUID();
        $reparation = new Reparation($id, $name, $registerDate, $license, $picture);
        // Creacion de la query
        $sql = "INSERT INTO reparation VALUES ('" . $reparation->getUUID() . ", " . $reparation->getName() . ", " . $reparation->getRegisterDate() . ", " . $reparation->getLicense() . ", " . $reparation->getPicture() . "')";
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
        $sql = "SELECT * FROM reparation WHERE ID = '$uuid'";

        // Ejecución de la consulta
        $result = $connection->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Obtener los datos de la reparación
            $row = $result->fetch_assoc();
            $reparation = new Reparation(
                $row['id'],
                $row['name'],
                $row['register_date'],
                $row['license'],
                $row['picture']
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