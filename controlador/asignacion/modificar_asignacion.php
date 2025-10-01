<?php
// ============================================
// ARCHIVO: controlador/asignacion/modificar_asignacion.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idtarea"]) && !empty($_POST["idcampaña"]) && 
        !empty($_POST["fechaasignacion"]) && !empty($_POST["observaciones"])) {

        $id = (int)$_POST["id"];
        $idtarea = (int)$_POST["idtarea"];
        $idcampania = (int)$_POST["idcampaña"];
        $fechaasignacion = $_POST["fechaasignacion"];
        $observacion = escaparString($_POST["observaciones"]);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "UPDATE asignacion SET Id_tarea=?, Id_campania=?, fecha=?, observaciones=? WHERE id_Asignacion=?"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iissi", $idtarea, $idcampania, $fechaasignacion, $observacion, $id);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Asignación actualizada correctamente!</div>';
                header("Location: listaasignacion.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío.</div>';
    }
}
?>