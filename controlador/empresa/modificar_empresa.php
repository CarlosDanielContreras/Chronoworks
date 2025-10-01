<?php
// ============================================
// ARCHIVO: controlador/empresa/modificar_empresa.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["Nombre_Empresa"]) && !empty($_POST["Nit_Empresa"]) && 
        !empty($_POST["Direccion"]) && !empty($_POST["Telefono"]) && 
        !empty($_POST["Sector"]) && !empty($_POST["Encargado"])) {

        $id = (int)$_POST["id"];
        $nombre_empresa = escaparString($_POST["Nombre_Empresa"]);
        $nit_empresa = escaparString($_POST["Nit_Empresa"]);
        $direccion = escaparString($_POST["Direccion"]);
        $telefono = escaparString($_POST["Telefono"]);
        $sector = escaparString($_POST["Sector"]);
        $encargado = escaparString($_POST["Encargado"]);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "UPDATE empresa SET Nombre_Empresa=?, Nit_Empresa=?, Direccion=?, 
             Telefono=?, Sector=?, Encargado=? WHERE ID_Empresa=?"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssi", $nombre_empresa, $nit_empresa, $direccion, 
                                   $telefono, $sector, $encargado, $id);
            
            if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Empresa actualizada correctamente!</div>';
                header("Location: listaempresa.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-warning">No se realizaron cambios</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
}
?>