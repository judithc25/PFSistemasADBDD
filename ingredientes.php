<?php
require_once 'src/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $id_proveedor = $_POST['id_proveedor'];
     
    if (!$nombre || !$cantidad || !$fecha_vencimiento || !$fecha_ingreso || !$id_proveedor) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }
    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            
            $sql = "INSERT INTO ingredientes (nombre, cantidad, fecha_vencimiento, fecha_ingreso, id_proveedor) 
                    VALUES (:nombre, :cantidad, :fecha_vencimiento, :fecha_ingreso, :id_proveedor)";
            $stmt = $conn->prepare($sql);

            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento);
            $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
            $stmt->bindParam(':id_proveedor', $id_proveedor);

            
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
