<?php
// ============================================
// ARCHIVO: controlador/credenciales/eliminar_credenciales.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    $query = "DELETE FROM credenciales WHERE id_credencial = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Cuenta eliminada correctamente!</div>';
        header("Location: listacredenciales.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar cuenta: ' . pg_last_error($conexion) . '</div>';
        header("Location: listacredenciales.php");
        exit();
    }
}
?>