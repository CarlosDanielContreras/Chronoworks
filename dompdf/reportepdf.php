<?php
// ============================================
// ARCHIVO: dompdf/reportepdf.php (SIN LIBRERÍAS EXTERNAS)
// ============================================

session_start();

// Verificar permisos
if (!isset($_SESSION['id_rol']) || ($_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 2)) {
    header("Location: ../login.php");
    exit();
}

include_once "../modelo/Conexion.php";

// Obtener datos de asignaciones con información completa
$sql = pg_query($conexion, 
    "SELECT a.id_asignacion, 
            t.nombre_tarea, 
            e.nombre || ' ' || e.apellido as empleado,
            c.nombre_campania, 
            emp.nombre_empresa, 
            a.fecha, 
            a.observaciones
     FROM asignacion a
     JOIN tarea t ON a.id_tarea = t.id_tarea
     JOIN campania c ON a.id_campania = c.id_campania
     JOIN empresa emp ON c.id_empresa = emp.id_empresa
     JOIN empleados e ON t.id_empleado = e.id_empleado
     ORDER BY a.fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asignaciones</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
            body {
                margin: 0;
                padding: 20px;
            }
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #4caed4;
            padding-bottom: 15px;
        }
        
        .header h1 {
            color: #4caed4;
            margin: 0;
            font-size: 28px;
        }
        
        .header p {
            color: #666;
            margin: 5px 0;
        }
        
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #4caed4;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .info-box p {
            margin: 5px 0;
            font-size: 14px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        th {
            background: linear-gradient(135deg, #4caed4 0%, #3d8db8 100%);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 13px;
            border: 1px solid #3d8db8;
        }
        
        td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 12px;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #e6f7ff;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #999;
            border-top: 2px solid #ddd;
            padding-top: 15px;
        }
        
        .no-data {
            text-align: center;
            padding: 30px;
            color: #999;
            font-style: italic;
            background: #f8f9fa;
        }
        
        .btn-print {
            background: #4caed4;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px auto;
            display: block;
            transition: all 0.3s;
        }
        
        .btn-print:hover {
            background: #3d8db8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        
        .stat-box {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            flex: 1;
            margin: 0 10px;
            border-top: 3px solid #4caed4;
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #4caed4;
        }
        
        .stat-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <button class="btn-print no-print" onclick="window.print()">
        🖨️ Imprimir / Guardar PDF
    </button>
    
    <div class="header">
        <h1>📊 REPORTE DE ASIGNACIONES</h1>
        <p>Sistema de Gestión Chronoworks</p>
    </div>
    
    <div class="info-box">
        <p><strong>📅 Fecha de generación:</strong> <?= date('d/m/Y H:i:s') ?></p>
        <p><strong>👤 Generado por:</strong> <?= htmlspecialchars($_SESSION['nombre_empleado']) ?></p>
        <p><strong>🎭 Rol:</strong> <?= ($_SESSION['id_rol'] == 1) ? 'Administrador' : 'Líder' ?></p>
    </div>
    
    <?php
    // Calcular estadísticas
    $total_asignaciones = pg_num_rows($sql);
    $asignaciones_mes_actual = 0;
    
    if ($sql && $total_asignaciones > 0) {
        $mes_actual = date('Y-m');
        pg_result_seek($sql, 0); // Reiniciar puntero
        
        while ($row = pg_fetch_object($sql)) {
            if (date('Y-m', strtotime($row->fecha)) == $mes_actual) {
                $asignaciones_mes_actual++;
            }
        }
        pg_result_seek($sql, 0); // Reiniciar para la tabla
    }
    ?>
    
    <div class="stats no-print">
        <div class="stat-box">
            <div class="stat-number"><?= $total_asignaciones ?></div>
            <div class="stat-label">Total Asignaciones</div>
        </div>
        <div class="stat-box">
            <div class="stat-number"><?= $asignaciones_mes_actual ?></div>
            <div class="stat-label">Este Mes</div>
        </div>
        <div class="stat-box">
            <div class="stat-number"><?= date('d/m/Y') ?></div>
            <div class="stat-label">Fecha Actual</div>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 15%;">Tarea</th>
                <th style="width: 15%;">Empleado</th>
                <th style="width: 15%;">Campaña</th>
                <th style="width: 15%;">Empresa</th>
                <th style="width: 10%;">Fecha</th>
                <th style="width: 25%;">Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($sql && pg_num_rows($sql) > 0) {
                while ($row = pg_fetch_object($sql)) { ?>
                    <tr>
                        <td style="text-align: center;"><?= htmlspecialchars($row->id_asignacion) ?></td>
                        <td><?= htmlspecialchars($row->nombre_tarea) ?></td>
                        <td><?= htmlspecialchars($row->empleado) ?></td>
                        <td><?= htmlspecialchars($row->nombre_campania) ?></td>
                        <td><?= htmlspecialchars($row->nombre_empresa) ?></td>
                        <td style="text-align: center;"><?= date('d/m/Y', strtotime($row->fecha)) ?></td>
                        <td><?= htmlspecialchars(substr($row->observaciones, 0, 100)) ?><?= strlen($row->observaciones) > 100 ? '...' : '' ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="7" class="no-data">
                        ℹ️ No hay asignaciones registradas
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <div class="footer">
        <p><strong>Chronoworks</strong> - Sistema de Gestión de Call Centers</p>
        <p>© <?= date('Y') ?> Todos los derechos reservados</p>
        <p>Documento generado automáticamente - No requiere firma</p>
    </div>
    
    <script>
        // Auto-imprimir al cargar (opcional - puedes comentar esta línea)
        // window.onload = function() { window.print(); };
        
        console.log('Reporte cargado: <?= $total_asignaciones ?> asignaciones');
    </script>
</body>
</html>