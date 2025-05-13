<?php @session_start();
if ($_SESSION['autenticado'] != true || $_SESSION['tipo_usuario'] !== 'ADMIN' && $_SESSION['tipo_usuario'] !== 'CONCESIONARIO' ) {
    // Redirige al usuario a la página de login si no está autenticado
    include("../php/cerrar_sesion.php");
    header("Location: ../index.html");
    exit();
}
?>
<!DOCTYPE html>
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
            <a href="../html/vista_concesionario.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow"  height="80"></a>
            <ul class="lista">
               <li><a href="../html/vista_datos_concesionario.php">Mi concesionario</a></li>
               <li><a href="../php/vista_turnos_concesionario.php">Turnos</a></li>
               <li><a href="../php/cerrar_sesion.php">Cerrar sesion</a></li>
               <li><a href="../html/vista_perfil.php"><i class="fa-regular fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <?php 
        include("conexion.php");
        $codigo1 = $_SESSION['id_sesion'];
        $consulta1 = mysqli_query($conexion, "SELECT * FROM CONCESIONARIO WHERE CODIGO_USUARIO = '$codigo1' ");
        $resultado1 = mysqli_fetch_assoc($consulta1);
    ?>
    <article class="pag_principal">
        <h1>Turnos de 
            <?php 
                echo $resultado1['NOMBRE']; 
            ?>
        </h1>
        <p>Aquí puedes ver y gestionar los turnos </p>
        
        <section class="vehiculos">
            <?php
                $i = 0;
                $codigo = $resultado1['CODIGO_CONCESIONARIO'];
                $consulta = mysqli_query($conexion, "SELECT * FROM TURNO WHERE CONCESIONARIO_CODIGO = '$codigo' AND ESTADO_TURNO != 'CANCELADO' ");
                $resultado = mysqli_num_rows($consulta);
                if ($resultado != 0) {
                    while($fila = mysqli_fetch_array($consulta)) {
                        echo "<div class='tarjeta-concesionario'>";
                        $consulta2 = mysqli_query($conexion, "SELECT M.DESCRIPCION FROM MANTENIMIENTO M JOIN TURNO T WHERE M.CODIGO_SERVICIO = T.MANT_CODIGO_SERVICIO ");
                        $mantenimiento = mysqli_fetch_array($consulta2);
                        echo "<h3>" . $mantenimiento[0] . "</h3>";
                        echo "<p><strong>Fecha:</strong> " . $fila['FECHA_TURNO'] . "</p>";
                        echo "<p><strong>Hora:</strong> " . $fila['HORA_TURNO'] . "</p>";
                        echo "<p><strong>Concesionario:</strong> " . $resultado1['NOMBRE'] . "</p>";
                        $patente = $fila['VEHICULO_PATENTE'];
                        $consulta2 = mysqli_query($conexion, "SELECT * FROM VEHICULO WHERE PATENTE = '$patente'" );
                        $vehiculo = mysqli_num_rows($consulta2);
                        if ($vehiculo != 0) {
                            $vehiculo = mysqli_fetch_array($consulta2);
                            $codigo_cliente = $vehiculo['CODIGO_PROPIETARIO'];
                            $consulta3 = mysqli_query($conexion, "SELECT * FROM CLIENTE WHERE CODIGO_CLIENTE = '$codigo_cliente'" );
                            $cliente = mysqli_fetch_array($consulta3);
                            echo "<p><strong>Vehiculo:</strong> " . $vehiculo['MARCA'] . " " . $vehiculo['MODELO'] . " " . $vehiculo['ANIO'] . " " . $vehiculo['PATENTE'] . "</p>";
                            echo "<p><strong>Cliente:</strong> " . $cliente['NOMBRES'] . " " . $cliente['APELLIDOS'] . " " . $cliente['USUARIO'] . " </p>";
                        }
                        else{
                            echo "<p><strong>Vehiculo:</strong> Sin asignar</p>";
                            echo "<p><strong>Cliente:</strong> Sin asignar </p>";
                        }
                        
                        echo "<form action='../html/vista_turno_admin.php' method='POST'>";
                        echo "<div class='campo-formulario'> ";
                        echo "<input type='hidden' name='codigo' value='".$fila['CODIGO_TURNO']."'>";
                        echo "<input type='hidden' name='nombre' value='".$resultado1['NOMBRE']."'>";
                        echo "<button type='submit' class='boton-reservar'>Modificar turno</button>";
                        echo "</div>";
                        $codigo_turno = $fila['CODIGO_TURNO'];
                        echo "<a href='#' onclick='confirmarCancelacion($codigo_turno)' class='boton-cancelar'>Cancelar Turno</a>";
                        echo "</form>";
                        echo "</div>";
                    } 
                }
                else {
                    echo "Sin turnos";
                }
            ?>
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