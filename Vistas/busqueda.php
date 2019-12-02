<?php session_start(); ?>
<main class='pt-5 mx-lg-5'>
    <div class='container-fluid mt-5'>
        <div class='card mb-12 wow'>
            <div class='card-body d-sm-flex justify-content-between'>
                <input class='form-control mr-sm-2' type='number' id='dniReceptor' placeholder='Buscar' aria-label='Buscar' minlength='6' maxlength='11' min='0' required> 
                <a href='javascript:;' class='btn btn-success' <?php echo "onclick='buscarEnvio({$_SESSION['idMunicipio']},{$_SESSION['idEncargado']})'" ?>><i class='fas fa-search'></i></a>
            </div>
        </div>
    </div>
</div>
</main>
<main class='pt-3 mx-lg-5'>
    <div id='Envios'></div>
</main>    
