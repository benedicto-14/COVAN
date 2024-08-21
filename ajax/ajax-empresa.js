$(document).ready( function(){
    $("#pass1").keyup(function() {
    $("#pass1").removeClass("is-invalid");
    $("#pass1").removeClass("is-valid");
    $("#pass2").removeClass("is-invalid");
    $("#pass2").removeClass("is-valid");
    $("#pass2").val("");
    consultarUsuarios();
    });
    $("#rsocial").keyup(function(){
      $("#rsocial").removeClass("is-invalid");
      $("#rsocial").removeClass("is-valid");
    });
    $("#usuario").keyup(function(){
      $("#usuario").removeClass("is-invalid");
      $("#usuario").removeClass("is-valid");
    });
    $('#ShowPassword').click(function () {
    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });


});

function validarCotraseña(){
  $("#pass2").removeClass("is-invalid");
  $("#pass2").removeClass("is-valid");
  var valor1=document.getElementById('pass1').value;
  var valor2=document.getElementById('pass2').value;
  var expresion=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,10}$/;
  var resultado=expresion.test(valor1);
  if(resultado == true){
    var elemento = document.getElementsByClassName("input-pass1");
	 for(var i = 0; i < elemento.length; i++)
	    elemento[i].className += " is-valid";
      document.getElementById("pass2").maxLength="12";
  console.log("contraseña válida");
  return true;
  }
 if(resultado == false) {
  var elemento = document.getElementsByClassName("input-pass1");
 for(var i = 0; i < elemento.length; i++)
    elemento[i].className += " is-invalid";
    document.getElementById("pass2").maxLength="2";
    console.log("contraseña inválida");
    return false;
  }
  if(valor1 == valor2) {
    alert("iguales");
   var elemento = document.getElementsByClassName("input-pass2");
  for(var i = 0; i < elemento.length; i++)
     elemento[i].className += " is-valid";
     console.log("contraseñas iguales");
     return false;
   }
   if( valor1 != valor2) {
    var elemento = document.getElementsByClassName("input-pass2");
   for(var i = 0; i < elemento.length; i++)
      elemento[i].className += " is-invalid";
      console.log("contraseña inválida");
      return false;
    }
}

function compararContraseñas(){
  var valor1=document.getElementById('pass1').value;
  var valor2=document.getElementById('pass2').value;
  if(valor1 == valor2) {
   var elemento = document.getElementsByClassName("input-pass2");
  for(var i = 0; i < elemento.length; i++)
     elemento[i].className += " is-valid";
     console.log("contraseñas iguales");
     return false;
   }
   if(valor1 != valor2) {
    var elemento = document.getElementsByClassName("input-pass2");
   for(var i = 0; i < elemento.length; i++)
      elemento[i].className += " is-invalid";
      return false;
    }
}
function mostrarPassword(){
 var cambio = document.getElementById("pass1");
 if(cambio.type == "password"){
 cambio.type = "text";
 $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
 }else{
 cambio.type = "password";
 $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
 }
 }
 function cambiar(){
     var pdrs = document.getElementById('file-upload').files[0].name;
     document.getElementById('info').innerHTML = pdrs;
 }

function getDataCompany(){
  if(validarFormulario()){
  var form = $("#form-company").serialize();
  console.log(form);
          $.ajax({
          url:"./controller/global-controller.php",
                  data: form,
                  method: "POST",
                  dataType: "text",
                  success: function (text){
                    alert(text);
                    if(text=="insertado"){
                      Swal.fire({
                      position: 'center',
                              type: 'success',
                              title: 'La empresa ha sido registrada con éxito',
                              showConfirmButton: false,
                              timer: 2000
                      });
                      location.href ="index.php";
                    }else {
                      Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: '¡Error al registrar empresa!'
                  });
                    }
                  }
          });
  }
}

function subirImagen(){
  var formData = new FormData($("#enviarImagen")[0]);
  var ruta = "./controller/global-controller.php";
  $.ajax({
      url: ruta,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(datos)
      {
        alert("succes");
      }
  });
}

