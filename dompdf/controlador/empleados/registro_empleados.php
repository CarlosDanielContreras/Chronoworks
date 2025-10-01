<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["email"]) && !empty($_POST["telefono"]) && !empty($_POST["turno"]) && !empty($_POST["fechaingreso"])) {

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["email"];
        $telefono = $_POST["telefono"];
        $fechaingreso = $_POST["fechaingreso"];
        $turno = $_POST["turno"];

        $sql = $conexion->query("INSERT INTO empleados (Nombre, Apellido, Correo, Teléfono, Fecha_Ingreso, id_turno)
                                 VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$fechaingreso', '$turno')");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Empleado registrado correctamente!</div>';
            header("Location: listaempleados.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar empleado</div>';
            header("Location: listaempleados.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
