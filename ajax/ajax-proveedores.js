//*************************INICIAN FUNCIONES DE LA SECCIÓN PROVEEDORES***********************************************
function cargarProveedores(){
    $.ajax({
        url: "../controller/global-controller.php",
        type: "POST",
        data:'proveedores=1',
        dataType: "json",
        success: function (json) {
            var i;
            var out = "<table border='1'>";
            for (i = 0; i < json.length; i++) {
                out += " <tr><td>" +
                        json[i].proveedor+
                        "</td><td>" +
                        json[i].telefono+
                        "</td><td>" +
                        json[i].rfc+
                        "</td><td>" +
                        json[i].correo+
             "</td><td height='5' width='5' title='Eliminar registro'><button class='dropdown-item' type='button' data-toggle='modal' onClick='eliminarProveedor("+ json[i].idProveedor+")'><i class='fa fa-trash' style='color: red'></i></button></td>"+
            "<td height='5' width='5' title='Modificar información'><button class='dropdown-item' type='button' data-toggle='modal' onClick='cargarProveedor("+ json[i].idProveedor+")' data-target='#modalActualizar'><i class='fa fa-edit' style='color: #28a745'></i></button></td>"+
            "<td height='5' width='5' title='Visualizar información'><button class='dropdown-item' type='button' data-toggle='modal' onClick='visualizarProveedor("+ json[i].idProveedor+")' data-target='#modalInformación' ><i class='fa fa-info-circle' style='color: #002752'></i></button></td>"+
           "</td></tr>";
            }
            out += "</table>";
            document.getElementById("resultado").innerHTML = out;
        }
    }).fail( function(){
    Swal.fire({
type: 'error',
title: 'Oops...',
text: '¡Error al consultar Proveedores!'
});
  });
}

function validarFormulario(){
 // valida que todo el formulario este lleno, si lo hace regresara un TRUE de lo contrario un FALSE
       if($("#nombreProveedor").val() == ""){
        alert("El campo NOMBRE no puede estar vacío.");
        $("#nombreProveedor").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#telefono").val() == ""){
        alert("El campo TELEFONO no puede estar vacío.");
        $("#telefono").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#rfc").val() == ""){
        alert("El campo RFC no puede estar vacío.");
        $("#rfc").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#email").val() == ""){
        alert("El campo EMAIL no puede estar vacío.");
        $("#email").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }

    if($("#calle").val() == ""){
        alert("El campo CALLE no puede estar vacío.");
        $("#calle").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#exterior").val() == ""){
        alert("El campo NÚMERO EXTERIOR no puede estar vacío.");
        $("#exterior").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#interior").val() == ""){
        alert("El campo NÚMERO INTERIOR no puede estar vacío.");
        $("#interior").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#idEstado").val() == ""){
        alert("El campo ESTADO no puede estar vacío.");
        $("#idEstado").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#idMunicipio").val() == ""){
        alert("El campo MUNICIPIO no puede estar vacío.");
        $("#idMunicipio").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#idLocalidad").val() == ""){
        alert("El campo LOCALIDAD no puede estar vacío.");
        $("#idLocalidad").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#colonia").val() == ""){
        alert("El campo COLONIA no puede estar vacío.");
        $("#colonia").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#cp").val() == ""){
        alert("El campo CODIGO POSTAL no puede estar vacío.");
        $("#cp").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    return true;
}

function validarFormularioEditar(){ // valida que todo el formulario este lleno, si lo hace regresara un TRUE de lo contrario un FALSE
       if($("#nombreProveedorEdit").val() == ""){
        alert("El campo NOMBRE no puede estar vacío.");
        $("#nombreProveedorEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#telefonoEdit").val() == ""){
        alert("El campo TELEFONO no puede estar vacío.");
        $("#telefonoEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#rfcEdit").val() == ""){
        alert("El campo RFC no puede estar vacío.");
        $("#rfcEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#emailEdit").val() == ""){
        alert("El campo EMAIL no puede estar vacío.");
        $("#emailEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#calleEdit").val() == ""){
        alert("El campo CALLE no puede estar vacío.");
        $("#calleEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#exteriorEdit").val() == ""){
        alert("El campo NÚMERO EXTERIOR no puede estar vacío.");
        $("#exteriorEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#interiorEdit").val() == ""){
        alert("El campo NÚMERO INTERIOR no puede estar vacío.");
        $("#interiorEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#editEstado").val() == ""){
        alert("El campo ESTADO no puede estar vacío.");
        $("#editEstado").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#editMunicipio").val() == ""){
        alert("El campo MUNICIPIO no puede estar vacío.");
        $("#editMunicipio").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#editLocalidad").val() == ""){
        alert("El campo LOCALIDAD no puede estar vacío.");
        $("#editLocalidad").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#coloniaEdit").val() == ""){
        alert("El campo COLONIA no puede estar vacío.");
        $("#coloniaEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#cpEdit").val() == ""){
        alert("El campo CODIGO POSTAL no puede estar vacío.");
        $("#cpEdit").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }

    return true;
}

function visualizarProveedor(id){
        $.ajax({
        url: "../controller/global-controller.php",
        type: "POST",
        data: "idProveedor="+id,
        dataType:"json",
        success: function (json) {
            var i;
            var out = "<table border='1'>";
            for (i in json) {
                out += " <tr><td>Proveedor:</td><td class='text-primary'>" +
                        json[i].proveedor +
                        "</td></tr><tr><td>Teléfono:</td><td class='text-primary'>" +
                        json[i].telefono +
                        "</td></tr><tr><td>Rregistro Federal de Contribuyentes:</td><td class='text-primary'>" +
                        json[i].rfc +
                        "</td></tr><tr><td>Correo:</td><td class='text-primary'>" +
                        json[i].correo+
                        "</td></tr><tr><td>Calle:</td><td class='text-primary'>"+
                        json[i].calle+
                        "</td></tr><tr><td>N° Exterior:</td><td class='text-primary'>#"+
                        json[i].numeroExt+
                        "</td></tr><tr><td>N° Interior:</td><td class='text-primary'>#"+
                        json[i].numeroInt+
                        "</td></tr><tr><td>Estado:</td><td class='text-primary'>"+
                        json[i].estado+
                        "</td></tr><tr><td>Municipio:</td><td class='text-primary'>"+
                        json[i].municipio+
                        "</td></tr><tr><td>Localidad:</td><td class='text-primary'>"+
                        json[i].localidad+
                        "</td></tr><tr><td>Colonia:</td><td class='text-primary'>"+
                        json[i].colonia+
                        "</td></tr><tr><td>Código Postal:</td><td class='text-primary'>"+
                        json[i].codigoPostal+
                        "</td></tr>";
            }
            out += "</table>";
            document.getElementById("infoProveedor").innerHTML = out;
        }
    }).fail(function(){
      $("#close").trigger("click");
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: '¡No se pudo consultar información!'
      });
    });
}

