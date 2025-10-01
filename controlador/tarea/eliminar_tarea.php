<?php
// ============================================
// ARCHIVO: controlador/tarea/eliminar_tarea.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    // ✅ CORREGIDO: Usar pg_query_params
    $query = "DELETE FROM tarea WHERE id_tarea = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Tarea eliminada correctamente!</div>';
        header("Location: listatarea.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar tarea</div>';
        header("Location: listatarea.php");
        exit();
    }
}
?>