//***************INICIA SECCIÓN DE COMBO BOX ANIDADO (Estado, Municipio, Localidad)******************************
function consultarEstados(){
$('#localidades').trigger("reset");
 $.ajax({
        url:"http://localhost/Covan/controller/global-controller.php?estado",
        method: "GET",
        success: function (data){
        var option ="<select class='custom-select' name='estado' id='idEstado' onchange='consultarMunicipios();'> \n\
<option selected=''>--SELECCIONE--</option>";
        for (var i in data){
            option +="<option  value="+data[i].idEstado+" >"+data[i].estado+"</option> ";
        }
     option +="</select>";
     document.getElementById("estados").innerHTML=option;
        }
    });
}

function modificarEstado(){
 $.ajax({
        url:"http://localhost/Covan/controller/global-controller.php?estado",
        method: "GET",
        success: function (data){
       var option = "<select class='form-control' id='editEdo' name='estado' onchange='modificarMunicipio();'><option selected=''>--SELECCIONE--</option>";
        for (var i in data) {
      option += "\n\
       \n\<option value="+ data[i].idEstado +">" + data[i].estado + "</option>";
            }
            option +="</select>";
            console.log(option);
    document.getElementById("editarEstado").innerHTML = option;
        }
    });
}

function consultarMunicipios(){
 var idEstado= document.getElementById("idEstado").value;
 $('#localidades').trigger("reset");
 $.ajax({
        url:"http://localhost/Covan/controller/global-controller.php?municipio="+idEstado,
        method: "GET",
        success: function (data){
        var option ="<select class='custom-select' name='municipio' id='idMunicipio' onchange='consultarLocalidades();'> \n\
<option selected=''>--SELECCIONE--</option>";
        for (var i in data){
            option +="<option  value="+data[i].idMunicipio+" >"+data[i].municipio+"</option> ";
        }
     option +="</select>";
     document.getElementById("municipios").innerHTML=option;
        }
    });
}

function modificarMunicipio(){
 var idEstado= document.getElementById("editEdo").value;
 $.ajax({
        url:"http://localhost/Covan/controller/global-controller.php?municipio="+idEstado,
        method: "GET",
        success: function (data){
        var option ="<select class='custom-select' name='municipio' id='editMunicipio' onchange='modificarLocalidades();'> \n\
<option selected=''>--SELECCIONE--</option>";
        for (var i in data){
            option +="<option  value="+data[i].idMunicipio+" >"+data[i].municipio+"</option> ";
        }
     option +="</select>";
     document.getElementById("editarMunicipio").innerHTML=option;
        }
    });
}

function consultarLocalidades(){
 var idMunicipio= document.getElementById("idMunicipio").value;
 $.ajax({
        url:"http://localhost/Covan/controller/global-controller.php?localidad="+idMunicipio,
        method: "GET",
        success: function (data){
        var option ="<select class='custom-select' name='localidad' id='idLocalidad'> \n\
<option selected=''>--SELECCIONE--</option>";
        for (var i in data){
            option +="<option  value="+data[i].idLocalidad+" >"+data[i].localidad+"</option> ";
        }
     option +="</select>";
     document.getElementById("localidades").innerHTML=option;
        }
    });
}

function modificarLocalidades(){
 var idMunicipio= document.getElementById("editMunicipio").value;
 $.ajax({
        url:"http://localhost/Covan/controller/global-controller.php?localidad="+idMunicipio,
        method: "GET",
        success: function (data){
        var option ="<select class='custom-select' name='localidad' id='editLocalidad'> \n\
<option selected=''>--SELECCIONE--</option>";
        for (var i in data){
            option +="<option  value="+data[i].idLocalidad+" >"+data[i].localidad+"</option> ";
        }
     option +="</select>";
     document.getElementById("editarLocalidades").innerHTML=option;
        }
    });
}
//***************TERMINA SECCIÓN DE COMBO BOX ANIDADO (Estado, Municipio, Localidad)******************************
