<?php

// Condicional para saber si busca un envio
if (@$_GET["accion"] == "buscarEnvio") {
    if (is_numeric($_GET["dniReceptor"])) {
        $ta = new Taquilla();
        $ta->buscarEnvioTaquilla();
    } else {
        echo "<div class='alert alert-danger'>Digita una identificación valida</div>";
    }
} else
// Condicional para saber si registrara un usuario
if (@$_GET["accion"] == "RegistrarUsuario") {
    $ta = new Taquilla();
    $ta->registrarUsuario();
}

// Condicional para saber si hara un envio
if (@$_GET["accion"] == "hacerGiro") {
    $ta = new Taquilla();
    $ta->hacerEnvio($_GET["idEncargado"], $_GET["idMunicipio"]);
}

// Condicional para saber si un usuario esta consultando
if (@$_GET["accion"] == "consultar") {
    $ta = new Taquilla();
    $ta->consultar();
}

// Cadena de condicionales para cargar
// Dept > Mun > DniEmisor > DniReceptor
if (isset($_GET['dept'])) {
    Taquilla::cargarDept();
} else {
    if (isset($_GET['mun'])) {
        Taquilla::cargarMun();
    } else {
        if (isset($_GET['dniEmi'])) {
            $ta = new Taquilla();
            $ta->buscarDniEmisor();
        } else {
            if (isset($_GET['dniRec'])) {
                $ta = new Taquilla();
                $ta->buscarDniReceptor();
            }
        }
    }
}

class Taquilla {

    function hacerEnvio($idEncargado, $idMuni) {
        require_once 'Conexion.php';
        $con = new Conexion();

        $dniEmisor = htmlspecialchars($_GET["dniEmisor"]);
        $dniReceptor = htmlspecialchars($_GET["dniReceptor"]);
        $idMunFinal = htmlspecialchars($_GET["idmuni"]);
        $valor = htmlspecialchars($_GET["valor"]);
        $descuento;

        if ($valor >= 5000 && $valor <= 100000) {
            $descuento = 0.03;
        } else {
            if ($valor >= 100001 && $valor <= 200000) {
                $descuento = 0.04;
            } else {
                if ($valor >= 200001 && $valor <= 300000) {
                    $descuento = 0.05;
                } else {
                    $descuento = 0.07;
                }
            }
        }
        $valorTotal = intval($valor - ($valor * $descuento));
        date_default_timezone_set('America/Bogota');
        $fechaEnvio = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `envios`(`idEnvio`,`idMunInicial`, `dniEmisor`, `dniReceptor`, `Valor`, `idMunFinal`, `fechaEnvio`, `estado`, `id_encargado`) VALUES"
                . "(0,$idMuni,$dniEmisor,$dniReceptor,$valorTotal,$idMunFinal,'$fechaEnvio','Pendiente',$idEncargado)";
        $res = $con->conectar()->query($sql);
        if ($res) {
            header("location: ComprobanteGiro.php?fechaEnvio=$fechaEnvio&dniEmisor=$dniEmisor&dniReceptor=$dniReceptor&valor=$valor&descuento=$descuento");
            exit();
        } else {
            echo $sql;
        }
    }

    static function login() {
        require_once 'Conexion.php';
        $con = new Conexion();

        $correo = htmlspecialchars($_POST['correo']);
        $clave = htmlspecialchars($_POST['clave']);

        $res = $con->conectar()->query("call loginTaquilla('$correo','$clave')");

        if ($row = $res->fetch_object()) {
            session_start();
            $_SESSION["idTaquilla"] = $row->idTaquilla;
            $_SESSION["correo"] = $row->correo;
            $_SESSION["idMunicipio"] = $row->idMunicipio;
            header("location:SelectPerfil.php");
        } else {
            echo "<div class='alert alert-danger mt-4'>Usuario o contraseña incorrectos</div>";
        }
    }

