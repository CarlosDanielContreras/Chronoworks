<?php
session_start();
if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["fechaacceso"]) && !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"]) && !empty($_POST["observaciones"])) {

        $idempleado = $_POST["idempleado"];
        $fechaacceso = $_POST["fechaacceso"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $observacion = $_POST["observaciones"];

        $sql = $conexion->query("INSERT INTO control_acceso (id_Empleado, Fecha, Hora_Entrada, Hora_Salida, Observacion)
                                 VALUES ($idempleado, '$fechaacceso', '$horaentrada', '$horasalida','$observacion')");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Acceso registrado correctamente!</div>';
            header("Location: listacontrol.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar el acceso</div>';
            header("Location: listacontrol.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
