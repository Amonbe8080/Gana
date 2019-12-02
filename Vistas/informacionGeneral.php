<div class="jumbotron text-center card-deck ">
    <div class="row mb-4">
        <div class="col-md-4">
            <a href="javascript:;" onclick="cargarGUI('contenido', 'envio.php');">
                <h3 class="text-success"><i class="fas fa-paper-plane"></i>Hacer Envio</h3>
                <img src="../Assets/Imagenes/hacerEnvio.png" width="250" height="355" class="img-thumbnail rounded-pill border-0"/>
            </a>
        </div>
        <div class="col-md-4">
            <a href="javascript:;" onclick="cargarGUI('contenido', 'busqueda.php');">
                <h3 class="text-success"><i class="fas fa-search-dollar"></i>Buscar Envios</h3> 
                <img src="../Assets/Imagenes/buscarEnvio.png" class="img-thumbnail rounded-pill border-0"/>
            </a>
        </div>
        <div class="col-md-4">
            <a href="javascript:;" onclick="cargarGUI('contenido', 'regUsuario.php');">
                <h3 class="text-success"><i class="fas fa-user-plus"></i>Registrar Usuario</h3> 
                <img src="../Assets/Imagenes/regUsu.png" class="img-thumbnail rounded-pill border-0"/>
            </a>
        </div>
    </div>

    <div class="row col-md-12 ml-4 pl-4">
        <div class="card col-md-4">
            <div class="card-body">
                <h5 class="card-title text-success">¿En que taquilla estoy?</h5>
                <p class="card-text">Esta taquilla esta identificada con el <strong>codigo</strong></p>
                <h4 class="card-text text-success text-center text-wrap" id="idTaquilla"><strong><?php echo $_SESSION["idTaquilla"]; ?></strong></h4>
            </div>
        </div>
        <div class="card col-md-4">
            <div class="card-body">
                <h5 class="card-title text-success">¿Quien?</h5>
                <p class="card-text">Esta taquilla esta identificada con el <strong>correo</strong></p>
                <p class="card-text text-success text-center text-wrap"><?php echo $_SESSION["correo"]; ?></p>
            </div>
        </div>
        <div class="card col-md-4">
            <div class="card-body">
                <h5 class="card-title text-success">¿Donde esta ubicada?</h5>
                <p class="card-text">Esta taquilla esta ubicada en</p>
                <h4 class="card-text text-success text-center text-wrap" id="idMunicipio"><strong>
                <?php   
                    require_once '../Controladores/Taquilla.php';
                    Taquilla::listarUbicacion($_SESSION["idMunicipio"]);
                ?>
                </strong></h4>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="ml-4 pl-4 mt-4">
            <a href="https://www.gana.com.co/" target="_blank">
                <img src="../Assets/Imagenes/banner.jpg" class="img-responsive w-100" alt="Banner promocional"/>  
            </a>
            <p class="card-text">Todas las acciones realizadas en esta taquilla estan registradas, cualquier intento de fraude sera castigado con sus debidas normas, 
                <a href="https://servicios.gana.com.co/uploads/default/practicas_de_transparencia/e32b861bc5a1504daabe81265e2a8c27.pdf" target="_blank">Leer normas.</a></p>
        </div>
    </div>
</div>