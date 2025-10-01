<?php
// ============================================
// ARCHIVO: controlador/credenciales/modificar_credenciales.php
// ============================================
// ✅ ELIMINADO session_start() - ya se inicia en la vista

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["correo"]) && !empty($_POST["pwd"]) && !empty($_POST["idrol"])) {

        $id = (int)$_POST["id"];
        $idempleado = (int)$_POST["idempleado"];
        $correo = $_POST["correo"];
        $contrasena = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        $id_rol = (int)$_POST["idrol"];

        // ✅ CORREGIDO: Usar pg_query_params
        $query = "UPDATE credenciales SET id_empleado = $1, usuario = $2, contrasena = $3, id_rol = $4 WHERE id_credencial = $5";
        $result = pg_query_params($conexion, $query, array($idempleado, $correo, $contrasena, $id_rol, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Cuenta actualizada correctamente!</div>';
            header("Location: listacredenciales.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar cuenta: ' . pg_last_error($conexion) . '</div>';
            header("Location: listacredenciales.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>