<?php
session_start();
if (isset($_SESSION["idTaquilla"]) || @$_SESSION["idEncargado"] != null) {
    header("location:dash-board.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="../Assets/Estilos/css/toastr.css" rel="stylesheet" type="text/css"/>
    <a href="../Assets/Estilos/toastr/toastr.js.map"></a>
    <script src="../Assets/Estilos/js/toastr.js" type="text/javascript"></script>
    <link href="../Assets/Estilos/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../Assets/Estilos/css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="../Assets/Imagenes/logo.png" id="icon" alt="User Icon" class="image mb-4" />
            </div>

            <!-- Login Form -->
            <form action="" method="POST" class="mt-4">
                <input type="email" id="login" class="fadeIn second mb-4" name="correo" placeholder="Usuario" required autofocus>
                <input type="password" id="password" class="fadeIn third mb-4" name="clave" placeholder="Contraseña" required>
                <input type="submit" class="fadeIn fourth" name="accion" value="Acceder">

                <a href="../index.php" class="text-success mp-4">No soy empleado</a>
                <?php
                if (isset($_POST["accion"])) {
                    require_once '../Controladores/Taquilla.php';
                    Taquilla::login();
                }
                ?>
            </form>

            <!-- Remind Passowrd -->
        </div>
    </div>
    <script src="../Assets/Estilos/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../Assets/Estilos/js/jquery-3.4.1.min.js" type="text/javascript"></script>
</body>
</html>
