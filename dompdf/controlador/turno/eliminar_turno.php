<?php
if(!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conexion->query("delete from turno where ID_Turno=$id ");
    if ($sql == 1) {
        // Mensaje de éxito para la otra vista
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Turno eliminado correctamente!</div>';
        header("Location: listaturno.php"); // Redirigir a la otra vista
        exit();
    } else {
        // Mensaje de error para la otra vista
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar turno </div>';
        header("Location: listaturno.php"); // Redirigir a la otra vista
        exit();
    }
}