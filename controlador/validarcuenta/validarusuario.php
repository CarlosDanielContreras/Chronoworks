<?php
include_once(__DIR__ . '/../../modelo/Conexion.php');

$tipoerror = "";
$error_message = "";

if (!empty($_POST["btniniciarsesion"]) && $_POST["btniniciarsesion"] === "ok") {
    if (!empty($_POST['correo']) && !empty($_POST['contraseña'])) {

        $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
        $contraseña = $_POST['contraseña'];

        // ✅ MySQL: Consulta preparada
        $stmt = mysqli_prepare($conexion, 
            "SELECT Usuario, Contrasena, id_rol, ID_Empleado FROM credenciales WHERE Usuario = ?"
        );
        
        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $pwd = $row['Contrasena'];
            $idrol = $row['id_rol'];
            $idEmpleado = $row['ID_Empleado'];

            // Validar contraseña
            if (password_verify($contraseña, $pwd)) {
                // Obtener nombre del empleado
                $stmtEmp = mysqli_prepare($conexion, 
                    "SELECT Nombre FROM empleados WHERE ID_Empleado = ?"
                );
                mysqli_stmt_bind_param($stmtEmp, "i", $idEmpleado);
                mysqli_stmt_execute($stmtEmp);
                $resultEmp = mysqli_stmt_get_result($stmtEmp);

                if ($resultEmp && mysqli_num_rows($resultEmp) > 0) {
                    $empleado = mysqli_fetch_assoc($resultEmp);
                    $nombreEmpleado = $empleado['Nombre'];

                    // Iniciar sesión
                    session_start();
                    $_SESSION['usuario'] = $correo;
                    $_SESSION['id_rol'] = $idrol;
                    $_SESSION['id_empleado'] = $idEmpleado;
                    $_SESSION['nombre_empleado'] = $nombreEmpleado;

                    // Redirigir según el rol
                    switch ($idrol) {
                        case 1:
                            header("Location: ../../admin.php");
                            break;
                        case 2:
                            header("Location: ../../lider.php");
                            break;
                        case 3:
                            header("Location: ../../agente.php");
                            break;
                        default:
                            $error_message = "Rol no reconocido.";
                            $tipoerror = "danger";
                    }
                    exit();
                } else {
                    $error_message = "Empleado no encontrado.";
                    $tipoerror = "danger";
                }
                mysqli_stmt_close($stmtEmp);
            } else {
                $error_message = "Contraseña incorrecta.";
                $tipoerror = "danger";
            }
        } else {
            $error_message = "Usuario no encontrado.";
            $tipoerror = "secondary";
        }
        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Alguno de los campos está vacío, por favor diligencie todos los datos.";
        $tipoerror = "warning";
    }
}
?>