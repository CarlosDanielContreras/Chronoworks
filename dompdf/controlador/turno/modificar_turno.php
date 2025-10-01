<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["horaentrada"]) && !empty($_POST["horasalida"])) {
        
        
        $id = $_POST["id"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];

        $sql = $conexion->query("update turno set Hora_Entrada='$horaentrada', Hora_Salida='$horasalida' where ID_Turno=$id");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Turno actualizado correctamente!</div>';
            header("Location: listaturno.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar turno</div>';
            header("Location: listaturno.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
