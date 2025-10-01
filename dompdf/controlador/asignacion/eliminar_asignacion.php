<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->query("delete from asignacion where id_Asignacion=$id ");
    if ($sql == 1) {
        // Mensaje de éxito para la otra vista
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Asignación eliminada correctamente!</div>';
        header("Location: listaasignacion.php"); // Redirigir a la otra vista
        exit();
    } else {
        // Mensaje de error para la otra vista
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar la asignación</div>';
        header("Location: listaasignacion.php"); // Redirigir a la otra vista
        exit();
    }
}
