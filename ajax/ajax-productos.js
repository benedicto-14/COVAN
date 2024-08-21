//*************************INICIAN FUNCIONES DE LA SECCIÓN PRODUCTS***********************************************
$(document).ready(function () {
  consultarProductos();
    buscarProducto();
    editarProducto();
});

function getDataProduct(){
var form = $("#form-Product").serialize();
alert(form);
        $.ajax({
        url:"http://localhost/Covan/controller/global-controller.php",
                data: form,
                method: "POST",
                success: function (datos){

                }, error: function (datos){
        }
        });
        Swal.fire({
        position: 'center',
                type: 'success',
                title: 'El proveedor ha sido guardado',
                showConfirmButton: false,
                timer: 2000
        });
        $("#cerrar").trigger("click");
        $('#form-Product').trigger("reset");
    }

function consultarProductos() {
   $.ajax({
     url: "http://localhost/Covan/controller/global-controller.php?productos",
     success: function (data){
       console.log(data);
       var txt ="";
       for (var i in data) {
         txt += "<tr>\n\
         \n\<td scope='row'>" + data[i].idProducto + "</td>\n\
         \n\<td>" + data[i].nombre + "</td>\n\
         \n\<td>" + data[i].descripcion + "</td>\n\
         \n\<td>$" + data[i].precioMenudeo + "</td>\n\
         \n\<td>" + data[i].categoria + "</td>\n\
         \n\<td>" + data[i].stock + "</td>\n\
   \n\<td><a href='#' data-toggle='modal' onClick='consultarProductos("+data[i].idProducto+")' data-target='#editProduct'><i class='far fa-edit'></i></a></td>\n\
   \n\<td><a href=''#' data-toggle='modal' data-target='#exampleModalCenter'><i class='fas fa-trash'></i></a></td>\n\
   \n\ </tr>\n\
   ";
       }
       //console.log(txt);
       document.getElementById("producto").innerHTML = txt;
    }
   })
}

function buscarProducto(){
  $(document).on('keyup', '#search', function(){
     var search = $(this).val();
     console.log(search);
     if(search!=""){
         cacharProducto(search);
     }else{
       consultarProductos();
     }
  });
}

function cacharProducto(producto){
    var pro = producto;
    $.ajax({
      url: "http://localhost/Covan/controller/global-controller.php?producto="+pro,
      success: function (data){
        var txt ="";
        for (var i in data) {
          txt += "<tr>\n\
          \n\<td scope='row'>" + data[i].idProducto + "</td>\n\
          \n\<td>" + data[i].nombre + "</td>\n\
          \n\<td>" + data[i].descripcion + "</td>\n\
          \n\<td>$" + data[i].precioMenudeo + "</td>\n\
          \n\<td>" + data[i].categoria + "</td>\n\
          \n\<td>" + data[i].stock + "</td>\n\
          \n\<td><a href='#' data-toggle='modal' onClick='consultarProductos("+data[i].idProducto+")' data-target='#editProduct'><i class='far fa-edit'></i></a></td>\n\
          \n\<td><a href=''#' data-toggle='modal' data-target='#exampleModalCenter'><i class='fas fa-trash'></i></a></td>\n\
          \n\ </tr>\n\
    ";
      }
      document.getElementById("producto").innerHTML = txt;
   }
 })
}

