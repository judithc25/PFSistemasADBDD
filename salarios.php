<?php
require_once 'src/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $monto = $_POST['monto'];
    $fecha_efectiva = $_POST['fecha_efectiva'];
     
    if (!$monto || !$fecha_efectiva) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }
    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            
            $sql = "INSERT INTO salarios (monto, fecha_efectiva) VALUES (:monto, :fecha_efectiva)";
            $stmt = $conn->prepare($sql);

            
            $stmt->bindParam(':monto', $monto);
            $stmt->bindParam(':fecha_efectiva', $fecha_efectiva);

            
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
