<?php @session_start();
include("..\php\conexion.php");
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'ADMIN' ) {
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
        <h1>Nuevo concesionario</h1>
        <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']); 
            }
        ?>
        <form action="../php/cargar_concesionario.php" method="post" class="formulario-login">
            <div class="campo-formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($_SESSION['nombre1']) ? $_SESSION['nombre1'] : ''; ?>" required>
            </div>
            <div class="campo-formulario">
                <label for="direccion">Direccion:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo isset($_SESSION['direccion1']) ? $_SESSION['direccion1'] : ''; ?>"required>
            </div>
            <div class="campo-formulario">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email1']) ? $_SESSION['email1'] : ''; ?>"required>
            </div>
            <div class="campo-formulario">
                <label for="nombre">Telefono:</label>
                <input type="number" id="telefono" name="telefono" value="<?php echo isset($_SESSION['telefono1']) ? $_SESSION['telefono1'] : ''; ?>"required>
            </div>
            <div class="campo-formulario">
                <label for="codigo_usuario">Usuario asignado:</label>
                <select id="codigo_usuario" name="codigo_usuario" value="<?php echo isset($_SESSION['codigo_usuario1']) ? $_SESSION['codigo_usuario1'] : ''; ?>"required>
                <?php 
                        $consulta = mysqli_query($conexion, "SELECT * FROM CLIENTE WHERE TIPO_CLIENTE = 'CONCESIONARIO' AND BORRADO = 0");
                        echo "<option value= NULL >Sin asignar</option>";
                        $fila = mysqli_fetch_array($consulta);
                        $consulta1 = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO ");
                        $resultado = mysqli_fetch_array($consulta1);
                        while($fila = mysqli_fetch_array($consulta)) {
                            $consulta1 = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE CODIGO_USUARIO =". $fila['CODIGO_CLIENTE'] );
                            if(!($resultado = mysqli_num_rows($consulta1)) ){
                                    echo "<option value='".$fila['CODIGO_CLIENTE']."'>".$fila['USUARIO']." </option>";
                            }
                        }
                        ?>     }
                ?>
                </select>
            </div>
            <button type="submit" class="boton-submit">Crear</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
</body>
</html>