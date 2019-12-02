<?php
session_start();
if (@$_SESSION["idEncargado"] == null || !isset($_SESSION["idEncargado"])) {
    $_SESSION["idEncargado"] = htmlspecialchars($_POST["idEncargado"]);
    $_SESSION["nombreEncargado"] = htmlspecialchars($_POST["nombre"]);
}

if (!isset($_SESSION["idTaquilla"])) {
    header("location:login.php");
} else {
    if (isset($_SESSION["idTaquilla"]) && $_SESSION["idEncargado"] == null) {
        header("location:SelectPerfil.php");
    }
}

if (isset($_GET['userchange'])) {
    $_SESSION["idEncargado"] = null;
    $_SESSION["nombreEncargado"] = null;
    header("location:SelectPerfil.php");
} else {
    if (isset($_GET['salirTaquilla'])) {
        session_destroy();
        header("location:login.php");
    }
}

if (@$_POST["accion"] == "Enviar Giro") {
    echo "<script> window.onload(cargarGUI('contenido', 'envio.php')); </script>";
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <title>Empleador | Gana, cerca de ti. </title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="../Assets/Estilos/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="../Assets/Estilos/css/mdb.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link href="../Assets/Estilos/css/style.min.css" rel="stylesheet">
        <!-- Material Toastr -->
        <link href="../Assets/Estilos/css/toastr.min.css" rel="stylesheet">
    </head>

    <body class="lighten-3">

        <!--Main Navigation-->
        <header>

            <!-- Navbar -->
            <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
                <div class="container-fluid">

                    <!-- Links -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Izquierda -->
                        <img src="../Assets/Imagenes/avatar.png" alt=""/>
                        
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item mt-3">
                                <h4 class="text-success">
                                    <b><?php echo $_SESSION["nombreEncargado"]; ?></b>
                                </h4>
                                <p class="text-muted" id="idEncargado"><?php echo $_SESSION["idEncargado"]; ?></p>
                            </li>
                        </ul>
                        <!-- Derecha -->
                        <ul class="navbar-nav nav-flex-icons">
                            <li class="nav-item">
                                <a href="?userchange" class="btn btn-warning ">
                                    Cambiar de usuario
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <!-- Navbar -->

            <!-- Sidebar -->
            <div class="sidebar-fixed position-fixed">
                <a href="dash-board.php" class="logo-wrapper waves-effect">
                    <img src="../Assets/Imagenes/logo.png" class="img-fluid" alt="">
                </a>
                <h4 class="list-group-item  waves-effect border-0">
                    <?php list($correo) = explode("@", $_SESSION["correo"]);
                    echo $correo; ?></h4>
                <div class="">

                    <a href="javascript:;" onclick="cargarGUI('contenido', 'envio.php')" class="border-0 list-group-item list-group-item-action waves-effect">
                      <i class="fas fa-paper-plane"></i>Hacer Envio</a>

                    <a href="javascript:;" onclick="cargarGUI('contenido', 'busqueda.php')" class="border-0 list-group-item list-group-item-action waves-effect">
                      <i class="fas fa-search-dollar"></i>Buscar Envios</a>
                      
                      <a href="javascript:;" onclick="cargarGUI('contenido', 'regUsuario.php')" class="border-0 list-group-item list-group-item-action waves-effect">
                          <i class="fas fa-user-plus"></i>Registrar Usuario</a>

                    <a href="?salirTaquilla" class="btn btn-red waves-effect fixed-bottom position-absolute">
                        <i class="fas fa-sign-out-alt"></i>Salir de taquilla</a>
                </div>
            </div>
            <!-- Sidebar -->
        </header>
        <!--Main Navigation-->

        <!--Main layout-->

        <div id="contenido" class="pt-4"></div>

        <main id="informacion" style="display:block" class="text-center pt-5 mx-lg-5" >
            <?php include 'informacionGeneral.php'; ?>
        </main>
        <!--Main layout-->

        <!-- SCRIPTS -->
        <script type="text/javascript" src="ajax.js"></script>
        <!-- JQuery -->
        <script type="text/javascript" src="../Assets/Estilos/js/jquery-3.4.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../Assets/Estilos/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../Assets/Estilos/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../Assets/Estilos/js/mdb.min.js"></script>
        <!-- Toastr core JavaScript -->
        <script type="text/javascript" src="../Assets/Estilos/js/toastr.min.js"></script>
    </body>

</html>
