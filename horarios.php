<?php
require_once 'src/database.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $dias = $_POST['dias'];
    $horario = $_POST['horario'];
     
    if (!$dias || !$horario) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }
    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            // Preparar la consulta para insertar los datos en la tabla horarios
            $sql = "INSERT INTO horarios (dias, horario) VALUES (:dias, :horario)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':dias', $dias);
            $stmt->bindParam(':horario', $horario);

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
