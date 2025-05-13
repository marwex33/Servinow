<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'USUARIO' ) {
    // Redirige al usuario a la página de login si no está autenticado
    include("../php/cerrar_sesion.php");
    header("Location: ../index.html");
    exit();
}
include('../php/conexion.php');?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>ServiNow - Turnos Asignados</title>
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
        <?php
            if(isset($_GET['turno_reservado']))
            {
                echo "<div class='alert'>¡Turno reservado exitosamente!</div>";
            }
        ?>
        <h1>Turnos Asignados</h1>
        <p>Aquí puedes ver los turnos que has reservado</p>
        <section class="turnos-asignados">
        <?php
        $codigo_cliente = $_SESSION['id_sesion'];
        $consulta1 = (mysqli_query($conexion, "SELECT * FROM vehiculo WHERE CODIGO_PROPIETARIO = '$codigo_cliente'"));
        if ($consulta1) {
            $rows = mysqli_num_rows($consulta1);
            if($rows >0 ){
                while($vehiculo = mysqli_fetch_assoc($consulta1) ){
                    $patente = $vehiculo['PATENTE'];
                    $marca = $vehiculo['MARCA'];
                    $modelo = $vehiculo['MODELO'];
                    
                    $turnos_usuario = mysqli_query($conexion, "SELECT * FROM turno WHERE VEHICULO_PATENTE = '$patente' AND ESTADO_TURNO != 'CANCELADO'");

                    while($turno = mysqli_fetch_assoc($turnos_usuario)){
                        $fecha = $turno['FECHA_TURNO'];
                        $hora = $turno['HORA_TURNO'];
                        $estado = $turno['ESTADO_TURNO'];

                        $consulta = mysqli_fetch_assoc(mysqli_query($conexion,'SELECT * FROM concesionario WHERE CODIGO_CONCESIONARIO = "'.$turno['CONCESIONARIO_CODIGO'].'"'));
                        $concesionario = $consulta['NOMBRE'];
                        $direccion = $consulta['DIRECCION'];
                        $telefono = $consulta['TELEFONO'];
                

                        $consulta = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM mantenimiento WHERE CODIGO_SERVICIO = '".$turno['MANT_CODIGO_SERVICIO']."'"));
                        $mantenimiento = $consulta['DESCRIPCION'];
                        echo '
                                <div class="tarjeta-turno">
                                    <h3>'.$concesionario.'</h3>
                                    <p><strong>Estado del turno:</strong> '.$estado.'</p>
                                    <p><strong>Fecha:</strong> '.$fecha.'</p>
                                    <p><strong>Hora:</strong> '.$hora.'</p>
                                    <p><strong>Dirección:</strong> '.$direccion.'</p>
                                    <p><strong>Telefono:</strong> '.$telefono.'</p>
                                    <p><strong>Vehículo:</strong> ['.$patente.']'.$marca.','.$modelo.'</p>
                                    <p><strong>Mantenimiento:</strong> '.$mantenimiento.'</p>
                                    <a href="#" onclick="confirmarCancelacion('.$turno['CODIGO_TURNO'].')" class="boton-cancelar">Cancelar Turno</a>
                                </div>';
                    }
                }
            }
        }
        ?>

        <div class="tarjeta-vehiculo nuevo-vehiculo">
                <i class="fa-solid fa-plus"></i>
                <h3>Reservar Turno</h3>
                <form action='../html/vista_reservar_turno.php' method='POST'>
                        <button type='submit' class='boton-agregar'>IR</button>
                </form>
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
