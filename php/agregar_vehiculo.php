<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <?php

            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $anio = $_POST['anio'];
            $patente = $_POST['patente'];
            $id_usuario = $_SESSION['id'];

            include("conexion.php");

            $consulta = mysqli_query($conexion, "SELECT * FROM VEHICULO WHERE PATENTE = '$patente'");
            $resultado = mysqli_num_rows($consulta);

            if ($resultado != 0)
            {
                echo "El vehiculo ya se encuentra registrado en el sistema";

                include("C:\\xampp\htdocs\Proyecto Final\html\\vista_mis_vehiculos.php");
            }
            else
            {
                $consulta = mysqli_query($conexion, "INSERT INTO VEHICULO VALUES ('$patente', '$marca', '$modelo', '$anio', '$id_usuario')");
                include("C:\\xampp\htdocs\Proyecto Final\html\\vista_mis_vehiculos.php");
            }

        ?>
    </body>
</html>