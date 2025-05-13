<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
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

    <title>ServiNow</title>
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
        <?php 
        include("../php/conexion.php");
        $codigo = $_POST['codigo'];
        $consulta = mysqli_query($conexion, "SELECT * FROM TURNO WHERE CODIGO_TURNO = '$codigo'");
        $resultado = mysqli_fetch_array($consulta);
        $codigo_conce = $resultado['CONCESIONARIO_CODIGO'];
        $consulta1 = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE CODIGO_CONCESIONARIO = '$codigo_conce'");
        $resultado1 = mysqli_fetch_array($consulta1);

        $nombre_concesionario = $resultado1['NOMBRE'];

        ?>
        <div class="reserva-container">
        <div class="reserva-card">
            <div class="card-header">
                <h3>Reserva de Turno para Mantenimiento</h3>
            </div>
            <div class="card-body">
                <form action="../php/modificar_reserva.php" method="POST" onsubmit="return confirmarModificacion()">

                <input type="hidden" name="codigo" value= "<?php echo $codigo; ?>" >
                    <div class="form-group">
                        <label for="concesionario">Concesionario</label>
                        <select type="text" id="concesionario" name="concesionario" required>
                            <?php echo $nombre_concesionario ?>
                            <option value="<?php echo $nombre_concesionario ?>" selected><?php echo $nombre_concesionario ?></option>
                            <?php 
                            $consulta = mysqli_query($conexion, "SELECT * FROM concesionario where NOMBRE != '".$nombre_concesionario."'");
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                if($row['NOMBRE'] == $resultado1['NOMBRE']){
                                    echo "<option value='".$row['NOMBRE']."' selected>".$row['NOMBRE']."</option>";
                                }
                                else{
                                    echo "<option value='".$row['NOMBRE']."'>".$row['NOMBRE']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="Mantenimiento">Mantenimiento</label>
                        <select type="text" id="mantenimiento" name="mantenimiento" required>
                            <option value="">Seleccione el mantenimiento deseado</option>
                            <?php 
                            $consulta = mysqli_query($conexion, "SELECT * FROM mantenimiento");
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                if($row['CODIGO_SERVICIO'] == $resultado['MANT_CODIGO_SERVICIO']){
                                    echo "<option value='".$row['DESCRIPCION']."'selected>".$row['DESCRIPCION']."</option>";
                                }
                                else{
                                    echo "<option value='".$row['DESCRIPCION']."'>".$row['DESCRIPCION']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha del Turno</label>
                        <input type="date" id="fecha" name="fecha" value= "<?php echo $resultado['FECHA_TURNO']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="hora">Hora del Turno</label>
                        <select type="text" id="hora" name="hora" required>
                            <option value="">Seleccione una hora</option>
                            <?php
                            for ($i = 8; $i <= 17; $i++) {
                                if($resultado['HORA_TURNO'] == $i . ':00' ){
                                    echo "<option value='$i:00'selected>$i:00</option>";
                                    echo "<option value='$i:30'>$i:30</option>";
                                }
                                else if($resultado['HORA_TURNO'] == $i . ':30' ){
                                    echo "<option value='$i:00'>$i:00</option>";
                                    echo "<option value='$i:30'selected >$i:30</option>";
                                }
                                else{
                                    echo "<option value='$i:00'>$i:00</option>";
                                    echo "<option value='$i:30'>$i:30</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vehiculo">Vehículo</label>
                        <select type="text" id="vehiculo" name="vehiculo" required>
                        <?php 
                            if($_SESSION['tipo_usuario'] == 'USUARIO'){
                                $consulta = mysqli_query($conexion, "SELECT * FROM vehiculo WHERE CODIGO_PROPIETARIO = '".$_SESSION['id_sesion']."'");
                            }
                            else{
                                $consulta = mysqli_query($conexion, "SELECT * FROM vehiculo ");
                            }
                            
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                if($row['PATENTE'] ==$resultado['VEHICULO_PATENTE'] ){
                                    echo "<option value='".$row['PATENTE']."' selected>".'['.$row['PATENTE'].']'." - ".$row['MARCA']." ".$row['MODELO']."</option>";
                                }
                                else{
                                    echo "<option value='".$row['PATENTE']."'>".'['.$row['PATENTE'].']'." - ".$row['MARCA']." ".$row['MODELO']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit">Modificar</button>
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
<<<<<<< Updated upstream
   
=======
    <script>
    function confirmarModificacion() {
        return confirm("¿Estás seguro de que quieres modificar el turno?");
    }
    </script>
>>>>>>> Stashed changes
</body>
</html>