<?php
require_once 'src/database.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? null;
    $apellido = $_POST['apellido'] ?? null;
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $correo_electronico = $_POST['correo_electronico'] ?? null;
    $fecha_contratacion = $_POST['fecha_contratacion'] ?? null;
    $id_departamento = $_POST['id_departamento'] ?? null;
    $id_puesto = $_POST['id_puesto'] ?? null;
    $id_horario = $_POST['id_horario'] ?? null;

    // Validar campos obligatorios
    if (!$nombre || !$apellido || !$fecha_nacimiento || !$direccion || !$telefono || !$correo_electronico || !$fecha_contratacion || !$id_departamento || !$id_puesto || !$id_horario) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }

    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            // Insertar empleado
            $sql = "INSERT INTO empleados (nombre, apellido, fecha_nacimiento, direccion, telefono, correo_electronico, fecha_contratacion, id_departamento, id_puesto, id_horario) 
                    VALUES (:nombre, :apellido, :fecha_nacimiento, :direccion, :telefono, :correo_electronico, :fecha_contratacion, :id_departamento, :id_puesto, :id_horario)";
            $stmt = $conn->prepare($sql);

            // Asignar parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':correo_electronico', $correo_electronico);
            $stmt->bindParam(':fecha_contratacion', $fecha_contratacion);
            $stmt->bindParam(':id_departamento', $id_departamento);
            $stmt->bindParam(':id_puesto', $id_puesto);
            $stmt->bindParam(':id_horario', $id_horario);

            // Ejecutar consulta
            if ($stmt->execute()) {
                echo 'Empleado registrado con éxito.';
            } else {
                echo 'Hubo un error al registrar el empleado.';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'No se pudo conectar a la base de datos.';
    }
} else {
    echo 'Método no permitido.';
}
?>
