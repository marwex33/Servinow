<?php @session_start();?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - ServiNow</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <header>
        <nav class="navegador">
            <div>
                <a href="../index.html"><img id="inicio" src="../img/icono.webp" alt="ServiNow" height="80"></a>
            </div>
            <ul class="lista">
                <li><a href="../html/vista_registrarte.php">Registrarse</a></li>
                <li><a href="../html/vista_iniciar_sesion.php">Iniciar sesión</a></li>
                <li><a href="../html/contacto.php">Contactanos</a></li>
            </ul>
        </nav>
    </header>
    
    <main class="contenedor-formulario">
        <h1>Iniciar Sesión</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']); 
        }    
        ?>
        <form action="../php/login.php" method="post" class="formulario-login">
            <div class="campo-formulario">
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>"required>
            </div>
            <div class="campo-formulario">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="boton-submit">Iniciar Sesión</button>
        </form>
        <p>¿No tienes una cuenta? <a href="../html/vista_registrarte.php?var1=2">Regístrate aquí</a></p>
    </main>

    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
</body>
</html>