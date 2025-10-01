<?php
// ============================================
// ARCHIVO: controlador/control_acceso/registro_controlacceso.php
// ============================================
// ✅ ELIMINADO session_start()

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["fechaacceso"]) && 
        !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"]) && 
        !empty($_POST["observaciones"])) {

        $idempleado = (int)$_POST["idempleado"];
        $fechaacceso = $_POST["fechaacceso"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $observacion = $_POST["observaciones"];

        $query = "INSERT INTO control_acceso (id_empleado, fecha, hora_entrada, hora_salida, observacion) VALUES ($1, $2, $3, $4, $5)";
        $result = pg_query_params($conexion, $query, array($idempleado, $fechaacceso, $horaentrada, $horasalida, $observacion));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Acceso registrado correctamente!</div>';
            header("Location: listacontrol.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar acceso: ' . pg_last_error($conexion) . '</div>';
            header("Location: listacontrol.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>