<!DOCTYPE html>
<?php
    @session_start();
    $correo = $_POST['correo'];
    $titulo = $_POST['titulo'];
    $mensaje = $_POST['mensaje'];

    include("conexion.php");

    $destino = "soporte@servinow.com";
    $asunto = "Contacto desde el sitio" ;
    $mensaje = "Mail usuario: " . $correo . "Titulo: " . $titulo . "Mensaje: " . $mensaje; 
    $header = "Email: " . $correo;

    $enviado = @mail($destino, $asunto, $mensaje, $header);

    if ($enviado == true) {
        echo "Su mensaje ha sido enviado.";
    }
    else { echo "Su mensaje no pudo ser enviado";}

    $consulta = mysqli_query($conexion, "INSERT INTO MENSAJE (TITULO, MENSAJE, CORREO_ELECTRONICO) VALUES ('$titulo', '$mensaje', '$correo')");
    echo
        "<script>
        alert('El mensaje ha sido enviado correctamente');
        </script>";
    if(isset ($_SESSION['tipo_usuario']) ? 'USUARIO' :'' ){
        include ("../html/vista_usuario.php");
    }
    else{
        
        header("Location:../index.html");
    }
    ?>
    
