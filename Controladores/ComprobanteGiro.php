<?php
require_once('Conexion.php');
$con = new Conexion();

$dniEmisor = $_GET["dniEmisor"];
$dniReceptor = $_GET["dniReceptor"];
$fechaEnvio = $_GET["fechaEnvio"];
$descuento = $_GET["descuento"] * 100;
$valorOriginal = $_GET["valor"];

$sql = "SELECT * FROM buscarenvio WHERE dniEmisor = $dniEmisor AND dniReceptor = $dniReceptor AND fechaEnvio = '$fechaEnvio'";
$res = $con->conectar()->query($sql);

if ($row = $res->fetch_object()) {
    $idEnvio = $row->idEnvio;
} else {
    echo "error";
}
$carpeta = 'Tiquetes/Giros';

if (!file_exists($carpeta)) {
    mkdir($carpeta);
}
$filename = $carpeta."/FacturasGiro".$idEnvio.".txt";

if ($handle = fopen($filename, 'a+')) {
    fwrite($handle, ("____________________________________") . "\n");
    fwrite($handle, ("             G A N A                ") . "\n");
    fwrite($handle, ("____________________________________") . "\n");
    fwrite($handle, ("           Datos Emisor             ") . "\n");
    fwrite($handle, (" DNI: $row->dniEmisor               ") . "\n");
    fwrite($handle, (" Nombre: $row->nombreEmisor         ") . "\n");
    fwrite($handle, ("____________________________________") . "\n");
    fwrite($handle, ("           Datos Receptor           ") . "\n");
    fwrite($handle, (" DNI: $row->dniReceptor             ") . "\n");
    fwrite($handle, (" Nombre: $row->nombreReceptor       ") . "\n");
    fwrite($handle, ("____________________________________") . "\n");
    fwrite($handle, ("           Datos de Envio           ") . "\n");
    fwrite($handle, (" Encargado Emisor: $row->idEmpleado ") . "\n");
    fwrite($handle, ("                                    ") . "\n");
    fwrite($handle, ("           Enviado desde            ") . "\n");
    fwrite($handle, (" $row->paisInicial > $row->departamentoInicial > $row->municipioInicial ") . "\n");
    fwrite($handle, ("                                    ") . "\n");
    fwrite($handle, ("           A recibir en             ") . "\n");
    fwrite($handle, (" $row->paisFinal > $row->departamentoFinal > $row->municipioFinal") . "\n");
    fwrite($handle, ("                                    ") . "\n");
    fwrite($handle, ("           Fecha Envio              ") . "\n");
    fwrite($handle, ("         $row->fechaEnvio           ") . "\n");
    fwrite($handle, ("____________________________________") . "\n");
    fwrite($handle, ("Iva $descuento %         Original $valorOriginal") . "\n");
    fwrite($handle, ("         Valor Total                ") . "\n");
    fwrite($handle, ("           $ $row->Valor            ") . "\n");
    fwrite($handle, ("____________________________________") . "\n");
    fclose($handle);
    echo "FacturasGiro$idEnvio.txt"; 
} else {
    echo "<div class='alert alert-danger'>Ha ocurrido un error al generar la colilla, Revisa que todos los campos esten diligenciados.</div>";
}



