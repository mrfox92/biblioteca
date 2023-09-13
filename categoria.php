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
                            <a type="button" class="btn btn-sm btn-outline-primary">Agregar categoria</a>
                        </div>
                    </div>
                </div>

                <h2>Categorias Libros</h2>
                <div class="table-responsive">
                    <!-- AGREGAR A MANO EL CÓDIGO DE LA GUIA PARA MOSTRAR DATOS CATEGORIAS LIBROS -->
                    
                    
                </div>
            </main>
        </div>
    </div>


    <!-- Archivo JavaScript de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>