function consultarEmpresas(){
  var name=$("#rsocial").val();
  $.ajax({
    url:'./controller/global-controller.php',
    method: 'POST',
    data:'name='+name+'&buscarEmpresas',
    dataType:'text',
    success: function (text) {
           if(text=="encontrado"){
             var elemento = document.getElementsByClassName("input-r");
            for(var i = 0; i < elemento.length; i++)
               elemento[i].className += " is-invalid";
               console.log("Empresa inválida");
               return false;
           }else{
             var elemento = document.getElementsByClassName("input-r");
            for(var i = 0; i < elemento.length; i++)
               elemento[i].className += " is-valid";
               console.log("válida");
               return true;
           }
    }
  });
}

function consultarUsuarios(){
  var user=$("#usuario").val();
  $.ajax({
    url:'./controller/global-controller.php',
    method: 'POST',
    data:'user='+user+'&buscarUsuarios',
    dataType:'text',
    success: function (text) {
           if(text=="encontrado"){
             var elemento = document.getElementsByClassName("input-user");
            for(var i = 0; i < elemento.length; i++)
               elemento[i].className += " is-invalid";
               console.log("Empresa inválida");
               return false;
           }else{
             var elemento = document.getElementsByClassName("input-user");
            for(var i = 0; i < elemento.length; i++)
               elemento[i].className += " is-valid";
               console.log("válida");
               return true;
           }
    }
  })
}

function validarFormulario(){
 // valida que todo el formulario este lleno, si lo hace regresara un TRUE de lo contrario un FALSE
       if($("#rsocial").val() == ""){
        alert("El campo RAZÓN SOCIAL no puede estar vacío.");
        $("#rsocial").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#rfc").val() == ""){
        alert("El campo RFC no puede estar vacío.");
        $("#rfc").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#usuario").val() == ""){
        alert("El campo USUARIO no puede estar vacío.");
        $("#usuario").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#pass1").val() == ""){
        alert("El campo CONTRASEÑA no puede estar vacío.");
        $("#pass1").focus();
        return false;
    }
    if( $("#pass1").val() != $("#pass2").val() ){
        alert("Error en las contraseñas");
        $("#email").focus();
        return false;
    }
    if($("#calle").val() == ""){
        alert("El campo CALLE no puede estar vacío.");
        $("#calle").focus();
        return false;
    }
    if($("#exterior").val() == ""){
        alert("El campo NÚMERO EXTERIOR no puede estar vacío.");
        $("#exterior").focus();
        return false;
    }
    if($("#interior").val() == ""){
        alert("El campo NÚMERO INTERIOR no puede estar vacío.");
        $("#interior").focus();
        return false;
    }
    if($("#idEstado").val() == ""){
        alert("El campo ESTADO no puede estar vacío.");
        $("#idEstado").focus();
        return false;
    }
    if($("#idMunicipio").val() == ""){
        alert("El campo MUNICIPIO no puede estar vacío.");
        $("#idMunicipio").focus();
        return false;
    }
    if($("#idLocalidad").val() == ""){
        alert("El campo LOCALIDAD no puede estar vacío.");
        $("#idLocalidad").focus();
        return false;
    }
    if($("#colonia").val() == ""){
        alert("El campo COLONIA no puede estar vacío.");
        $("#colonia").focus();
        return false;
    }
    if($("#cp").val() == ""){
        alert("El campo CODIGO POSTAL no puede estar vacío.");
        $("#cp").focus();
        return false;
    }
    if($("#giro").val() == ""){
        alert("El campo GIRO no puede estar vacío.");
        $("#giro").focus();
        return false;
    }
    if($("#telefono").val() == ""){
        alert("El campo TELEFONO no puede estar vacío.");
        $("#telefono").focus();
        return false;
    }
    if($("#email").val() == ""){
        alert("El campo EMAIL no puede estar vacío.");
        $("#email").focus();
        return false;
    }
    if($("#sello").val() == ""){
        alert("El campo SELLO no puede estar vacío.");
        $("#sello").focus();
        return false;
    }
    return true;
}

//******************FUNCIONES DE PERFIL DE EMPRESA******************************

