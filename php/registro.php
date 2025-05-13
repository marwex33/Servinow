<?php @session_start();?>

<!doctype html>
<html>
    <head>
    </head>
    <title>Registro</title>

    <body>
        <?php

            $_SESSION['nombre'] = $_POST['nombre'];
            $_SESSION['apellido'] = $_POST['apellido'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['usuario'] = $_POST['usuario'];
            $_SESSION['telefono'] = $_POST['telefono'];
            $password = $_POST['password'];
            $confirmarPassword = $_POST['confirmar-password'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $usuario = $_POST['usuario'];
            $telefono = $_POST['telefono'];
            include("conexion.php");

            if ($password !== $confirmarPassword) {
                $_SESSION['error'] = "Las contraseñas no coinciden.";
                header("Location: ../html/vista_registrarte.php");
                exit;
            }
            $consulta = mysqli_query($conexion, "SELECT * FROM CLIENTE WHERE USUARIO = '$usuario'");
            if (mysqli_num_rows($consulta) > 0) {
                $_SESSION['error'] = "El nombre de usuario ya existe. Por favor, elige otro.";
                header("Location: ../html/vista_registrarte.php");
                exit;
            } else {
                $contraseña = md5($password);
                if($_POST['tipo_usuario'] == 'concesionario'){
                    $consulta = mysqli_query($conexion, "INSERT INTO CLIENTE (NOMBRES, APELLIDOS, CORREO_ELECTRONICO, USUARIO, CONTRASEÑA, TELEFONO, TIPO_CLIENTE) VALUES ('$nombre', '$apellido', '$email', '$usuario', '$contraseña', '$telefono', 'CONCESIONARIO')");
                }
                else if($_POST['tipo_usuario'] == 'admin'){
                    $consulta = mysqli_query($conexion, "INSERT INTO CLIENTE (NOMBRES, APELLIDOS, CORREO_ELECTRONICO, USUARIO, CONTRASEÑA, TELEFONO, TIPO_CLIENTE) VALUES ('$nombre', '$apellido', '$email', '$usuario', '$contraseña', '$telefono', 'ADMIN')");
                }
                else{
                    $consulta = mysqli_query($conexion, "INSERT INTO CLIENTE (NOMBRES, APELLIDOS, CORREO_ELECTRONICO, USUARIO, CONTRASEÑA, TELEFONO, TIPO_CLIENTE) VALUES ('$nombre', '$apellido', '$email', '$usuario', '$contraseña', '$telefono', 'USUARIO')");
                }
                if($_SESSION['tipo_usuario'] == 'ADMIN'){
                    header("Location:../php/vista_clientes_admin.php");
                }
                else{
                    header("Location:../html/vista_iniciar_sesion.php");
                }
                $_SESSION['nombre'] = '';
                $_SESSION['apellido'] = '';
                $_SESSION['email'] = '';
                $_SESSION['usuario'] = '';
                $_SESSION['telefono'] = '';
            }
        ?>
    </body>
</html>