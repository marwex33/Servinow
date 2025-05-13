<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'ADMIN' ) {
    // Redirige al usuario a la página de login si no está autenticado
    include("../php/cerrar_sesion.php");
    header("Location: ../index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>ServiNow - Mis Vehículos</title>
</head>
<body>
    <header>
        <nav class="navegador">
            <a href="../html/vista_admin.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow"  height="80"></a>
            <ul class="lista">
               <li><a href="vista_clientes_admin.php">Usuarios</a></li>
               <li><a href="vista_concesionarios_admin.php">Concesionarios</a></li>
               <li><a href="cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>Vehículos de 
            <?php  
            echo $_POST['usuario'] ?>
        </h1>
        <p>Aquí puedes ver y gestionar los vehículos registrados</p>
        
        <section class="vehiculos">
            <?php
                $i = 0;
                $codigo = $_POST['codigo'];
                include("conexion.php");
                $consulta = mysqli_query($conexion, "SELECT * FROM VEHICULO WHERE CODIGO_PROPIETARIO = '$codigo' AND BORRADO = 0 ");
                $resultado = mysqli_num_rows($consulta);
                if ($resultado != 0) {
                    while($fila = mysqli_fetch_array($consulta)) {
                        echo "<div class='tarjeta-concesionario'>";
                        echo "<h3>" . $fila['MARCA'] . ' ' . $fila['MODELO'] . "</h3>";
                        echo "<p><strong>Año:</strong> " . $fila['ANIO'] . "</p>";
                        echo "<p><strong>Patente:</strong> " . $fila['PATENTE'] . "</p>";
                        
                        echo "<form action='../html/vista_vehiculo_admin.php' method='POST'>";
                        echo "<div class='campo-formulario'> ";
                        echo "<input type='hidden' name='patente' value='" . $fila['PATENTE'] . "'>";
                        echo "<button type='submit' class='boton-reservar'>Modificar vehiculo</button>";
                        echo "</div>";
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
                <h3>Agregar Nuevo Vehiculo</h3>
                <form action='../html/vista_cargar_vehiculo_admin.php' method='POST'>
                        <input type='hidden' name='codigo' value="<?php echo $codigo?>">
                        <button type='submit' class='boton-agregar'>Agregar</button>
                </form>
        </div>
        </section>
    </article>
    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>