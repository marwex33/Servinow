<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'ADMIN' ) {
    // Redirige al usuario a la página de login si no está autenticado
    include("../php/cerrar_sesion.php");
    header("Location: ../index.html");
    exit();
}
?>
<!DOCTYPE html>
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
            <div>
                <a href="../html/vista_admin.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow"  height="80"></a>
            </div>
            <ul class="lista">
               <li><a href="../php/vista_clientes_admin.php">Usuarios</a></li>
               <li><a href="../php/vista_concesionarios_admin.php">Concesionarios</a></li>
               <li><a href="../php/cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>        
        </nav>
    </header>
    <main class="contenedor-formulario">
        <h1>Nuevo vehiculo</h1>
        <form action="../php/cargar_vehiculo.php" method="post" class="formulario-login">
                <input type='hidden' name='codigo' value="<?php echo $_POST['codigo']?>">
                <input type='hidden' name='tipo_usuario' value="ADMIN">
                <div class="campo-formulario">
                    <label for="marca">Marca:</label>
                    <input type="text" id="marca" name="marca" value="" required>
                </div>
                <div class="campo-formulario">
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" value="" required>
                </div>
                 <div class="campo-formulario">
                    <label for="patente">Patente:</label>
                    <input type="text" id="patente" name="patente" value="" required>
                </div>
                <div class="campo-formulario">
                    <label for="anio">Año:</label>
                    <input type="text" id="anio" name="anio" value="" required>
                </div>
                <button type="submit" class="boton-guardar">Agregar</button>

        </form>
    </main>
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>