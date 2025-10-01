<?php
session_start();
include "../../modelo/Conexion.php";

$id = (int)$_GET['id'];

// ✅ MySQL
$stmt = mysqli_prepare($conexion, "SELECT * FROM empresa WHERE ID_Empresa = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/modificar.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
</head>
<body class="fondo">
    <header>
        <div class="fondo_menu">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="../../img/logo.png" alt="Logo" style="width:50px;" class="rounded-pill border border-2">
                        </a>
                        <a class="navbar-brand fw-semibold text-light" href="index.php">Chronoworks</a>
                        <a href="../../admin.php" class="botoninicio">Inicio</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm"
        style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Modificar Empresa
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <?php
                include "../../controlador/empresa/modificar_empresa.php";
                
                // ✅ MySQL
                if ($result && mysqli_num_rows($result) > 0) {
                    $datos = mysqli_fetch_object($result);
                ?>
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="Nombre_Empresa" class="form-label">Nombre de la Empresa:</label>
                            <input type="text" class="form-control" id="Nombre_Empresa" name="Nombre_Empresa" value="<?= htmlspecialchars($datos->Nombre_Empresa) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="Nit_Empresa" class="form-label">Nit de Empresa:</label>
                            <input type="text" class="form-control" name="Nit_Empresa" id="Nit_Empresa" value="<?= htmlspecialchars($datos->Nit_Empresa) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="Direccion" class="form-label">Dirección:</label>
                            <input class="form-control" name="Direccion" id="Direccion" value="<?= htmlspecialchars($datos->Direccion) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="Telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="Telefono" id="Telefono" value="<?= htmlspecialchars($datos->Telefono) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="Sector" class="form-label">Sector:</label>
                            <input type="text" class="form-control" name="Sector" id="Sector" value="<?= htmlspecialchars($datos->Sector) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="Encargado" class="form-label">Encargado:</label>
                            <input type="text" class="form-control" name="Encargado" id="Encargado" value="<?= htmlspecialchars($datos->Encargado) ?>" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Actualizar</button>
                    </div>
                <?php
                } else {
                    echo '<div class="alert alert-danger">No se encontró la empresa</div>';
                }
                mysqli_stmt_close($stmt);
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>