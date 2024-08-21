$(document).ready(function () {
    busquedaCambio();
    consultarProductosMasVendidos();
    buscarProductoVenta();
    mostrarSelectProveedor();
    buscarCompraGeneralbyProveedor();
});
//--------------------------------------------------------------------------------------------------------------------------------------------------------->
//Muestra todas las ventas realizadas de la base de datos en una tabla.
function mostrarCompraGeneralC(mostrar) { 
//    Mediante AJAX se realiza la petición al controlador para obtener los datos de la BD.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?productosCompras=" + mostrar,
        //Método de envio.
        method: "GET",
        beforeSend: function () {
            //Se muestra una pantalla de carga de datos.
            mostrarSpinner();
        },
        success: function (data) {
            //Se oculta la pantalla de carga
            ocultarSpinner();
            var txt = "";
            txt += "";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) { 
                txt += " \n\
      <td>" + data[i].proveedor + "</td>\n\
      \n\<td> $" + data[i].totalCompra + "</td>\n\
      \n\<td>" + data[i].fecha + "</td>\n\
      \n\<td>" + data[i].hora + "</td>\n\
      \n\<td height='10' width='10'><button class='dropdown-item' type='button' id='visualizar' data-toggle='modal' data-target='#ModalVisualizarProductos' onclick='mostarProductobyId(" + data[i].idCompraProveedor + ")' ><i class='fas fa-eye' style='color: #002752'></i></button></td>\n\
      \n\</td><td height='10' width='10'><button class='dropdown-item' id='eliminar' type='button' onclick='eliminar(" + data[i].idCompraProveedor + ")'><i class='fas fa-trash' style='color: red' ></i></button></td>\n\
       </tr>";
            }
            //Se inyecya el codigo con los datos en la interfaz.
            document.getElementById("tbodyProductos").innerHTML = txt; 
        }
    });
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función se elimina la compra selecionada.
function eliminar(id) {
    //Se muestra un mensaje de confirmación
    Swal.fire({
        title: '¿Está seguro que desea eliminar la compra?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar!'
    }).then((result) => {
        if (result.value) {
//    Mediante AJAX se realiza la petición al controlador enviando el id de la compra para traer la información de los productos comprados.
            $.ajax({
                url: "http://localhost/COVAN/controller/global-controller.php?idCompras=" + id,
                method: "GET",
                beforeSend: function () {
                },
                success: function (data) {
                    var txt = "";
                    txt += "";
                    //Con este ciclo se llenan los datos con HTML.
                    for (var i in data) { 
//    Mediante AJAX se realiza la petición al controlador enviando datos para reducir el stock de los productos.
                        $.ajax({
                            url: "http://localhost/COVAN/controller/global-controller.php?",
                            //Método de envio.
                            method: "POST",
                            data: {
                                'idProductoC': data[i].idProducto,
                                'cantidadPC': data[i].cantidad
                            },
                            beforeSend: function () {
                            },
                            success: function (data) {
                            }
                        });
                    }
                }
            });
            //Se envia el id de la compra para eliminarla.
            eliminarRegistrosProductos(id);
        }
    });
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
//En esta función elimina la compra realizada.
function eliminarRegistrosProductos(id) {
    // Mediante AJAX se realiza la petición al controlador enviando el id de la compra para eliminarla los productos de la BD.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?",
        //Método de envio.
        method: "POST",
        data: {
            'idCompraProductosC': id
        },
        beforeSend: function () {
        },
        success: function (data) {
        }
    });
    //Se hace un llamado a la función para eliminar la compra general.
    eliminarRegistroGeneral(id);
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
//Con esta función se elimina la compra general.
function eliminarRegistroGeneral(id) {
    // Mediante AJAX se realiza la petición al controlador enviando el id de la compra para eliminarla la compra general de la BD.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?",
        //Método de envio.
        method: "POST",
        data: {
            'idCompraGeneral': id
        },
        beforeSend: function () {
        },
        success: function (data) {
        }, error: function (datos) {
            $(document).ready(function () {
                //Se manda a llamar la función
                busquedaCambio();
            });
        }
    });
     //Se muestra un mensaje de alerta.
            Swal.fire(
                    '¡Compra eliminada!',
                    'Su compra ha sido eliminada.',
                    'success'
                    );
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//En esta función muestra a los productos por su id.
function mostarProductobyId(id) {
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idCompras=" + id,
        method: "GET",
        beforeSend: function () {

//                mostrarSpinner();



        },
        success: function (data) {
            console.log(data);
//            cerrarSpinner();
            var txt = "";
            txt += "";
            for (var i in data) { //Con este ciclo se llenan los datos con HTML
                txt += " \n\
      <td>" + data[i].nombre + "</td>\n\
      \n\<td>" + data[i].cantidad + "</td>\n\
      \n\<td> $" + data[i].costo + "</td>\n\
      \n\<td> $" + data[i].subTotal + "</td>\n\
       </tr>";
            }

            document.getElementById("ModalMostrarProductos").innerHTML = txt; //Se inyecya el codigo con los datos en la interfaz

        }
    });

}
function mostarProductobyFecha(fecha) {
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?fechaCompras=" + fecha,
        method: "GET",
        beforeSend: function () {

//                mostrarSpinner();



        },
        success: function (data) {
            console.log(data);
//            cerrarSpinner();
            var txt = "";
            txt += "";
            for (var i in data) { //Con este ciclo se llenan los datos con HTML
                txt += " \n\
      <td>" + data[i].proveedor + "</td>\n\
      \n\<td> $" + data[i].totalCompra + "</td>\n\
      \n\<td>" + data[i].fecha + "</td>\n\
      \n\<td>" + data[i].hora + "</td>\n\
      \n\<td height='10' width='10'><button class='dropdown-item' type='button' id='visualizar' data-toggle='modal' data-target='#ModalVisualizarProductos' onclick='mostarProductobyId(" + data[i].idCompraProveedor + ")' ><i class='fas fa-eye' style='color: #002752'></i></button></td>\n\
      \n\</td><td height='10' width='10'><button class='dropdown-item' id='eliminar' type='button' onclick='eliminar(" + data[i].idCompraProveedor + ")'><i class='fas fa-trash' style='color: red' ></i></button></td>\n\
       </tr>";
            }

            document.getElementById("tbodyProductos").innerHTML = txt; //Se inyecya el codigo con los datos en la interfaz

        }
    });

}

