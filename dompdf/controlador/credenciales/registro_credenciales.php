<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["correo"]) && !empty($_POST["pwd"]) && !empty($_POST["idrol"])) {

        $idempleado = $_POST["idempleado"];
        $correo = $_POST["correo"];
        $pwd = $_POST["pwd"];
        $idrol = $_POST["idrol"];

        $sql = $conexion->query("INSERT INTO credenciales (ID_Empleado, Usuario, Contraseña, id_rol)
                                 VALUES ($idempleado, '$correo', '$pwd', '$idrol')");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Cuenta registrada correctamente!</div>';
            header("Location: listacredenciales.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar la cuenta</div>';
            header("Location: listacredenciales.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
