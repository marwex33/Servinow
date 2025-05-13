<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'USUARIO' ) {
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
    <title>ServiNow - Mis Vehículos</title>
</head>
<body id="vista-portada-dos">
    <header>
        <nav class="navegador">
            <a href="vista_usuario.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow" height="80"></a>
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
        <h1>Mis Vehículos</h1>
        <p>Aquí puedes ver y gestionar tus vehículos registrados</p>
        
        <section class="vehiculos">

            <?php
                include("..\php\conexion.php");
                $id_usuario = $_SESSION['id_sesion'];
                $consulta = mysqli_query($conexion, "SELECT PATENTE, MARCA, MODELO, ANIO FROM VEHICULO WHERE CODIGO_PROPIETARIO = '$id_usuario' AND BORRADO = 0");

                $resultado = mysqli_num_rows($consulta);
                
                if ($resultado != 0)
                {
                    $respuesta = mysqli_fetch_all($consulta);
                    foreach($respuesta as $vehiculo)
                    {
            ?>
            <div class="tarjeta-vehiculo">
                        
                
                    <?php 
                        echo"<h3>$vehiculo[1] $vehiculo[2]</h3>";
                        echo"<p><strong>Año:</strong> $vehiculo[3]</p>";
                        echo"<p><strong>Patente:</strong> $vehiculo[0]</p>";
                    ?>
                <a href="../html/vista_vehiculo_admin.php?patente=<?php echo $vehiculo[0] ?>" class="boton-editar">Editar</a>
                </div>
                    <?php
                    }
                }
                    ?>
                          
            <div class="tarjeta-vehiculo nuevo-vehiculo">
                <i class="fa-solid fa-plus"></i>
                <h3>Agregar Nuevo Vehículo</h3>
                <a href="#" class="boton-editar">Agregar</a>
            </div>

            <div id="modalAgregarVehiculo" class="modal">
                <div class="contenido-modal">
                    <span class="cerrar-modal">&times;</span>
                    <h2>Agregar Nuevo Vehículo</h2>
                    <form id="formularioAgregarVehiculo" class="formulario-login" action="../php/cargar_vehiculo.php" method="post">
                        <div class="campo-formulario">
                            <label for="marca">Marca:</label>
                            <input type="text" id="marca" name="marca" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="modelo">Modelo:</label>
                            <input type="text" id="modelo" name="modelo" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="anio">Año:</label>
                            <input type="number" id="anio" name="anio" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="patente">Patente:</label>
                            <input type="text" id="patente" name="patente" required>
                        </div>
                        <button type="submit" class="boton-submit">Agregar Vehículo</button>
                    </form>
                </div>
            </div>
        </section>
    </article>

    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('modalAgregarVehiculo');
            var botonAgregar = document.querySelector('.nuevo-vehiculo .boton-editar');
            var cerrarModal = document.querySelector('.cerrar-modal');

            botonAgregar.onclick = function() {
                modal.style.display = "block";
            }

            cerrarModal.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
</body>
</html>