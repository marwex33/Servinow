<!doctype html>
<html>
    <head>
    </head>
    <title>Cargar concesionario</title>

    <body>
        <?php @session_start();
            $_SESSION['nombre1'] = $_POST['nombre'];
            $_SESSION['direccion1'] = $_POST['direccion'];
            $_SESSION['email1'] = $_POST['email'];
            $_SESSION['telefono1'] = $_POST['telefono'];
            $_SESSION['usuario1'] = $_POST['codigo_usuario'];
            
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $usuario = $_POST['codigo_usuario'];
            include("conexion.php");
            
            $consulta = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE NOMBRE = '$nombre'");
            
            if (mysqli_num_rows($consulta) > 0) {
                $_SESSION['error'] = "El nombre de concesionario ya existe. Por favor, elige otro.";
                header("Location: ../html/vista_cargar_concesionario_admin.php");
                exit;

            }
            else {
                $consulta = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE CODIGO_USUARIO = '$usuario'");
                if (mysqli_num_rows($consulta) > 0){
                    $_SESSION['error'] = "El usuario ya se encuentra asignado a otro concesionario. Por favor, elige otro.";
                    header("Location: ../html/vista_cargar_concesionario_admin.php");
                    exit;
                }
                else{
                    $consulta = mysqli_query($conexion, "INSERT INTO CONCESIONARIO (NOMBRE, DIRECCION, TELEFONO, CORREO_ELECTRONICO, CODIGO_USUARIO) VALUES ('$nombre', '$direccion', '$telefono', '$email',$usuario)");
                    header("Location:../php/vista_concesionarios_admin.php");
                    $_SESSION['nombre1'] = '';
                    $_SESSION['direccion1'] = '';
                    $_SESSION['email1'] = '';
                    $_SESSION['telefono1'] = '';
                    $_SESSION['usuario1'] = '';
                    exit;
                }
            }
        ?>
    </body>
</html>