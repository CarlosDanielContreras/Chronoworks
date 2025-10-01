<?php
// ============================================
// ARCHIVO: controlador/turno/modificar_turno.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["horaentrada"]) && !empty($_POST["horasalida"])) {
        
        $id = (int)$_POST["id"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];

        // ✅ CORREGIDO: Usar pg_query_params
        $query = "UPDATE turno SET hora_entrada = $1, hora_salida = $2 WHERE id_turno = $3";
        $result = pg_query_params($conexion, $query, array($horaentrada, $horasalida, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Turno actualizado correctamente!</div>';
            header("Location: listaturno.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar turno</div>';
            header("Location: listaturno.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>
