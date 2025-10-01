<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["correo"]) && !empty($_POST["pwd"]) && !empty($_POST["idrol"])) {

        $id = $_POST["id"];
        $idempleado = $_POST["idempleado"];
        $correo = $_POST["correo"];
        $contraseña = $_POST["pwd"];
        $id_rol = $_POST["idrol"];

        $sql = $conexion->query("update credenciales set ID_Empleado=$idempleado, Usuario='$correo', Contraseña='$contraseña', id_rol=$id_rol where ID_Credencial=$id");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Cuenta actualizada correctamente!</div>';
            header("Location: listacredenciales.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar la cuenta</div>';
            header("Location: listacredenciales.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
