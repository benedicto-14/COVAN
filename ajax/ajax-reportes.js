$(document).ready(function() {
  //generarReporteVenta();
  //bodyPDF();
});
var imagen = new Image();
var fecha1;
var fecha2;

function reportes() {
  var fecha = getFechaReporte();
  openModal();
  console.log(fecha);
  var txt = "";
  txt = "\n\<div class='row mb-4'>\n\
            \n\<h3 class='col-md-12 mb-3' style='text-align: center;'>Rango de fechas:</h3>\n\
            \n\<div class='col-md-6'>\n\
                \n\<label> De </label>\n\
                \n\<input class='form-control' type='date' id='fecha1' value=" + fecha + ">\n\
            \n\</div>\n\
            \n\<div class='col-md-6'>\n\
                \n\<label> a </label>\n\
                \n\<input class='form-control' type='date' id='fecha2' value=" + fecha + ">\n\
            \n\</div>\n\
         \n\</div>\n\
         \n\<div class='row'>\n\
            \n\<div class='col-md-6' style='text-align: center;'>\n\
                \n\<h2>Ventas</h2>\n\
                \n\<button class='btn btn-outline-success' type='button' id='ventas' onclick='reporteVenta();'>Generar reporte</button>\n\
            \n\</div>\n\
            \n\<div class='col-md-6' style='text-align: center;'>\n\
                \n\<h2>Compras</h2>\n\
                \n\<button class='btn btn-outline-info' type='button' id='compras' onclick='reporteCompra()'>Generar reporte</button>\n\
            \n\</div>\n\
        \n\</div>\n\
         ";

  document.getElementById("modalLog").innerHTML = txt;
}

function getFechaReporte() {
  var fecha = new Date();
  var m = fecha.getMonth() + 1;
  if (m <= 10) {
    m = '0' + (m);
  }
  var fechaReporte = fecha.getFullYear() + '-' + m + '-' + fecha.getDate();
  return fechaReporte;
}

function obtenerFechas() {
  fecha1 = document.getElementById("fecha1").value;
  fecha2 = document.getElementById("fecha2").value;
}

function getDate() {
  var date = new Date();
  var options = {
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "numeric",
    minute: "numeric",
    hour12: "false"
  };
  return date.toLocaleDateString("es-MX", options);
}

function ajaxEmpresa() {
  return $.ajax({
    data: {
      'sucursal': 1
    },
    type: "GET",
    url: "http://localhost/COVAN/controller/class/class-reportes.php"
  });
}

function ajaxVentaDescripcion(venta) {
  return $.ajax({
    data: {
      'venta': venta
    },
    type: "GET",
    async: false,
    url: "http://localhost/COVAN/controller/class/class-reportes.php"
  });
}

function headerPDF(pdf, resp) {
  pdf.setFontSize(14);
  pdf.text(15, 15, resp[0][0].empresa);
  pdf.setFontSize(8);
  pdf.text(15, 20, resp[0][0].sucursal);
  pdf.setFontSize(8);
  pdf.setFontStyle("italic");
  pdf.text(15, 25, resp[0][0].estado + ', ' + resp[0][0].municipio + ', ' + resp[0][0].localidad);
  pdf.text(15, 30, resp[0][0].calle + ', Num. ' + resp[0][0].numeroExt + ', C.P. ' + resp[0][0].codigoPostal);
  pdf.text(15, 35, 'Tel. ' + resp[0][0].telefono);
}

function bodyReporteVentaPDF(pdf, resp) {

  var columnasVenta = [{
      title: "Folio",
      key: "idVenta"
    },
    {
      title: "Usuario",
      key: "usuario"
    },
    {
      title: "Fecha",
      key: "fecha"
    },
    {
      title: "Hora",
      key: "hora"
    },
    {
      title: "Total venta",
      key: "totalVenta"
    }
  ];

  var columnasVentaDescripcion = [{
      title: "Cantidad",
      key: "cantidad"
    },
    {
      title: "Producto",
      key: "nombre"
    },
    {
      title: "Descripción",
      key: "descripcion"
    },
    {
      title: "Medida",
      key: "medida"
    },
    {
      title: "Precio",
      key: "precioMenudeo"
    },
    {
      title: "SubTotal",
      key: "subTotal"
    }
  ];

  for (var b in resp[0]) {
    pdf.autoTable(columnasVenta, [resp[0][b]], {
      margin: {
        top: 52
      },
      headStyles: {
        fillColor: [69, 72, 72]
      }
    });
    $.when(ajaxVentaDescripcion(resp[0][b].idVenta)).done(function(data) {
      pdf.autoTable(columnasVentaDescripcion, data, {
        margin: {
          bottom: 10
        },
        headStyles: {
          fillColor: [182, 184, 185],
        }
      });
    });
  }
}

