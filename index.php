<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido | Gana, cerca de ti.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="Assets/Estilos/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="Assets/Estilos/css/mdb.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <!-- Material Toastr -->
        <link href="Assets/Estilos/css/toastr.min.css" rel="stylesheet">
        <style type="text/css">
            html,
            body,
            header,
            .view {
                height: 100%;
            }

            @media (max-width: 740px) {
                html,
                body,
                header,
                .view {
                    height: 1000px;
                }
            }

            @media (min-width: 800px) and (max-width: 850px) {
                html,
                body,
                header,
                .view {
                    height: 650px;
                }
            }
            @media (min-width: 800px) and (max-width: 850px) {
                .navbar:not(.top-nav-collapse) {
                    background: #1C2331!important;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
            <div class="container">
                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <img src="Assets/Imagenes/Gana-Index.png" width="200" height="80" class="" alt="">
                        </li>
                    </ul>

                    <ul class="navbar-nav nav-flex-icons">
                        <li class="nav-item">
                            <a href="Vistas/login.php" class="nav-link border rounded border-white text-white"
                               target="_blank">
                                <i class="fas fa-user-tie mr-2"></i>Ingresar
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h3 class="modal-title text-success mr-auto ml-auto" id="modal"><i class="fas fa-envelope-open"></i> Al parecer tienes giros pendientes <i class="fas fa-envelope-open"></i></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="alertQuery"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar -->
        <div class="view full-page-intro" style="background-image: url('https://image.freepik.com/foto-gratis/alcancia-colocada-monedas-oro-apiladas-casa-pizarra_2361-1198.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row wow fadeIn">
                        <div class="col-md-6 mb-4 white-text text-center text-md-left">
                            <h1 class="display-4 font-weight-bold">Inversión, tú mejor giro.</h1>
                            
                            <h1 class="display-4 font-weight-bold"></h1>

                            <hr class="hr-light">

                            <p>
                                <strong>Proyecto final PHP </strong>
                            </p>

                            <p class="mb-4 d-none d-md-block">
                                <strong>Este proyecto pretende simular la funcionalidad de envio del servicio <a href="https://www.gana.com.co/" class="text-success"><strong>Gana,</strong></a>
                                    Permitiendo simular el papel de un empleado, el cual podra <strong class="text-success">Hacer y Reclamar</strong> envios.
                                </strong>
                            </p>

                            <a target="_blank" href="https://github.com/Amonbe8080/Gana" class="btn btn-success btn-lg">Ver Documentación
                                <i class="fab fa-github ml-2"></i>
                            </a>

                        </div>
                        <!--Grid column-->

                        <div class="col-md-6 col-xl-5 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="dark-grey-text text-center text-success">
                                        <strong><i class="fas fa-paper-plane"></i>Consulta ya tu envio.</strong>
                                    </h3>
                                    <hr>
                                    <div class="md-form">
                                        <i class="fas fa-address-card prefix green-text"></i>
                                        <input type="text" id="dniReceptor" class="form-control">
                                        <label for="form3">Identificación</label>
                                    </div>
                                    <div class="md-form">
                                        <div class="g-recaptcha pl-4 ml-4" data-sitekey="6Ld0h8UUAAAAAAFvuT_fUG_wG2-5rjiurPeWgSiG"></div>
                                    </div>
                                    <div class="md-form">
                                        <a href="javascript:;" class="btn btn-success btn-block" onclick="consultar()">Consultar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Page Intro -->


        <!-- SCRIPTS -->
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script type="text/javascript" src="Vistas/ajax.js"></script>
        <!-- JQuery -->
        <script type="text/javascript" src="Assets/Estilos/js/jquery-3.4.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="Assets/Estilos/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="Assets/Estilos/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="Assets/Estilos/js/mdb.min.js"></script>
        <!-- Toastr core JavaScript -->
        <script type="text/javascript" src="Assets/Estilos/js/toastr.min.js"></script>
    </body>

</html>
