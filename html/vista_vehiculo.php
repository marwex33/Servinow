<?php @session_start();?>
<!DOCTYPE html>
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
            <?php if($_SESSION['tipo_usuario'] == 'USUARIO' ){
            
            echo"<a href='../html/vista_usuario.php'><img id='inicio' src='../img/icono.webp' alt='ServiNow'  height='80'></a>";
            echo"<ul class='lista'>";
            echo"   <li><a href='../html/vista_reservar_turno.php'>Reservar Turno</a></li>";
            echo"   <li><a href='../html/vista_turnos_asignados.php'>Turnos Asignados</a></li>";
            echo"   <li><a href='../html/vista_mis_vehiculos.php'>Mis Vehículos</a></li>";
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
        <h1>Vehiculo</h1>
        <p>Aquí puedes modificar la informacion del vehiculo</p>
        <?php 
        include("../php/conexion.php");
        if($_SESSION['tipo_usuario'] == 'USUARIO'){
            $patente = $_GET['patente'];
        }
        else{
            $patente = $_POST['patente'];
        }
        $consulta = mysqli_query($conexion, "SELECT * FROM VEHICULO WHERE PATENTE = '$patente'");
        $resultado = mysqli_fetch_array($consulta);
        ?>
        <section class="perfil-usuario">
            <form class="formulario-perfil" action="../php/modificar_vehiculo.php" method="post">
               
                <div class="campo-formulario">
                    <label for="patente">Patente: <?php echo $resultado['PATENTE']?> </label>
                     <input type='hidden' name='patente' value="<?php echo $resultado['PATENTE']?>">
                </div>
                <div class="campo-formulario">
                    <label for="marca">Marca:</label>
                    <input type="text" id="marca" name="marca" value="<?php echo $resultado['MARCA']?>">
                </div>
                <div class="campo-formulario">
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" value="<?php echo $resultado['MODELO']?>">
                </div>
                <div class="campo-formulario">
                    <label for="anio">Año:</label>
                    <input type="text" id="anio" name="anio" value="<?php echo $resultado['ANIO']?>">
                </div>
                <button type="submit" name="accion" value="modificar" class="boton-guardar">Guardar Cambios</button>
                <button type="submit" name="accion" value="borrar" class="boton-guardar">Borrar vehiculo</button>

            </form>
        </section>
    </article>
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
</body>
</html>