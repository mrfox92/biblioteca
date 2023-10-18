<?php
// Incluye el archivo de conexión
include 'conexion.php';
include './partials/scripts.php';

// Verifica si se ha enviado el formulario a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario

    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $nacionalidad = $_POST['nacionalidad'];

    // Realiza la inserción en la base de datos
    try {
        $sql = "INSERT INTO estudiante (rut, nombre, direccion, fecha_nacimiento, telefono, email, nacionalidad) VALUES (:rut, :nombre, :direccion, :fecha_nacimiento, :telefono, :email, :nacionalidad)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':rut', $rut, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':nacionalidad', $nacionalidad, PDO::PARAM_STR);
        $stmt->execute();

        //  muestra notificacion y redirecciona a estudiante.php
        echo "<script>
                Swal.fire('Estudiante registrado', 'El estudiante ha sido registrado correctamente', 'success').then(function() {
                    location.href = 'estudiante.php'
                });
            </script>";
    } catch (PDOException $e) {
        // En caso de error, muestra un mensaje de error
        echo "Error al crear el estudiante: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Categoría</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Estilos personalizados -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

    <!-- CABECERA -->
    <?php require('./partials/header.php') ?>

    <div class="container-fluid">
        <div class="row my-4 mx-auto">
            <!-- MENU PRINCIPAL -->
            <?php require('./partials/menu.php') ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1>Registrar Nuevo estudiante</h1>
                <!-- mejorar a partir de Bootstrap 5 -->
                <form method="POST" action="crearestudiante.php">

                <div class="mb-3">
                        <label for="rut" class="form-label">Rut:</label>
                        <input type="text" id="rut" name="rut" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                        <input type="text" id="nacionalidad" name="nacionalidad" class="form-control" required>
                    </div>
            
                    <div class="d-grid gap-2">
                        <input class="btn btn-success" type="submit" value="Registrar estudiante">
                    </div>
                </form>
            </main>

        </div>
    </div>


    <!-- Archivo JavaScript de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
</body>
</html>
