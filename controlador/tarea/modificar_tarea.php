<?php
// ============================================
// ARCHIVO: controlador/tarea/modificar_tarea.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["ID_Empleado"]) && !empty($_POST["nombre_tarea"]) && !empty($_POST["detalles"])) {

        $id = (int)$_POST["id"];
        $id_empleado = (int)$_POST["ID_Empleado"];
        $nombre_tarea = $_POST["nombre_tarea"];
        $detalles = $_POST["detalles"];

        // ✅ CORREGIDO: Usar pg_query_params
        $query = "UPDATE tarea SET id_empleado = $1, nombre_tarea = $2, detalles = $3 WHERE id_tarea = $4";
        $result = pg_query_params($conexion, $query, array($id_empleado, $nombre_tarea, $detalles, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Tarea actualizada correctamente!</div>';
            header("Location: listatarea.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar tarea: ' . pg_last_error($conexion) . '</div>';
            header("Location: listatarea.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>