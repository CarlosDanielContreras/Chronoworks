<?php
// ============================================
// ARCHIVO: controlador/roles/modificar_roles.php
// ============================================
// ✅ ELIMINADO session_start()

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"])) {

        $id = (int)$_POST["id"];
        $nombre = $_POST['nombre'];

        $query = "UPDATE roles SET nombre = $1 WHERE id_rol = $2";
        $result = pg_query_params($conexion, $query, array($nombre, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Rol actualizado correctamente!</div>';
            header("Location: listaroles.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar rol: ' . pg_last_error($conexion) . '</div>';
            header("Location: listaroles.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">El campo nombre está vacío.</div>';
    }
}
?>