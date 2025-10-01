<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["Nombre_Empresa"]) && !empty($_POST["Nit_Empresa"]) && !empty($_POST["Direccion"]) && !empty($_POST["Telefono"]) && !empty($_POST["Sector"]) && !empty($_POST["Encargado"])) {

        $Nombre_Empresa = $_POST["Nombre_Empresa"];
        $Nit_Empresa = $_POST["Nit_Empresa"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Sector = $_POST["Sector"];
        $Encargado = $_POST["Encargado"];

        $sql = $conexion->query("INSERT INTO Empresa (Nombre_Empresa, Nit_Empresa, Dirección, Teléfono, Sector, Encargado )
                                 VALUES ('$Nit_Empresa', '$Nombre_Empresa', '$Direccion','$Telefono','$Sector','$Encargado')");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Empresa registrada correctamente!</div>';
            header("Location: listaEmpresa.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar empresa /div>';
            header("Location: listaEmpresa.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
