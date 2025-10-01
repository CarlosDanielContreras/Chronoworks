<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->query("delete from control_acceso where ID_Control=$id ");
    if ($sql == 1) {
        // Mensaje de éxito para la otra vista
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Acceso eliminado correctamente!</div>';
        header("Location: listacontrol.php"); // Redirigir a la otra vista
        exit();
    } else {
        // Mensaje de error para la otra vista
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar el Acceso</div>';
        header("Location: listacontrol.php"); // Redirigir a la otra vista
        exit();
    }
}

