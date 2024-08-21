$(document).ready(function () {
  consultarProductos();
});

function consultarProductos(){
   $.ajax({
     url: "http://localhost:8081/COVAN/controller/controlador-productos/controlador-productos.php?productos",
     success: function (data){
       console.log(data);
       var txt ="";
       for (var i in data) {
         txt += "<tr>\n\
         \n\<td scope='row'>" + data[i].idProducto + "</td>\n\
         \n\<td>" + data[i].productos + "</td>\n\
         \n\<td>" + data[i].descripcion + "</td>\n\
         \n\<td>" + data[i].departamento + "</td>\n\
         \n\<td>" + data[i].stock + "</td>\n\
   \n\<td><a href='#' data-toggle='modal' data-target='#exampleModalCenter'><i class='far fa-edit'></i></a></td>\n\
   \n\<td><a href=''#' data-toggle='modal' data-target='#exampleModalCenter'><i class='fas fa-trash'></i></a></td>\n\
   \n\ </tr>\n\
   ";
       }
       //console.log(txt);
       document.getElementById("producto").innerHTML = txt;
    }
   })
}