function editarProducto(producto){
  var pro =producto;
    $.ajax({
      url: "http://localhost/Covan/controller/global-controller.php?producto="+pro,
      type: "GET",
      success: function (data){
        var txt ='<form method="POST" id="form-product-edit">';
        for (var i in data) {
          txt += "<input type='hidden' value=' "+data[i].idProducto+"' name='updateProduct'>\n\
          \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>codigo de barras</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='number' class='form-control' name='serie' value=' "+data[i].serie+"' placeholder='S/N'>\n\
              \n\</div>\n\
            \n\</div>\n\
            \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>Nombre</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='text' class='form-control' name='producto' value=' "+data[i].productos+"' placeholder='nombre'>\n\
              \n\</div>\n\
            \n\</div>\n\
            \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>precio minimo</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='number' class='form-control' name='preciomin' value=' "+data[i].precioMinimo+"' placeholder='precio minimo'>\n\
              \n\</div>\n\
            \n\</div>\n\
            \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>Precio maximo</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='number' class='form-control' name='preciomax' value=' "+data[i].precioMaximo+"' placeholder='precio maximo'>\n\
              \n\</div>\n\
            \n\</div>\n\
            \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>Descripción</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='text' class='form-control' name='descripcion' value=' "+data[i].descripcion+"' placeholder='descripción'>\n\
              \n\</div>\n\
            \n\</div>\n\
            \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>Stock</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='number' class='form-control' name='stock' value=' "+data[i].stock+"' placeholder='stock'>\n\
              \n\</div>\n\
            \n\</div>\n\
            \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>Departamento</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='text' class='form-control' name='departamento' value=' "+data[i].departamento+"' placeholder='departamento'>\n\
              \n\</div>\n\
            \n\</div>\n\
            \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>categoria</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='text' class='form-control' name='categoria' value=' "+data[i].categoria+"' placeholder='categoria'>\n\
              \n\</div>\n\
            \n\</div>\n\
            \n\<div class='form-group row'>\n\
              \n\<label for='inputEmail3' class='col-sm-2 col-form-label'>tipo medida</label>\n\
              \n\<div class='col-sm-10'>\n\
                \n\<input type='text' class='form-control' name='medida' value=' "+data[i].medida+"' placeholder='tipo medida'>\n\
              \n\</div>\n\
            \n\</div>\n\
          ";
      }
      document.getElementById("editarProducto").innerHTML = txt;
   }
 })
}

function getDataProviderEdit(){
var form = $("#form-product-edit").serialize();
console.log(form);
        $.ajax({
        url:"http://localhost/COVAN/controller/controlador-productos/controlador-productos.php",
                data: form,
                method: "POST",
                success: function (datos){

                }, error: function (datos){
        }
        }); Swal.fire({
        position: 'center',
                type: 'success',
                title: 'El proveedor ha sido actualizado',
                showConfirmButton: false,
                timer: 2000
        });
        $('#form-product-edit').trigger("reset");
    }


    function consultarDepartamentos(){
     $.ajax({
            url:"http://localhost/Covan/controller/global-controller.php?departamento",
            method: "GET",
            success: function (data){
            var option ="<select class='custom-select' name='departamento' id='idDepartamento' onchange='consultarCategorias();'><option selected=''>Seleccione...</option>";
            for (var i in data){
                option +="<option  value="+data[i].idDepartamento+" >"+data[i].departamento+"</option> ";
            }
         option +="</select>";
         document.getElementById("departamentos").innerHTML=option;
            }
        });
    }




    function consultarCategorias(){
     var idDepartamento= document.getElementById("idDepartamento").value;
     $.ajax({
            url:"http://localhost:/Covan/controller/global-controller.php?categoria="+idDepartamento,
            method: "GET",
            success: function (data){
            var option ="<select class='custom-select' name='categoria' id='idCategoria' onClick='mostrar();'><option selected=''>Seleccione...</option>";
            for (var i in data){
                option +="<option  value="+data[i].idCategoria+" >"+data[i].categoria+"</option> ";
            }
         option +="</select>";
         document.getElementById("categorias").innerHTML=option;
            }
        });
    }
function mostrar(){
     var idCategoria= document.getElementById("idCategoria").value;
     console.log(idCategoria);
    if(idCategoria==50202200){
      $("#gradosAlcohol").show();
    }else {
      $("#gradosAlcohol").hide();
    }
}



function consultarUnidadMedida(){
 $.ajax({
        url:"http://localhost/Covan/controller/global-controller.php?medida",
        method: "GET",
        success: function (data){
        var option ="<select class='custom-select' name='medida' id='idMedida'><option selected=''>Seleccione...</option>";
        for (var i in data){
            option +="<option  value="+data[i].idMedida+" >"+data[i].medida+"</option> ";
        }
     option +="</select>";
     document.getElementById("uniMedida").innerHTML=option;
        }
    });
}


//**********************************TERMINAN FUNCIONES DE PRODUCTS********************************************************
