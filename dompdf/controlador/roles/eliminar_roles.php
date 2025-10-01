<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->query("delete from roles where ID_Rol=$id ");
    if ($sql == 1) {
        // Mensaje de éxito para la otra vista
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Rol eliminado correctamente!</div>';
        header("Location: listaroles.php"); // Redirigir a la otra vista
        exit();
    } else {
        // Mensaje de error para la otra vista
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar rol </div>';
        header("Location: listaroles.php"); // Redirigir a la otra vista
        exit();
    }
}
