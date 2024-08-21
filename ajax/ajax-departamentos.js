function cargarDepartamentos(){
    $.ajax({
        url: "http://localhost:8081/Covan/controller/global-controller.php",
        type: "POST",
        data: 'departamentos=1',
        dataType: "json",
        success: function (json) {
            var i;
            var out = "<tr>";
            for (i = 0; i < json.length; i++) {
                out += "<td>" +
                        json[i].departamento+
                       "</td>" +
                       "<td>"+
                        json[i].descripcion+
                        "</td>" +
           "<td height='5' width='5' title='Eliminar registro'><button class='dropdown-item' type='button' onClick='eliminarDepartamento("+ json[i].idDepartamento+")'><i class='fa fa-trash' style='color: red'></i></button></td>"+
           "</td></tr>";
            }
            out += "<tr>";
            document.getElementById("departamentos").innerHTML = out;
        }
    }
  ).fail( function(){
    Swal.fire({
type: 'error',
title: 'Oops...',
text: '¡Error al consultar departamentos!'
});
  });
}

function comboDepartamentos(){
 $.ajax({
        url:"../controller/global-controller.php?departamentos",
        type: "POST",
        data: 'departamentos=1',
        dataType: "json",
        success: function (json){
        var option ="<select class='custom-select' name='departamento' id='idDepartamento'> \n\
        <option selected=''>--SELECCIONE--</option>";
        for (var i in json){
            option +="<option  value="+json[i].idDepartamento+" >"+json[i].departamento+"</option> ";
        }
     option +="</select>";
     document.getElementById("comboDepartamentos").innerHTML=option;
        }
    });
}

function insertarDepartamento(){
  var departamento=$("#nombreDepartamento").val();
  var descripcion=$("#descripcionDep").val();
  $.ajax({
         url: "../controller/global-controller.php",
         type:'POST',
         data: 'departamento='+departamento+'&descripcion='+descripcion+'&agregarDepartamento=1',
         dataType: 'text',
         success: function(text){
           if(text=="insertado"){
             $(document).ready( function(){
             cargarDepartamentos();
             });
             Swal.fire({
             position: 'center',
                     type: 'success',
                     title: 'El nuevo Departamento ha sido guardado',
                     showConfirmButton: false,
                     timer: 2000
             });
           }else{
          Swal.fire({
         type: 'error',
         title: 'Oops...',
         text: '¡No se pudo insertar el nuevo Departamento!'
         });
           }
         }
  });
  $("#cerrarDep").trigger("click");
  $('#nombreDepartamento').val('');
    $('#descripcionDep').val('');
}

function eliminarDepartamento(id) { //Elimina al empleado seleccionado+
 Swal.fire({ //Muestra un mensaje de alerta
  title: '¿Estas seguro que quieres eliminar el departamento?',
  type: 'warning',
  showCancelButton: true,
  cancelButtonText: 'Cancelar',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sí, eliminar'
}).then((result) => { // al responde sí, se eliminara el empleado y al darle cancelar no se eliminara
  if (result.value) {
        $.ajax({
          url:"../controller/global-controller.php",
          data: 'eliminarDepartamento='+id,
          method: "POST",
          dataType: "text",
          success: function (text){
        if(text=='eliminado'){
          $(document).ready( function(){
          cargarDepartamentos();
          });
          Swal.fire({
          position: 'center',
                  type: 'success',
                  title: 'Eliminado',
                  showConfirmButton: false,
                  timer: 2000
          });
        }else {
          Swal.fire({
         type: 'error',
         title: 'Oops...',
         text: '¡No se pudo realizar la acción!'
         });
        }
        }
    });
  }
});
}

function cargarCategorias(){
    $.ajax({
        url: "http://localhost:8081/Covan/controller/global-controller.php",
        type: "POST",
        data:'categorias=1',
        dataType: "json",
        success: function (json) {
            var i;
            var out = "<tr>";
            for (i = 0; i < json.length; i++) {
                out += "<td>" +
                        json[i].categoria+
                       "</td>" +
                       "<td>" +
                       json[i].descripcion+
                       "</td>"+
           "<td height='5' width='5' title='Eliminar registro'><button class='dropdown-item' type='button' data-toggle='modal' onClick='eliminarCategoria("+ json[i].idCategoria+")'><i class='fa fa-trash' style='color: red'></i></button></td>"+
           "<td height='5' width='5' title='Modificar información'><button class='dropdown-item' type='button' data-toggle='modal' onClick='cargarCategoria("+ json[i].idCategoria+")' data-target='#actualizarCategoria'><i class='fa fa-edit' style='color: #28a745'></i></button></td>"+
           "</td></tr>";
            }
            out += "<tr>";
            document.getElementById("categorias").innerHTML = out;
        }
    }
  ).fail( function(){
    Swal.fire({
type: 'error',
title: 'Oops...',
text: '¡Error al consultar categorias!'
});
  });
}

