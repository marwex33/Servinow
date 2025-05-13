<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
    <head>

    </head>
    <body>
        
    <?php
        $patente = $_POST['patente'];
        $hora = $_POST['hora'];
        $fecha = $_POST['fecha'];
        $mantenimiento = $_POST['mantenimiento'];
        $codigo = $_POST['codigo'];
        if($patente == 'NULL'){
           $estado = 'disponible'; 
        }
        else{
            $estado = 'ocupado';
        }
        include("conexion.php");

        $consulta = mysqli_query($conexion, "SELECT * FROM TURNO WHERE CODIGO_TURNO = '$codigo'");
        $resultado = mysqli_num_rows($consulta);
        
        if($_POST['accion'] =='modificar'){
            if ($resultado != 0)
            {
                if($patente == 'NULL'){
                    $consulta = mysqli_query($conexion, "UPDATE TURNO SET PATENTE_VEHICULO = NULL ,HORA_TURNO = '$hora', FECHA_TURNO = '$fecha', MANT_CODIGO_SERVICIO = '$mantenimiento',ESTADO_TURNO = '$estado' WHERE CODIGO_TURNO = '$codigo'");
                }
                else{
                    $consulta = mysqli_query($conexion, "UPDATE TURNO SET PATENTE_VEHICULO = '$patente' ,HORA_TURNO = '$hora', FECHA_TURNO = '$fecha', MANT_CODIGO_SERVICIO = '$mantenimiento' WHERE CODIGO_TURNO = '$codigo'");
                }
                echo "Cambios realizados";
                include("..\php\\vista_concesionarios.php");
            }
            else 
            {
                echo "Cambios no realizados";
                include("..\php\\vista_concesionarios.php");
            }
        }
        else{
            $consulta = mysqli_query($conexion, "DELETE FROM TURNO WHERE CODIGO_TURNO = '$codigo'");
            include("..\php\\vista_concesionarios.php");
        }
    ?>

    </body>
</html>