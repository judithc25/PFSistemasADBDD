<?php
require_once 'src/database.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos del formulario
    $monto = $_POST['monto'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $descripcion = $_POST['descripcion'];
    $id_producto = $_POST['id_producto'];

    // Validar que todos los campos estén completos
    if (!$monto || !$fecha_ingreso || !$descripcion || !$id_producto) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }

    // Obtener la conexión a la base de datos
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            // Preparar la consulta para insertar los datos en la tabla ingresos
            $sql = "INSERT INTO ingresos (monto, fecha_ingreso, descripcion, id_producto) 
                    VALUES (:monto, :fecha_ingreso, :descripcion, :id_producto)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':monto', $monto);
            $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id_producto', $id_producto);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo 'Registro de ingreso exitoso.';
            } else {
                echo 'Hubo un error al registrar el ingreso.';
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
