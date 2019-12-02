<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Seleccionar Perfil | Gana, cerca de ti. </title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="../Assets/Estilos/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="../Assets/Estilos/css/mdb.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link href="../Assets/Estilos/css/style.css" rel="stylesheet">
        <!-- Material Toastr -->
        <link href="../Assets/Estilos/css/toastr.min.css" rel="stylesheet">
    </head>
    <body>
        <!-- Jumbotron -->
        <div class="jumbotron text-center">

            <!-- Title -->
            <h2 class="card-title text-success h4">Bienvenido a la taquilla <?php echo $_SESSION["correo"]; ?></h2>

            <!-- Grid row -->
            <div class="row d-flex justify-content-center">

                <!-- Grid column -->
                <div class="col-xl-7 pb-2">

                    <p class="card-text">Somos un Centro Integral de Servicios Punto Clave con una ubicación estratégica en la ciudad, que ofrece una variada oferta de servicios, buscando solucionar las necesidades de los clientes de una forma ágil, cómoda y segura.</p>
                    <p class="card-text">¿No es tu taquilla? <a href="?salirATaquilla" class="text-success">Salir.</a></p>
                </div>
                
                <?php 
                    if (isset($_GET["salirATaquilla"])) {
                        session_destroy();
                        header("location:login.php");
                    }
                
                ?>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

            <hr class="my-4">
            <section class="p-1 col-md-12">
                <div class="container">
                <div class="row pl-4 ml-4">
                    
                        <?php
                        if (isset($_SESSION["idTaquilla"])) {
                            include_once '../Controladores/Taquilla.php';
                            $ta = new Taquilla();
                            $ta->listarEncargadosPorTaquilla($_SESSION["idTaquilla"]);
                        } else {    
                            header("location:login.php");
                        }
                        ?>
                        </div>
                </div>
            </section>
        </div>
        <!-- Jumbotron -->

    </body>
</html>
