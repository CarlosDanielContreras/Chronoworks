<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["ID_Empleado"]) && !empty($_POST["nombre_tarea"]) && !empty($_POST["detalles"])) {


        $ID_Empleado = $_POST["ID_Empleado"];
        $nombre_tarea = $_POST["nombre_tarea"];
        $detalles = $_POST["detalles"];

        $sql = $conexion->query("INSERT INTO tarea (ID_Empleado, nombre_tarea, detalles)
                                 VALUES ( '$ID_Empleado', '$nombre_tarea', '$detalles')");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Tarea registrada correctamente!</div>';
            header("Location: listatarea.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar tarea /div>';
            header("Location: listatarea.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
