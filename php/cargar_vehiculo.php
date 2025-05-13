<?php @session_start();?>
<!doctype html>
<html>
    <head>
    </head>
    <title>Cargar concesionario</title>

    <body>
        <?php
            if($_SESSION['tipo_usuario'] == 'ADMIN'){
                $id_usuario = $_POST['codigo'];
            }
            else{
                $id_usuario = $_SESSION['id_sesion'];
            }
            $patente = $_POST['patente'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $anio = $_POST['anio'];
           
            include("conexion.php");
            $consulta = mysqli_query($conexion, "SELECT * FROM VEHICULO WHERE PATENTE = '$patente'");
            $resultado = mysqli_num_rows($consulta);
            if ($resultado != 0)
            {
                echo "<script>alert('El vehículo ya se encuentra registrado en el sistema');</script>";
            }
            else
            {
                $consulta = mysqli_query($conexion, "INSERT INTO VEHICULO VALUES ('$patente', '$marca', '$modelo', '$anio', '$id_usuario', 0)");
                echo "<script>alert('Vehículo registrado exitosamente');</script>";

            }

            if($_SESSION['tipo_usuario'] == 'ADMIN'){
                header("Location:../php/vista_clientes_admin.php");
            }
            else{
                include("..\html\\vista_mis_vehiculos.php");
            }
        ?>
    </body>
</html>