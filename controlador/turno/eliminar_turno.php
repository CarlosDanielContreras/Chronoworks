<?php
// ============================================
// ARCHIVO: controlador/turno/eliminar_turno.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    // ✅ CORREGIDO: Usar pg_query_params
    $query = "DELETE FROM turno WHERE id_turno = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Turno eliminado correctamente!</div>';
        header("Location: listaturno.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar turno</div>';
        header("Location: listaturno.php");
        exit();
    }
}
?>