function mostarProductobyProveedor(proveedor) {
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?proveedorCompras=" + proveedor,
        method: "GET",
        beforeSend: function () {

//                mostrarSpinner();



        },
        success: function (data) {
            console.log(data);
//            cerrarSpinner();
            var txt = "";
            txt += "";
            for (var i in data) { //Con este ciclo se llenan los datos con HTML
                txt += " \n\
      <td>" + data[i].proveedor + "</td>\n\
      \n\<td> $" + data[i].totalCompra + "</td>\n\
      \n\<td>" + data[i].fecha + "</td>\n\
      \n\<td>" + data[i].hora + "</td>\n\
      \n\<td height='10' width='10'><button class='dropdown-item' type='button' id='visualizar' data-toggle='modal' data-target='#ModalVisualizarProductos' onclick='mostarProductobyId(" + data[i].idCompraProveedor + ")' ><i class='fas fa-eye' style='color: #002752'></i></button></td>\n\
      \n\</td><td height='10' width='10'><button class='dropdown-item' id='eliminar' type='button' onclick='eliminar(" + data[i].idCompraProveedor + ")'><i class='fas fa-trash' style='color: red' ></i></button></td>\n\
       </tr>";
            }

            document.getElementById("tbodyProductos").innerHTML = txt; //Se inyecya el codigo con los datos en la interfaz

        }
    });

}

