<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'ADMIN' ) {
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
<body>
    <header>
        <nav class="navegador">
            <a href="../html/vista_admin.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow"  height="80"></a>
            <ul class="lista">
               <li><a href="vista_clientes_admin.php">Usuarios</a></li>
               <li><a href="vista_concesionarios_admin.php">Concesionarios</a></li>
               <li><a href="cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>Vehículos de 
            <?php  
            echo $_POST['usuario'] ?>
        </h1>
        <p>Aquí puedes ver y gestionar los vehículos registrados</p>
        
        <section class="vehiculos">
            <?php
                $i = 0;
                $codigo = $_POST['codigo'];
                include("conexion.php");
                $consulta = mysqli_query($conexion, "SELECT * FROM TURNO WHERE CONCESIONARIO_CODIGO = '$codigo'AND ESTADO_TURNO != 'CANCELADO'  ");
                $resultado = mysqli_num_rows($consulta);
                if ($resultado != 0) {
                    while($fila = mysqli_fetch_array($consulta)) {
                        echo "<div class='tarjeta-concesionario'>";
                        $consulta2 = mysqli_query($conexion, "SELECT M.DESCRIPCION FROM MANTENIMIENTO M JOIN TURNO T WHERE M.CODIGO_SERVICIO = T.MANT_CODIGO_SERVICIO ");
                        $mantenimiento = mysqli_fetch_array($consulta2);
                        echo "<h3>" . $mantenimiento[0] . "</h3>";
                        echo "<strong>Estado del turno:</strong> ". $fila['ESTADO_TURNO'] ;
                        echo "<p><strong>Fecha:</strong> " . $fila['FECHA_TURNO'] . "</p>";
                        echo "<p><strong>Hora:</strong> " . $fila['HORA_TURNO'] . "</p>";
                        echo "<p><strong>Concesionario:</strong> " . $_POST['nombre'] . "</p>";
                        $patente = $fila['VEHICULO_PATENTE'];
                        $consulta2 = mysqli_query($conexion, "SELECT * FROM VEHICULO WHERE PATENTE = '$patente'" );
                        $vehiculo = mysqli_num_rows($consulta2);
                        
                        if ($vehiculo != 0) {
                            $vehiculo = mysqli_fetch_array($consulta2);
                            echo "<p><strong>Vehiculo:</strong> " . $vehiculo['MARCA'] . " " . $vehiculo['MODELO'] . " " . $vehiculo['ANIO'] . " " . $vehiculo['PATENTE'] . "</p>";
                        }
                        else{
                            echo "<p><strong>Vehiculo:</strong> Sin asignar</p>";
                        }
                        
                        echo "<form action='../html/vista_turno_admin.php' method='POST'>";
                        echo "<div class='campo-formulario'> ";
                        echo "<input type='hidden' name='codigo' value='".$fila['CODIGO_TURNO']."'>";
                        echo "<input type='hidden' name='nombre' value='".$_POST['nombre']."'>";
                        echo "<button type='submit' class='boton-reservar'>Modificar turno</button>";
                        echo "</div>";
                        $codigo_turno = $fila['CODIGO_TURNO'];
                        echo "<a href='#' onclick='confirmarCancelacion('$codigo_turno') class='boton-cancelar'>Cancelar Turno</a>";
                        echo "</form>";
                        $codigo_turno = $fila['CODIGO_TURNO'];
                        echo "<a href='../php/cancelar_turno.php?id=$codigo_turno' onclick='confirmarCancelacion('$codigo_turno') class='boton-cancelar'>Cancelar Turno</a>";
                        echo "</div>";
                    } 
                }
                else {
                    echo "0 resultados";
                }
            ?>
             <div class="tarjeta-vehiculo nuevo-vehiculo">
                <i class="fa-solid fa-plus"></i>
                <h3>Agregar Nuevo Turno</h3>
                <a href="../html/form_reserva_de_turnos.php?concesionario=<?php echo $nombre ?>" class="boton-reservar">Reservar Turno</a>
        </div>
        </section>
    </article>
    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
    <script>
    function confirmarCancelacion(idTurno) {
        if (confirm('¿Está seguro que desea cancelar este turno?')) {
            window.location.href = '../php/cancelar_turno.php?id=' + idTurno;
        }
    }
    </script>
</body>
</html>