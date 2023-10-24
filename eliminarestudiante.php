<?php

include 'conexion.php';
include './partials/scripts.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $idEstudiante = (int)$_POST['idEstudiante'];

    // echo "ID Estudiante: " . $idEstudiante;

    try {

        //  primero comprobamos que no existan prestamos de libros realizados al estudiante prestamo.id_estudiante

        $sqlCheck = "SELECT id FROM prestamo WHERE id_estudiante = :id";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':id', $idEstudiante, PDO::PARAM_INT);
        $stmtCheck->execute();

        if($stmtCheck->rowCount() > 0) {

            echo "<script>
                Swal.fire('Estudiante sin eliminar', 'No se puede eliminar al estudiante porque hay prestamos asociados a el.', 'info').then(function() {
                    location.href = 'estudiante.php'
                });
            </script>";
        } else {
            
            $sql = "DELETE FROM estudiante WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $idEstudiante, PDO::PARAM_INT);
            $stmt->execute();

            echo "<script>
                Swal.fire('Estudiante eliminado', 'El estudiante ha sido eliminado con éxito', 'success').then(function() {
                    location.href = 'estudiante.php'
                });
            </script>";

        }


    } catch(PDOException $e) {
        echo "Error al intentar eliminar el estudiante: " . $e->getMessage();
    }

}

?>