<?php
// ============================================
// ARCHIVO: controlador/empresa/eliminar_empresa.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    // ✅ CORREGIDO: Usar pg_query_params
    $query = "DELETE FROM empresa WHERE id_empresa = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Empresa eliminada correctamente!</div>';
        header("Location: listaempresa.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar empresa</div>';
        header("Location: listaempresa.php");
        exit();
    }
}
?>