<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="shortcut icon" href="./imagenes/favicon.png" type="image/x-icon">

  </head>
  <div class="navbar">
    <h2><b>Judith Bakery´s</b></h2>
    <a href="index.php">Productos</a>
    <a href="Productos.php">Ventas</a>
    </div>
  <body>
<br>
<br>
<div class="container mt-4">
    <h2>Registrar Empleado</h2>
    <form action="empleados.php" method="POST" class="row g-3 needs-validation">
        <div class="col-md-4 position-relative">
            <label for="nombre" class="form-label"><b>Nombre</b></label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="apellido" class="form-label"><b>Apellido</b></label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="fecha_nacimiento" class="form-label"><b>Fecha de Nacimiento</b></label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="direccion" class="form-label"><b>Dirección</b></label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="telefono" class="form-label"><b>Teléfono</b></label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="correo_electronico" class="form-label"><b>Correo Electrónico</b></label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="fecha_contratacion" class="form-label"><b>Fecha de Contratación</b></label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" required>
        </div>
        <div class="col-md-4 position-relative">
        <label for="id_departamento" class="form-label"><b>Departamento</b></label>
        <select class="form-control" id="id_departamento" name="id_departamento" required>
            <option value="">Selecciona un departamento</option>
            <?php
                require_once 'src/database.php';
                $database = new Database();
                $conn = $database->getConnection();
                if ($conn) {
                    $stmt = $conn->prepare("SELECT id_departamento, nombre_departamento FROM departamentos");
                    $stmt->execute();
                    $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($departamentos as $departamento) {
                        echo "<option value='{$departamento['id_departamento']}'>{$departamento['nombre_departamento']}</option>";
                    }
                }
            ?>
        </select>
        </div>
        <div class="col-md-4 position-relative">
            <label for="id_puesto" class="form-label"><b>Puesto ID</b></label>
            <select class="form-control" id="id_puesto" name="id_puesto" required>
            <option value="">Selecciona un puesto</option>
            <?php
                if ($conn) {
                    $stmt = $conn->prepare("SELECT id_puesto, titulo_puesto FROM puestos");
                    $stmt->execute();
                    $puestos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($puestos as $puesto) {
                        echo "<option value='{$puesto['id_puesto']}'>{$puesto['titulo_puesto']}</option>";
                    }
                }
            ?>
        </select>
        </div>
        <div class="col-md-4 position-relative">
          <label for="id_producto" class="form-label"><b>Producto</b></label>
          <select class="form-control" id="id_producto" name="id_producto" required>
            <option value="">Selecciona un producto</option>
            <?php
              // Obtener productos desde la base de datos
              if ($conn) {
                $stmt = $conn->prepare("SELECT id_producto, nombre FROM productos");
                $stmt->execute();
                $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($productos as $producto) {
                  echo "<option value='{$producto['id_producto']}'>{$producto['nombre']}</option>";
                }
              }
            ?>
          </select>
        </div>
    </form>
</div>

<div class="container mt-4">
    <h2>Registrar Cliente</h2>
    <form action="clientes.php" method="POST" class="row g-3 needs-validation">
        <div class="col-md-4 position-relative">
            <label for="nombre" class="form-label"><b>Nombre</b></label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="telefono" class="form-label"><b>Teléfono</b></label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="direccion" class="form-label"><b>Dirección</b></label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="col-12">
            <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Cliente</button>
        </div>
    </form>
</div>

<div class="container mt-4">
    <h2>Registrar Ingreso</h2>
    <form action="ingresos.php" method="POST" class="row g-3 needs-validation">
        <div class="col-md-4 position-relative">
            <label for="monto" class="form-label"><b>Monto</b></label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="fecha_ingreso" class="form-label"><b>Fecha de Ingreso</b></label>
            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="descripcion" class="form-label"><b>Descripción</b></label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="col-md-4 position-relative">
          <label for="id_producto" class="form-label"><b>Producto</b></label>
          <select class="form-control" id="id_producto" name="id_producto" required>
            <option value="">Selecciona un producto</option>
            <?php
              // Obtener productos desde la base de datos
              if ($conn) {
                $stmt = $conn->prepare("SELECT id_producto, nombre FROM productos");
                $stmt->execute();
                $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($productos as $producto) {
                  echo "<option value='{$producto['id_producto']}'>{$producto['nombre']}</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="col-12">
            <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Ingreso</button>
        </div>
    </form>
</div>
<div class="container mt-4">
<h2>Egresos</h2>
<form action="egresos.php" method="POST" class="row g-3 needs-validation">
        <div class="col-md-4 position-relative">
            <label for="monto" class="form-label"><b>Monto</b></label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="fecha_egreso" class="form-label"><b>Fecha de Egreso</b></label>
            <input type="date" class="form-control" id="fecha_egreso" name="fecha_egreso" required>
        </div>
        <div class="col-md-4 position-relative">
            <label for="descripcion" class="form-label"><b>Descripción</b></label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="col-md-4 position-relative">
    <label for="id_proveedor" class="form-label"><b>Proveedor</b></label>
    <select class="form-control" id="id_proveedor" name="id_proveedor" required>
        <option value="">Selecciona un proveedor</option>
        <?php
        // Conectar a la base de datos y obtener proveedores
        require_once 'src/database.php';
        $database = new Database();
        $conn = $database->getConnection();
        if ($conn) {
            $stmt = $conn->prepare("SELECT id_proveedor, nombre FROM proveedores");
            $stmt->execute();
            $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($proveedores as $proveedor) {
                echo "<option value='{$proveedor['id_proveedor']}'>{$proveedor['nombre']}</option>";
            }
        } else {
            echo "<option value=''>Error al cargar proveedores</option>";
        }
        ?>
    </select>
</div>
        <div class="col-12">
            <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Egreso</button>
        </div>
    </form>  
</div>
      
  </body>
</html>
