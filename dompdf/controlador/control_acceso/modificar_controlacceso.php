<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["fechaacceso"]) && !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"]) && !empty($_POST["observaciones"])) {

        $id = $_POST["id"];
        $idempleado = $_POST['idempleado'];
        $fechaacceso = $_POST["fechaacceso"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $observacion = $_POST["observaciones"];


        $sql = $conexion->query("update control_acceso set id_Empleado=$idempleado, Fecha='$fechaacceso', Hora_Entrada='$horaentrada', Hora_Salida='$horasalida', Observacion='$observacion' where ID_Control=$id");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Acceso actualizado correctamente!</div>';
            header("Location: listacontrol.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar el acceso</div>';
            header("Location: listacontrol.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}