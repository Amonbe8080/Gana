function hacerGiro(idEncargado, idMunicipio) {
    var dniEmisor = document.getElementById("dniEmisor").value;
    var dniReceptor = document.getElementById("dniReceptor").value;
    var idmuni = document.getElementById("idMunFinal").value;
    var valor = document.getElementById("valor").value;

    var ajax = new XMLHttpRequest();
    ajax.open("GET", "../Controladores/Taquilla.php?idEncargado=" + idEncargado +
            "&idMunicipio=" + idMunicipio + "&dniEmisor=" + dniEmisor +
            "&dniReceptor=" + dniReceptor + "&idmuni=" + idmuni +
            "&valor=" + valor+ "&accion=hacerGiro", true);
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (ajax.responseText != "<div class='alert alert-danger'>Ha ocurrido un error al generar la colilla</div>") {
                window.open("../Controladores/Tiquetes/Giros/" + ajax.responseText, "_blank");
                window.location = "dash-board.php";
            } else {
                document.getElementById("msjGiro").innerHTML = ajax.responseText;
            }
        }
    }
    ajax.send();
}

function buscarEnvio(idMunicipio, idEncargado) {
    var dniReceptor = document.getElementById("dniReceptor").value;
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "../Controladores/Taquilla.php?dniReceptor=" + dniReceptor + "&idMunicipio=" + idMunicipio + "&idEncargado=" + idEncargado + "&accion=buscarEnvio", true);
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("Envios").innerHTML = ajax.responseText;
        }
    }
    ajax.send();
}

function registrarUsuario() {
    var dni = document.getElementById("dni").value;
    var nombre = document.getElementById("nombre").value;
    var idDocumento = document.getElementById("idDocumento").value;

    var ajax = new XMLHttpRequest();
    ajax.open("GET", "../Controladores/Taquilla.php?dni=" + dni + "&nombre=" + nombre + "&idDocumento=" + idDocumento + "&accion=RegistrarUsuario", true);
    ajax.onreadystatechange = function () {
        if (ajax.responseText == "si") {
            toastr.success("Usuario registrado con exito");
            window.location = "../Vistas/dash-board.php";
        } else {
            document.getElementById("alertReg").innerHTML = ajax.responseText;
        }
    }

    ajax.send();
}

function buscarDniEmisor(dniEmi) {
    if (dniEmi.length >= 6) {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "../Controladores/Taquilla.php?dniEmi=" + dniEmi, true);
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (ajax.responseText != "<div class='alert alert-danger mt-4'>Usuario no registrado</div>") {
                    document.getElementById("datosReceptor").style.display = "block";
                    document.getElementById("datosEmisor").innerHTML = ajax.responseText;
                } else {
                    document.getElementById("datosTransaccion").style.display = "none";
                    document.getElementById("datosReceptor").style.display = "none";
                    document.getElementById("datosEmisor").innerHTML = ajax.responseText;
                }
            }
        }
        ajax.send();
    }
}

function buscarDniReceptor(dniRec) {
    var dniEmi = document.getElementById("dniEmisor").value;
    if (dniEmi == dniRec) {
        toastr.error("No se puede enviar hacia el mismo emisor");
    } else {
        if (dniRec.length >= 6) {
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "../Controladores/Taquilla.php?dniRec=" + dniRec, true);
            ajax.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (ajax.responseText != "<div class='alert alert-danger mt-4'>Destinatario no registrado, Este giro no se podra realizar hasta que el destinatario no este registrado.</div>") {
                        document.getElementById("queryRec").innerHTML = ajax.responseText;
                        document.getElementById("queryRec").style.display = "block";
                        document.getElementById("datosTransaccion").style.display = "block";
                    } else {
                        document.getElementById("datosTransaccion").style.display = "none";
                        document.getElementById("queryRec").innerHTML = ajax.responseText;
                    }
                }
            }
            document.getElementById("queryRec").style.display = "block";
            ajax.send();
        }
    }
}

function selectMun(id) {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "../Controladores/Taquilla.php?mun=" + id, true);
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("municipio").innerHTML = ajax.responseText;
        }
    }
    ajax.send();
}

function selectDept(id) {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "../Controladores/Taquilla.php?dept=" + id, true);
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("departamento").innerHTML = ajax.responseText;
        }
    }
    ajax.send();
    selectMun(0);
}

function cargarGUI(ui, archivo) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && this.status == 200) {
            document.getElementById("informacion").style.display = "none";
            document.getElementById(ui).innerHTML = this.responseText;
        } else {

            document.getElementById(ui).innerHTML = "<img style='float:right; margin-right:30px;' width='80%' src='../Assets/Imagenes/indeterminate.gif'>";
        }
    };
    xhttp.open("GET", archivo, true);
    xhttp.send();

}

function esconderResultado(id) {
    document.getElementById(id).style.display = "none";
}

function consultar() {
    var dniReceptor = document.getElementById("dniReceptor").value;
    var response = grecaptcha.getResponse();

    if (response.length == 0) {
        alert("Captcha no verificado")
    } else {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "../Controladores/Taquilla.php?dniReceptor=" + dniReceptor + "&accion=consultar", true);
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("alertQuery").innerHTML = ajax.responseText;
            }
        }
        ajax.send();
    }

}

