<?php
require_once 'src/database.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre_departamento = $_POST['nombre_departamento'];
    $descripcion = $_POST['descripcion'];
     
    if (!$nombre_departamento || !$descripcion) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }
    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            // Preparar la consulta para insertar los datos en la tabla departamentos
            $sql = "INSERT INTO departamentos (nombre_departamento, descripcion) 
                    VALUES (:nombre_departamento, :descripcion)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':nombre_departamento', $nombre_departamento);
            $stmt->bindParam(':descripcion', $descripcion);
            

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo 'Registro exitoso.';
            } else {
                echo 'Hubo un error al registrar los datos.';
            }
        } catch (PDOException $e) {
            echo 'Error en la base de datos: ' . $e->getMessage();
        }
    } else {
        echo 'No se pudo conectar a la base de datos.';
    }
} else {
    echo 'Método no permitido.';
}
?>
