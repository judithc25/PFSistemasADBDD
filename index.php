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
    <h1><b>Judith Bakery´s</b></h1>
    <a href="Productos.php">Productos</a>
    <a href="Ventas.php">Ventas</a>
    </div>
  <body>
<br>
<br>
    <div class="container mt-4">
        <h2>Registrar Horario</h2>
        <form action="horarios.php" method="POST" class="row g-3 needs-validation">
          <div class="col-md-4 position-relative">
            <label for="dias" class="form-label"><b>Días</b></label>
            <input type="text" class="form-control" id="dias" name="dias" required>
          </div>
          <div class="col-md-4 position-relative">
            <label for="horario" class="form-label"><b>Horario</b></label>
            <input type="text" class="form-control" id="horario" name="horario" required>
          </div>
          <div class="col-12">
            <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Horario</button>
          </div>
        </form>
      </div>
      <div class="container mt-4">
        <h2>Registrar Salario</h2>
        <form action="salarios.php" method="POST" class="row g-3 needs-validation">
          <div class="col-md-4 position-relative">
            <label for="monto" class="form-label"><b>Monto</b></label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
          </div>
          <div class="col-md-4 position-relative">
            <label for="fecha_efectiva" class="form-label"><b>Fecha Efectiva</b></label>
            <input type="date" class="form-control" id="fecha_efectiva" name="fecha_efectiva" required>
          </div>
          <div class="col-12">
            <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Salario</button>
          </div>
        </form>
      </div>
    <div class="container mt-4">
      <h2>Registrar Puesto</h2>
      <form action="puestos.php" method="POST" class="row g-3 needs-validation">
        
        <div class="col-md-4 position-relative">
          <label for="titulo_puesto" class="form-label"><b>Título del Puesto</b></label>
          <input type="text" class="form-control" id="titulo_puesto" name="titulo_puesto" required>
        </div>
        
        <div class="col-md-8 position-relative">
          <label for="descripcion" class="form-label"><b>Descripción</b></label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <div class="col-md-4 position-relative">
          <label for="id_salario" class="form-label"><b>Salario</b></label>
          <select class="form-control" id="id_salario" name="id_salario" required>
            <option value="">Selecciona un salario</option>
            <?php
              // Conexión a la base de datos y obtener salarios
              require_once 'src/database.php';
              $database = new Database();
              $conn = $database->getConnection();

              if ($conn) {
                try {
                  // Obtener todos los salarios
                  $sql = "SELECT id_salario, monto FROM salarios";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();

                  // Mostrar los salarios en el campo select
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['id_salario'] . "'>" . $row['monto'] . "</option>";
                  }
                } catch (PDOException $e) {
                  echo "<option disabled>Error al cargar salarios: " . $e->getMessage() . "</option>";
                }
              } else {
                echo "<option disabled>No se pudo conectar a la base de datos</option>";
              }
            ?>
          </select>
        </div>

        <div class="col-12">
          <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Puesto</button>
        </div>
      </form>
    </div>
  

    <div class="container mt-4">
      <h2>Registrar Departamento</h2>
      <form action="departamentos.php" method="POST" class="row g-3 needs-validation">
        
        <div class="col-md-4 position-relative">
          <label for="nombre_departamento" class="form-label"><b>Nombre del Departamento</b></label>
          <input type="text" class="form-control" id="nombre_departamento" name="nombre_departamento" required>
        </div>
        
        <div class="col-md-8 position-relative">
          <label for="descripcion" class="form-label"><b>Descripción</b></label>
          <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        </div>
        <div class="col-12">
          <button class="btn btn-light" type="submit" style="background-color: rgb(149, 109, 150); color: white;">Registrar Departamento</button>
        </div>
      </form>
    </div>      
       
  </body>
</html>
