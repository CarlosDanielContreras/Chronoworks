<?php
// ============================================
// ARCHIVO: controlador/roles/eliminar_roles.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    // ✅ CORREGIDO: Usar pg_query_params en lugar de $conexion->query()
    $query = "DELETE FROM roles WHERE id_rol = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Rol eliminado correctamente!</div>';
        header("Location: listaroles.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar rol: ' . pg_last_error($conexion) . '</div>';
        header("Location: listaroles.php");
        exit();
    }
}
?>