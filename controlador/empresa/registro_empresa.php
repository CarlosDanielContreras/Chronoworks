<?php
// ============================================
// ARCHIVO: controlador/empresa/registro_empresa.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["Nombre_Empresa"]) && !empty($_POST["Nit_Empresa"]) && 
        !empty($_POST["Direccion"]) && !empty($_POST["Telefono"]) && 
        !empty($_POST["Sector"]) && !empty($_POST["Encargado"])) {

        $nombre_empresa = escaparString($_POST["Nombre_Empresa"]);
        $nit_empresa = escaparString($_POST["Nit_Empresa"]);
        $direccion = escaparString($_POST["Direccion"]);
        $telefono = escaparString($_POST["Telefono"]);
        $sector = escaparString($_POST["Sector"]);
        $encargado = escaparString($_POST["Encargado"]);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "INSERT INTO empresa (Nombre_Empresa, Nit_Empresa, Direccion, Telefono, Sector, Encargado) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $nombre_empresa, $nit_empresa, $direccion, 
                                   $telefono, $sector, $encargado);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Empresa registrada correctamente!</div>';
                header("Location: listaempresa.php");
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