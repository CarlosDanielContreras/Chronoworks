<?php
session_start(); 

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idtarea"]) && !empty($_POST["idcampaña"]) && !empty($_POST["fechaasignacion"]) && !empty($_POST["observaciones"])) {

        $id = $_POST["id"];
        $idtarea = $_POST["idtarea"];
        $idcampaña = $_POST["idcampaña"];
        $fechaasignacion = $_POST["fechaasignacion"];
        $observacion = $_POST["observaciones"];

        $sql = $conexion->query("update asignacion set Id_tarea=$idtarea, Id_campaña=$idcampaña, fecha='$fechaasignacion', observaciones='$observacion' where id_Asignacion=$id");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Asignación actualizada correctamente!</div>';
            header("Location: listaasignacion.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar la asignación</div>';
            header("Location: listaasignacion.php"); // Redirigir a la otra vista
            exit();
        }
    }
    else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}