    function buscarEnvioTaquilla() {
        error_reporting(0);
        require_once 'Conexion.php';
        $con = new Conexion();

        $dniReceptor = htmlspecialchars($_GET['dniReceptor']);
        $idMunicipio = htmlspecialchars($_GET['idMunicipio']);
        $idEncargado = htmlspecialchars($_GET['idEncargado']);

        $pre = 0;
        $sql = "SELECT * FROM buscarenvio WHERE dniReceptor = $dniReceptor AND id = $idMunicipio AND estado = 'Pendiente'";
        $res = $con->conectar()->query($sql);

        if (mysqli_num_rows($res) > 0) {
            while ($row = $res->fetch_object()) {
                $pre = $row->Valor + $pre;
                echo "<div class='accordion' id='accordionExample$row->idEnvio' style='display: block   ; '>
                <div class='card' id='$row->idEnvio' style='display: block;'>
                    <div class='card-header' id='h$row->idEnvio'>
                        <h2 class='mb-0'>
                            <button class='btn w-100' type='button' data-toggle='collapse' data-target='#collapse$row->idEnvio' aria-expanded='true' aria-controls=''>
                                <div class='row'>
                                    <div class='col-sm-4'>
                                        <h5 class='text-success'><strong>Procedente de</strong></h5> $row->nombreEmisor
                                    </div>
                                    <div class='col-sm-4'>
                                        <h5 class='text-success'><strong>A nombre de</strong></h5> $row->nombreReceptor
                                    </div> 
                                    <div class='col-sm-4'>
                                        <h5 class='text-success'><strong>Total a entregar</strong></h5> $row->Valor $
                                    </div>
                                </div>
                            </button>
                        </h2>
                    </div>

                    <div id='collapse$row->idEnvio' class='collapse' aria-labelledby='h$row->idEnvio' data-parent='#accordionExample$row->idEnvio'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-sm-4'>
                                    <div class='treeview-animated'>
                                       <ul class='treeview-animated-list'>
                                            <li class='treeview-animated-items'>
                                                <a class='closed open bg-success'>
                                                    <span><i class='far fa-address-card mr-1'></i>Datos del Emisor</span>
                                                </a>
                                                <ul class='nested active'>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='far fa-id-card mr-1'></i>Identificación</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>$row->dniEmisor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='fas fa-file-signature mr-1'></i>Nombre Completo</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>$row->nombreEmisor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class='col-sm-4'>
                                    <div class='treeview-animated'>
                                       <ul class='treeview-animated-list'>
                                            <li class='treeview-animated-items'>
                                                <a class='closed open bg-success'>
                                                    <span><i class='far fa-address-card mr-1'></i>Datos del Receptor</span>
                                                </a>
                                                <ul class='nested active'>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='far fa-id-card mr-1'></i>Identificación</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>$row->dniReceptor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='fas fa-file-signature mr-1'></i>Nombre Completo</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>$row->nombreReceptor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class='col-sm-4'>
                                    <div class='treeview-animated'>
                                       <ul class='treeview-animated-list'>
                                            <li class='treeview-animated-items'>
                                                <a class='closed open bg-success'>
                                                    <span><i class='far fa-address-card mr-1'></i>Información de envio</span>
                                                </a>
                                                <ul class='nested active'>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='far fa-id-card mr-1'></i>Valor</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-dollar-sign mr-2'></i>$row->Valor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='fas fa-file-signature mr-1'></i>Acciones</span></a>
                                                        <ul class=''>
                                                            <a class='btn btn-warning' target='_blank' onclick='esconderResultado($row->idEnvio)' href='../Controladores/ComprobanteEntrega.php?id=$row->idEnvio&idEncargado=$idEncargado' >
                                                                <i class='fas fa-print mr-2'></i>Imprimir Comprobante
                                                            </a>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            $res = $con->conectar()->query("SELECT * FROM buscarenvio WHERE dniReceptor = $dniReceptor AND estado = 'Pendiente'");
            if (mysqli_num_rows($res) > 0) {
                echo "<div class='alert alert-warning'>
                       Existen envios para este usuario, <strong>Pero no se puede reclamar en este municipio.
                       Debera ser reclamado en:</strong><br><br>";
                echo "<ul>";
                while ($row = $res->fetch_object()) {
                    echo "<li> <strong>$row->paisFinal  >  $row->departamentoFinal  >  $row->municipioFinal.</strong></li>";
                }
                echo "</ul></div>";
            } else {
                echo "<div class='alert alert-danger'>No existe un envio para este usuario</div>";
            }
        }
    }

    function listarPaises() {
        require_once('Conexion.php');
        $con = new Conexion();

        $sql = "SELECT * FROM pais ORDER BY Nombre";

        $res = $con->conectar()->query($sql);
        echo "<select id='pais' onchange='selectDept(this.value)'>";
        echo "<option value='0'>País</option>";
        while ($row = $res->fetch_object()) {
            echo "<option value='$row->id'>$row->Nombre</option>";
        }
        echo "</select>";
    }

    static function cargarDept() {
        require_once('Conexion.php');
        $con = new Conexion();

        $sql = "SELECT * FROM departamento WHERE id_pais = {$_GET['dept']} ORDER BY nombre";
        $res = $con->conectar()->query($sql);

        echo "<select onchange='selectMun(this.value)' class='form-control mr-2'>";
        echo "<option value='0'>Departamento</option>";
        while ($row = $res->fetch_object()) {
            echo "<option value='$row->id'>$row->nombre</option>";
        }
        echo "</select>";
    }

    static function cargarMun() {
        require_once('Conexion.php');
        $con = new Conexion();

        $sql = "SELECT * FROM municipio WHERE id_departamento = {$_GET['mun']} ORDER BY nombre";
        $res = $con->conectar()->query($sql);

        echo "<select id='idMunFinal' class='form-control'>";
        echo "<option value='0'>Municipio</option>";
        while ($row = $res->fetch_object()) {
            echo "<option value='$row->id'>$row->nombre</option>";
        }
        echo "</select>";
    }

    static function cargarPais() {
        require_once('Conexion.php');
        $con = new Conexion();

        $sql = "SELECT * FROM pais ORDER BY Nombre";
        $res = $con->conectar()->query($sql);

        echo "<option value='0'>Pais</option>";
        while ($row = $res->fetch_object()) {
            echo "<option value='$row->id'>$row->Nombre</option>";
        }
    }

    static function listarTipoDocumento() {
        require_once('Conexion.php');
        $con = new Conexion();

        $sql = "SELECT * FROM tipodocumento";
        $res = $con->conectar()->query($sql);

        while ($row = $res->fetch_object()) {
            echo "<option value='$row->idDocumento'>$row->nombreDocumento</option>";
        }
    }

    function buscarDniEmisor() {
        require_once 'Conexion.php';
        $con = new Conexion();

        $dniEmi = htmlspecialchars($_GET['dniEmi']);

        $res = $con->conectar()->query("SELECT u.dni, td.nombreDocumento, u.nombre, td.idDocumento FROM usuario u 
                                INNER JOIN tipodocumento td on td.idDocumento = u.idDocumento WHERE dni = $dniEmi");

        if ($row = $res->fetch_object()) {
            echo "<div class='col-sm-5 col-5'>";
            echo "<h6>Nombre</h6>";
            echo "<input type='text' class='form-control' readonly value='$row->nombre'/>";
            echo "</div>";

            echo "<div class='col-sm-5 '>";
            echo "<h6>Tipo de documento</h6>";
            echo "<select required class='form-control' readonly>"
            . "<option value='$row->idDocumento'>$row->nombreDocumento</option>"
            . "</select>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger mt-4'>Usuario no registrado</div>";
        }
    }

    function buscarDniReceptor() {
        require_once 'Conexion.php';
        $con = new Conexion();

        $dniEmi = htmlspecialchars($_GET['dniRec']);

        $res = $con->conectar()->query("SELECT u.dni, td.nombreDocumento, u.nombre, td.idDocumento FROM usuario u 
                                INNER JOIN tipodocumento td on td.idDocumento = u.idDocumento WHERE dni = $dniEmi");

        if ($row = $res->fetch_object()) {
            echo "<div class='col-sm-5 col-5'>";
            echo "<h6>Nombre</h6>";
            echo "<input type='text' class='form-control' readonly value='$row->nombre'/>";
            echo "</div>";

            echo "<div class='col-sm-5'>";
            echo "<h6>Tipo de documento</h6>";
            echo "<select required class='form-control' readonly>"
            . "<option value='$row->idDocumento'>$row->nombreDocumento</option>"
            . "</select>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger mt-4'>Destinatario no registrado, Este giro no se podra realizar hasta que el destinatario no este registrado.</div>";
        }
    }

    function listarEncargadosPorTaquilla($idTaquilla) {
        require_once 'Conexion.php';
        $con = new Conexion();

        $res = $con->conectar()->query("SELECT * FROM encargado e INNER JOIN taquillas t on t.idTaquilla = e.id_taquilla WHERE e.id_taquilla = $idTaquilla");

        while ($row = $res->fetch_object()) {

            echo "<div class='ml-4 pl-4 col-lg-4 col-md-12'>
           <div class='card'>
            <form action='dash-board.php' method='POST' >
                <div class='view overlay'>
                  <img class='card-img-top' src='../Assets/Imagenes/employee.png' width='50' height='150'>
                  <a href='#!'>
                    <div class='mask rgba-white-slight'></div>
                  </a>
                </div>
                <div class='card-body'>
                <p>Ingresar como</p>
                  <input class='card-title sin-borde b-none text-success h4' value='$row->nombreEnc' name='nombre' readonly/>
                  <input class='card-title sin-borde text-center' name='idEncargado' value='$row->id' readonly/>
                  <input type='submit' value='Ingresar' class='btn btn-success col-md-12 px-0 mx-0' name='SelectPerfil'/>
                </div> 
            </form>
        </div></div>";
        }
    }

    function registrarUsuario() {
        require_once 'Conexion.php';
        $con = new Conexion();

        $dni = htmlspecialchars($_GET["dni"]);
        $idDocumento = htmlspecialchars($_GET["idDocumento"]);
        $nombre = htmlspecialchars($_GET["nombre"]);

        $sql = "INSERT INTO `usuario`(`dni`, `idDocumento`, `nombre`) VALUES ($dni,$idDocumento,'$nombre')";
        if ($con->conectar()->query($sql) > 0) {
            echo "si";
        } else {
            echo "<div class='alert alert-danger'>Este usuario ya existe</div>";
        }
    }

    static function listarDocumentos() {
        require_once 'Conexion.php';
        $con = new Conexion();
        $sql = "SELECT * FROM `tipodocumento`";

        $res = $con->conectar()->query($sql);
        echo "<option value='0'>Tipo de Documento</option>";
        while ($row = $res->fetch_object()) {
            echo "<option value='$row->idDocumento'>$row->nombreDocumento</option>";
        }
    }

    static function listarUbicacion($idMunIni) {
        require_once '../Controladores/Conexion.php';
        $con = new Conexion();

        $sql = "SELECT * FROM listarubicacion WHERE idMuni = " . $idMunIni;
        $res = $con->conectar()->query($sql);

        if ($row = $res->fetch_object()) {
            echo $row->namePais . " > " . $row->nameDept . " > " . $row->nameMuni;
        }
    }

    function consultar() {
        require_once 'Conexion.php';
        $con = new Conexion();

        $dniReceptor = htmlspecialchars($_GET['dniReceptor']);
        $sql = "SELECT * FROM buscarenvio WHERE dniReceptor = $dniReceptor and estado = 'Pendiente'";
        $res = $con->conectar()->query($sql);
        $dniReceptor = 0;
        if (mysqli_num_rows($res) > 0) {
            while ($row = $res->fetch_object()) {
                echo "<div class='accordion' id='accordionExample$row->idEnvio'>
                <div class='card' id='$row->idEnvio'>
                    <div class='card-header' id='h$row->idEnvio'>
                        <h2 class='mb-0'>
                            <button class='btn w-100' type='button' data-toggle='collapse' data-target='#collapse$row->idEnvio' aria-expanded='true' aria-controls=''>
                                <div class='row'>
                                    <div class='col-sm-4'>
                                        <h5 class='text-success'><strong>Procedente de</strong></h5> $row->nombreEmisor
                                    </div>
                                    <div class='col-sm-4'>
                                        <h5 class='text-success'><strong>A nombre de</strong></h5> $row->nombreReceptor
                                    </div> 
                                    <div class='col-sm-4'>
                                        <h5 class='text-success'><strong>Total a entregar</strong></h5> $row->Valor $
                                    </div>
                                </div>
                            </button>
                        </h2>
                    </div>

                    <div id='collapse$row->idEnvio' class='collapse' aria-labelledby='h$row->idEnvio' data-parent='#accordionExample$row->idEnvio'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-sm-4'>
                                    <div class='treeview-animated'>
                                       <ul class='treeview-animated-list'>
                                            <li class='treeview-animated-items'>
                                                <a class='closed open bg-success'>
                                                    <span><i class='far fa-address-card mr-1'></i>Datos del Emisor</span>
                                                </a>
                                                <ul class='nested active'>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='far fa-id-card mr-1'></i>Identificación</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>$row->dniEmisor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='fas fa-file-signature mr-1'></i>Nombre Completo</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>$row->nombreEmisor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class='col-sm-4'>
                                    <div class='treeview-animated'>
                                       <ul class='treeview-animated-list'>
                                            <li class='treeview-animated-items'>
                                                <a class='closed open bg-success'>
                                                    <span><i class='far fa-address-card mr-1'></i>Datos del Receptor</span>
                                                </a>
                                                <ul class='nested active'>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='far fa-id-card mr-1'></i>Identificación</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>$row->dniReceptor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='fas fa-file-signature mr-1'></i>Nombre Completo</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>$row->nombreReceptor
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class='col-sm-4'>
                                    <div class='treeview-animated'>
                                       <ul class='treeview-animated-list'>
                                            <li class='treeview-animated-items'>
                                                <a class='closed open bg-success'>
                                                    <span><i class='far fa-address-card mr-1'></i>Datos del Envio</span>
                                                </a>
                                                <ul class='nested active'>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='fas fa-plane-departure'></i>Enviado desde</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>
                                                                $row->paisInicial > $row->departamentoInicial > $row->municipioInicial
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class='treeview-animated-items'>
                                                        <a class='closed open bg-success'>
                                                            <span><i class='fas fa-plane-arrival'></i>A reclamar en</span></a>
                                                        <ul class=''>
                                                            <li>
                                                                <div class='treeview-animated-element'><i class='fas fa-angle-right mr-2'></i>
                                                                $row->paisFinal > $row->departamentoFinal > $row->municipioFinal
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        }else{
            echo "No existe";
        }
    }

}
