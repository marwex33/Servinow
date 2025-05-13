<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Proyecto%20Final/estilos.css">
    <title>ServiNow - Turnos Asignados</title>
</head>
<body>
    <header>
        <nav class="navegador">
            <a href="http://localhost/Proyecto%20Final/html/vista_admin.php"><img id="inicio" src="http://localhost/Proyecto%20Final/img/icono.webp" alt="ServiNow" height="80"></a>
            <ul class="lista">
               <li><a href="http://localhost/Proyecto%20Final/php/vista_clientes.php">Clientes</a></li>
               <li><a href="http://localhost/Proyecto%20Final/php/vista_concesionarios.php">Concesionarios</a></li>
               <li><a href="http://localhost/Proyecto%20Final/php/vista_turnos.php">Turnos</a></li>
               <li><a href="http://localhost/Proyecto%20Final/php/salir.php">Cerrar sesion</a></li>
               <li><a href="http://localhost/Proyecto%20Final/html/vista_perfil.php"><i class="fa-regular fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>Clientes</h1>
        <section class="concesionarios">   
            <?php
            $i = 0;
            include("conexion.php");
            $consulta = mysqli_query($conexion, "SELECT * FROM CLIENTE ");
            $resultado = mysqli_num_rows($consulta);
            if ($resultado != 0) {
                while($fila = mysqli_fetch_array($consulta)) {
                    echo "<div class='tarjeta-concesionario'>";
                    echo "<h3>" . $fila['USUARIO'] . "</h3>";
                    echo "<p><strong>Nombres:</strong> " . $fila['NOMBRES'] . "</p>";
                    echo "<p><strong>Apellidos:</strong> " . $fila['APELLIDOS'] . "</p>";
                    echo "<p><strong>Correo Electronico:</strong> " . $fila['CORREO_ELECTRONICO'] . "</p>";
                    echo "<p><strong>Telefono:</strong> " . $fila['TELEFONO'] . "</p>";
                    //modificar el link a la vista de vehiculos y turnos segun este el archivo.
                    echo "<form action='http://localhost/Proyecto%20Final/php/vista_vehiculos.php' method='POST'>";
                    echo "<input type='hidden' name='codigo' value='" . $fila['CODIGO_CLIENTE'] . "'>";
                    echo "<input type='hidden' name='usuario' value='" . $fila['USUARIO'] . "'>";
                    echo "<button type='submit' class='boton-reservar'>Ver vehiculos</button>";
                    echo "</form>";

                    echo "<form action='http://localhost/Proyecto%20Final/html/vista_turnos.php' method='POST'>";
                    echo "<input type='hidden' name='codigo' value='" . $fila['CODIGO_CLIENTE'] . "'>";
                    echo "<button type='submit' class='boton-reservar'>Ver turnos</button>";
                    echo "</form>";

                    echo "<form action='http://localhost/Proyecto%20Final/html/vista_cliente.php' method='POST'>";
                    echo "<input type='hidden' name='codigo' value='" . $fila['CODIGO_CLIENTE'] . "'>";
                    echo "<button type='submit' class='boton-reservar'>Modificar cliente</button>";
                    echo "</form>";
                    echo "</div>";
                } 
            }
            else {
                echo "0 resultados";
            }
        ?>
         <div class="tarjeta-vehiculo nuevo-vehiculo">
                <i class="fa-solid fa-plus"></i>
                <h3>Agregar Nuevo Cliente</h3>
                <a href="http://localhost/Proyecto%20Final/html/vista_cargar_cliente.php" class="boton-agregar">Agregar</a>
        </div>
        <section>
    </article>
    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>
