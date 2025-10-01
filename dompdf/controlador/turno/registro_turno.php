<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["horaentrada"]) && !empty($_POST["horasalida"])) {

        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $sql = $conexion->query("INSERT INTO turno (Hora_Entrada, Hora_Salida)
                                 VALUES ('$horaentrada', '$horasalida')");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Turno registrado correctamente!</div>';
            header("Location: listaturno.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar turno /div>';
            header("Location: listaturno.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
