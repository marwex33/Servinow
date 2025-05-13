<?php @session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true && !isset($_SESSION['autenticado']) || $_SESSION['tipo_usuario'] !== 'ADMIN' ) {
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
    <title>ServiNow - Turnos Asignados</title>
</head>
<body onload="buscarCliente()">
    <header>
        <nav class="navegador">
            <a href="../html/vista_admin.php"><img id="inicio" src="../img/icono.webp" alt="ServiNow" height="80"></a>
            <ul class="lista">
               <li><a href="../php/vista_clientes_admin.php">Usuarios</a></li>
               <li><a href="../php/vista_concesionarios_admin.php">Concesionarios</a></li>
               <li><a href="../php/cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </header>
    
    <article class="pag_principal">
        <h1>USUARIOS</h1>
        <section class="concesionarios"> 
        <input type="text" id="buscar" onkeyup="buscarCliente()" placeholder="Buscar" class="tarjeta-concesionario">
        </section>
        <section class="concesionarios"> 
            <div id="resultado" class="concesionarios">
                <!-- Aqu� se cargaran los resultados -->
            </div>
        </section>
    </article>
    
    <footer>
        <p>&copy; 2024 ServiNow. Todos los derechos reservados.</p>
    </footer>
    <script src="https://kit.fontawesome.com/7b8a06bdc2.js" crossorigin="anonymous"></script>
    <script>
        function buscarCliente() {
            // Obtener el valor del input
            let buscar = document.getElementById("buscar").value;

            // Crear una solicitud AJAX
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "buscar.php?buscar=" + encodeURIComponent(buscar), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Actualizar el contenido de la tabla con los resultados
                    document.getElementById("resultado").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
