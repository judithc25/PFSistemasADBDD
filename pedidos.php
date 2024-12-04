<?php
require_once 'src/database.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos del formulario
    $fecha = $_POST['fecha'] ?? null;
    $costo = $_POST['costo'] ?? null;
    $id_cliente = $_POST['id_cliente'] ?? null;
    $id_producto = $_POST['id_producto'] ?? null;
    $cantidad = $_POST['cantidad'] ?? null;
    $entrega = $_POST['entrega'] ?? null;

    // Verificar que todos los campos obligatorios están llenos
    if (!$fecha || !$costo || !$id_cliente || !$id_producto || !$cantidad || !$entrega) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }

    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            // Preparar la consulta para insertar el pedido
            $sql = "INSERT INTO pedidos (fecha, costo, id_cliente, id_producto, cantidad, entrega) 
                    VALUES (:fecha, :costo, :id_cliente, :id_producto, :cantidad, :entrega)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':costo', $costo);
            $stmt->bindParam(':id_cliente', $id_cliente);
            $stmt->bindParam(':id_producto', $id_producto);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':entrega', $entrega);

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