function cargarEmpresa(){
        var id= $("#idEmpresa").val();
        $.ajax({
        url: "../controller/global-controller.php",
        type: "POST",
        data: "datosEmpresa="+id,
        dataType: "json",
        success: function (json) {
            var i;
            var img ='<div class="form-group">';
            var out ='<form method="POST" id="form-empresa-edit">';
            for (i in json) {
                out +='<input type="hidden" name="editarEmpresa" value="'+json[i].idEmpresa+'">'+
                '<input type="hidden" name="idDomicilio" value="'+json[i].idDomicilio+'">'+
                '<div class="row text-muted" >'+
                   '<div class="col-md-6">'+
                    '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Razon social: </label>'+
                       '<input type="text" value="'+json[i].empresa+'" name="razonSocial" autofocus="autofocus" class="form-control" id="rsocial" required="" >'+
                       '</div>'+
                   '</div>'+
                   '<div class="col-md-6">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">RFC : </label>'+
                       '<input type="text" name="rfc" value="'+json[i].rfc+'" maxlength="13" class="form-control" id="rfc" aria-describedby="rfcHelp" placeholder="Opcional" required="">'+
                       '</div>'+
                   '</div>'+
                 '</div>'+
                 '<div class="row">'+
                   '<div class="col-md-4">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Teléfono: </label>'+
                       '<input type="text" name="telefono" value="'+json[i].telefono+'" class="form-control" id="telefono" aria-describedby="telefonoHelp" placeholder="" required="">'+
                   '</div>'+
                   '</div>'+
                   '<div class="col-md-4">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Email: </label>'+
                       '<input type="text" name="email" value="'+json[i].correo+'" class="form-control" id="email" aria-describedby="emailHelp" placeholder="" required="">'+
                   '</div>'+
                   '</div>'+
                   '<div class="col-md-4">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Sello Digital: </label>'+
                       '<input type="text" name="sello" value="'+json[i].idSelloDigital+'" class="form-control" id="sello" ondragover="" aria-describedby="selloHelp" placeholder="" required="">'+
                   '</div>'+
                   '</div>'+
                 '</div>'+
                 '<div class="row">'+
                   '<div class="col-md-4">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Giro: </label>'+
                   '<select class="custom-select" id="giro"  name="giro">'+
                       '<option selected >'+json[i].giro+'</option>'+
                       '<option value="1">Abarrotes</option>'+
                       '<option value="2">Farmacia</option>'+
                       '<option value="3">Papeleria</option>'+
                       '<option value="4">Cyber-café</option>'+
                   '</select></div>'+
                   '</div>'+
                 '</div>'+
                 'Domicilio'+
                 '<div class="row">'+
                   '<div class="col-md-6">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Calle: </label>'+
                       '<input type="text" name="calle" value="'+json[i].calle+'" class="form-control" onkeypress="compararContraseñas();" id="calle" aria-describedby="calleHelp" placeholder="" required="">'+
                   '</div>'+
                   '</div>'+
                   '<div class="col-md-3">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">N° exterior: </label>'+
                       '<input type="text" name="exterior" value="'+json[i].numeroExt+'" class="form-control" id="exterior" aria-describedby="exteriorHelp" placeholder="" required="">'+
                   '</div>'+
                   '</div>'+
                   '<div class="col-md-3">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">N° interior: </label>'+
                       '<input type="text" name="interior"  value="'+json[i].numeroInt+'" class="form-control" id="interior" aria-describedby="interiorHelp" placeholder="" required="">'+
                   '</div>'+
                   '</div>'+
                 '</div>'+
                 '<div class="row">'+
                   '<div class="col-md-4">'+
                    '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Estado: </label>'+
                      '<div class="form-group" id="editarEstado">'+
                       '<select class="custom-select" name="estado" onchange="modificarEstado()">'+
                       '<option selected="" value="'+json[i].idEstado+'">'+json[i].estado+'</option>'+
                       '<option>Más estados</option>'+
                       '</select>'+
                      '</div>'+
                    '</div>'+
                   '</div>'+
                   '<div class="col-md-4">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Municipio: </label>'+
                       '<div class="form-group" id="editarMunicipio">'+
                           '<select class="custom-select" name="municipio">'+
                               '<option value="'+json[i].idMunicipio+'" selected="">'+json[i].municipio+'</option>'+
                           '</select>'+
                       '</div>'+
                     '</div>'+
                   '</div>'+
                   '<div class="col-md-4">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Localidad: </label>'+
                        '<div class="form-group" id="editarLocalidades">'+
                              '<select class="custom-select" name="localidad">'+
                                  '<option value="'+json[i].idLocalidad+'" selected="">'+json[i].localidad+'</option>'+
                              '</select>'+
                          '</div>'+
                        '</div>'+
                   '</div>'+
                 '</div>'+
                 '<div class="row">'+
                   '<div class="col-md-4">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Colonia: </label>'+
                       '<input type="text" name="colonia" class="form-control" value="'+json[i].colonia+'" id="colonia" aria-describedby="calleHelp" placeholder="" required="">'+
                   '</div>'+
                   '</div>'+
                   '<div class="col-md-4">'+
                     '<div class="col-form col-sm-12">'+
                       '<label class="col-form-label">Código Postal: </label>'+
                       '<input type="text" name="cp" value="'+json[i].codigoPostal+'" class="form-control" id="cp" aria-describedby="codigoPostalHelp" placeholder="" required="">'+
                  '</div>'+
                   '</div>'+
                 '</div>'+
                 '<br>';
               img+='<div class="card-img">'+
                 '<img src="'+json[i].logo+'" class="rounded mx-auto img-fluid" alt="Responsive image" style="width: 235px; height:235px;">'+
                 '</div>'+
               '</div>'+
               '<hr>'+
               '<div class="form-group">'+
                 '<button class="btn btn-info" data-toggle="modal" data-target="#modalImg">Actualizar</button'+
                 '</div>';
            }
            out += "</form>";
            img+= '</div>';
            document.getElementById("datosEmpresa").innerHTML = out;
            document.getElementById("imgEmpresa").innerHTML = img;
        }
    }).fail(function(){
      $("#cerrarEdit").trigger("click");
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: '¡No se pudo consultar información!'
      });
    });
}
function subirImagen(){
  var formData = new FormData($("#enviarImagen")[0]);
  var ruta = "../controller/global-controller.php";
  $.ajax({
      url: ruta,
      type: "POST",
      data: formData,
      dataType:'text',
      contentType: false,
      processData: false,
      success: function(text)
      {
        if (text=='subida'){
          $("#cerrarEdit").trigger("click");
          Swal.fire({
          position: 'center',
                  type: 'success',
                  title: 'La imagen ha sido actualizada',
                  showConfirmButton: false,
                  timer: 2000
          });
        }else {
          $("#cerrarEdit").trigger("click");
          Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: '¡Error al actualizar información!'
      });
        }
      }
  });
}