function cargarProveedor(id){
        $.ajax({
        url: "../controller/global-controller.php",
        type: "POST",
        data: "idProveedor="+id,
        dataType: "json",
        success: function (json) {
            var i;
            var out ='<form method="POST" id="form-provider-edit">';
            for (i in json) {
                out += '<div class="row" >'+
                                '<input type="hidden" value="'+json[i].idProveedor+'" name="updateProvider">'+
                                '<input type="hidden" value="'+json[i].idDomicilio+'" name="idDomicilio">'+
                                '<div class="col-form-4 col-sm-6 ">'+
                                   '<label>Razón social:</label>'+
                                   '<input class="form-control" id="nombreProveedorEdit" name="nombre" value="'+json[i].proveedor+'" placeholder="Proveedor" required="">'+
                '</div>'+
                                '<div class="col-form-4 col-sm-6">'+
                                   '<label>Teléfono:</label>'+
                                   '<input class="form-control" id="telefonoEdit" name="telefono" value="'+json[i].telefono+'" placeholder="Telefono" required="">'+
                                '</div>'+
                '</div>'+
                '<div class="row" >'+
                                '<div class="col-form-4 col-sm-6 ">'+
                                    '<label>RFC:</label>'+
                                    '<input class="form-control" maxlength="14" id="rfcEdit" name="rfc" value="'+json[i].rfc+'" placeholder="...." required="">'+
                                '</div>'+
                                '<div class="col-form-4 col-sm-6">'+
                                    '<label>Email:</label>'+
                                    '<input class="form-control" id="emailEdit" name="email" type="email" value="'+json[i].correo+'" placeholder="Email" required="">'+
                                '</div>'+
                '</div>'+
                '<div class="row">'+
                                '<div class="col-md-4 col-sm-10 offset-sm-1 offset-md-0">'+
                                    '<label class="col-form-label">Calle: </label>'+
                                    '<input type="text" name="calle" class="form-control" id="calleEdit" aria-describedby="calleHelp"  value="'+json[i].calle+'"  placeholder="" required="">'+
                                '</div>'+
                                '<div class="col-md-4 col-sm-6">'+
                                    '<label class="col-form-label">N° exterior: </label>'+
                                    '<input type="text" name="exterior" class="form-control" id="exteriorEdit" aria-describedby="exteriorHelp"  value="'+json[i].numeroExt+'" placeholder="" required="">'+
                               ' </div>'+
                                '<div class="col-md-4 col-sm-6">'+
                                    '<label class="col-form-label">N° interior: </label>'+
                                    '<input type="text" name="interior" class="form-control" id="interiorEdit" aria-describedby="interiorHelp"  value="'+json[i].numeroInt+'" placeholder="" required="">'+
                               ' </div>'+
                '</div>'+
                '<div class="row">'+
                                '<div class="col-form-4 col-sm-6" >'+
                                    '<label class="col-form-label">Estado: </label>'+
                                       '<div class="form-group" id="editarEstado">'+
                                        '<select class="custom-select" name="estado" onchange="modificarEstado()" >'+
                                            '<option value="'+json[i].idEstado+'" selected="">'+json[i].estado+'</option>'+
                                            '<option>Más estados</option>'+
                                        '</select>'+
                                    '</div>'+
                                     '</div>'+
                                '<div class="col-form-4 col-sm-6">'+
                                    '<label class="col-form-label">Municipio: </label>'+
                                    '<div class="form-group" id="editarMunicipio">'+
                                        '<select class="custom-select" name="municipio">'+
                                            '<option value="'+json[i].idMunicipio+'" selected="">'+json[i].municipio+'</option>'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                '<div class="row">'+
                    '<div class="col-form-4 col-sm-6">'+
                                    '<label class="col-form-label">Localidad: </label>'+
                                    '<div class="form-group" id="editarLocalidad">'+
                                        '<select class="custom-select" name="localidad">'+
                                            '<option value="'+json[i].idLocalidad+'" selected="">'+json[i].localidad+'</option>'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                    '<div class="col-form-4 col-sm-6">'+
                                    '<label class="col-form-label">Colonia: </label>'+
                                    '<input type="text" name="colonia" class="form-control" id="coloniaEdit" aria-describedby="coloniaHelp"  value="'+json[i].colonia+'"   placeholder="" required="">'+
                               ' </div>'+
               ' </div>'+
                '<div class="row">'+
                                '<div class="col-form-4 col-sm-6">'+
                                    '<label class="col-form-label">Código Postal: </label>'+
                                    '<input type="text" name="cp" class="form-control" id="cpEdit" aria-describedby="otraColoniaHelp" value="'+json[i].codigoPostal+'"   placeholder="" required="">'+
                                '</div>'+
               '</div>';
            }
            out += "</form>";
            document.getElementById("editarProveedor").innerHTML = out;
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


function getDataProvider(){
if(validarFormulario()){
  var form = $("#form-provider").serialize();
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
                    title: 'El proveedor ha sido guardado',
                    showConfirmButton: false,
                    timer: 2000
            });
            $(document).ready( function(){
            cargarProveedores();
            });
          }).fail(function(){
            Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: '¡Error al guardar Proveedor!'
        });
          });
          $("#cerrar").trigger("click");
          $('#form-provider').trigger("reset");
}

  }

