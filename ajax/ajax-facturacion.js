$(document).ready(function () {

   
});



function buscarCliente(){
//    var nombre="bryan";
//    console.log(nombre);
//   $('#nombreC').val(nombre);
var nombre = $("#nombre").val();
var paterno = $("#paterno").val();
var materno = $("#materno").val();
var validar = "cliente";
if(validarFormBuscarC ()){
    $.ajax({
        url:"http://localhost/COVAN/controller/global-controller.php",
        method: "POST",
        data:{
         nombreCF:nombre,
         paternoCF:paterno,
         maternoCF:materno
        },
            beforeSend: function () {
                mostrarLoading();
              
            },
        success: function (data){
                cerrarloading();
        for (var i in data) {
            validar=data[i].nombre; 
          $('#nombreC').val(data[i].nombre);
          $('#apellidoC').val(data[i].apellidoPaterno);
          $('#rfcC').val(data[i].rfc);  
          
          $("#cancelarB").trigger("click");
          $('#formConsultarCliente').trigger("reset");
            }
            if(validar=="cliente"){
                 Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: '¡No se tiene al cliente registrado!'
                    });
            }
        },
        error: function (data){
            
        }
    });
    
}

 
    


}
function cerrarloading(){
   $("#loadingBoton").css("display", "block"); //Mostrar
   $("#loadingBoton2").css("display", "none"); //Ocultar

    
}

function mostrarLoading(){
    $("#loadingBoton").css("display", "none");
    $("#loadingBoton2").css("display", "block");
    
    
}

function validarFormBuscarC (){
    if($("#nombre").val() == ""){
        alert("El campo NOMBRE no puede estar vacío.");
        $("#nombre").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#paterno").val() == ""){
        alert("El campo PATERNO no puede estar vacío.");
        $("#paterno").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#materno").val() == ""){
        alert("El campo MATERNO no puede estar vacío.");
        $("#materno").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    return true;
}

function buscarProductos(){
    var p = $('#productos').val();
    if(p != ""){
        console.log('entro al ajax');
        
        
    $.ajax({
        url:"http://localhost/COVAN/controller/global-controller.php",
        method: "POST",
        data:{
         idByProductosF:p
        },
            beforeSend: function () {
               mostrarLoading2();
              
            },
        success: function (data){
            var txt ="";
                cerrarloading2();
                console.log(data);
                
        for (var i in data) {
           var validarDatos = data[i].Nombre; 
            }
            if(validarDatos == null){
                 Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: '¡No se encontraron productos!'
                    });
            }else{
           for (var i in data) {
            var catidad,iva,ieps,subtotal;   
           txt+='\n\
        <tr>\n\
        <td>'+data[i].cantidad+'</td>\n\
        <td>'+data[i].idMedida+'</td>\n\
        <td>'+data[i].idCategoria+'</td>\n\
        <td>'+data[i].iva+'</td>\n\
        <td>'+data[i].ieps+'</td>\n\
        <td>'+data[i].subTotal+'</td>\n\
        <td>'+data[i].subTotal+'</td>\n\
      </tr>';    
            }
          $("#cancelarP").trigger("click");
          $('#productos').val("");
          
                
            }
        },
        error: function (data){
            
        }
    });
    
}else{
        alert('El campo no debe de estar vacío');
      
}
  
}

function cerrarloading2(){
   $("#loadingBoton3").css("display", "block"); 
   $("#loadingBoton4").css("display", "none"); 

    
}

function mostrarLoading2(){
    $("#loadingBoton3").css("display", "none");
    $("#loadingBoton4").css("display", "block");
    
    
}

function imprimir(id){
    
    console.log('hola');
    
    
  var data = document.getElementById(id);
  var ventimp = window.open('', '');
  ventimp.document.write( data.innerHTML );
  ventimp.document.close();
//   var css = ventimp.document.createElement("link");
//    css.setAttribute("href", "../assets/css/ticket.css");
//    css.setAttribute("rel", "stylesheet");
//    css.setAttribute("type", "text/css");
//    ventimp.document.head.appendChild(css);
//  
// ventimp.print();
// ventimp.close();
    
    
    /* PRINT */
  


/* END PRINT */
    
//    window.print();
//    $("contenedor").css("display", "block");
//    $("#ticket").css("display", "none");
//    var ficha = document.getElementById(id);
//	  var ventimp = window.open(' ', 'popimpr');
//	  ventimp.document.write( ficha.innerHTML );
//	  ventimp.document.close();
//	  ventimp.print( );
//	  ventimp.close();
    
}

//function imprimir(id){
//    var data = document.getElementById(id);
//  var ventana = window.open('', 'PRINT', '');
//  ventana.document.write('<html><head><title>' + 'Ticket' + '</title>');
//  ventana.document.write('</head><body >');
//  ventana.document.write(data.innerHTML);
//  ventana.document.write('</body></html>');
//  ventana.document.close();
//  ventana.print();
//  ventana.close();
//    window.print();
//}

//function imprimir() {
//     var contenido= document.getElementById('ticket').innerHTML;
//     var contenidoOriginal= document.body.innerHTML;
//
//     document.body.innerHTML = contenido;
//
//     window.print();
//
//     document.body.innerHTML = contenidoOriginal;
//}






 