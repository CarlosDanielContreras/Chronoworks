<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["email"]) && !empty($_POST["telefono"]) && !empty($_POST["turno"]) && !empty($_POST["fechaingreso"])) {

        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["email"];
        $telefono = $_POST["telefono"];
        $fechaingreso = $_POST["fechaingreso"];
        $turno = $_POST["turno"];

        $sql = $conexion->query("update empleados set Nombre='$nombre', Apellido='$apellido', Correo='$correo', Teléfono='$telefono', Fecha_Ingreso='$fechaingreso', id_turno=$turno where ID_Empleado=$id");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Empleado actualizado correctamente!</div>';
            header("Location: listaempleados.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar empleado</div>';
            header("Location: listaempleados.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