function getDataProviderEdit(){
  if(validarFormularioEditar()){
var form = $("#form-provider-edit").serialize();
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
                  title: 'El proveedor ha sido actualizado',
                  showConfirmButton: false,
                  timer: 2000
          });
          $(document).ready( function(){
          cargarProveedores();
          });
        }).fail(function(){
          Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: '¡Error al actualizar Proveedor!'
      });
        });
        $("#cerrarEdit").trigger("click");
        $('#form-provider-edit').trigger("reset");
      }
    }

function eliminarProveedor(id) { //Elimina al empleado seleccionado+
  console.log("se elimino");
 Swal.fire({ //Muestra un mensaje de alerta
  title: '¿Estas seguro que quieres eliminar al empleado?',
  type: 'warning',
  showCancelButton: true,
  cancelButtonText: 'Cancelar',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sí, eliminar'
}).then((result) => { // al responde sí, se eliminara el empleado y al darle cancelar no se eliminara
  if (result.value) {
        $.ajax({
          url:"../controller/global-controller.php?eliminarProveedor="+id,
          method: "GET",
          dataType: "text",
       success: function (datos){
         $(document).ready( function(){
         cargarProveedores();
         });
        },error: function (datos){
       }
    });
    $(document).ready( function(){
    cargarProveedores();
    });
    Swal.fire(
      '¡Eliminado!',
      'El proveedor ha sido eliminado',
      'success'
    );

  }
});
}
//**********************************TERMINAN FUNCIONES DE PROVEEDORES****************************************
