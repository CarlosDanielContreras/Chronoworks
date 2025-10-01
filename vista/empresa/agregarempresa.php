<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Agregar Empresa </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/agregar.css">
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
        Agregar Empresa
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <?php
                include "../../modelo/Conexion.php";
                include "../../controlador/empresa/registro_empresa.php";
                include "../../controlador/empresa/eliminar_empresa.php";
                ?>
                <div class="row mb-3">
                    <div class="mb-3 col-6">
                        <label for="idcampaña" class="form-label">Nombre de la Empresa:</label>
                        <input type="TEXT" class="form-control" id="nombreempresa" placeholder="Ingrese nombre de empresa" name="Nombre_Empresa">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="fechaasignacion" class="form-label">Nit de Empresa:</label>
                        <input type="number" class="form-control" name="Nit_Empresa" id="nombre_empresa" placeholder="Nit Empresa">
                    </div>


                    <div class="mb-3 col-6">
                        <label for="observaciones" class="form-label"> Dirección:</label>
                        <input class="form-control" name="Direccion" id="Direccion" placeholder="Direccion de empresa"></input>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="observaciones" class="form-label"> Telefono:</label>
                        <input type="text" class="form-control" name="Telefono" id="Telefono" placeholder="Telefono de la empresa"></input>
                    </div>


                    <div class="mb-3 col-6">
                        <label for="observaciones" class="form-label"> Sector:</label>
                        <input type="text" class="form-control" name="Sector" id="Sector" placeholder="Sector de la empresa"></input>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="observaciones" class="form-label"> Encargado:</label>
                        <input type="Tect" class="form-control" name="Encargado" id="Encargado" placeholder="Encargado de la empresa"></input>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Registrar </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>