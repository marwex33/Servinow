<?php
    @session_start();
    include("conexion.php");

    $concesionario = $_POST['concesionario'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $patente = $_POST['vehiculo'];
    $servicio = $_POST['mantenimiento'];

    //echo $hora . "<br>" . $fecha . "<br>" . $patente . "<br>" . $servicio . "<br>" . $concesionario . "<br>";

    $result_concesionario = mysqli_query($conexion, "SELECT CODIGO_CONCESIONARIO FROM CONCESIONARIO WHERE NOMBRE = '$concesionario'");
    $row_concesionario = mysqli_fetch_assoc($result_concesionario);
    $id_concesionario = $row_concesionario['CODIGO_CONCESIONARIO'];

    

    $result_servicio = mysqli_query($conexion, "SELECT CODIGO_SERVICIO FROM mantenimiento WHERE DESCRIPCION = '$servicio'");
    $row_servicio = mysqli_fetch_assoc($result_servicio);
    $id_servicio = $row_servicio['CODIGO_SERVICIO'];
    
    $estado = 'PENDIENTE';
    
    mysqli_query($conexion, "INSERT INTO turno 
                (CONCESIONARIO_CODIGO, MANT_CODIGO_SERVICIO, FECHA_TURNO, HORA_TURNO, ESTADO_TURNO, VEHICULO_PATENTE) 
        VALUES ('$id_concesionario' , '$id_servicio' , '$fecha' , '$hora' , '$estado' , '$patente')");
    if($_SESSION['tipo_usuario'] == 'USUARIO'){
        header("Location: ../html/vista_usuario.php");
    }
    else{
        header("Location: ../html/vista_admin.php");
    }
?>
