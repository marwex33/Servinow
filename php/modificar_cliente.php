<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
    <head>

    </head>
    <body>
        
    <?php
        $codigo = $_POST['codigo'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        

        include("conexion.php");

        $consulta = mysqli_query($conexion, "SELECT * FROM CLIENTE WHERE CODIGO_CLIENTE = '$codigo'");
        $resultado = mysqli_num_rows($consulta);
        
        if($_POST['accion'] =='modificar'){
            if ($resultado != 0)
            {
                $consulta = mysqli_query($conexion, "UPDATE CLIENTE SET NOMBRES = '$nombres',APELLIDOS = '$apellidos', USUARIO = '$usuario', CORREO_ELECTRONICO = '$email', TELEFONO = $telefono WHERE CODIGO_CLIENTE = '$codigo'");
                echo "Cambios realizados";
            }
            else 
            {
                echo "Cambios no realizados";
            }
        }
        else{
            $resultado = mysqli_fetch_assoc($consulta);
            $consulta = mysqli_query($conexion, "UPDATE CLIENTE SET BORRADO = 1 WHERE CODIGO_CLIENTE = '$codigo'");
            if($resultado['TIPO_CLIENTE'] == 'USUARIO' ){
                $consulta1 = (mysqli_query($conexion, "SELECT * FROM vehiculo WHERE CODIGO_PROPIETARIO = '$codigo'"));
                while($vehiculo = mysqli_fetch_assoc($consulta1)){
                    $patente = $vehiculo['PATENTE'];
                    $consulta = mysqli_query($conexion, "UPDATE TURNO SET ESTADO_TURNO = 'CANCELADO' WHERE VEHICULO_PATENTE = '$patente'");
                }
                $consulta = mysqli_query($conexion, "UPDATE VEHICULO SET BORRADO = 1 WHERE CODIGO_PROPIETARIO = '$codigo'");
                echo "Usuario eliminado";
            }
            elseif($resultado['TIPO_CLIENTE'] == 'CONCESIONARIO'){
                $consulta = mysqli_query($conexion, "UPDATE CONCESIONARIO SET CODIGO_USUARIO = NULL WHERE CODIGO_USUARIO = '$codigo'");
            }
        }
        include("..\php\\vista_clientes_admin.php");
    ?>

    </body>
</html>