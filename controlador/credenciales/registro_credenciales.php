<?php
// ============================================
// ARCHIVO: controlador/credenciales/registro_credenciales.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["correo"]) && 
        !empty($_POST["pwd"]) && !empty($_POST["idrol"])) {

        $idempleado = (int)$_POST["idempleado"];
        $correo = escaparString($_POST["correo"]);
        $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        $idrol = (int)$_POST["idrol"];

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion, 
            "INSERT INTO credenciales (ID_Empleado, Usuario, Contrasena, id_rol) VALUES (?, ?, ?, ?)"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issi", $idempleado, $correo, $pwd, $idrol);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Cuenta registrada correctamente!</div>';
                header("Location: listacredenciales.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error: ' . mysqli_error($conexion) . '</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
}
?>