function insertarCategoria(){
  var departamento=$("#idDepartamento").val();
  var clave=$("#clave").val();
  var categoria=$("#nombreCategoria").val();
  var descripcion=$("#descripcionCat").val();
  $.ajax({
         url: "../controller/global-controller.php",
         type:'POST',
         data: 'idDepartamento='+departamento+'&clave='+clave+'&categoria='+categoria+'&descripcion='+descripcion+'&insertarCategoria',
         dataType: 'text',
         success: function(text){
           if(text=="insertado"){
             $(document).ready( function(){
             cargarCategorias();
             });
             Swal.fire({
             position: 'center',
                     type: 'success',
                     title: 'La nueva categoria ha sido guardada',
                     showConfirmButton: false,
                     timer: 2000
             });
           }else{
          Swal.fire({
         type: 'error',
         title: 'Oops...',
         text: '¡No se pudo insertar la nueva Categoria!'
         });
           }
         }
  });
  $("#cerrarCat").trigger("click");
  $("#idDepartamento").val('');
  $("#clave").val('');
  $("#nombreCategoria").val('');
  $("#descripcionCat").val('');
}

function cargarCategoria(id){
        $.ajax({
        url: "../controller/global-controller.php",
        type: "POST",
        data: "categoria="+id,
        dataType: "json",
        success: function (json) {
            var i;
            var out ='<div class="row">';
            for (i in json) {
                out +='<div class="col-md-12 col-sm-12">'+
                    '<label class="col-form-label">Departamento: </label>'+
                      '<input type="text" name="dep"  value="'+json[i].idDepartamento+'" class="form-control" id="dep" aria-describedby="categoriaHelp" placeholder="" disabled>'+
                  '</div>'+
                  '<div class="col-md-12 col-sm-12">'+
                      '<label class="col-form-label">Clave: </label>'+
                      '<input type="text" name="claveEdit"  value="'+json[i].idCategoria+'"  class="form-control" id="idC" aria-describedby="categoriaHelp" placeholder="" disabled>'+
                  '</div>'+
                    '<div class="col-md-12 col-sm-12">'+
                        '<label class="col-form-label">Nombre de categoria: </label>'+
                        '<input type="text" name="cat"  value="'+json[i].categoria+'" class="form-control" id="catEdit" aria-describedby="categoriaHelp" placeholder="" required="">'+
                    '</div>'+
                    '<div class="col-md-12 col-sm-12">'+
                        '<label class="col-form-label">Descripción:</label>'+
                        '<textarea type="text" name="desCat"  value="'+json[i].descripcion+'" class="form-control" id="desCatEdit" aria-describedby="desCategoriaHelp" placeholder="" required=""></textarea>'+
                    '</div>';
            }
            out += "</div>";
            document.getElementById("editarCategoria").innerHTML = out;
        }
    }).fail(function(){
      $("#cerrarCat").trigger("click");
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: '¡No se pudo consultar información!'
      });
    });
}
function editarCategoria(){
  var id=$("#idC").val();
  var cat=$("#catEdit").val();
  var des=$("#desCatEdit").val();
  $.ajax({
         url: "../controller/global-controller.php",
         type:'POST',
         data: '&clave='+id+'&categoria='+cat+'&descripcion='+des+'&editarCategoria',
         dataType: 'text',
         success: function(text){
           if(text=="[]success"){
             $(document).ready( function(){
             cargarCategorias();
             });
             Swal.fire({
             position: 'center',
                     type: 'success',
                     title: 'La información ha sido actualizada',
                     showConfirmButton: false,
                     timer: 2000
             });
           }else{
          Swal.fire({
         type: 'error',
         title: 'Oops...',
         text: '¡No se pudo realizar la acción!'
         });
           }
         }
  });
}

function eliminarCategoria(id) { //Elimina al empleado seleccionado+
 Swal.fire({ //Muestra un mensaje de alerta
  title: '¿Estas seguro que quieres eliminar la categoria?',
  type: 'warning',
  showCancelButton: true,
  cancelButtonText: 'Cancelar',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sí, eliminar'
}).then((result) => { // al responde sí, se eliminara el empleado y al darle cancelar no se eliminara
  if (result.value) {
        $.ajax({
          url:"../controller/global-controller.php",
          data: 'eliminarCategoria='+id,
          method: "POST",
          dataType: "text",
          success: function (text){
        if(text=='eliminado'){
          $(document).ready( function(){
          cargarCategorias();
          });
          Swal.fire({
          position: 'center',
                  type: 'success',
                  title: 'Eliminado',
                  showConfirmButton: false,
                  timer: 2000
          });
        }else {
          Swal.fire({
         type: 'error',
         title: 'Oops...',
         text: '¡No se pudo realizar la acción!'
         });
        }
        }
    });
  }
});
}
