<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'CONCESIONARIO' ) {
    // Redirige al usuario a la página de login si no está autenticado
    include("../php/cerrar_sesion.php");
    header("Location: ../index.html");
    exit();
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="">
    <title>ServiNow</title>
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
        <h1>Concesionario</h1>
        <p>Aquí puedes modificar la informacion del concesionario</p>
        <?php 
        include("..\php\conexion.php");
        $codigo = $_SESSION['id_sesion'];
        $consulta = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE CODIGO_USUARIO = '$codigo'");
        if(!($fila=mysqli_num_rows($consulta))){
            echo "<p>Sin concesionario asignado.</p>";
        }
        else{

        $resultado = mysqli_fetch_assoc($consulta);
        $codigo1 = $resultado['CODIGO_CONCESIONARIO'];
        echo'
        <section class="perfil-usuario">
            <form class="formulario-perfil" action="../php/modificar_concesionario.php" method="post">
                <input type="hidden" name="codigo" value= '.$codigo1.' >
                <div class="campo-formulario">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="'. $resultado['NOMBRE'].'" required>
                </div>
                
                <div class="campo-formulario">
                    <label for="direccion">Direccion:</label>
                    <input type="text" id="direccion" name="direccion" value="'. $resultado['DIRECCION'].'" required>
                </div>
                
                <div class="campo-formulario">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="'. $resultado['CORREO_ELECTRONICO'].'" required>
                </div>
                
                <div class="campo-formulario">
                    <label for="direccion">Telefono:</label>
                    <input type="number" id="telefono" name="telefono" value="'. $resultado['TELEFONO'].'" required>
                </div>
                <button type="submit" name="accion" value="modificar" class="boton-guardar">Guardar Cambios</button>            
            </form>
        </section>';
        }
        ?>
    </article>
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>