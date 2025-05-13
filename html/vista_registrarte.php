<?php @session_start();?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - ServiNow</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <header>
        <nav class="navegador">
             <?php if(isset ($_SESSION['tipo_usuario']) ? 'ADMIN' :'' ){
            echo"<a href='../html/vista_admin.php'><img id='inicio' src='../img/icono.webp' alt='ServiNow'  height='80'></a>";
            echo"<ul class='lista'>";
            echo"   <li><a href='../php/vista_clientes_admin.php'>Usuarios</a></li>";
            echo"   <li><a href='../php/vista_concesionarios_admin.php'>Concesionarios</a></li>";
            echo"   <li><a href='../php/cerrar_sesion.php'>Cerrar sesion</a></li>";
            echo"</ul> ";
            
        }
        else{
            echo'<div>
                <a href="../index.html"><img id="inicio" src="../img/icono.webp" alt="ServiNow" height="80"></a>
            </div>
            <ul class="lista">
                <li><a href="../html/vista_registrarte.php">Registrarse</a></li>
                <li><a href="../html/vista_iniciar_sesion.php">Iniciar sesión</a></li>
                <li><a href="../html/contacto.php">Contactanos</a></li>
            </ul>';
        }
        ?>
        </nav>
    </header>
    
    <main class="contenedor-formulario">
        <h1>Registrarse</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']); 
        }    
        ?>
        <form action="../php/registro.php" method="post" class="formulario-login">
            <div class="campo-formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>"required>
            </div>
            <div class="campo-formulario">
                <label for="nombre">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo isset($_SESSION['apellido']) ? $_SESSION['apellido'] : ''; ?>"required>
            </div>
            <div class="campo-formulario">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"required>
            </div>
            <div class="campo-formulario">
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>" required>
            </div>
            <div class="campo-formulario">
                <label for="nombre">Telefono:</label>
                <input type="number" id="telefono" name="telefono" value="<?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; ?>"required>
            </div>
            <div class="campo-formulario">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="campo-formulario">
                <label for="confirmar-password">Confirmar contraseña:</label>
                <input type="password" id="confirmar-password" name="confirmar-password" required>
            </div>
            <?php if( isset ($_SESSION['tipo_usuario']) ? 'ADMIN' :'' ){
            echo
            '<div class="campo-formulario">
                <label for="tipo_usuario">Tipo de usuario:</label>
                <select id="opciones" name="tipo_usuario" required>
                        <option value="cliente" selected> CLIENTE </option>
                        <option value="concesionario" > CONCESIONARIO </option>
                        <option value="admin" > ADMINISTRADOR </option>
                </select>
            </div>';
            }
            ?>
            <button type="submit" class="boton-submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="../html/vista_iniciar_sesion.php">Inicia sesión aquí</a></p>
    </main>

    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    
</body>
</html>
