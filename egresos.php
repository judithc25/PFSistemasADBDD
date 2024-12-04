<?php
require_once 'src/database.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos del formulario
    $monto = $_POST['monto'];
    $fecha_egreso = $_POST['fecha_egreso'];
    $descripcion = $_POST['descripcion'];
    $id_proveedor = $_POST['id_proveedor'];

    // Validar que todos los campos estén completos
    if (!$monto || !$fecha_egreso || !$descripcion || !$id_proveedor) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }

    // Obtener la conexión a la base de datos
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            // Preparar la consulta para insertar los datos en la tabla egresos
            $sql = "INSERT INTO egresos (monto, fecha_egreso, descripcion, id_proveedor) 
                    VALUES (:monto, :fecha_egreso, :descripcion, :id_proveedor)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':monto', $monto);
            $stmt->bindParam(':fecha_egreso', $fecha_egreso);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id_proveedor', $id_proveedor);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo 'Registro de egreso exitoso.';
            } else {
                echo 'Hubo un error al registrar el egreso.';
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
