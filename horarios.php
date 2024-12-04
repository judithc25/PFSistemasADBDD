<?php
require_once 'src/database.php'; 

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
            
           
            $sql = "INSERT INTO horarios (dias, horario) VALUES (:dias, :horario)";
            $stmt = $conn->prepare($sql);

            
            $stmt->bindParam(':dias', $dias);
            $stmt->bindParam(':horario', $horario);

            
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
