<?php @session_start();

    $usuario = $_POST['usuario'];
    $contraseña = md5($_POST['password']);
    $_SESSION['usuario'] = $_POST['usuario'];
    include("conexion.php");
    
    $consulta = mysqli_query($conexion, "SELECT * FROM CLIENTE WHERE USUARIO = '$usuario' AND BORRADO = 0");
    $resultado = mysqli_num_rows($consulta);
    $respuesta = mysqli_fetch_array($consulta);
    if($resultado != 0){
        if ($respuesta['CONTRASEÑA'] == $contraseña) {
            $_SESSION['usuario'] = '';
            $_SESSION['autenticado'] = true;
            if ( $respuesta['TIPO_CLIENTE'] == 'USUARIO')
            {
                $_SESSION['tipo_usuario'] = $respuesta['TIPO_CLIENTE'];
                $_SESSION['nombre_sesion'] = $respuesta['NOMBRES'];
                $_SESSION['apellido_sesion'] = $respuesta['APELLIDOS'];
                $_SESSION['correo_sesion'] = $respuesta['CORREO_ELECTRONICO'];
                $_SESSION['telefono_sesion'] = $respuesta['TELEFONO'];
                $_SESSION['usuario_sesion'] = $usuario;
                $_SESSION['contraseña_sesion'] = $contraseña;
                $_SESSION['id_sesion'] = $respuesta['CODIGO_CLIENTE'];
        
                header('Location: ../html/vista_usuario.php');
                exit();
            }
            else if ($respuesta['TIPO_CLIENTE'] == 'ADMIN')
            {
                $_SESSION['tipo_usuario'] = $respuesta['TIPO_CLIENTE'];
                $_SESSION['nombre_sesion'] = $respuesta['NOMBRES'];
                $_SESSION['apellido_sesion'] = $respuesta['APELLIDOS'];
                $_SESSION['correo_sesion'] = $respuesta['CORREO_ELECTRONICO'];
                $_SESSION['telefono_sesion'] = $respuesta['TELEFONO'];
                $_SESSION['usuario_sesion'] = $usuario;
                $_SESSION['contraseña_sesion'] = $contraseña;
                $_SESSION['id_sesion'] = $respuesta['CODIGO_CLIENTE'];

                header('Location: ../html/vista_admin.php');
                exit(); 
            }
            else if ($respuesta['TIPO_CLIENTE'] == 'CONCESIONARIO')
                    {
                        $_SESSION['tipo_usuario'] = $respuesta['TIPO_CLIENTE'];
                        $_SESSION['nombre_sesion'] = $respuesta['NOMBRES'];
                        $_SESSION['apellido_sesion'] = $respuesta['APELLIDOS'];
                        $_SESSION['correo_sesion'] = $respuesta['CORREO_ELECTRONICO'];
                        $_SESSION['telefono_sesion'] = $respuesta['TELEFONO'];
                        $_SESSION['usuario_sesion'] = $usuario;
                        $_SESSION['contraseña_sesion'] = $contraseña;
                        $_SESSION['id_sesion'] = $respuesta['CODIGO_CLIENTE'];

                        include("../html/vista_concesionario.php");
                    }
        }
        else{
            $_SESSION['error'] = "La contraseña es incorrecta.";
            header("Location: ../html/vista_iniciar_sesion.php");
            exit;
        }
    }
    else{
        $_SESSION['error'] = "El usuario no existe.";
        header("Location: ../html/vista_iniciar_sesion.php");
        exit;
    }