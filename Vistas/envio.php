<?php
session_start();
?>
<main class="pt-5 mx-lg-5 ">
    <div class="container-fluid mt-5">
        <div class="card mb-4 wow">
            <div class="container">
                <h1 style="text-align: center;" class="mt-4 text-success"><i class="fas fa-paper-plane"></i>Hacer Giro</h1>
                <div class="alert alert-info">Recuerda que se debe tener la <strong>mayoria de edad (+18)</strong> para realizar un giro, El empleador debera estar pendiente a la fecha de nacimiento del usuario que desea hacer el giro.</div>
                <div class="m-5">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h6 style="text-align: center;">Datos Emisor</h6>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6>DNI de emisor</h6>
                                    <input type="number" id="dniEmisor" required min="0" placeholder="Maximo 11 digitos" class="form-control" maxlength="11" onkeyup="buscarDniEmisor(this.value)" id="dniEmisor">
                                </div>
                                <div id="datosEmisor" class="col-md-9 row"></div>
                            </div>
                        </li>

                        <li class="list-group-item" id="datosReceptor" style="display:none;">
                            <h6 style="text-align: center;">Datos Receptor</h6>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6>DNI de receptor</h6>
                                    <input type="number" required id="dniReceptor" placeholder="Maximo 11 digitos" min="0" class="form-control"  maxlength="11" onkeyup="buscarDniReceptor(this.value)">
                                </div>
                                <div id="queryRec" class="col-md-9 d-inline-flex"></div>
                            </div>
                        </li>

                        <div id="datosTransaccion" style="display:none">
                            <li class="list-group-item" >
                                <h6 style="text-align: center;" id="idTaquilla">Lugar hacia donde va</h6>
                                <div class="row">
                                    <select id="pais" onchange="selectDept(this.value)" class="form-control col-md-4 mr-2 ml-2"> 
                                        <?php
                                            require_once('../Controladores/Taquilla.php');
                                            $cad = new Taquilla();
                                            $cad::cargarPais();
                                        ?>
                                    </select>
                                    <div id="departamento" class="col-md-4 row"></div>
                                    <div id="municipio" class="col-md-4 row"></div> 
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row" style="">
                                    <div class="col-sm-4">
                                        <h6 id="idEncargado">Cantidad</h6>
                                        <input type="number" required placeholder="Cantidad a enviar" id="valor" min="0" class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="javascript:;" <?php echo "onclick='hacerGiro({$_SESSION['idEncargado']}, {$_SESSION['idMunicipio']})'" ?> class="btn btn-success" >Enviar Giro</a>
                                    </div>
                                    <div class="col-sm-4">
                                        <div id="msjGiro"></div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
            </form>
        </div>
    </div>
</main>