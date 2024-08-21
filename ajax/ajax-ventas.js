$(document).ready(function() {
  consultarProductosMasVendidos();
  buscarProductoVenta();
  cobrarVenta();
  realizarVentaFinal();
});
var arrayProducts = new Array();
var arrayIepsDiferent = new Array();
var txt;
var totalVenta;
var valorEfectivo;
var cambioVenta;
var iva;
var ieps;
var subTotalVenta;


class productosVentas {
  constructor(producto, nombre, descripcion, cantidad, subTotal, iva, totalIva, ieps, totalIeps, total) {
    this.producto = producto;
    this.nombre = nombre;
    this.descripcion = descripcion;
    this.cantidad = cantidad;
    this.subTotal = subTotal;
    this.iva = iva;
    this.totalIva = totalIva;
    this.ieps = ieps;
    this.totalIeps = totalIeps;
    this.total = total;
  }
}

function consultarProductosMasVendidos() {
  $.ajax({
    data: {
      'productos': true
    },
    type: "GET",
    url: "http://localhost/COVAN/controller/class/class-ventas.php",
    success: function(data) {
      //console.log(data);
      var cpv = "";
      for (var i in data) {
        cpv += "<div id='tamCard' class='col-lg-6 col-md-6 col-sm-6'>\n\
                  \n\<div id='cardP' class='card border-secondary mb-3' style='max-width: 18rem;'>\n\
                      \n\<div class='card-header'>" + data[i].nombre + "</div>\n\
                      \n\<div  id='cardB'  class='card-body text-secondary'>\n\
                         \n\<p class='card-text'>" + data[i].descripcion.substr(0, 50) + "</p>\n\
                         \n\<div class='overlay'>\n\
                            \n\<div class='addIcon'>\n\
                              \n\<a onclick=cargarProducto(" + data[i].idProducto + ") href='#'><i id='cardAdd' class='fas fa-plus-circle fa-2x'></i></a>\n\
                            \n\</div>\n\
                         \n\</div>\n\
                      \n\</div>\n\
                      \n\<div class='card-footer p-0'>\n\
                          \n\<div class='row p-0 m-0'>\n\
                                \n\<div class='col-md-8 p-0 bg-info text-white'>" + '$ ' + data[i].precioMenudeo + "</div>\n\
                                \n\<div class='col-md-4 p-0 bg-secondary text-white'>" + data[i].stock + "</div>\n\
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
    data: {
      'producto': pro
    },
    type: "GET",
    url: "http://localhost/COVAN/controller/class/class-ventas.php",
    success: function(data) {
      var cpro = "";
      for (var i in data) {
        //console.log(data);
        cpro += "<div id='tamCard' class='col-lg-6 col-md-6 col-sm-6'>\n\
                 \n\<div id='cardP' class='card border-secondary mb-3' style='max-width: 18rem;'>\n\
                     \n\<div class='card-header'>" + data[i].nombre + "</div>\n\
                     \n\<div  id='cardB'  class='card-body text-secondary'>\n\
                        \n\<p class='card-text'>" + data[i].descripcion.substr(0, 50) + "</p>\n\
                        \n\<div class='overlay'>\n\
                           \n\<div class='addIcon'>\n\
                             \n\<a id='add' onclick=cargarProducto(" + data[i].idProducto + ") href='#'><i id='cardAdd' class='fas fa-plus-circle fa-2x'></i></a>\n\
                           \n\</div>\n\
                        \n\</div>\n\
                     \n\</div>\n\
                     \n\<div class='card-footer p-0'>\n\
                         \n\<div class='row p-0 m-0'>\n\
                               \n\<div class='col-md-8 p-0 bg-info text-white'>" + '$ ' + data[i].precioMenudeo + "</div>\n\
                               \n\<div class='col-md-4 p-0 bg-secondary text-white'>" + data[i].stock + "</div>\n\
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
  $(document).on('keyup', '#buscar', function() {
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
      arrayProducts.push(new productosVentas(producto, "", "", 1, 0, 0, 0, 0, 0, 0));
    }
  } else {
    arrayProducts.push(new productosVentas(producto, "", "", 1, 0, 0, 0, 0, 0, 0));
  }

  for(var x in arrayProducts){
    if (arrayProducts[x].cantidad == 0) {
      arrayProducts.splice(x, 1);
      console.log(arrayProducts);
    }
  }
  console.log(arrayProducts);
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
    var subTotal;
    $.ajax({
      data: {
        'addPro': pro,
        'cantidad': cant
      },
      type: "GET",
      url: "http://localhost/COVAN/controller/class/class-ventas.php",
      success: function(data) {
        //console.log(data);
        if (data != false) {
          for (var a in data) {
            //subTotal = arrayProducts[indice].getSubTotal(data[a].precioMaximo, cant);
            subTotal = parseFloat(data[a].precioMenudeo * cant).toFixed(2);
            arrayProducts[indice].nombre = data[a].nombre;
            arrayProducts[indice].descripcion = data[a].descripcion;
            arrayProducts[indice].iva = Number(data[a].iva);
            arrayProducts[indice].ieps = Number(data[a].ieps);
            arrayProducts[indice].total = Number(subTotal);
            /*txt += "<h1>"+data[a].productos+"</h1>";*/
            txt += "<tr>\n\
                     \n\<th scope='row'>" + data[a].nombre + "</th>\n\
                     \n\<td>" + data[a].descripcion.substr(0, 33) + '...' + "</td>\n\
                     \n\<td><input class='border' id='" + data[a].idProducto + "' type='number' value=" + cant + " name='' onchange=cantidadProducto(" + data[a].idProducto + ")></td>\n\
                     \n\<td>" + '$' + data[a].precioMenudeo + "</td>\n\
                     \n\<td>" + '$' + subTotal + "</td>\n\
                     \n\<td>\n\
                         \n\<a onclick=removerProductoVentas(" + data[a].idProducto + ")><i class='fas fa-trash' style='color: #ff6b6b;'></i></a>\n\
                     \n\</td>\n\
                 \n\</tr>\n\
                 ";
          }
          document.getElementById("productoVenta").innerHTML = txt;
          cargarProductosVentas(indice + 1);
        } else {
          Swal.fire({
            type: 'error',
            title: 'Error',
            text: '¡La cantidad supera el stock del producto!',
            showConfirmButton: false,
            timer: 1500
          })
          arrayProducts[indice].cantidad = 0;
        }
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
  calcularVentaSinImpuestos()
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
    document.getElementById("total").innerHTML = "<h3>" + '$' + Number(totalVenta) + "</h3>";
  } else {
    document.getElementById("total").innerHTML = "<h3>$00.00</h3>";
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
    document.getElementById("iva").innerHTML = "<h6>" + '$' + Number(iva) + "</h6>";
  } else {
    document.getElementById("iva").innerHTML = "<h6>$00.00</h6>";
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

function calcularVentaIepsDesglosado() {
  let uniqueIeps = [];
  const elementExist = (arrayProducts, value) => {
    for (var index in arrayProducts) {
      if (arrayProducts[index].ieps == value) return arrayProducts[index].ieps;
    }
    return false;
  }
  arrayProducts.forEach((e) => {
    let i = elementExist(uniqueIeps, e.ieps);
    if (i === false) {
      uniqueIeps.push({
        "ieps": e.ieps,
        "valor": Number((e.totalIeps).toFixed(6))
      });
    } else {
      for (var h in uniqueIeps) {
        var iep = uniqueIeps[h].ieps;
        if (iep == e.ieps) Number(uniqueIeps[h].valor += e.totalIeps).toFixed(6);
      }
    }
  });
  arrayIepsDiferent = uniqueIeps;
  //console.log(arrayIepsDiferent);
  //console.log(uniqueIeps);
  var htmlIeps = "";
  for (var g in uniqueIeps) {
    htmlIeps += "\n\<tr>\n\
                   \n\<td ><h6><b>" + uniqueIeps[g].ieps + "</b></h6></td>\n\
                   \n\<td><h6>" + '$' + uniqueIeps[g].valor + "</h6></td>\n\
                 \n\</tr>\n\
                 ";
  }
  document.getElementById("iepsGen").innerHTML = htmlIeps;
}

function calcularVentaIeps() {
  //var arrayIeps = new Array();
  if (arrayProducts.length != 0) {
    calcularIepsByProducto();
    calcularVentaIepsDesglosado();
    var acu = 0;
    for (var a in arrayProducts) {
      acu += arrayProducts[a].totalIeps;
    }
    ieps = acu.toFixed(6);
    document.getElementById("ieps").innerHTML = "<h6>" + '$' + Number(ieps) + "</h6>";

  } else {
    document.getElementById("ieps").innerHTML = "<h6>$00.00</h6>";
    document.getElementById("iepsGen").innerHTML = "";
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
    document.getElementById("subTotal").innerHTML = "<h5>" + '$' + Number(subTotalVenta) + "</h5>";
  } else {
    document.getElementById("subTotal").innerHTML = "<h5>$00.00</h5>";
  }
}

function cobrarVenta() {
  //console.log(totalVenta);
  $(document).on('click', '#cobrarVenta', function() {
    $("#efectivo").val("");
    $("#efectivo").focus();
    $("#cobrar").prop('disabled', true);
    cambioVenta = 0;
    document.getElementById("cambioVenta").innerHTML = "<h4>$00.00</h4>";
    if (arrayProducts.length != 0) {
      document.getElementById("saldoFinal").innerHTML = "<h4>" + '$' + totalVenta + "</h4>";
      $(document).on('change', '#efectivo', function() {
         valorEfectivo = $(this).val();
        if (valorEfectivo >= totalVenta) {
          cambioVenta = valorEfectivo - totalVenta;
          document.getElementById("cambioVenta").innerHTML = "<h4>" + '$' + cambioVenta + "</h4>";
          $("#cobrar").prop('disabled', false);
        } else {
          document.getElementById("cambioVenta").innerHTML = "<p style='color: red;'>El valor ingresado no cubre el total de la venta.</p>";
          $("#cobrar").prop('disabled', true);
        }

      });
    } else {
      document.getElementById("saldoFinal").innerHTML = "<h4>$00.00</h4>";
    }
  });
}

function realizarVentaFinal() {
  $(document).on('click', '#cobrar', function() {
    //console.log('Venta realizada con exito');
    guardarProductosVenta();
    //location.reload();
  });
}

function guardarProductosVenta() {
  var user = 1;
  var sucursal = 1;
  $.ajax({
    type: "POST",
    url: "http://localhost/COVAN/controller/class/class-ventas.php",
    data: {
      'totalVenta': totalVenta,
      'subTotalVenta': subTotalVenta,
      'cambioVenta': cambioVenta,
      'totalIva': iva,
      'totalIeps': ieps,
      'usuario' : user,
      'sucursal' : sucursal,
      'productos': JSON.stringify(arrayProducts)
    },
    success: function(data) {
      /* Data = id de la venta */
      console.log(data);
      
      $('#modalCobrar').hide();
      Swal.fire({
        type: 'success',
        title: 'Vendido',
        text: '¡Venta realizada con exito.!',
        showConfirmButton: false,
        timer: 1300
      }).then((result) => {
        ticket(data);
        location.reload();
      })
    },
    error: function(data) {
      $('#modalCobrar').hide();
      Swal.fire({
        type: 'error',
        title: 'Error',
        text: '¡No se pudo realizar la venta!',
        showConfirmButton: false,
        timer: 1500
      }).then((result) => {
        location.reload();
      })
    }
  });
}

function tablaCorte(){
    idUsuario = 1;
    $.ajax({
       data: {
              'corte': true,
              'usuario': idUsuario
            },
       url : 'http://localhost/COVAN/controller/class/class-ventas.php',
       type : 'POST',
       success: function (data) {
           var total = 0;
           var out = "";
           for (var i in data) {
               out += " <tr><td>" + data[i].departamento +
                        "</td><td>" +
                        "$ "+ parseFloat(data[i].total).toFixed(6) +
                        "</td></tr>";
               total = total + parseFloat(data[i].total);
           }
           document.getElementById("tabla_corte").innerHTML = out;
           document.getElementById("total_corte").innerHTML = "Total:  $ " + total;
       },
       error: function(data){
          console.log(data);
          alert("no se pudo cargar la información");
       }
     });

}

function ticket(id){
  // var imagen =document.getElementById('logo');
  //var data = document.getElementById(id);
  var fecha =  getFechaTicket();
  var ventimp = window.open('', '');
  ventimp.document.write('<div class="ticket" style="font-size: 12px;font-family: "Times New Roman";">');
  //ventimp.document.write('<img src="https://yt3.ggpht.com/-3BKTe8YFlbA/AAAAAAAAAAI/AAAAAAAAAAA/ad0jqQ4IkGE/s900-c-k-no-mo-rj-c0xffffff/photo.jpg" style="width: 120px; height: 90px; display:block;margin:auto;"/>');
  ventimp.document.write('<p class="centrado" style=" text-align: center; align-content: center;">TICKET DE VENTA<br>NOMBRE DE LA EMPRESA<br>'+fecha+'<br>TELEFONO <br> DIRECCIÓN<br>Folio: '+id+'</p>');
  ventimp.document.write('<table style="  border-top: 1px solid black; border-collapse: collapse;  font-size: 12px;font-family: "Times New Roman"; width: 230px; max-width: 230px;">');
  ventimp.document.write('<thead><tr><th class="cantidad" style=" border-top: 1px solid black; border-collapse: collapse; ">CANT</th><th class="producto" style=" border-top: 1px solid black; border-collapse: collapse;">PRODUCTOS</th><th class="precio" style=" border-top: 1px solid black; border-collapse: collapse;">PRECIO</th></tr></thead>');
  ventimp.document.write('<tbody>');
  //For
  for(var w in arrayProducts){
  ventimp.document.write('<tr>');
  ventimp.document.write('<td class="cantidad" style=" border-top: 1px solid black; border-collapse: collapse;">'+arrayProducts[w].cantidad+'</td>');
  ventimp.document.write('<td class="producto" style=" border-top: 1px solid black; border-collapse: collapse; text-align: left">'+arrayProducts[w].nombre+' '+arrayProducts[w].descripcion +'</td>');
  ventimp.document.write('<td class="precio" style=" border-top: 1px solid black; border-collapse: collapse; text-align: right"">$'+arrayProducts[w].total+'</td>');
  ventimp.document.write('</tr>');
  // end For
  }
  ventimp.document.write('<tr><td class="cantidad" style=" border-top: 1px solid black; border-collapse: collapse;"></td><td class="producto" style=" border-top: 1px solid black; border-collapse: collapse;">SUBTOTAL</td><td class="precio" style=" border-top: 1px solid black; border-collapse: collapse; text-align: right">'+subTotalVenta+'</td></tr>');
  ventimp.document.write('<tr><td class="cantidad" ></td><td class="producto" >IEPS</td><td class="precio" style="text-align: right">$'+ieps+'</td></tr>');
  ventimp.document.write('<tr><td class="cantidad" ></td><td class="producto" >IVA</td><td class="precio" style="text-align: right">$'+iva+'</td></tr>');
  ventimp.document.write('<tr><td class="cantidad" style=" border-top: 1px solid black; border-collapse: collapse;"></td><td class="producto" style=" border-top: 1px solid black; border-collapse: collapse;">TOTAL</td><td class="precio" style=" border-top: 1px solid black; border-collapse: collapse; text-align: right">$'+totalVenta+'</td></tr>');
  ventimp.document.write('<tr><td class="cantidad" style=" border-collapse: collapse;"></td><td class="producto" style=" border-collapse: collapse;">EFECTIVO</td><td class="precio" style="  border-collapse: collapse; text-align: right">$'+valorEfectivo+'</td></tr>');
  ventimp.document.write('<tr><td class="cantidad" style=" border-top: 1px solid black; border-collapse: collapse;"></td><td class="producto" style=" border-top: 1px solid black; border-collapse: collapse;">CAMBIO</td><td class="precio" style=" border-top: 1px solid black; border-collapse: collapse; text-align: right">$'+cambioVenta+'</td></tr>');
  ventimp.document.write('</tbody>'); 
   ventimp.document.write('</table>');
   ventimp.document.write('<p class="centrado" style=" text-align: center"  >¡GRACIAS POR SU COMPRA!</p>');
   ventimp.document.write('</div>');
//  ventimp.document.write( data.innerHTML );
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
}
function getFechaTicket() {
  var fecha = new Date();
  var m = fecha.getMonth() + 1;
  var s = fecha.getSeconds();
  if(s<=9){
      s = '0' + s;
  }
  if (m <= 9) {
    m = '0' + (m);
  }
  var fechaticket = fecha.getFullYear() + '-' + m + '-' + fecha.getDate() + ' ' + fecha.getHours() +':'+ fecha.getMinutes() +':'+ s;
    console.log(fechaticket);
    return fechaticket;
}



