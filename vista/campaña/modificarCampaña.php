<?php
session_start();

if (!isset($_SESSION['id_rol']) || ($_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 2)) {
    header("Location: ../../login.php");
    exit();
}

include_once "../../modelo/Conexion.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['mensaje'] = '<div class="alert alert-danger">ID de campaña no especificado</div>';
    header("Location: listacampaña.php");
    exit();
}

$id = (int)$_GET['id'];

// ✅ MySQL
$stmt = mysqli_prepare($conexion, "SELECT * FROM campania WHERE ID_Campania = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    $_SESSION['mensaje'] = '<div class="alert alert-danger">Campaña no encontrada</div>';
    mysqli_stmt_close($stmt);
    header("Location: listacampaña.php");
    exit();
}

$datos = mysqli_fetch_object($result);
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Campaña</title>
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
                        <a href="<?php echo ($_SESSION['id_rol'] === 1) ? '../../admin.php' : '../../lider.php'; ?>" class="botoninicio">Inicio</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm"
        style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Modificar Campaña
    </h2>
    
    <div class="container">
        <div class="col-12">
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            ?>
            
            <form method="post" action="" id="formModificar">
                <input type="hidden" name="id" value="<?= $id ?>">
                
                <?php include_once "../../controlador/campaña/modificar_campaña.php"; ?>
                
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="idempresa" class="form-label">Empresa: <span class="text-danger">*</span></label>
                        <select class="form-control" name="idempresa" id="idempresa" required>
                            <option value="">Seleccione una empresa</option>
                            <?php
                            // ✅ MySQL
                            $sql_empresas = mysqli_query($conexion, "SELECT ID_Empresa, Nombre_Empresa FROM empresa ORDER BY Nombre_Empresa");
                            if ($sql_empresas) {
                                while ($empresa = mysqli_fetch_assoc($sql_empresas)) {
                                    $selected = ($empresa['ID_Empresa'] == $datos->ID_Empresa) ? 'selected' : '';
                                    echo "<option value='{$empresa['ID_Empresa']}' $selected>{$empresa['Nombre_Empresa']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="campaña" class="form-label">Nombre Campaña: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="campaña" 
                               placeholder="Nombre de la campaña" 
                               name="campaña" 
                               value="<?= htmlspecialchars($datos->Nombre_Campania) ?>" 
                               required maxlength="100">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="mb-3 col-6">
                        <label for="descripcion" class="form-label">Descripción: <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="descripcion" id="descripcion" 
                                  placeholder="Descripción..." rows="4" required 
                                  maxlength="500"><?= htmlspecialchars($datos->Descripcion) ?></textarea>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="fechainicio" class="form-label">Fecha Inicio: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="fechainicio" id="fechainicio" 
                               value="<?= $datos->Fecha_Inicio ?>" required>
                        
                        <label for="fechafin" class="form-label mt-3">Fecha Fin: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="fechafin" id="fechafin" 
                               value="<?= $datos->Fecha_Fin ?>" required>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="listacampaña.php" class="btn btn-secondary shadow py-2 px-4 fw-bold col-3">Cancelar</a>
                    <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-3" 
                            name="btnregistrar" value="ok">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validarFormulario() {
            const fechaInicio = new Date(document.getElementById('fechainicio').value);
            const fechaFin = new Date(document.getElementById('fechafin').value);
            
            if (fechaFin <= fechaInicio) {
                alert('La fecha fin debe ser posterior a la fecha inicio');
                return false;
            }
            
            return confirm('¿Está seguro de actualizar esta campaña?');
        }
        
        document.getElementById('formModificar').addEventListener('submit', function(e) {
            if (!validarFormulario()) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>