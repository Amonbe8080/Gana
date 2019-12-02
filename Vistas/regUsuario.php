<main class="pt-5 mx-lg-5 ">
    <div class="container-fluid mt-5 col-md-6">
        <form class="text-center border border-light p-5" method="POST" action="">
            <p class="h4 mb-4 text-success">Agregar Usuario</p>
            <label>Documento de identidad</label>
            <input type="number" autocomplete="off" class="form-control mb-4" id="dni" placeholder="Maximo 11 caracteres numericos" required min="6" maxlength="11">
            <label>Nombre completo</label>
            <input type="text" autocomplete="off" class="form-control mb-4" id="nombre" placeholder="Tomado del documento de identidad" required >
            <label>Tipo De Documento</label>
            <select class="browser-default custom-select mb-4" id="idDocumento" required>
                <?php
                    require_once '../Controladores/Taquilla.php';
                    Taquilla::listarTipoDocumento();
                ?>
            </select>
            <div id="alertReg"></div>
            <a href="javascript:;" class="btn btn-success btn-block" onclick="registrarUsuario()">Registrar</a>
        </form>
    </div>
</main>