<?php @session_start();?>
<html>
    <head>

    </head>
    <body>
        
    <?php
    include("conexion.php");
        $codigo = $_POST['codigo'];
        if($_POST['accion'] =='modificar'){
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
                if($_SESSION['tipo_usuario'] == 'ADMIN'){
                      $codigo_usuario = $_POST['codigo_usuario'];
                }
                else{
                    $codigo_usuario = $_SESSION['id_sesion'];
                }
        }

        

        $consulta = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE CODIGO_CONCESIONARIO = '$codigo'");
        $resultado = mysqli_num_rows($consulta);
        if($_POST['accion'] =='modificar'){
            if ($resultado != 0)
            {
                $consulta = mysqli_query($conexion, "UPDATE CONCESIONARIO SET NOMBRE = '$nombre', DIRECCION = '$direccion', CORREO_ELECTRONICO = '$email', TELEFONO = $telefono , CODIGO_USUARIO = $codigo_usuario WHERE CODIGO_CONCESIONARIO = '$codigo'");
                if ($consulta) {
                    echo "Cambios realizados correctamente";
                } 
                else {
                    echo "Error al realizar cambios: " . mysqli_error($conexion);
                }
            }
            else 
            {
                echo "Cambios no realizados";
            }
        }
        else{
            $consulta = mysqli_query($conexion, "UPDATE TURNO SET ESTADO_TURNO = 'CANCELADO'WHERE CONCESIONARIO_CODIGO = '$codigo'");
            $consulta = mysqli_query($conexion, "UPDATE CONCESIONARIO SET BORRADO = 1, CODIGO_USUARIO = NULL WHERE CODIGO_CONCESIONARIO = '$codigo'");

        }
        if($_SESSION['tipo_usuario'] == 'CONCESIONARIO'){
            include("../html/vista_datos_concesionario.php");
        }
        else{
            include("../php/vista_concesionarios_admin.php");
        }
    ?>

    </body>
</html>