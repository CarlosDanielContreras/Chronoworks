<?php
// ============================================
// ARCHIVO: dompdf/reporte_html_acceso.php (Temporal - Sin PDF)
// ============================================

session_start();
include_once(__DIR__ . '/../modelo/Conexion.php');

// Obtener datos de control de acceso
$query = "SELECT ca.id_control, 
                 e.nombre || ' ' || e.apellido as empleado,
                 ca.fecha, 
                 ca.hora_entrada, 
                 ca.hora_salida, 
                 ca.observacion
          FROM control_acceso ca
          JOIN empleados e ON ca.id_empleado = e.id_empleado
          ORDER BY ca.fecha DESC, ca.hora_entrada DESC";

$result = pg_query($conexion, $query);

if (!$result) {
    die("Error en la consulta: " . pg_last_error($conexion));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Control de Acceso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .report-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #667eea;
            font-weight: bold;
        }
        .btn-print {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 25px;
            font-weight: bold;
        }
        .btn-print:hover {
            background: #764ba2;
            color: white;
        }
        @media print {
            body { background: white; }
            .btn-print, .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="header">
            <h1>CHRONOWORKS</h1>
            <p class="text-muted">Reporte de Control de Acceso</p>
            <p class="text-muted">Fecha de generación: <?= date('d/m/Y H:i:s') ?></p>
        </div>

        <div class="text-end mb-3 no-print">
            <button onclick="window.print()" class="btn btn-print">
                <i class="fas fa-print"></i> Imprimir Reporte
            </button>
            <a href="../vista/controlacceso/listacontrol.php" class="btn btn-secondary">
                Volver
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Empleado</th>
                        <th>Fecha</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    while ($row = pg_fetch_object($result)) { 
                        $fecha_formato = date('d/m/Y', strtotime($row->fecha));
                        $observacion = $row->observacion ? htmlspecialchars($row->observacion) : 'Sin observaciones';
                        $total++;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row->id_control) ?></td>
                            <td><?= htmlspecialchars($row->empleado) ?></td>
                            <td><?= $fecha_formato ?></td>
                            <td><?= htmlspecialchars($row->hora_entrada) ?></td>
                            <td><?= htmlspecialchars($row->hora_salida) ?></td>
                            <td><?= $observacion ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="text-end mt-3">
            <strong>Total de registros: <?= $total ?></strong>
        </div>

        <div class="text-center mt-4 text-muted" style="font-size: 0.9em;">
            <p>Chronoworks - Sistema de Gestión de Call Center</p>
            <p>Este documento es confidencial y de uso exclusivo para personal autorizado</p>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
</body>
</html>
<?php pg_close($conexion); ?>