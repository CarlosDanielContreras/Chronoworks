<?php
session_start();

if (!isset($_SESSION['id_rol']) || ($_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 2)) {
    header("Location: ../../login.php");
    exit();
}

include_once "../../modelo/Conexion.php";

if (!isset($conexion) || !$conexion) {
    die("Error: No se pudo establecer conexión con la base de datos");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Campaña</title>
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
                        <a href="<?php echo ($_SESSION['id_rol'] === 1) ? '../../admin.php' : '../../lider.php'; ?>" class="botoninicio">Inicio</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm"
        style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Agregar Campaña
    </h2>
    
    <div class="container">
        <div class="col-12">
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            
            include_once "../../controlador/campaña/registro_campaña.php";
            ?>
            
            <form method="post" action="" id="formAgregar">
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="idempresa" class="form-label">Empresa: <span class="text-danger">*</span></label>
                        <select class="form-control" name="idempresa" id="idempresa" required>
                            <option value="">Seleccione una empresa</option>
                            <?php
                            // ✅ MySQL
                            $sql_empresas = mysqli_query($conexion, "SELECT ID_Empresa, Nombre_Empresa FROM empresa ORDER BY Nombre_Empresa");
                            
                            if ($sql_empresas) {
                                if (mysqli_num_rows($sql_empresas) > 0) {
                                    while ($empresa = mysqli_fetch_assoc($sql_empresas)) {
                                        echo "<option value='{$empresa['ID_Empresa']}'>{$empresa['Nombre_Empresa']}</option>";
                                    }
                                } else {
                                    echo '<option value="" disabled>No hay empresas registradas</option>';
                                }
                            } else {
                                echo '<option value="" disabled>Error al cargar empresas</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="campaña" class="form-label">Nombre Campaña: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="campaña" 
                               placeholder="Nombre de la campaña" 
                               name="campaña" 
                               required 
                               minlength="3"
                               maxlength="100">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="mb-3 col-6">
                        <label for="descripcion" class="form-label">Descripción: <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="descripcion" id="descripcion" 
                                  placeholder="Descripción..." 
                                  rows="4" 
                                  required
                                  minlength="10"
                                  maxlength="500"></textarea>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="fechainicio" class="form-label">Fecha Inicio: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="fechainicio" id="fechainicio" required>
                        
                        <label for="fechafin" class="form-label mt-3">Fecha Fin: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="fechafin" id="fechafin" required>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="listacampaña.php" class="btn btn-secondary shadow py-2 px-4 fw-bold">Cancelar</a>
                    <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold" 
                            name="btnregistrar" value="ok">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
    <script>
        document.getElementById('formAgregar').addEventListener('submit', function(e) {
            const fechaInicio = document.getElementById('fechainicio').value;
            const fechaFin = document.getElementById('fechafin').value;
            
            if (fechaInicio && fechaFin) {
                if (new Date(fechaFin) <= new Date(fechaInicio)) {
                    e.preventDefault();
                    alert('La fecha fin debe ser posterior a la fecha inicio');
                    return false;
                }
            }
        });
    </script>
</body>
</html>