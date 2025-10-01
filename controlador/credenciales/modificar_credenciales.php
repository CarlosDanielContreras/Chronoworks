<?php
// ============================================
// ARCHIVO: controlador/credenciales/modificar_credenciales.php (MYSQL)
// ============================================

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["correo"]) && 
        !empty($_POST["pwd"]) && !empty($_POST["idrol"])) {

        $id = (int)$_POST["id"];
        $idempleado = (int)$_POST["idempleado"];
        $correo = escaparString($_POST["correo"]);
        $contrasena = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        $id_rol = (int)$_POST["idrol"];

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "UPDATE credenciales SET ID_Empleado=?, Usuario=?, Contrasena=?, id_rol=? 
             WHERE ID_Credencial=?"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issii", $idempleado, $correo, $contrasena, $id_rol, $id);
            
            if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Cuenta actualizada correctamente!</div>';
                header("Location: listacredenciales.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
}
?>