function buscarCompraGeneralbyProveedor() {
    console.log('keyup');
    $(document).on('keyup', '#inputBuscador', function () {
        var buscar = $(this).val();
        if (buscar != "") {
            mostarProductobyProveedor(buscar);
        } else {
            var mostrar = "general";
            mostrarCompraGeneralC(mostrar);
        }
    });
}

function busquedaCambio() {
    var mostrar;

    var valor;
    valor = $('#busquedaSel').val();
    if (valor == 0) {
        mostrar = "general";
        mostrarCompraGeneralC(mostrar);


    } else if (valor == 1) {
        $("#inputFecha").prop('disabled', true);
        $("#inputBuscador").prop('disabled', false);
        $('#inputBuscador').focus();
        $("#inputFecha").val("");
        filtro = "proveedor";
    } else if (valor == 2) {
        $("#inputBuscador").val("");
        $("#inputFecha").prop('disabled', false);
        $("#inputBuscador").prop('disabled', true);
        $('#inputFecha').focus();
        filtro = "fecha";

    } else if (valor == 3) {
        $("#inputBuscador").val("");
        $("#inputFecha").val("");
        $("#inputFecha").prop('disabled', true);
        $("#inputBuscador").prop('disabled', true);
        mostrar = "general";
        mostrarCompraGeneralC(mostrar);

    }

}




function validar() {


}
function buscarDatos() {
    var mostrar;

    if (filtro == "fecha") {
        if ($('#inputFecha').val() == "") {
            alert("Debe ingresar una fecha para la busqueda");
            $("#inputFecha").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.

        } else {


            mostrar = $('#inputFecha').val();
            console.log(mostrar);
            mostarProductobyFecha(mostrar);
        }

    }
//        else if(filtro=="proveedor"){
//            if($('#inputBuscador').val()==""){
//        alert("El campo BUSCADOR no puede estar vacío.");
//        $("#inputBuscador").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
//        return false;
//    }
//            
//            
//        mostrar = $('#inputBuscador').val();
//                    console.log(mostrar);
//                    // mostarProductobyProveedor(mostrar);
//        }


}


//------------------------------------------------------>



var arrayProducts = new Array();
var txt;
var totalVenta;
var cambioVenta;
var iva;
var ieps;
var subTotalVenta;

class productosVentas {
    constructor(producto, cantidad, subTotal, iva, totalIva, ieps, totalIeps, total, precio) {
        this.producto = producto;
        this.cantidad = cantidad;
        this.subTotal = subTotal;
        this.iva = iva;
        this.totalIva = totalIva;
        this.ieps = ieps;
        this.totalIeps = totalIeps;
        this.total = total;
        this.precio = precio;

    }
}

function consultarProductosMasVendidos() {
    $.ajax({
        url: "http://localhost/COVAN/controller/class/class-ventas.php?productos",
        success: function (data) {
//       console.log(data);
            var cpv = "";
            for (var i in data) {
                cpv += "<div id='tamCard' class='col-lg-6 col-md-6 col-sm-6'>\n\
                  \n\<div id='cardP' class='card border-secondary mb-3' style='max-width: 18rem;'>\n\
                      \n\<div class='card-header'>" + data[i].nombre + "</div>\n\
                      \n\<div  id='cardB'  class='card-body text-secondary'>\n\
                         \n\<p class='card-text'>" + data[i].descripcion + "</p>\n\
                         \n\<div class='overlay'>\n\
                            \n\<div class='addIcon'>\n\
                              \n\<a onclick=cargarProducto(" + data[i].idProducto + ") href='#'><i id='cardAdd' class='fas fa-plus-circle fa-2x'></i></a>\n\
                            \n\</div>\n\
                         \n\</div>\n\
                      \n\</div>\n\
                  \n\</div>\n\
            \n\</div>\n\
          ";
            }
            //console.log(txt);
            document.getElementById("productos").innerHTML = cpv;
        }
    })
}

