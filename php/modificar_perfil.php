<?php @session_start()?>
<html>
    <head>

    </head>
    <body>
        
    <?php

        $usuario = $_SESSION['usuario_sesion'];
        $contraseña = $_SESSION['contraseña_sesion'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];


        include("conexion.php");

        $consulta = mysqli_query($conexion, "SELECT NOMBRES, APELLIDOS, CORREO_ELECTRONICO, TELEFONO FROM CLIENTE WHERE USUARIO = '$usuario' AND CONTRASEÑA ='$contraseña'");
        $resultado = mysqli_num_rows($consulta);

        if ($resultado != 0)
        {
            $consulta = mysqli_query($conexion, "UPDATE CLIENTE SET NOMBRES = '$nombre', APELLIDOS = '$apellido', CORREO_ELECTRONICO = '$email', TELEFONO = $telefono WHERE USUARIO = '$usuario' AND CONTRASEÑA = '$contraseña'");
            echo "Cambios realizados correctamente";
            include("../html/vista_perfil.php");
        }
        else 
        {
            echo "Cambios no realizados";
            include("../html/vista_perfil.html");    
        }
        
    ?>

    </body>
</html>