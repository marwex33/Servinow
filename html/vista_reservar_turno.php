<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'USUARIO' ) {
    // Redirige al usuario a la página de login si no está autenticado
    include("../php/cerrar_sesion.php");
    header("Location: ../index.html");
    exit();
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>ServiNow - Reservar Turno</title>
</head>
<body id="vista-portada-dos">
    <header>
        <nav class="navegador">
            <a href="../html/vista_usuario.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow" height="80"></a>
            <ul class="lista">
                <li><a href="#">Reservar Turno</a></li>
                <li><a href="../html/vista_turnos_asignados.php">Turnos Asignados</a></li>
                <li><a href="../html/vista_mis_vehiculos.php">Mis Vehículos</a></li>
                <li><a href="../html/contacto.php">Contactanos</a></li>
                <li><a href="../php/cerrar_sesion.php">Cerrar sesion</a></li>
                <li><a href="../html/vista_perfil.php"><i class="fa-regular fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>Reservar Turno</h1>
        <p>Selecciona un concesionario para reservar tu turno</p>
        
        <section class="concesionarios">

            <?php 

                include("..\php\conexion.php");

                $consulta = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE BORRADO = 0");

                $resultado = mysqli_num_rows($consulta);

                if ($resultado != 0)
                {

                    $respuesta = mysqli_fetch_all($consulta);
                    foreach ($respuesta as $concesionario)
                    {
            ?>

            <div class="tarjeta-concesionario">
                
                <?php
                    echo "<h3>$concesionario[1]</h3>";
                    echo "<p><strong>Direccion:</strong> $concesionario[2]</p>";
                    echo "<p><strong>Numero de telefono:</strong> $concesionario[3]</p>";
                    echo "<p><strong>Correo electronico:</strong> $concesionario[4]</p>";
                    ?>
                <a href="form_reserva_de_turnos.php?concesionario=<?php echo $concesionario[1] ?>" class="boton-reservar">Reservar Turno</a>
            </div>
                <?php
                    }
                }
                ?>
        </section>
    </article>
    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>


