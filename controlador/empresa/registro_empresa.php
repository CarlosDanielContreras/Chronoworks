<?php
// ============================================
// ARCHIVO: controlador/empresa/registro_empresa.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["Nombre_Empresa"]) && !empty($_POST["Nit_Empresa"]) && 
        !empty($_POST["Direccion"]) && !empty($_POST["Telefono"]) && 
        !empty($_POST["Sector"]) && !empty($_POST["Encargado"])) {

        $nombre_empresa = $_POST["Nombre_Empresa"];
        $nit_empresa = $_POST["Nit_Empresa"];
        $direccion = $_POST["Direccion"];
        $telefono = $_POST["Telefono"];
        $sector = $_POST["Sector"];
        $encargado = $_POST["Encargado"];

        // ✅ CORREGIDO: Usar pg_query_params
        $query = "INSERT INTO empresa (nombre_empresa, nit_empresa, direccion, telefono, sector, encargado) 
                  VALUES ($1, $2, $3, $4, $5, $6)";
        
        $result = pg_query_params($conexion, $query, 
            array($nombre_empresa, $nit_empresa, $direccion, $telefono, $sector, $encargado));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Empresa registrada correctamente!</div>';
            header("Location: listaempresa.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar empresa: ' . pg_last_error($conexion) . '</div>';
            header("Location: listaempresa.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>