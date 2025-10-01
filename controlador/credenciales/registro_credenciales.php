<?php
// ============================================
// ARCHIVO: controlador/credenciales/registro_credenciales.php
// ============================================
// ✅ ELIMINADO session_start()

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["correo"]) && !empty($_POST["pwd"]) && !empty($_POST["idrol"])) {

        $idempleado = (int)$_POST["idempleado"];
        $correo = $_POST["correo"];
        $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        $idrol = (int)$_POST["idrol"];

        $query = "INSERT INTO credenciales (id_empleado, usuario, contrasena, id_rol) VALUES ($1, $2, $3, $4)";
        $result = pg_query_params($conexion, $query, array($idempleado, $correo, $pwd, $idrol));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Cuenta registrada correctamente!</div>';
            header("Location: listacredenciales.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar cuenta: ' . pg_last_error($conexion) . '</div>';
            header("Location: listacredenciales.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>