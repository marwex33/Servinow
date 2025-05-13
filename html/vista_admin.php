<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'ADMIN' ) {
    // Redirige al usuario a la p�gina de login si no est� autenticado
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
    <title>ServiNow - Panel de Usuario</title>
</head>
<body>
    <header>
        <nav class="navegador">
            <a href="../html/vista_admin.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow"  height="80"></a>
           <ul class="lista">
               <li><a href="../php/vista_clientes_admin.php">Usuarios</a></li>
               <li><a href="../php/vista_concesionarios_admin.php">Concesionarios</a></li>
               <li><a href="../php/cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>Bienvenido a tu Panel de Administrador</h1>
        
        <section id="reservar-turno" class="servicios">
            <a href="../php/vista_clientes_admin.php"> <h2>Usuarios</h2> </a>
            <p>Visualiza y gestiona el perfil de un usuario.</p>
        </section>
        
        <section id="turnos-asignados" class="servicios">
            <a href="../php/vista_concesionarios_admin.php"> <h2>Concesionarios</h2> </a>
            <p>Visualiza y gestiona los concesionarios.</p>
        </section>
    </article>
    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>
