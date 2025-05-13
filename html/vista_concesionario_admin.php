<?php @session_start();
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
                <a href="../html/vista_admin.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow" height="80"></a>
            </div>
            <ul class="lista">
               <li><a href="../php/vista_clientes_admin.php">Usuarios</a></li>
               <li><a href="../php/vista_concesionarios_admin.php">Concesionarios</a></li>
               <li><a href="../php/cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </header>
    <article class="pag_principal">
        <h1>Concesionario</h1>
        <p>Aquí puedes modificar la informacion del concesionario</p>
        <?php 
        include("..\php\conexion.php");
        $codigo = $_POST['codigo'];

        $consulta = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE CODIGO_CONCESIONARIO = '$codigo'");
        $resultado = mysqli_fetch_assoc($consulta);

        ?>
        <section class="perfil-usuario">
            <form class="formulario-perfil" id="formulario-perfil" action="../php/modificar_concesionario.php" method="post">
                <input type='hidden' name='codigo' value="<?php echo $codigo?>">
                <div class="campo-formulario">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $resultado['NOMBRE']?>" required>
                </div>
                
                <div class="campo-formulario">
                    <label for="direccion">Direccion:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo $resultado['DIRECCION']?>" required>
                </div>
                
                <div class="campo-formulario">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="<?php echo $resultado['CORREO_ELECTRONICO']?>" required>
                </div>
                
                <div class="campo-formulario">
                    <label for="direccion">Telefono:</label>
                    <input type="number" id="telefono" name="telefono" value="<?php echo $resultado['TELEFONO']?>" required>
                </div>
                <div class="campo-formulario">
                    <label for="opciones">Selecciona un usuario para administrar el concesionario:</label>
                    <select id="opciones" name="codigo_usuario" required>
                        <?php 
                        if($resultado['CODIGO_USUARIO']!=NULL){
                            $consulta1 = mysqli_query($conexion, "SELECT * FROM CLIENTE WHERE CODIGO_CLIENTE =". $resultado['CODIGO_USUARIO']);
                            $fila = mysqli_fetch_array($consulta1);
                            echo "<option value='".$fila['CODIGO_CLIENTE']."' selected>".$fila['USUARIO']." </option>";
                        }
                        echo "<option value= NULL >Sin asignar</option>";
                        $consulta = mysqli_query($conexion, "SELECT * FROM CLIENTE WHERE TIPO_CLIENTE = 'CONCESIONARIO' AND BORRADO = 0");
                        while($fila = mysqli_fetch_array($consulta)) {
                            $consulta1 = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE CODIGO_USUARIO =". $fila['CODIGO_CLIENTE'] );
                            if(!($resultado = mysqli_num_rows($consulta1)) ){
                                    echo "<option value='".$fila['CODIGO_CLIENTE']."'>".$fila['USUARIO']." </option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="accion" value="modificar" class="boton-guardar" onclick="activarRequeridos(true)">Guardar Cambios</button>
                <button type="submit" name="accion" value="borrar" class="boton-guardar" onclick="activarRequeridos(false)">Borrar Concesionario</button>
            </form>
        </section>
    </article>
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
    <script>
        function activarRequeridos(requiereDatos) {
            // Selecciona todos los campos de entrada dentro del formulario
            const formulario = document.getElementById("formulario-perfil");
            const inputs = formulario.querySelectorAll("input[type='text'], input[type='email'], input[type='number']");
            
            // Cambia el atributo required según el parámetro
            inputs.forEach(input => {
                if (requiereDatos) {
                    input.setAttribute("required", "required");
                } else {
                    input.removeAttribute("required");
                }
            });
        }
    </script>
</body>
</html>