<?php
session_start(); // Inicia sesión para usar $_SESSION

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idtarea"]) && !empty($_POST["idcampaña"]) && !empty($_POST["fechaasignacion"]) && !empty($_POST["observaciones"])) {

        $idtarea = $_POST["idtarea"];
        $idcampaña = $_POST["idcampaña"];
        $fechaasignacion = $_POST["fechaasignacion"];
        $observacion = $_POST["observaciones"];

        $sql = $conexion->query("INSERT INTO asignacion (Id_tarea, Id_campaña, fecha, observaciones)
                                 VALUES ($idtarea, $idcampaña, '$fechaasignacion', '$observacion')");
        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Asignación registrada correctamente!</div>';
            header("Location: listaasignacion.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar la asignación</div>';
            header("Location: listaasignacion.php"); // Redirigir a la otra vista
            exit();
        }
    }
    else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
