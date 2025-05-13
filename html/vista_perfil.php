<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Redirige al usuario a la página de login si no está autenticado
    include("../php/cerrar_sesion.php");
    header("Location: ../index.html");
    exit();
}
include("../php/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>ServiNow - Perfil de Usuario</title>
</head>
<body id="vista-portada-tres">
    <header>
        <nav class="navegador">
        <?php if($_SESSION['tipo_usuario'] == 'USUARIO' ){
            
            echo"<a href='../html/vista_usuario.php'><img id='inicio' src='../img/icono.webp' alt='ServiNow'  height='80'></a>";
            echo"<ul class='lista'>";
            echo"   <li><a href='../html/vista_reservar_turno.php'>Reservar Turno</a></li>";
            echo"   <li><a href='../html/vista_turnos_asignados.php'>Turnos Asignados</a></li>";
            echo"   <li><a href='../html/vista_mis_vehiculos.php'>Mis Vehículos</a></li>";
            echo'<li><a href="../html/contacto.php">Contactanos</a></li>';
            echo"   <li><a href='../php/cerrar_sesion.php'>Cerrar sesion</a></li>";
            echo"   <li><a href='../html/vista_perfil.php'><i class='fa-regular fa-user'></i></a></li>";
            echo"</ul> ";
        }
        else if($_SESSION['tipo_usuario'] == 'CONCESIONARIO' ){
            echo"<a href='../html/vista_concesionario.php'><img id='inicio' src='../img/icono.webp' alt='ServiNow'  height='80'></a>";
            echo"<ul class='lista'>";
            echo"   <li><a href='../html/vista_datos_concesionario.php'>Mi concesionario</a></li>";
            echo"   <li><a href='../php/vista_turnos_concesionario.php'>Turnos</a></li>";
            echo"   <li><a href='../php/cerrar_sesion.php'>Cerrar sesion</a></li>";
            echo"   <li><a href='../html/vista_perfil.php'><i class='fa-regular fa-user'></i></a></li>";
            echo"</ul> ";
        }
        else{
            echo"<a href='../html/vista_admin.php'><img id='inicio' src='../img/icono.webp' alt='ServiNow'  height='80'></a>";
            echo"<ul class='lista'>";
            echo"   <li><a href='../php/vista_clientes_admin.php'>Usuarios</a></li>";
            echo"   <li><a href='../php/vista_concesionarios_admin.php'>Concesionarios</a></li>";
            echo"   <li><a href='../php/cerrar_sesion.php'>Cerrar sesion</a></li>";
            echo"</ul> ";
        }
        ?>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>Perfil de Usuario</h1>
        <p>Aquí puedes personalizar tu información de perfil</p>
        <?php 
        include("..\php\conexion.php");
        $usuario = $_SESSION['usuario_sesion'];
        $contraseña = $_SESSION['contraseña_sesion'];
        $consulta = mysqli_query($conexion, "SELECT NOMBRES, APELLIDOS, CORREO_ELECTRONICO, TELEFONO FROM CLIENTE WHERE USUARIO = '$usuario' AND CONTRASEÑA ='$contraseña'");
        $resultado = mysqli_fetch_array($consulta);
        ?>
        
        <section class="perfil-usuario">
            <form class="formulario-perfil" action="../php/modificar_perfil.php" method="post">
                <div class="campo-formulario">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $resultado['NOMBRES']?>">
                </div>
                
                <div class="campo-formulario">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" value="<?php echo $resultado['APELLIDOS']?>">
                </div>
                
                <div class="campo-formulario">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="<?php echo $resultado['CORREO_ELECTRONICO']?>">
                </div>
                
                <div class="campo-formulario">
                    <label for="direccion">Telefono:</label>
                    <input type="number" id="telefono" name="telefono" value="<?php echo $resultado['TELEFONO']?>">
                </div>
                
                <button type="submit" class="boton-guardar">Guardar Cambios</button>
                
            </form>
        </section>
    </article>
    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>