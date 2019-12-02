<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
    <body>
        <form class="text-center border border-light p-5" method="POST" action="">
            <p class="h4 mb-4 text-success">Consultar Envio</p>
            <label>Documento de identidad</label>
            <input type="number" autocomplete="off" class="form-control mb-4" id="dniReceptor" placeholder="Maximo 11 caracteres numericos" required min="6" maxlength="11">
            <div class="g-recaptcha" data-sitekey="6Ld0h8UUAAAAAAFvuT_fUG_wG2-5rjiurPeWgSiG"></div>
            
            <a href="javascript:;" class="btn btn-success btn-block" onclick="consultar()">Consultar</a>
        </form>
        <div id="alertQuery"></div>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="ajax.js" type="text/javascript"></script>
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
    </body>
</html>
