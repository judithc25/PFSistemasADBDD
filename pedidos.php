<?php
require_once 'src/database.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $fecha_pedido = $_POST['fecha_pedido'];
    $total = $_POST['total'];
    $id_cliente = $_POST['id_cliente'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $fecha_entrega = $_POST['fecha_entrega'];
     
    if (!$fecha_pedido || !$total || !$id_cliente || !$id_producto || !$cantidad || !$fecha_entrega) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }
    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            // Preparar la consulta para insertar el pedido
            $sql = "INSERT INTO pedidos (fecha_pedido, total, id_cliente, id_producto, cantidad, fecha_entrega) 
                    VALUES (:fecha_pedido, :total, :id_cliente, :id_producto, :cantidad, :fecha_entrega)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':fecha_pedido', $fecha_pedido);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':id_cliente', $id_cliente);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':fecha_entrega', $fecha_entrega);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo 'Pedido registrado con éxito.';
            } else {
                echo 'Hubo un error al registrar el pedido.';
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
