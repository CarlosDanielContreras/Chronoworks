<?php
// ============================================
// ARCHIVO: controlador/asignacion/registro_asignacion.php (MYSQL)
// ============================================

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idtarea"]) && !empty($_POST["idcampaña"]) && 
        !empty($_POST["fechaasignacion"]) && !empty($_POST["observaciones"])) {

        $idtarea = (int)$_POST["idtarea"];
        $idcampania = (int)$_POST["idcampaña"];
        $fechaasignacion = $_POST["fechaasignacion"];
        $observacion = escaparString($_POST["observaciones"]);

        // ✅ MySQL: Usar mysqli_prepare
        $stmt = mysqli_prepare($conexion, 
            "INSERT INTO asignacion (Id_tarea, Id_campania, fecha, observaciones) VALUES (?, ?, ?, ?)"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iiss", $idtarea, $idcampania, $fechaasignacion, $observacion);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Asignación registrada correctamente!</div>';
                header("Location: listaasignacion.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar: ' . mysqli_error($conexion) . '</div>';
            }
            
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error en la consulta: ' . mysqli_error($conexion) . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío.</div>';
    }
}
?>