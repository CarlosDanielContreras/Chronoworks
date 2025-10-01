<?php
// ============================================
// ARCHIVO: controlador/control_acceso/modificar_controlacceso.php
// ============================================
// ✅ ELIMINADO session_start()

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["fechaacceso"]) && 
        !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"]) && 
        !empty($_POST["observaciones"])) {

        $id = (int)$_POST["id"];
        $idempleado = (int)$_POST['idempleado'];
        $fechaacceso = $_POST["fechaacceso"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $observacion = $_POST["observaciones"];

        $query = "UPDATE control_acceso SET id_empleado = $1, fecha = $2, hora_entrada = $3, hora_salida = $4, observacion = $5 WHERE id_control = $6";
        $result = pg_query_params($conexion, $query, array($idempleado, $fechaacceso, $horaentrada, $horasalida, $observacion, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Acceso actualizado correctamente!</div>';
            header("Location: listacontrol.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar acceso: ' . pg_last_error($conexion) . '</div>';
            header("Location: listacontrol.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>