function editarEmpresa(){
var form = $("#form-empresa-edit").serialize();
        $.ajax({
        url:"../controller/global-controller.php",
                data: form,
                method: "POST",
                dataType: "text",
                success: function (text){
                }
        }).done(function(text){
          Swal.fire({
          position: 'center',
                  type: 'success',
                  title: 'La información ha sido actualizada',
                  showConfirmButton: false,
                  timer: 2000
          });
          $(document).ready( function(){
          cargarEmpresa();
          });
        }).fail(function(){
          Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: '¡Error al actualizar información!'
      });
        });
        $("#cerrarEdit").trigger("click");
        $('#form-provider-edit').trigger("reset");
    }

function cargarImagen(){
  document.getElementById('file-upload').addEventListener('change', file, false);
  function file(evt) {
      var files = evt.target.files; // FileList object
      //Obtenemos la imagen del campo "file".
      for (var i= 0, f; f = files[i]; i++) {
          //Solo admitimos imágenes.
          if (!f.type.match('image.*')) {
              continue;
          }
          var reader = new FileReader();
          reader.onload = (function (theFile) {
              return function (e) {
                  document.getElementById("list").innerHTML = ['<img  class="rounded mx-auto img-fluid" alt="Responsive image"src=" ', e.target.result, ' " title=" ', escape(theFile.name), ' "  style="width: 235px; height:235px;"/>'].join('');
               };
          })(f);
          reader.readAsDataURL(f);
      }
  }
}
//*****************TERMINAN FUNCIONES DE PERFIL DE EMPRESA**********************
