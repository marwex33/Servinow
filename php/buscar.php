<!doctype html>
<html>
    <head>
    </head>

    <body>
        <?php
        include("conexion.php");
            $buscar = isset($_GET['buscar']) ? $conexion->real_escape_string($_GET['buscar']) : '';

// Crear la consulta SQL con el filtro
$sql = "SELECT * FROM cliente WHERE 
        (nombres LIKE '$buscar%' OR 
        apellidos LIKE '$buscar%' OR
        usuario LIKE '$buscar%' OR
        correo_electronico LIKE '$buscar%' OR 
        telefono LIKE '$buscar%')
        AND (BORRADO = 0)";

$resultado = $conexion->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
                    echo "<div class='tarjeta-concesionario'>";
                    $tipo_usuario = $fila['TIPO_CLIENTE'];
                    if($tipo_usuario == 'USUARIO'){
                        echo "<h2>CLIENTE</h2>";
                    }
                    else{
                        echo "<h2>" . $fila['TIPO_CLIENTE'] . "</h2>";
                    }
                    echo "<h3>" . $fila['USUARIO'] . "</h3>";
                    echo "<p><strong>Nombres:</strong> " . $fila['NOMBRES'] . "</p>";
                    echo "<p><strong>Apellidos:</strong> " . $fila['APELLIDOS'] . "</p>";
                    echo "<p><strong>Correo Electronico:</strong> " . $fila['CORREO_ELECTRONICO'] . "</p>";
                    echo "<p><strong>Telefono:</strong> " . $fila['TELEFONO'] . "</p>";
                    
                    if( $fila['TIPO_CLIENTE']  == 'USUARIO'){

                    echo "<form action='../php/vista_vehiculos_admin.php' method='POST'>";
                    echo "<div class='campo-formulario'> ";
                    echo "<input type='hidden' name='codigo' value='" . $fila['CODIGO_CLIENTE'] . "'>";
                    echo "<input type='hidden' name='usuario' value='" . $fila['USUARIO'] . "'>";
                    echo "<button type='submit' class='boton-reservar'>Ver vehiculos</button>";
                    echo "</div> </form> ";

                    }

                    else if($fila['TIPO_CLIENTE'] == 'CONCESIONARIO'){

                    echo "<form action='../html/vista_concesionario_admin.php' method='POST'>";
                    echo "<div class='campo-formulario'> ";
                    $resultado2 = mysqli_query($conexion, "SELECT CODIGO_CONCESIONARIO,NOMBRE FROM CONCESIONARIO WHERE CODIGO_USUARIO =" . $fila['CODIGO_CLIENTE']);
                    $fila1 = mysqli_fetch_assoc($resultado2);
                    if ($resultado2 && mysqli_num_rows($resultado2) > 0) {
                        echo "<p><strong>Concesionario:</strong> ".$fila1['NOMBRE']." </p>";
                    }
                    else{
                        echo "<p><strong>Concesionario:</strong> sin asignar</p>";
                    }
                    
                    echo "</div> </form> ";


                    }
                    echo " <form action='../html/vista_cliente.php' method='POST'>";
                    echo "<div class='campo-formulario'> ";
                    echo "<input type='hidden' name='codigo' value='" . $fila['CODIGO_CLIENTE'] . "'>";
                    echo "<button type='submit' class='boton-reservar'>Modificar usuario</button>";
                    echo "</div> </form> ";
                    echo "</div>";



                } 
                echo"<div class='tarjeta-vehiculo nuevo-vehiculo'>";
                echo"<i class='fa-solid fa-plus'></i>";
                echo"<h3>Agregar Nuevo Cliente</h3>";
                echo"<a href='../html/vista_registrarte.php' class='boton-agregar'>Agregar</a>";
                echo"</div>";

}

else {
    echo "<p>No se encontraron resultados para '$buscar'.</p>";
}
        ?>
    </body>
</html>