function reporteVenta() {
  var pdf = new jsPDF();
  obtenerFechas();
  //console.log(fecha1,fecha2);

  imagen.src = '../assets/img/ventas.png';
  pdf.addImage(imagen, 'PNG', 168, 10, 32, 30);

  pdf.setFontSize(20);
  pdf.setFontStyle("normal");
  pdf.text(76, 45, 'Reporte de ventas');

  var fecha = getDate();
  pdf.setFontSize(8);
  pdf.text(155, 45, fecha);

  var ajaxDatosVenta = $.ajax({
    data: {
      'ventas': true,
      'fecha1': fecha1,
      'fecha2': fecha2
    },
    type: "GET",
    url: "http://localhost/COVAN/controller/class/class-reportes.php"
  });

  $.when(ajaxEmpresa(), ajaxDatosVenta).done(function(data1, data2) {
    //console.log(data1,data2);
    headerPDF(pdf, data1);
    if (data2[0].length != 0) {
      bodyReporteVentaPDF(pdf, data2);
      //pdf.save('Reporte.pdf')
      window.open(pdf.output('bloburl'));
    } else {
      pdf.setFontSize(12);
      pdf.setFontStyle("italic");
      pdf.setTextColor(255, 0, 0);
      pdf.text(87, 55, "¡No existen ventas!");
      window.open(pdf.output('bloburl'));
    }
  });
}

function ajaxCompraDescripcion(compra) {
  return $.ajax({
    data: {
      'compra': compra
    },
    type: "GET",
    async: false,
    url: "http://localhost/COVAN/controller/class/class-reportes.php"
  });
}

function bodyReporteCompraPDF(pdf, resp) {

  var columnasCompra = [{
      title: "Folio",
      key: "idCompraProveedor"
    },
    {
      title: "Proveedor",
      key: "proveedor"
    },
    {
      title: "Fecha",
      key: "fecha"
    },
    {
      title: "Hora",
      key: "hora"
    },
    {
      title: "Total compra",
      key: "totalCompra"
    }
  ];

  var columnasCompraDescripcion = [{
      title: "Cantidad",
      key: "cantidad"
    },
    {
      title: "Producto",
      key: "nombre"
    },
    {
      title: "Descripción",
      key: "descripcion"
    },
    {
      title: "Costo",
      key: "costo"
    },
    {
      title: "SubTotal",
      key: "subTotal"
    }
  ];

  for (var b in resp[0]) {
    pdf.autoTable(columnasCompra, [resp[0][b]], {
      margin: {
        top: 52
      },
      headStyles: {
        fillColor: [69, 72, 72]
      }
    });
    $.when(ajaxCompraDescripcion(resp[0][b].idCompraProveedor)).done(function(data) {
      pdf.autoTable(columnasCompraDescripcion, data, {
        margin: {
          bottom: 10
        },
        headStyles: {
          fillColor: [182, 184, 185],
        }
      });
    });
  }
}

function reporteCompra() {
  var pdf = new jsPDF();
  obtenerFechas();

  imagen.src = '../assets/img/compras.png';
  pdf.addImage(imagen, 'PNG', 168, 10, 32, 30);

  pdf.setFontSize(20);
  pdf.setFontStyle("normal");
  pdf.text(76, 45, 'Reporte de compras');

  var fecha = getDate();
  pdf.setFontSize(8);
  pdf.text(155, 45, fecha);

  var ajaxDatosCompra = $.ajax({
    data: {
      'compras': true,
      'fecha1': fecha1,
      'fecha2': fecha2
    },
    type: "GET",
    url: "http://localhost/COVAN/controller/class/class-reportes.php"
  });

  $.when(ajaxEmpresa(), ajaxDatosCompra).done(function(data1, data2) {
    //console.log(data1,data2);
    headerPDF(pdf, data1);
    if (data2[0].length != 0) {
      bodyReporteCompraPDF(pdf, data2);
      window.open(pdf.output('bloburl'));
    } else {
      pdf.setFontSize(12);
      pdf.setFontStyle("italic");
      pdf.setTextColor(255, 0, 0);
      pdf.text(87, 55, "¡No existen compras!");
      window.open(pdf.output('bloburl'));
    }
  });

}

function openModal() {
  console.log("retroceder");
  $('body').addClass("modal-open");
  $("#myModal").addClass("show");
  $("#myModal").attr("aria-hidden", "false");
  $("#myModal").css("display", "block");
  $('body').append("<div class='modal-backdrop fade show'></div>");
}

function closeModal() {
  $('body').removeClass("modal-open");
  $("#myModal").removeClass("show");
  $("#myModal").attr("aria-hidden", "true");
  $("#myModal").css("display", "none");
  $('.modal-backdrop').remove();
}
