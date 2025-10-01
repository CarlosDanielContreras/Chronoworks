<?php
// ============================================
// ARCHIVO 2: vista/campaña/modificarCampaña.php (MEJORADO)
// ============================================
?>
<?php
session_start();

// Verificar permisos
if (!isset($_SESSION['id_rol']) || ($_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 2)) {
    header("Location: ../../login.php");
    exit();
}

include_once "../../modelo/Conexion.php";

// Validar que el ID existe
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['mensaje'] = '<div class="alert alert-danger">ID de campaña no especificado</div>';
    header("Location: listacampaña.php");
    exit();
}

$id = (int)$_GET['id'];

// Obtener datos de la campaña
$sql = pg_query_params($conexion, "SELECT * FROM campania WHERE id_campania = $1", array($id));

// Verificar que la campaña existe
if (!$sql || pg_num_rows($sql) == 0) {
    $_SESSION['mensaje'] = '<div class="alert alert-danger">Campaña no encontrada</div>';
    header("Location: listacampaña.php");
    exit();
}

$datos = pg_fetch_object($sql);
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
    <style>
        .alert-actualizar {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
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
            // Mostrar mensajes
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            ?>
            
            <form method="post" action="" id="formModificar" onsubmit="return validarFormulario()">
                <input type="hidden" name="id" value="<?= $id ?>">
                
                <?php include_once "../../controlador/campaña/modificar_campaña.php"; ?>
                
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="idempresa" class="form-label">Empresa: <span class="text-danger">*</span></label>
                        <select class="form-control" name="idempresa" id="idempresa" required>
                            <option value="">Seleccione una empresa</option>
                            <?php
                            $sql_empresas = pg_query($conexion, "SELECT id_empresa, nombre_empresa FROM empresa ORDER BY nombre_empresa");
                            if ($sql_empresas) {
                                while ($empresa = pg_fetch_assoc($sql_empresas)) {
                                    $selected = ($empresa['id_empresa'] == $datos->id_empresa) ? 'selected' : '';
                                    echo "<option value='{$empresa['id_empresa']}' $selected>{$empresa['nombre_empresa']}</option>";
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
                               value="<?= htmlspecialchars($datos->nombre_campania) ?>" 
                               required maxlength="100">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="mb-3 col-6">
                        <label for="descripcion" class="form-label">Descripción: <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="descripcion" id="descripcion" 
                                  placeholder="Descripción..." rows="4" required 
                                  maxlength="500"><?= htmlspecialchars($datos->descripcion) ?></textarea>
                        <small class="text-muted">Máximo 500 caracteres</small>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="fechainicio" class="form-label">Fecha Inicio: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="fechainicio" id="fechainicio" 
                               value="<?= $datos->fecha_inicio ?>" required>
                        
                        <label for="fechafin" class="form-label mt-3">Fecha Fin: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="fechafin" id="fechafin" 
                               value="<?= $datos->fecha_fin ?>" required>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="listacampaña.php" class="btn btn-secondary shadow py-2 px-4 fw-bold col-3">Cancelar</a>
                    <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-3" 
                            name="btnregistrar" value="ok">
                        Actualizar Campaña
                    </button>
                </div>
            </form>
            
            <!-- Panel de depuración (quitar en producción) -->
            <div class="mt-4 p-3 bg-light border" style="display: none;" id="debug">
                <h5>Datos actuales:</h5>
                <pre><?php print_r($datos); ?></pre>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validarFormulario() {
            // Validar empresa
            const empresa = document.getElementById('idempresa').value;
            if (!empresa) {
                alert('Debe seleccionar una empresa');
                return false;
            }
            
            // Validar nombre
            const nombre = document.getElementById('campaña').value.trim();
            if (nombre.length < 3) {
                alert('El nombre debe tener al menos 3 caracteres');
                return false;
            }
            
            // Validar descripción
            const descripcion = document.getElementById('descripcion').value.trim();
            if (descripcion.length < 10) {
                alert('La descripción debe tener al menos 10 caracteres');
                return false;
            }
            
            // Validar fechas
            const fechaInicio = new Date(document.getElementById('fechainicio').value);
            const fechaFin = new Date(document.getElementById('fechafin').value);
            
            if (fechaFin <= fechaInicio) {
                alert('La fecha fin debe ser posterior a la fecha inicio');
                return false;
            }
            
            // Confirmar actualización
            return confirm('¿Está seguro de actualizar esta campaña?');
        }
        
        // Mostrar debug en consola
        console.log('Datos de la campaña:', <?= json_encode($datos) ?>);
    </script>
</body>
</html>