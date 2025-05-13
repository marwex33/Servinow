<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'USUARIO' ) {
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
    <title>ServiNow - Panel de Usuario</title>
</head>
<body id="vista-portada-dos">
    <header>
        <nav class="navegador">
            <a href="vista_usuario.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow"  height="80"></a>

            <ul class="lista">
                <li><a href="../html/vista_reservar_turno.php">Reservar Turno</a></li>
                <li><a href="../html/vista_turnos_asignados.php">Turnos Asignados</a></li>
                <li><a href="../html/vista_mis_vehiculos.php">Mis Vehículos</a></li>
                <li><a href="../html/contacto.php">Contactanos</a></li>
                <li><a href="../php/cerrar_sesion.php">Cerrar sesion</a></li>
                <li><a href="../html/vista_perfil.php"><i class="fa-regular fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>Bienvenido a tu Panel de Usuario</h1>
        
        <section id="reservar-turno" class="trabajos">
            <div>
                <a href="vista_reservar_turno.php" class="img-referenciada"><img src="../img/reserva.png" alt="reserva"></a>
            </div>
            <div>
                <h2>Reservar Turno</h2>
                <p>Aquí puedes reservar un nuevo turno para tu vehículo.</p>
            </div>
                
        </section>
        
        <section id="turnos-asignados" class="trabajos">
            <div>
                <a href="vista_turnos_asignados.php" class="img-referenciada"><img src="../img/cita.png" alt="turno asignado"></a>
            </div>    
            <div>
                <h2>Turnos Asignados</h2>
                <p>Visualiza y gestiona tus turnos asignados.</p>
            </div>
              
        </section>
        
        <section id="mis-vehiculos" class="trabajos">
            <div>
                <a href="vista_mis_vehiculos.php" class="img-referenciada"><img src="../img/flota.png" alt="mis vehiculos"></a>
            </div>
            <div>
                <h2>Mis Vehículos</h2>
                <p>Administra la información de tus vehículos registrados.</p>
            </div>    
              
        </section>

        <section class="trabajos">
            <div>
                <a href="contacto.php" class="img-referenciada"><img src="../img/email.png" alt="email.png"></a>
            </div>
            <div>
                <h2>Contactanos</h2>
                <p>¿Tienes alguna pregunta o sugerencia? ¡Estamos aquí para ayudarte!</p>
            </div>    
        </section>
    </article>
    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>
