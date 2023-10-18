<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Biblioteca</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Estilos personalizados -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>

<body>

    <!-- CABECERA -->
    <?php require('./partials/header.php') ?>

    <div class="container-fluid">
        <div class="row">

            <!-- MENU PRINCIPAL -->
            <?php require('./partials/menu.php') ?>

            <!-- contenido principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Panel de control</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="crearestudiante.php" type="button" class="btn btn-sm btn-outline-primary">Agregar estudiante</a>
                        </div>
                    </div>
                </div>

                <h2>Estudiantes</h2>
                <div class="table-responsive">
                    <!-- AGREGAR A MANO EL CÓDIGO DE LA GUIA PARA MOSTRAR DATOS estudianteS LIBROS -->
                    <?php
                        // Incluye el archivo de conexión
                        include 'conexion.php';

                        // Realizar la consulta para obtener todos los datos de la tabla estudiante
                        try {
                            $sql = "SELECT * FROM estudiante";
                            $stmt = $pdo->query($sql);

                            // id INT AUTO_INCREMENT PRIMARY KEY,
                            // rut VARCHAR(12) NOT NULL,
                            // nombre VARCHAR(100) NOT NULL,
                            // direccion VARCHAR(200) NOT NULL,
                            // fecha_nacimiento DATE NOT NULL,
                            // telefono VARCHAR(20),
                            // email VARCHAR(100),
                            // nacionalidad VARCHAR(100)

                            // Mostrar los datos en una tabla HTML
                            echo '<table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">rut</th>
                                            <th scope="col">nombre</th>
                                            <th scope="col">direccion</th>
                                            <th scope="col">fecha_nacimiento</th>
                                            <th scope="col">telefono</th>
                                            <th scope="col">email</th>
                                            <th scope="col">nacionalidad</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['rut']}</td>
                                        <td>{$row['nombre']}</td>
                                        <td>{$row['direccion']}</td>
                                        <td>{$row['fecha_nacimiento']}</td>
                                        <td>{$row['telefono']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['nacionalidad']}</td>
                                        <td>
                                            <a href='editarestudiante.php?id={$row['id']}' class='btn btn-primary'>Editar</a>
                                            <button onclick='eliminarEstudiante({$row['id']})' class='btn btn-danger'>Eliminar</button>
                                        </td>
                                    </tr>";
                            }

                            echo '</tbody>
                            </table>';
                        } catch (PDOException $e) {
                            // En caso de error, muestra un mensaje de error
                            echo "Error en la consulta: " . $e->getMessage();
                        }
                        ?>

                    
                </div>
            </main>
        </div>
    </div>


    <!-- Archivo JavaScript de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Funcion eliminar estudiante -->
    <script>
        function eliminarEstudiante(id) {
            // alert("estudiante ID: " + id)
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará al estudiante, ¿Deseas continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar'
            }).then( function(result) {

                if( result.isConfirmed ) {
                     // Si el usuario confirma, envía el formulario de eliminación
                    const form = document.createElement('form');
                    form.method = 'post';
                    form.action = 'estudiante.php';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'idEstudiante';
                    input.value = id;
                    form.appendChild(input);
                    const button = document.createElement('button');
                    button.type = 'submit';
                    button.name = 'eliminar';
                    form.appendChild(button);
                    document.body.appendChild(form);
                    form.submit();
                }

            })
        }
    </script>
</body>

</html>