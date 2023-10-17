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
                            <a href="crearlibro.php" type="button" class="btn btn-sm btn-outline-primary">Agregar libro</a>
                        </div>
                    </div>
                </div>

                <h2>Categorias Libros</h2>
                <div class="table-responsive">
                    <!-- AGREGAR A MANO EL CÓDIGO DE LA GUIA PARA MOSTRAR DATOS CATEGORIAS LIBROS -->
                    <?php
                        // Incluye el archivo de conexión
                        include 'conexion.php';

                        // Realizar la consulta para obtener todos los datos de la tabla categoria
                        try {
                            
                            // $sql = "SELECT * FROM libro";

                            $sql = "SELECT libro.id, libro.titulo, libro.autor, libro.isbn, libro.anio_publicacion,
                            libro.ejemplares_disponibles, libro.ejemplares_totales, libro.id_categoria, libro.id_editorial, 
                            categoria.nombre AS categoria_nombre, editorial.nombre AS editorial_nombre
                            FROM libro
                            LEFT JOIN categoria ON libro.id_categoria = categoria.id
                            LEFT JOIN editorial ON libro.id_editorial = editorial.id";
                            $stmt = $pdo->query($sql);


                            // id INT AUTO_INCREMENT PRIMARY KEY,
                            // titulo VARCHAR(100) NOT NULL,
                            // autor VARCHAR(255),
                            // isbn INT NOT NULL,
                            // anio_publicacion INT,
                            // ejemplares_disponibles INT NOT NULL,
                            // ejemplares_totales INT NOT NULL,
                            // id_categoria INT NOT NULL,
                            // id_editorial INT NOT NULL,
                            // FOREIGN KEY (id_categoria) REFERENCES categoria (id),
                            // FOREIGN KEY (id_editorial) REFERENCES editorial (id)

                            // Mostrar los datos en una tabla HTML
                            echo '<table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">titulo</th>
                                            <th scope="col">autor</th>
                                            <th scope="col">isbn</th>
                                            <th scope="col">anio_publicacion</th>
                                            <th scope="col">ejemplares_disponibles</th>
                                            <th scope="col">ejemplares_totales</th>
                                            <th scope="col">id_categoria</th>
                                            <th scope="col">categoria_nombre</th>
                                            <th scope="col">id_editorial</th>
                                            <th scope="col">editorial_nombre</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['titulo']}</td>
                                        <td>{$row['autor']}</td>
                                        <td>{$row['isbn']}</td>
                                        <td>{$row['anio_publicacion']}</td>
                                        <td>{$row['ejemplares_disponibles']}</td>
                                        <td>{$row['ejemplares_totales']}</td>
                                        <td>{$row['id_categoria']}</td>
                                        <td>{$row['categoria_nombre']}</td>
                                        <td>{$row['id_editorial']}</td>
                                        <td>{$row['editorial_nombre']}</td>
                                        <td>
                                            <a href='editarlibro.php?id={$row['id']}' class='btn btn-primary'>Editar</a>
                                            <button onclick='eliminarLibro({$row['id']})' class='btn btn-danger'>Eliminar</button>
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

    <!-- Funcion eliminar categoria -->
    <script>
        function eliminarLibro(id) {
            // alert("categoria ID: " + id)
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el libro, ¿Deseas continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar'
            }).then( function(result) {

                if( result.isConfirmed ) {
                     // Si el usuario confirma, envía el formulario de eliminación
                    const form = document.createElement('form');
                    form.method = 'post';
                    form.action = 'libro.php';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'idLibro';
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
