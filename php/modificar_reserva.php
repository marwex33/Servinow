<?php
    @session_start();
    include("conexion.php");
    $codigo = $_POST['codigo'];
    $concesionario = $_POST['concesionario'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $patente = $_POST['vehiculo'];
    $servicio = $_POST['mantenimiento'];

    

    $result_concesionario = mysqli_query($conexion, "SELECT CODIGO_CONCESIONARIO FROM CONCESIONARIO WHERE NOMBRE = '$concesionario'");
    $row_concesionario = mysqli_fetch_assoc($result_concesionario);
    $id_concesionario = $row_concesionario['CODIGO_CONCESIONARIO']; 

    $result_servicio = mysqli_query($conexion, "SELECT CODIGO_SERVICIO FROM mantenimiento WHERE DESCRIPCION = '$servicio'");
    $row_servicio = mysqli_fetch_assoc($result_servicio);
    $id_servicio = $row_servicio['CODIGO_SERVICIO'];
    
    $estado = 'MODIFICADO';
    
    mysqli_query($conexion, "UPDATE turno SET
        CONCESIONARIO_CODIGO = '$id_concesionario',
        MANT_CODIGO_SERVICIO = '$id_servicio',
        FECHA_TURNO = '$fecha',
        HORA_TURNO = '$hora',
        ESTADO_TURNO = '$estado',
        VEHICULO_PATENTE = '$patente'
        WHERE CODIGO_TURNO = '$codigo'");
    if($_SESSION['tipo_usuario'] == 'CONCESIONARIO'){
        include("../html/vista_concesionario.php");
    }
    else{
        include("../html/vista_admin.php");
    }
?>
