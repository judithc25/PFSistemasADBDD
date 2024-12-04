<?php
require_once 'src/database.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $titulo_puesto = $_POST['titulo_puesto'];
    $descripcion = $_POST['descripcion'];
    $salario_id = $_POST['id_salario'];
     
    if (!$titulo_puesto || !$descripcion || !$salario_id) {
        echo 'Por favor, completa todos los campos obligatorios.';
        exit();
    }
    
    $database = new Database();
    $conn = $database->getConnection();

    if ($conn) {
        try {
            
            // Preparar la consulta para insertar los datos en la tabla puestos
            $sql = "INSERT INTO puestos (titulo_puesto, descripcion, id_salario) 
                    VALUES (:titulo_puesto, :descripcion, :id_salario)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':titulo_puesto', $titulo_puesto);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id_salario', $id_salario);

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
