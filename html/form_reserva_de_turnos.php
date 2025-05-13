<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true ) {
    // Redirige al usuario a la página de login si no está autenticado
    include("../php/cerrar_sesion.php");
    header("Location: ../index.html");
    exit();
}
  include("../php/conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>ServiNow - Formulario de Reserva de Turnos</title>
</head>
<body>
<header>
        <nav class="navegador">
        <?php if($_SESSION['tipo_usuario'] == 'USUARIO' ){
            
            echo"<a href='../html/vista_usuario.php'><img id='inicio' src='../img/icono.webp' alt='ServiNow'  height='80'></a>";
            echo"<ul class='lista'>";
            echo"   <li><a href='../html/vista_reservar_turno.php'>Reservar Turno</a></li>";
            echo"   <li><a href='../html/vista_turnos_asignados.php'>Turnos Asignados</a></li>";
            echo"   <li><a href='../html/vista_mis_vehiculos.php'>Mis Vehículos</a></li>";
            echo' <li><a href="../html/contacto.php">Contactanos</a></li>';
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
    <div class="reserva-container">
        <div class="reserva-card">
            <div class="card-header">
                <h3>Reserva de Turno para Mantenimiento</h3>
            </div>
            <div class="card-body">
                <form action="../php/procesar_reserva.php" method="POST">
                    <div class="form-group">
                        <label for="concesionario">Concesionario</label>
                        <select type="text" id="concesionario" name="concesionario" required>
                            <?php echo $_GET['concesionario'] ?>
                            <option value="<?php echo $_GET['concesionario'] ?>" selected><?php echo $_GET['concesionario'] ?></option>
                            <?php 
                            $consulta = mysqli_query($conexion, "SELECT * FROM concesionario where NOMBRE != '".$_GET['concesionario']."'");
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo "<option value='".$row['NOMBRE']."'>".$row['NOMBRE']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="mantenimiento">Mantenimiento</label>
                        <select type="text" id="mantenimiento" name="mantenimiento" required>
                            <option value="">Seleccione el mantenimiento deseado</option>
                            <?php 
                            $consulta = mysqli_query($conexion, "SELECT * FROM mantenimiento");
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo "<option value='".$row['DESCRIPCION']."'>".$row['DESCRIPCION']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha del Turno</label>
                        <input type="date" id="fecha" name="fecha" required>
                    </div>

                    <div class="form-group">
                        <label for="hora">Hora del Turno</label>
                        <select id="hora" name="hora">
                            <!-- Opciones para las horas -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vehiculo">Vehículo</label>
                        <select type="text" id="vehiculo" name="vehiculo" required>
                        <?php 
                            if($_SESSION['tipo_usuario'] == 'USUARIO'){
                                $consulta = mysqli_query($conexion, "SELECT * FROM vehiculo WHERE CODIGO_PROPIETARIO = '".$_SESSION['id_sesion']."' AND BORRADO = 0");
                            }
                            else{
                                $consulta = mysqli_query($conexion, "SELECT * FROM vehiculo ");
                            }
                            
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo "<option value='".$row['PATENTE']."'>".'['.$row['PATENTE'].']'." - ".$row['MARCA']." ".$row['MODELO']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit">Reservar Turno</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </article>
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
    <script>
        var hoy = new Date();
        var dia = String(hoy.getDate()).padStart(2,0);
        var mes = String(hoy.getMonth() + 1).padStart(2,0);
        var anio = String(hoy.getFullYear());

        var fechaActual = anio + '-' + mes + '-' + dia;

        document.getElementById('fecha').setAttribute('min', fechaActual);

        var horaSelect = document.getElementById('hora');
        for (var h = 8; h < 19; h++) {
            for (var m = 0; m < 60; m += 30) {
                var hora = String(h).padStart(2, '0');
                var minuto = String(m).padStart(2, '0');
                var option = document.createElement('option');
                option.value = hora + ':' + minuto;
                option.textContent = hora + ':' + minuto;
                horaSelect.appendChild(option);
            }
        }

        // Función para validar la hora
        function validarHora() {
            var fechaSeleccionada = document.getElementById('fecha').value;
            var horaSelect = document.getElementById('hora');
            
            if (fechaSeleccionada === fechaActual) {
                var ahora = new Date();
                var horas = ahora.getHours();
                var minutos = ahora.getMinutes();

                // Redondea los minutos al intervalo más cercano de 30 minutos
                if (minutos < 30) {
                    minutos = 30;
                } else {
                    minutos = 0;
                    horas += 1;
                }
                
                var horaActual = String(horas).padStart(2, '0') + ':' + String(minutos).padStart(2, '0');

                // Deshabilita opciones de hora anteriores a la hora actual
                for (var i = 0; i < horaSelect.options.length; i++) {
                    if (horaSelect.options[i].value < horaActual) {
                        horaSelect.options[i].disabled = true;
                    } else {
                        horaSelect.options[i].disabled = false;
                    }
                }
            } else {
                // Habilita todas las opciones si la fecha no es hoy
                for (var i = 0; i < horaSelect.options.length; i++) {
                    horaSelect.options[i].disabled = false;
                }
            }
        }
        
        // Llama a validarHora cuando la fecha cambia
        document.getElementById('fecha').addEventListener('change', validarHora);

        // Llama a validarHora al cargar la página para establecer correctamente el min de la hora si la fecha es hoy
        validarHora();
        
    </script>
</body>
</html>


