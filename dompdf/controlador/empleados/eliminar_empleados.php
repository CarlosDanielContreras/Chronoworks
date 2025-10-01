<?php

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->query("delete from empleados where ID_Empleado=$id ");
    if ($sql == 1) {
        // Mensaje de éxito para la otra vista
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Empleado eliminado correctamente!</div>';
        header("Location: listaempleados.php"); // Redirigir a la otra vista
        exit();
    } else {
        // Mensaje de error para la otra vista
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar empleado </div>';
        header("Location: listaempleados.php"); // Redirigir a la otra vista
        exit();
    }
}
