<?php @session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'CONCESIONARIO' ) {
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
    <title>ServiNow - Panel de Concesionario</title>
</head>

<body>
    <header>
        <nav class="navegador">
            <a href="../html/vista_concesionario.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow"  height="80"></a>
           <ul class="lista">
               <li><a href="../html/vista_datos_concesionario.php">Mi concesionario</a></li>
               <li><a href="../php/vista_turnos_concesionario.php">Turnos</a></li>
               <li><a href="../php/cerrar_sesion.php">Cerrar sesion</a></li>
               <li><a href="../html/vista_perfil.php"><i class="fa-regular fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>Bienvenido <?php echo $_SESSION['usuario_sesion']?> a tu panel de concesionario</h1>
        
        <section id="reservar-turno" class="servicios">
            <a href="../html/vista_datos_concesionario.php"> <h2>Mi concesionario</h2> </a>
            <p>Visualiza y gestiona los datos de tu concesionario.</p>
        </section>
        
        <section id="turnos-asignados" class="servicios">
            <a href="../php/vista_turnos_concesionario.php"> <h2>Turnos</h2> </a>
            <p>Visualiza y gestiona los turnos de tu concesionario.</p>
        </section>
        
    </article>

    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
    
</html>
