<?php
require_once('Conexion.php');
$con = new Conexion();

$idEnvio = $_GET["id"];
$idEncargado = $_GET["idEncargado"];

$sqlUpdate = "UPDATE envios SET estado = 'Entregado' WHERE idEnvio = $idEnvio";

if ($con->conectar()->query($sqlUpdate) > 0) {
    echo "Actualizado";
}else{
    echo "Error";
}

$sql = "SELECT * FROM buscarenvio WHERE idEnvio = $idEnvio";

$res = $con->conectar()->query($sql);
$carpeta = 'Tiquetes/Entregas';

if (!file_exists($carpeta)) {
    mkdir($carpeta);
}
$filename = $carpeta . "/FacturasEntrega" . $idEnvio . ".txt";

if ($row = $res->fetch_object()) {
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
        fwrite($handle, (" Encargado Receptor: $idEncargado   ") . "\n");
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
        fwrite($handle, ("            $ $row->Valor           ") . "\n");
        fwrite($handle, ("____________________________________") . "\n");
        fclose($handle);
        header("location: $filename"); 
    } else {
        echo "<div class='alert alert-danger'>Ha ocurrido un error al generar la colilla.</div>";
    }
}


