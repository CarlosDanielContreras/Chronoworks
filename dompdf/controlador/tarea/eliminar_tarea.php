<?php

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->query("delete from tarea  where ID_Tarea=$id ");
    if ($sql == 1) {
        // Mensaje de éxito para la otra vista
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Tarea eliminada correctamente!</div>';
        header("Location: listatarea.php"); // Redirigir a la otra vista
        exit();
    } else {
        // Mensaje de error para la otra vista
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar tarea </div>';
        header("Location: listatarea.php"); // Redirigir a la otra vista
        exit();
    }
}
