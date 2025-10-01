<?php
// ============================================
// ARCHIVO: controlador/turno/registro_turno.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["horaentrada"]) && !empty($_POST["horasalida"])) {

        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        
        // ✅ CORREGIDO: Usar pg_query_params
        $query = "INSERT INTO turno (hora_entrada, hora_salida) VALUES ($1, $2)";
        $result = pg_query_params($conexion, $query, array($horaentrada, $horasalida));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Turno registrado correctamente!</div>';
            header("Location: listaturno.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar turno: ' . pg_last_error($conexion) . '</div>';
            header("Location: listaturno.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>