function consultarProductoInput(producto) {
    var pro = producto;
    $.ajax({
        url: "http://localhost/COVAN/controller/class/class-ventas.php?producto=" + pro,
        beforeSend: function () {

        },
        success: function (data) {

            var cpro = "";
            for (var i in data) {
                //console.log(data);
                cpro += "<div id='tamCard' class='col-lg-6 col-md-6 col-sm-6'>\n\
                 \n\<div id='cardP' class='card border-secondary mb-3' style='max-width: 18rem;'>\n\
                     \n\<div class='card-header'>" + data[i].nombre + "</div>\n\
                     \n\<div  id='cardB'  class='card-body text-secondary'>\n\
                        \n\<p class='card-text'>" + data[i].descripcion + "</p>\n\
                        \n\<div class='overlay'>\n\
                           \n\<div class='addIcon'>\n\
                             \n\<a id='add' onclick=cargarProducto(" + data[i].idProducto + ") href='#'><i id='cardAdd' class='fas fa-plus-circle fa-2x'></i></a>\n\
                           \n\</div>\n\
                        \n\</div>\n\
                     \n\</div>\n\
                 \n\</div>\n\
               \n\</div>\n\
            ";
            }
            document.getElementById("productos").innerHTML = cpro;
        }
    })
}

function buscarProductoVenta() {
    $("#buscar").focus();

    $(document).on('keyup', '#buscar', function () {
        var buscar = $(this).val();
        if (buscar != "") {
            consultarProductoInput(buscar);
        } else {
            consultarProductosMasVendidos();
        }
    });
}

function cargarProducto(producto) {
    if (arrayProducts != 0) {
        var estado = false;
        for (var indice in arrayProducts) {
            var pro = arrayProducts[indice].producto;
            if (pro == producto) {
                arrayProducts[indice].cantidad += 1;
                estado = true;
            }
        }
        if (estado != true) {
            arrayProducts.push(new productosVentas(producto, 1, 0, 0, 0, 0, 0, 0, 0));
        }
    } else {
        arrayProducts.push(new productosVentas(producto, 1, 0, 0, 0, 0, 0, 0, 0));
    }
//   console.log(arrayProducts);
    txt = "";
    cargarProductosVentas(0);
    $("#buscar").val("");
    $("#buscar").focus();
    consultarProductosMasVendidos();
}

function cargarProductosVentas(indice) {
    if (indice < arrayProducts.length) {
        var pro = arrayProducts[indice].producto;
        var cant = arrayProducts[indice].cantidad;
        var precio = arrayProducts[indice].precio;
        var subTotal;
        $.ajax({
            url: "http://localhost/COVAN/controller/class/class-ventas.php?addPro=" + pro,
            success: function (data) {
                //console.log(data);
                for (var a in data) {
                    //subTotal = arrayProducts[indice].getSubTotal(data[a].precioMaximo, cant);
                    subTotal = parseFloat(precio * cant).toFixed(2);
                    arrayProducts[indice].iva = Number(data[a].iva);
                    arrayProducts[indice].ieps = Number(data[a].ieps);
                    arrayProducts[indice].total = Number(subTotal);

                    /*txt += "<h1>"+data[a].productos+"</h1>";*/
                    txt += "<tr id='resultados' >\n\
                   \n\<th scope='row'>" + data[a].nombre + "</th>\n\
                   \n\<td>" + data[a].descripcion + "</td>\n\
                   \n\<td><input class='border' id='" + data[a].idProducto + "' type='number' value=" + cant + " name='' onchange=cantidadProducto(" + data[a].idProducto + ")></td>\n\
                   \n\<td><input class='border' id='" + data[a].idProducto + "1' type='number' value=" + precio + " name='' onchange='cambiarPrecio(" + data[a].idProducto + "," + data[a].idProducto + "1);' ></td>\n\
                   \n\<td>" + subTotal + "</td>\n\
                   \n\<td>\n\
                       \n\<a onclick=removerProductoVentas(" + data[a].idProducto + ")><i class='fas fa-trash' style='color: #ff6b6b;'></i></a>\n\
                   \n\</td>\n\
               \n\</tr>\n\
               ";
                }
                document.getElementById("productoVenta").innerHTML = txt;
                cargarProductosVentas(indice + 1);
            }
        })
    }
    if (arrayProducts.length == 0) {
        txt += "<tr> <td class='text-muted' colspan='6'><em>Agrega un producto.</em></td></tr>";
        document.getElementById("productoVenta").innerHTML = txt;
    }
    totalVentaProductos();
    calcularVentaIva();
    calcularVentaIeps();
    calcularVentaSinImpuestos();
}

