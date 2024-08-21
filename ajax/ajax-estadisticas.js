//Variables para poder controlar las graficas
var barGraph1;
var ctx1;
var barGraph2;
var ctx2;
var barGraph3;
var ctx3;
var barGraph4;
var ctx4;
var v1;
var v2;
var v3;
var v4;
//Funcion para la carga de la página
$(document).ready(function () {
  $("#contenido").hide();
  $("#DatosNull").hide();
  cargarTipo();
  $('[data-toggle="tooltip"]').tooltip();
});
//Carga el tipo de graficas
function cargarTipo() {

  $("#spinner").show();
  var mensajeError = '<br><br><br><br><h1 id="mensajeError">Algo salio mal</h1>' + '<br><i class="fas fa-robot" style="font-size: 120px"></i>';

  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php?tipo",
    method: "GET",
    success: function (data) {
      console.log(data);
      if (data.length == null) {
        console.log("no hay");
      } else {
        $("#load").hide();
        $("#contenido").show();

        var tipo1 = data[0].tipo;
        var tipo2 = data[1].tipo;
        var tipo3 = data[2].tipo;
        var tipo4 = data[3].tipo;

        var valor1 = '<option value="' + tipo1 + '" selected>Tipo</option>\n\
                    <option value="line">Lineal</option>\n\
                    <option value="bar">Barra</option>\n\
                    <option value="pie">Pastel</option>\n\
                    <option value="radar">Radar</option>';

        var valor2 = '<option value="' + tipo2 + '" selected>Tipo</option>\n\
                    <option value="line">Lineal</option>\n\
                    <option value="bar">Barra</option>\n\
                    <option value="pie">Pastel</option>\n\
                    <option value="radar">Radar</option>';

        var valor3 = '<option value="' + tipo3 + '" selected>Tipo</option>\n\
                    <option value="line">Lineal</option>\n\
                    <option value="bar">Barra</option>\n\
                    <option value="pie">Pastel</option>\n\
                    <option value="radar">Radar</option>';

        var valor4 = '<option value="' + tipo4 + '" selected>Tipo</option>\n\
                    <option value="line">Lineal</option>\n\
                    <option value="bar">Barra</option>\n\
                    <option value="pie">Pastel</option>\n\
                    <option value="radar">Radar</option>';


        $("#tipo").html(valor1);
        $("#tipoC").html(valor2);
        $("#tipoV").html(valor3);
        $("#tipoVP").html(valor4);

        fechas();

      }

    },
    timeout: 4000
  }).fail(function (jqXHR, textStatus, errorThrown) {
    if (textStatus === 'parsererror') {
      $("#spinner").hide();
      $("#contenido").hide();
      console.log("Requested JSON parse failed");
      $("#mensaje").html(mensajeError);
      console.log("jqXHR:" + jqXHR);
      console.log("textStatus:" + textStatus);
      console.log("errorThrown:" + errorThrown);
    }
  });
}
//Genera las fechas de las graficas
function fechas() {
  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php?fechas",
    method: "GET",
    success: function (data) {
      console.log(data);

      if (data.Compras[0].inicio == null) {
        console.log("no hay");
        $("#contenido").hide();
        $("#DatosNull").show();
        $("#mensajeDatos").html('No hay datos aún');
      } else {
        //$("#DatosNull").hide();
        var FI = '<input type="date" class="form-control" value="' + data.Ganancias[data.Ganancias.length - 1].fecha + '" id="FechaInicio" onchange="cambiar();">';
        var FF = '<input type="date" class="form-control" value="' + data.Ganancias[0].fecha + '" id="FechaFin" onchange="cambiar();">';
        var FIC = '<input type="date" class="form-control" value="' + data.Compras[0].inicio + '" id="FechaInicioC" onchange="cambiarC();">';
        var FFC = '<input type="date" class="form-control" value="' + data.Compras[0].fin + '" id="FechaFinC" onchange="cambiarC();">';
        var FIV = '<input type="date" class="form-control" value="' + data.Ventas[0].inicio + '" id="FechaInicioV" onchange="cambiarV();">';
        var FFV = '<input type="date" class="form-control" value="' + data.Ventas[0].fin + '" id="FechaFinV" onchange="cambiarV();">';
        var FIVP = '<input type="date" class="form-control" value="' + data.Ventas[0].inicio + '" id="FechaInicioVP" onchange="cambiarVP();">';
        var FFVP = '<input type="date" class="form-control" value="' + data.Ventas[0].fin + '" id="FechaFinVP" onchange="cambiarVP();">';

        $("#FI").html(FI);
        $("#FF").html(FF);
        $("#FIC").html(FIC);
        $("#FFC").html(FFC);
        $("#FIV").html(FIV);
        $("#FFV").html(FFV);
        $("#FIVP").html(FIVP);
        $("#FFVP").html(FFVP);

        cambiar();
        cambiarC();
        cambiarV();
        cambiarVP();

      }

    }
  });
}
//Cambia el contenido de las graficas
function cambiar() {
  var inicio = document.getElementById("FechaInicio").value;
  var fin = document.getElementById("FechaFin").value;
  var tipo = document.getElementById("tipo").value;

  if (barGraph1 == null) {
    console.log("indefinido");
  } else {
    barGraph1.destroy();
  }

  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php",
    method: "POST",
    data: {
      fi: inicio,
      ff: fin
    },
    success: function (data) {
      console.log(data);
      if (data.length == 0) {
        console.log("no hay");
        
        mostrarMensaje("#CanvasGanancias","#mensajeGanancias");
        v1 = 0;
        console.log("valor:"+v1);
      
      } else {
        
        ocultarMensaje("#CanvasGanancias","#mensajeGanancias");
        v1 = 1;
        console.log("valor:"+v1);
        
        var ivn = [];
        var gan = [];
        var fech = [];

        for (var i in data) {
          fech.push(data[i].fecha);
          ivn.push(data[i].inversion);
          gan.push(data[i].ganancia);
        }

        var chartdata = {
          labels: fech,
          datasets: [{
            label: 'Inversiones',
            borderWidth: 1,
            backgroundColor: 'rgba(23,165,137,0.3)',
            data: ivn
          }, {
            label: "Ganancias",
            borderWidth: 1,
            backgroundColor: 'rgba(21,67,96,0.3)',
            data: gan
          }]
        };

        ctx1 = $("#CanvasGanancias");

        barGraph1 = new Chart(ctx1, {
          type: tipo,
          data: chartdata
        });
      }

    }
  });
}
//Cambia el contenido de las graficas
function cambiarC() {

  var inicio = document.getElementById("FechaInicioC").value;
  var fin = document.getElementById("FechaFinC").value;
  var tipo = document.getElementById("tipoC").value;

  if (barGraph2 == null) {
    console.log("indefinido");
  } else {
    barGraph2.destroy();
  }

  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php",
    method: "POST",
    data: {
      fiC: inicio,
      ffC: fin
    },
    success: function (data) {
      console.log(data);      

      if(data.Mas.length == 0){
        console.log("no hay");
        mostrarMensaje("#CanvasCompras","#mensajeCompras");

      }else{

        ocultarMensaje("#CanvasCompras","#mensajeCompras");

        var producto = [];
      var compras = [];

      for (let i = 0; i < data.Mas.length; i++) {
        producto.push(data.Mas[i].nombre);
        compras.push(data.Mas[i].total);
      }
      for (let i = 0; i < data.Mas.length; i++) {
        producto.push(data.Menos[i].nombre);
        compras.push(data.Menos[i].total);
      }

      var chartdata = {
        labels: producto,
        datasets: [{
          label: 'Productos Comprados',
          borderWidth: 1,
          backgroundColor: 'rgba(65,219,27,0.3)',
          data: compras
        }]
      };

      ctx2 = $("#CanvasCompras");

      barGraph2 = new Chart(ctx2, {
        type: tipo,
        data: chartdata
      });

      }

    }
  });

}
//Cambia el contenido de las graficas
function cambiarV() {

  var inicio = document.getElementById("FechaInicioV").value;
  var fin = document.getElementById("FechaFinV").value;
  var tipo = document.getElementById("tipoV").value;

  if (barGraph3 == null) {
    console.log("indefinido");
  } else {
    barGraph3.destroy();
  }

  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php",
    method: "POST",
    data: {
      fiV: inicio,
      ffV: fin
    },
    success: function (data) {

      console.log(data);
      
      if (data.length == 0) {
        console.log("no hay");
        mostrarMensaje("#CanvasVentas","#mensajeVentas");
      
      }else{
        console.log("si hay");
        ocultarMensaje("#CanvasVentas","#mensajeVentas");
        
        var user = [];
      var venta = [];
      var color = [];

      for (var i in data) {
        user.push(data[i].usuario);
        venta.push(data[i].ventas);
        color.push(Colors());
      }

      var chartdata = {
        labels: user,
        datasets: [{
          label: "Ventas Realizadas",
          borderWidth: 1,
          backgroundColor: color,
          data: venta
        }]
      };

      ctx3 = $("#CanvasVentas");

      barGraph3 = new Chart(ctx3, {
        type: tipo,
        data: chartdata
      });
      }      

    }
  });
}
//Cambia el contenido de las graficas
function cambiarVP() {
  var inicio = document.getElementById("FechaInicioVP").value;
  var fin = document.getElementById("FechaFinVP").value;
  var tipo = document.getElementById("tipoVP").value;

  if (barGraph4 == null) {
    console.log("indefinido");
  } else {
    barGraph4.destroy();
  }

  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php",
    method: "POST",
    data: {
      fiVP: inicio,
      ffVP: fin
    },
    success: function (data) {
      console.log(data);

      if(data.Mas.length == 0){
        console.log("no hay");
        mostrarMensaje("#CanvasVentasProducts","#mensajeVentasProducts");

      }else{
        console.log("si hay");
        ocultarMensaje("#CanvasVentasProducts","#mensajeVentasProducts");

        var producto = [];
      var ventas = [];
      var color = [];

      for (let i = 0; i < data.Mas.length; i++) {
        producto.push(data.Mas[i].nombre);
        ventas.push(data.Mas[i].total);
      }
      for (let i = 0; i < data.Mas.length; i++) {
        producto.push(data.Menos[i].nombre);
        ventas.push(data.Menos[i].total);
      }

      for (var i in producto) {
        color.push(Colors());
      }

      var chartdata = {
        labels: producto,
        datasets: [{
          label: 'Productos Vendidos',
          borderWidth: 1,
          backgroundColor: 'rgba(255,0,35,0.2)',
          data: ventas
        }]
      };

      ctx4 = $("#CanvasVentasProducts");

      barGraph4 = new Chart(ctx4, {
        type: tipo,
        data: chartdata
      });

      }      

    }
  });
}
//Genera colores aleatorios tipo RGBA
function Colors() {
  var r = Math.floor(Math.random() * 255);
  var g = Math.floor(Math.random() * 255);
  var b = Math.floor(Math.random() * 255);
  return "rgb(" + r + "," + g + "," + b + ",0.3)";
}
//Abre un nuevo tab en el navegador 
//para visulizar el PDF
function previewPDF() {
  var g1 = "Grafica de Ganancias";
  var g2 = "Grafica de Compras";
  var g3 = "Grafica de Ventas";
  var g4 = "Grafica de Ventas de Productos";


  var checkBox1 = document.getElementById("customSwitch1");
  var checkBox2 = document.getElementById("customSwitch2");
  var checkBox3 = document.getElementById("customSwitch3");
  var checkBox4 = document.getElementById("customSwitch4");

  var canvas1 = document.getElementById("CanvasGanancias");
  var canvas2 = document.getElementById("CanvasCompras");
  var canvas3 = document.getElementById("CanvasVentas");
  var canvas4 = document.getElementById("CanvasVentasProducts");

  img1 = canvas1.toDataURL("image/png", 1.0).replace("image/jpg", "image/octet-stream");
  img2 = canvas2.toDataURL("image/png", 1.0).replace("image/jpg", "image/octet-stream");
  img3 = canvas3.toDataURL("image/png", 1.0).replace("image/jpg", "image/octet-stream");
  img4 = canvas4.toDataURL("image/png", 1.0).replace("image/jpg", "image/octet-stream");

  if (checkBox1.checked == false && checkBox2.checked == false && checkBox3.checked == false && checkBox4.checked == false) {
    Swal.fire({
      type: 'warning',
      title: 'Desbes seleccionar al menos una grafica'
    });
  }

  if (checkBox1.checked == true && checkBox2.checked == true && checkBox3.checked == true && checkBox4.checked == true) {
    var doc = new jsPDF();
    doc.text('Grafica de Ganancias', 20, 30);
    doc.addImage(img1, 20, 50);
    doc.text('Grafica de Compras', 20, 150);
    doc.addImage(img2, 20, 170);
    doc.addPage();
    doc.text('Grafica de Ventas', 20, 30);
    doc.addImage(img3, 20, 50);
    doc.text('Grafica de Ventas de Productos', 20, 150);
    doc.addImage(img4, 20, 170);
    window.open(doc.output('bloburl'));
  }

  if (checkBox1.checked == true && checkBox2.checked == true && checkBox3.checked == true) {
    generar3Graficas(g1, g2, g3, img1, img2, img3);
  }

  if (checkBox1.checked == true && checkBox2.checked == true && checkBox4.checked == true) {
    generar3Graficas(g1, g2, g4, img1, img2, img4);
  }

  if (checkBox1.checked == true && checkBox3.checked == true && checkBox4.checked == true) {
    generar3Graficas(g1, g3, g4, img1, img3, img4);
  }

  if (checkBox2.checked == true && checkBox3.checked == true && checkBox4.checked == true) {
    generar3Graficas(g2, g3, g4, img2, img3, img4);
  }

  if (checkBox1.checked == true && checkBox2.checked == true) {
    generar2Graficas(g1, g2, img1, img2);
  }

  if (checkBox1.checked == true && checkBox3.checked == true) {
    generar2Graficas(g1, g3, img1, img3);
  }

  if (checkBox1.checked == true && checkBox4.checked == true) {
    generar2Graficas(g1, g4, img1, img4);
  }

  if (checkBox2.checked == true && checkBox3.checked == true) {
    generar2Graficas(g2, g3, img2, img3);
  }

  if (checkBox2.checked == true && checkBox4.checked == true) {
    generar2Graficas(g2, g4, img2, img4);
  }

  if (checkBox3.checked == true && checkBox4.checked == true) {
    generar2Graficas(g3, g4, img3, img4);
  }

  if (checkBox1.checked == true) {
    generar1Graficas(g1, img1);
  }
  if (checkBox2.checked == true) {
    generar1Graficas(g2, img2);
  }
  if (checkBox3.checked == true) {
    generar1Graficas(g3, img3);
  }
  if (checkBox4.checked == true) {
    generar1Graficas(g4, img4);
  }

}
//Funcion para generar el PDF de acuerdo
// a una grafica seleccionada
function generar1Graficas(tituloGrafica1, immg1) {
  var doc = new jsPDF();
  doc.text(tituloGrafica1, 20, 30);
  doc.addImage(immg1, 20, 50);
  window.open(doc.output('bloburl'));
}
//Funcion para generar el PDF de acuerdo 
// a dos grafica seleccionada
function generar2Graficas(tituloGrafica1, tituloGrafica2, immg1, immg2) {
  var doc = new jsPDF();
  doc.text(tituloGrafica1, 20, 30);
  doc.addImage(immg1, 20, 50);
  doc.text(tituloGrafica2, 20, 150);
  doc.addImage(immg2, 20, 170);
  window.open(doc.output('bloburl'));
}
//Funcion para generar el PDF de acuerdo 
// a tres grafica seleccionada
function generar3Graficas(tituloGrafica1, tituloGrafica2, tituloGrafica3, immg1, immg2, immg3) {
  var doc = new jsPDF();
  doc.text(tituloGrafica1, 20, 30);
  doc.addImage(immg1, 20, 50);
  doc.text(tituloGrafica2, 20, 150);
  doc.addImage(immg2, 20, 170);
  doc.addPage();
  doc.text(tituloGrafica3, 20, 30);
  doc.addImage(immg3, 20, 50);
  window.open(doc.output('bloburl'));
}
//Guarda el tipo de grafica
function guardarInfo() {
  var tipo = document.getElementById("tipo").value;
  var tipoC = document.getElementById("tipoC").value;
  var tipoV = document.getElementById("tipoV").value;
  var tipoVP = document.getElementById("tipoVP").value;
  console.log(123);
  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php",
    method: "POST",
    data: {
      info1: tipo,
      info2: tipoC,
      info3: tipoV,
      info4: tipoVP,
    },
    success: function (data) {
      console.log(data);

      Swal.fire({
        position: 'top-end',
        type: 'success',
        title: 'Tipos de Graficas guardadas',
        showConfirmButton: false,
        timer: 1000
      });
    }
  });
}
//Genera un tabla con los registros
// que se han hecho
function generarlogs() {
  console.log("Logss");
  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php?logs",
    method: "GET",
    success: function (data) {

      console.log(data);

      if (data.length == 0) {
        console.log("No hay Registro de Actividad");
        closeModal();
        openModal();
        $("#titulolog").html("Registro de Actividades");
        $("#modalLog").html("No hay Registro de Actividades");
      } else {

        console.log(data);

        var table = '<input type="date" class="form-control" value="' + (data[0].fecha) + '" id="FechaLog" onchange="consultarLog();"><br>\n\
      <table class="table">\n\
                    <thead>\n\
                      <tr>\n\
                        <th scope="col">Fecha</th>\n\
                        <th scope="col">...</th>\n\
                        <th scope="col">...</th>\n\
                      </tr>\n\
                    </thead>\n\
                    <tbody id="contenidoTbody">\n\
                      \n\
                    </tbody>\n\
                  </table>\n\
                  ';

        closeModal();
        openModal();

        $("#titulolog").html("Registro de Actividades");
        $("#modalLog").html(table + '<div id="navNumeros"></div>');

        $('#navNumeros').pagination({
          dataSource: data,
          pageSize: 10,
          showPrevious: false,
          className: 'paginationjs-theme-blue paginationjs-big',
          showNext: false,
          callback: function (data, pagination) {
            console.log(data, pagination);

            var tbody = "";

            for (var i in data) {
              tbody += "\n\
                            <tr>\n\
                              <td>" + data[i].fecha + "</td>\n\
                              <td onClick=verLog(" + "'" + data[i].fecha + "'" + ")> \n\
                              <i class='far fa-eye'></i>\n\
                              </td>\n\
                              <td onClick=eliminarLog(" + data[i].idLog + ",'" + data[i].fecha + "'" + ")> \n\
                              <i class='far fa-trash-alt'></i>\n\
                              </td>\n\
                            </tr>\n\
              ";
            }

            $("#contenidoTbody").html(tbody);
          }
        });

      }

    }
  });
}
//Visualiza el contenido del 
//registro del log
function verLog(fecha) {
  $.ajax({
    url: "http://localhost/COVAN/controller/class/class-estadisticas.php",
    method: "GET",
    data: {
      fechalog: fecha
    },
    success: function (data) {
      console.log(data);
      var tbody = "";

      if (data.Registros == null) {
        $("#titulolog").html("<i class='fas fa-arrow-left' onclick=generarlogs()></i> Registro de Actividades");
        $("#modalLog").html("No hay Registro de Actividades");
      } else {
        var table = '\n\
        <table class="table">\n\
        <thead>\n\
          <tr>\n\
            <th scope="col">Hora</th>\n\
            <th scope="col">Actividad</th>\n\
            </tr>\n\
        </thead>\n\
        <tbody id="contenidoTbody">\n\
        \n\
        </tbody>\n\
      </table>\n\
        ';

        $("#titulolog").html("<i class='fas fa-arrow-left' onclick=generarlogs()></i> " + formatFecha(fecha));
        $("#modalLog").html(table + '<div id="navNumeros"></div>');

        $('#navNumeros').pagination({
          dataSource: data.Registros,
          pageSize: 10,
          showPrevious: false,
          className: 'paginationjs-theme-blue paginationjs-big',
          showNext: false,
          callback: function (data, pagination) {

            var tbody = "";

            for (var i in data) {
              tbody += "<tr>\n\
          <td class='hora'>" + data[i].substr(0, 8) + "</td>\n\
          <td>" + data[i].substr(8) + "</td>\n\
          </tr>";
            }

            $("#contenidoTbody").html(tbody);
          }
        });

      }

    }
  });
}
//Consulta un registro espesifico
//de acuerdo a la fecha selecionada
function consultarLog() {
  var fecha = document.getElementById("FechaLog").value;
  console.log(fecha);
  verLog(fecha);
}
//Elimina un registro seleccionado
function eliminarLog(id, fecha) {
  console.log(id, fecha);
  Swal.fire({
    title: '¿Estás seguro?',
    text: "¡No podrás revertir esto!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: '¡Sí, bórralo!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "http://localhost/COVAN/controller/class/class-estadisticas.php",
        method: "POST",
        data: {
          EliminarlogId: id,
          EliminarlogFecha: fecha
        },
        success: function (data) {
          console.log(data);
          generarlogs();
        }
      });
      Swal.fire(
        'Eliminado',
        'Su archivo ha sido eliminado.',
        'success'
      )
    }
  })
}
//Abre el modal para poder 
//vizualizar su contendio
function openModal() {
  $('body').addClass("modal-open");
  $("#myModal").addClass("show");
  $("#myModal").attr("aria-hidden", "false");
  $("#myModal").css("display", "block");
  $('body').append("<div class='modal-backdrop fade show'></div>");
}
//Cierra el modal que abre
function closeModal() {
  $('body').removeClass("modal-open");
  $("#myModal").removeClass("show");
  $("#myModal").attr("aria-hidden", "true");
  $("#myModal").css("display", "none");
  $('.modal-backdrop').remove();
}
//Le da un formato a las fechas 
function formatFecha(fecha) {
  var nuevafecha = new Date(Date.parse(fecha + 'T23:30:00-0600'));

  var options = {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  };

  return nuevafecha.toLocaleDateString('es-MX', options)
}

function mostrarMensaje(canvas,mensaje) {
  $(canvas).hide();
  $(mensaje).show();
  $(mensaje).html("No hay registros de las fechas seleccionadas");
}

function ocultarMensaje(canvas,mensaje) {
  $(mensaje).hide();
  $(canvas).show();
}