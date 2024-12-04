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
    <a href="Ventas.php">Ventas</a>
    </div>
  <body>
<br>
<br>
<div class="container mt-4">
      <h2>Registrar Proveedor</h2>
      <form action="proveedores.php" method="POST" class="row g-3 needs-validation">
        <div class="col-md-4 position-relative">
          <label for="nombre" class="form-label"><b>Nombre</b></label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
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
          <label for="numero_cuenta" class="form-label"><b>Número de Cuenta</b></label>
          <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta" required>
        </div>

        <div class="col-12">
          <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Proveedor</button>
        </div>
      </form>
    </div>
    <div class="container mt-4">
      <h2>Registrar Ingrediente</h2>
      <form action="ingredientes.php" method="POST" class="row g-3 needs-validation">
        
        <div class="col-md-4 position-relative">
          <label for="nombre" class="form-label"><b>Nombre</b></label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        
        <div class="col-md-4 position-relative">
          <label for="cantidad" class="form-label"><b>Cantidad</b></label>
          <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>

        <div class="col-md-4 position-relative">
          <label for="fecha_vencimiento" class="form-label"><b>Fecha de Vencimiento</b></label>
          <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
        </div>

        <div class="col-md-4 position-relative">
          <label for="fecha_ingreso" class="form-label"><b>Fecha de Ingreso</b></label>
          <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
        </div>

        <!-- Selección de proveedor -->
        <div class="col-md-4 position-relative">
          <label for="id_proveedor" class="form-label"><b>Proveedor</b></label>
          <select class="form-select" id="id_proveedor" name="id_proveedor" required>
            <option value="">Seleccione un proveedor</option>
            <?php
              require_once 'src/database.php';
              $database = new Database();
              $conn = $database->getConnection();

              if ($conn) {
                  $sql = "SELECT id_proveedor, nombre FROM proveedores";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($proveedores as $proveedor) {
                      echo "<option value='{$proveedor['id_proveedor']}'>{$proveedor['nombre']}</option>";
                  }
              }
            ?>
          </select>
        </div>

        <div class="col-12">
          <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Ingrediente</button>
        </div>
      </form>
    </div>   
    <div class="container mt-4">
      <h2>Registrar Producto</h2>
      <form action="producto.php" method="POST" class="row g-3 needs-validation">
        
        <div class="col-md-4 position-relative">
          <label for="nombre" class="form-label"><b>Nombre</b></label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        
        <div class="col-md-4 position-relative">
          <label for="cantidad" class="form-label"><b>Cantidad</b></label>
          <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>

        <div class="col-md-4 position-relative">
          <label for="precio" class="form-label"><b>Precio</b></label>
          <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
        </div>

        <div class="col-md-4 position-relative">
          <label for="fecha_vencimiento" class="form-label"><b>Fecha de Vencimiento</b></label>
          <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
        </div>

        <div class="col-md-4 position-relative">
          <label for="fecha_ingreso" class="form-label"><b>Fecha de Ingreso</b></label>
          <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
        </div>

        <div class="col-12">
          <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Producto</button>
        </div>
      </form>
    </div>  
    <div class="container mt-4">
      <h2>Registrar Pedido</h2>
      <form action="index.php" method="POST" class="row g-3 needs-validation">
        
        <div class="col-md-4 position-relative">
          <label for="fecha_pedido" class="form-label"><b>Fecha de Pedido</b></label>
          <input type="date" class="form-control" id="fecha_pedido" name="fecha_pedido" required>
        </div>

        <div class="col-md-4 position-relative">
          <label for="total" class="form-label"><b>Total</b></label>
          <input type="number" step="0.01" class="form-control" id="total" name="total" required>
        </div>

        <div class="col-md-4 position-relative">
          <label for="id_cliente" class="form-label"><b>Cliente</b></label>
          <select class="form-control" id="id_cliente" name="id_cliente" required>
            <option value="">Selecciona un cliente</option>
            <?php
              // Conectar a la base de datos y obtener clientes
              require_once 'src/database.php';
              $database = new Database();
              $conn = $database->getConnection();
              if ($conn) {
                $stmt = $conn->prepare("SELECT id_cliente, nombre FROM clientes");
                $stmt->execute();
                $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($clientes as $cliente) {
                  echo "<option value='{$cliente['id_cliente']}'>{$cliente['nombre']}</option>";
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
        <div class="col-md-4 position-relative">
          <label for="cantidad" class="form-label"><b>Cantidad</b></label>
          <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>

        <div class="col-md-4 position-relative">
          <label for="fecha_entrega" class="form-label"><b>Fecha de Entrega</b></label>
          <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
        </div>
        <div class="col-12">
          <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Pedido</button>
        </div>
      </form>
    </div>
  </body>
</html>
