<?php 
if (!empty($_POST['btnregistrar']) && $_POST['btnregistrar'] === 'ok'){
    if(!empty($_POST['id_empleado']) and ($_POST['fecha']) and !empty($_POST['entrada']) and !empty($_POST['salida']) and !empty($_POST['observaciones'])){

        $id_empleado= $_POST['id_empleado'];
        $v_fecha = $_POST['fecha'];
        $v_entrada = $_POST['entrada'];
        $v_salida = $_POST['salida'];
        $v_observaciones = $_POST['observaciones'];
        
    }

        $sql=$conexion -> query("insert into control_acceso (id_Empleado,Fecha, Hora_Entrada, Hora_Salida, Observacion) values($id_empleado,'$v_fecha','$v_entrada','$v_salida','$v_observaciones')");


        if ($sql==1) {
            echo '<div>Se guardo correctamente</div>';

        } else {
            echo '<div>Error al registrar</div>';
        }
        
    }else{
        echo"Alguno de los campos esta vacio";
    }


?>