function cantidadProducto(pro) {
    //console.log(pro);
    var cantidad = parseFloat(document.getElementById(pro).value).toFixed(3);
    //console.log(cantidad);
    for (var indice in arrayProducts) {
        var id = arrayProducts[indice].producto;
        if (id == pro) {
            arrayProducts[indice].cantidad = Number(cantidad);
            //console.log(arrayProducts);
        }
    }
    txt = "";
    cargarProductosVentas(0);
}
function cambiarPrecio(idP, pro) {
    console.log(idP, pro);
    var precio = parseFloat(document.getElementById(pro).value).toFixed(2);
    console.log(precio);

    for (var indice in arrayProducts) {
        var id = arrayProducts[indice].producto;
        if (id == idP) {
            arrayProducts[indice].precio = Number(precio);
            //console.log(arrayProducts);
        }
    }
    txt = "";
    cargarProductosVentas(0);
}

function removerProductoVentas(pro) {
    for (var indice in arrayProducts) {
        var id = arrayProducts[indice].producto;
        if (id == pro) {
            var index = indice;
            arrayProducts.splice(index, 1);
            //console.log(arrayProducts);
        }
    }
    txt = "";
    cargarProductosVentas(0);
}

function totalVentaProductos() {
    totalVenta = 0;
    if (arrayProducts.length != 0) {
        for (var a in arrayProducts) {
            totalVenta += arrayProducts[a].total;
        }
        document.getElementById("total").innerHTML = "<h3>" + Number(totalVenta) + "</h3>";
    } else {
        document.getElementById("total").innerHTML = "<h3>00.00</h3>";
    }
}

function calcularIvaByProducto() {
    for (var a in arrayProducts) {
        var acu = 0;
        acu = arrayProducts[a].total * arrayProducts[a].iva / 100;
        //console.log(Number(acu.toFixed(6)));
        arrayProducts[a].totalIva = Number(acu.toFixed(6));
    }
}

function calcularVentaIva() {
    if (arrayProducts.length != 0) {
        calcularIvaByProducto();
        var acu = 0;
        for (var a in arrayProducts) {
            acu += arrayProducts[a].totalIva;
            //console.log(acu);
        }
        iva = acu.toFixed(6);
        //console.log(iva);
        //document.getElementById("iva").innerHTML = "<h6>"+Number(iva)+"</h6>";
    } else {
        //document.getElementById("iva").innerHTML = "<h6>00.00</h6>";
    }
}

function calcularIepsByProducto() {
    for (var a in arrayProducts) {
        var acu = 0;
        arrayProducts[a].subTotal = arrayProducts[a].total - arrayProducts[a].totalIva;
        acu = arrayProducts[a].subTotal * arrayProducts[a].ieps / 100;
        arrayProducts[a].totalIeps = Number(acu.toFixed(6));
    }
}

function calcularVentaIeps() {
    if (arrayProducts.length != 0) {
        calcularIepsByProducto();
        var acu = 0;
        for (var a in arrayProducts) {
            acu += arrayProducts[a].totalIeps;
            //console.log(acu);
        }
        ieps = acu.toFixed(6);
        //console.log(ieps);
        //document.getElementById("ieps").innerHTML = "<h6>"+Number(ieps)+"</h6>";
    } else {
        // document.getElementById("ieps").innerHTML = "<h6>00.00</h6>";
    }
}

