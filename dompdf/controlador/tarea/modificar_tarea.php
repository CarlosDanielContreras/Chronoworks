<?php
session_start();

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["ID_tarea"]) && !empty($_POST["ID_Empleado"]) && !empty($_POST["nombre_tarea"]) && !empty($_POST["detalles"])) {

        $ID_tarea = $_POST["ID_tarea"];
        $ID_Empleado = $_POST["ID_Empleado"];
        $nombre_tarea = $_POST["nombre_tarea"];
        $detalles = $_POST["detalles"];

        $sql = $conexion->query("update tarea set ID_tarea='$ID_tarea', ID_Empleado='$ID_Empleado', nombre_tarea='$nombre_tarea', detalles='$detalles'where ID_Tarea=$id");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Tarea actualizada correctamente!</div>';
            header("Location: listatarea.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar tarea</div>';
            header("Location: listatarea.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
