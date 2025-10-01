
<?php
// ============================================
// ARCHIVO: controlador/empresa/modificar_empresa.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["Nombre_Empresa"]) && !empty($_POST["Nit_Empresa"]) && 
        !empty($_POST["Direccion"]) && !empty($_POST["Telefono"]) && 
        !empty($_POST["Sector"]) && !empty($_POST["Encargado"])) {

        $id = (int)$_POST["id"];
        $nombre_empresa = $_POST["Nombre_Empresa"];
        $nit_empresa = $_POST["Nit_Empresa"];
        $direccion = $_POST["Direccion"];
        $telefono = $_POST["Telefono"];
        $sector = $_POST["Sector"];
        $encargado = $_POST["Encargado"];

        // ✅ CORREGIDO: Usar pg_query_params
        $query = "UPDATE empresa SET nombre_empresa = $1, nit_empresa = $2, direccion = $3, 
                  telefono = $4, sector = $5, encargado = $6 WHERE id_empresa = $7";
        
        $result = pg_query_params($conexion, $query, 
            array($nombre_empresa, $nit_empresa, $direccion, $telefono, $sector, $encargado, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Empresa actualizada correctamente!</div>';
            header("Location: listaempresa.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar empresa</div>';
            header("Location: listaempresa.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>