<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["ID_Empresa"]) && !empty($_POST["Nombre_Empresa"]) && !empty($_POST["Nit_Empresa"]) && !empty($_POST["Direccion"]) && !empty($_POST["Telefono"]) && !empty($_POST["Sector"]) && !empty($_POST["Encargado"])) {

        $ID_Empresa = $_POST["ID_Empresa"];
        $Nombre_Empresa = $_POST["Nombre_Empresa"];
        $Nit_Empresa = $_POST["Nit_Empresa"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Sector = $_POST["Sector"];
        $Encargado = $_POST["Encargado"];

        $sql = $conexion->query("update Empresa set ID_Empresa='$ID_Empresa', Nombre_Empresa='$Nombre_Empresa', Nit_Empresa='$Nit_Empresa', Dirección='$Direccion', Teléfono='$Telefono', Sector='$Sector', Encargado='$Encargado'where ID_Empresa=$id");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Empresa actualizada correctamente!</div>';
            header("Location: listaEmpresa.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar empresa</div>';
            header("Location: listaEmpresa.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}