function calcularVentaSinImpuestos() {
    subTotalVenta = 0;
    if (arrayProducts != 0) {
        var acu = 0;
        for (var c in arrayProducts) {
            acu += arrayProducts[c].subTotal - arrayProducts[c].totalIeps;
        }
        subTotalVenta = acu.toFixed(2);
        // document.getElementById("subTotal").innerHTML = "<h5>"+Number(subTotalVenta)+"</h5>";
    } else {
        //document.getElementById("subTotal").innerHTML = "<h5>00.00</h5>";
    }
}

//function cobrarVenta(){
//  //console.log(totalVenta);
//  $(document).on('click', '#cobrarVenta', function(){
//    if(arrayProducts.length!=0){
//      document.getElementById("saldoFinal").innerHTML = "<h4>"+ totalVenta +"</h4>";
//      $(document).on('change', '#efectivo', function(){
//         var valorEfectivo = $(this).val();
//         if(valorEfectivo>=totalVenta){
//           cambioVenta = valorEfectivo - totalVenta;
//           document.getElementById("cambioVenta").innerHTML = "<h4>"+ cambioVenta +"</h4>";
//           $("#cobrar").prop('disabled', false);
//         }else {
//           document.getElementById("cambioVenta").innerHTML = "<p style='color: red;'>El valor ingresado no cubre el total de la venta.</p>";
//           $("#cobrar").prop('disabled', true);
//         }
//
//      });
//    }else {
//      document.getElementById("saldoFinal").innerHTML = "<h4>00.00</h4>";
//    }
//  });
//}

function realizarVentaFinal() {

    if (validarFomr()) {
        Swal.fire({
            title: '¿Desea guardar la compra?',
            text: "¡Está seguro que ha ingresado todos los productos!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Se ha guardado la compra!',
                    showConfirmButton: false,
                    timer: 2000

                });
                guardarProductosVenta();


            }
        });

    }







}

function validarFomr() {
    if (arrayProducts.length == 0) {
        alert("Debe de ingresar un producto para guardar la compra.");
        console.log('array');
        return false;
    }
    if ($("#proveedorSelect").val() == "<--- Selecione --->") {
        alert("Seleecione al PREVEEDOR.");
        $("#nombre").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }

    return true;
}

function guardarProductosVenta() {
    console.log(arrayProducts);
    var proveedor = "";
    var sucursal = 1;
    proveedor = $('#proveedorSelect').val();



    $.ajax({
        type: "POST",
        url: "http://localhost/COVAN/controller/global-controller.php",
        data: {'totalVentaCompra': totalVenta,
            'proveedorCompra': proveedor,
            'sucursalCompra': sucursal,
            'productosCompra': JSON.stringify(arrayProducts)},
        success: function (data) {
            console.log(data);
        }, error: function (datos) {
            $(document).ready(function () {
                while (arrayProducts.length > 0) {
                    arrayProducts.pop();
                    $('#resultados').remove();
                }
                busquedaCambio();



            });
        }
    });
    console.log(arrayProducts);

    var txt = "";
    txt += "<tr> <td class='text-muted' colspan='6'><em>Agrega un producto.</em></td></tr>";
    document.getElementById("productoVenta").innerHTML = txt;
    console.log('agrega producto');

}

function mostrarSelectProveedor() {
    var pro = "proveedor";
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?proveedorC=" + pro,
        success: function (data) {
            var option = "<select class='form-control' id='proveedorSelect'><option> <--- Selecione ---> </option>";
            for (var i in data) {//Con este ciclo se llenan los datos con HTML
                option += "\n\
       \n\<option value=" + data[i].idProveedor + ">" + data[i].proveedor + "</option>\n\
      ";
            }
            option += "</select>";

            document.getElementById("selectProveedor").innerHTML = option; //Se inyecya el codigo con los datos en la interfaz

        }
    });
}

function mostrarSpinner() {
    $("#spinner").css("display", "block");
}

function ocultarSpinner() {
    $("#spinner").css("display", "none");
}