$(document).ready(function(e){

cargarSucursales("");
buscarInformacion();
});


// Esta función se encarga de localizar la información en el input
function buscarInformacion(){
	$(document).on('keyup', '#busqueda', function()
	{
		var valorBusqueda=$(this).val();
		cargarSucursales(valorBusqueda);
	});
}

function limpiarModalAgregar(){
	$("#nombre").val("");
	$("#telefono").val("");
	$("#correo").val("");
	$("#colonia").val("");
	$("#calle").val("");
	document.getElementById("municipios").innerHTML =
	"<select class='custom-select'>	<option selected=''>--SELECCIONE--</option>	</select>";
	document.getElementById("localidades").innerHTML =
	"<select class='custom-select'>	<option selected=''>--SELECCIONE--</option>	</select>";
	$("#cp").val("");
	$("#exterior").val("");
	$("#interior").val("");
}


function cargarSucursales(sucursales)
{
	$.ajax({
		url : '../controller/global-controller.php',
		method : 'POST',
		data: {sucursales: sucursales},
		beforeSend: function () {
				 // alert("enviando" + sucursales);
		 },
		   /*dataType : 'html',*/

	  success: function (data) {
			 // alert(typeof(data));
			  // alert(data);
			 // console.log(data);
        var i;
            var out = "<table border='1'>";
            for (i = 0; i < data.length; i++) {

                out += " <tr><td>" +
                        data[i].idSucursal +
												"</td><td>" +
				                data[i].sucursal +
                        "</td><td>" +
				                data[i].telefono +
                        "</td><td>" +
												"c/" + data[i].calle + ", #" + data[i].numeroExt + ", Col. " + data[i].colonia + ", C.P. " + data[i].codigoPostal +
                        "</td><td>" +
                        data[i].correo +
                        "</td><td height='10' width='10'><button class='dropdown-item' type='button' data-toggle='modal' onclick='eliminarSucursal("+data[i].idSucursal+")'>											<i class='fa fa-trash' style='color: red'></i></button></td>\n\ "+
                        		 "<td height='10' width='10'><button class='dropdown-item' type='button' data-toggle='modal' onClick='cargarModalActualizar("+data[i].idSucursal+")' >		 											<i class='fa fa-edit' style='color: #28a745'></i></button></td>\n\ "+
                             "<td height='10' width='10'><button class='dropdown-item' type='button' data-toggle='modal' onClick='cargarSucursal("+ data[i].idSucursal+")' data-target='#modalInformación' ><i class='fa fa-info-circle' style='color: #002752'></i></button></td>\n\
                         \n\
              "
                "</td></tr>";
            }
            out += "</table>";
						document.getElementById("registros_content").innerHTML = out;
	},
	error: function(data){
		console.log(data);
		 // alert("no se pudo cargar la información");
	}

});
}


function agregarSucursal() {
    var agregarSucursal =true;
    var nombreSucursal = $("#nombre").val();
		var telefonoSucursal = $("#telefono").val();
    var correoSucursal = $("#correo").val();
		var coloniaSucursal = $("#colonia").val();
    var calleSucursal = $("#calle").val();
		var cpSucursal = $("#cp").val();
		var numExtSucursal = $("#exterior").val();
		var numIntSucursal = $("#interior").val();
		var idEstadoSucursal= document.getElementById("idEstado").value;
		var idMunicipioSucursal= document.getElementById("idMunicipio").value;
		var idLocalidadSucursal= document.getElementById("idLocalidad").value;

    $.ajax({
      url : '../controller/global-controller.php',
      method : 'POST',
      data: {
              agregarSucursal: agregarSucursal,
              nombreSucursal: nombreSucursal,
							telefonoSucursal: telefonoSucursal,
              correoSucursal: correoSucursal,
							coloniaSucursal: coloniaSucursal,
							calleSucursal: calleSucursal,
							cpSucursal: cpSucursal,
							numExtSucursal: numExtSucursal,
							numIntSucursal: numIntSucursal,
							idEstadoSucursal: idEstadoSucursal,
							idMunicipioSucursal: idMunicipioSucursal,
							idLocalidadSucursal: idLocalidadSucursal,
            },
      beforeSend: function () {
               // alert("se está enviando " + idMunicipioSucursal);
       },
         /*dataType : 'html',*/

      success: function (data) {
         // alert("se ha devuelto" + data);
         // alert(typeof(data));
         // console.log(data);

				limpiarModalAgregar()
        cargarSucursales("");
    },
      error: function(data){
         //   console.log(data);
				 //   alert(data)
         // alert("no se pudo agregar al sucursal");
      }

    });
		Swal.fire({
		position: 'center',
						type: 'success',
						title: 'La Sucursal ha sido agregada',
						showConfirmButton: false,
						timer: 2000
		});
}


function cargarModalActualizar(consultarSucursal) {
    // Add User ID to the hidden field for furture usage
    $("#id_sucursal_oculto").val(consultarSucursal);

    $("#actualizar_modal_sucursal").modal('show');

		// modificarEstado();
    $.ajax({
      url : '../controller/global-controller.php',
      method : 'POST',
      data: {consultarSucursal: consultarSucursal},
      beforeSend: function () {
             // alert("se está enviando: " + consultarSucursal);
       },
         /*dataType : 'html',*/

      success: function (data) {
        // alert("se ha recibido: " + data);


        for (i = 0; i < data.length; i++) {
        // Assing existing values to the modal popup fields
        $("#actualizar_nombre").val(data[i].sucursal);
				$("#actualizar_telefono").val(data[i].telefono);
        $("#actualizar_correo").val(data[i].correo);
				$("#actualizar_calle").val(data[i].calle);
				$("#actualizar_exterior").val(data[i].numeroExt);
				$("#actualizar_interior").val(data[i].numeroInt);
				document.getElementById("editarEstado").innerHTML =
				"<select class='custom-select' id='editEdo' name='estado' onclick='modificarEstado()' >"+
				"<option value="+data[i].idEstado+" selected="+ data[i].idEstado + "> "+data[i].estado+
				"</option></select>";
				document.getElementById("editarMunicipio").innerHTML =
				"<select class='custom-select' id='editMunicipio' name='municipio' >"+
				"<option value="+data[i].idMunicipio+" selected="+ data[i].idMunicipio + "> "+data[i].municipio+
				"</option></select>";
				document.getElementById("editarLocalidas").innerHTML =
				"<select class='custom-select' id='idLocalidad' name='localidad' >"+
				"<option value="+data[i].idLocalidad+" selected="+ data[i].idLocalidad + "> "+data[i].localidad+
				"</option></select>";
				$("#actualizar_colonia").val(data[i].colonia);
				$("#actualizar_cp").val(data[i].codigoPostal)
        }

      },
      error: function(){
         alert("ha ocurrido un error en cargarModalActualizar");
      }

    });
    // Open modal popup
}

function actualizarSucursal() {
    // get values
        var actualizarSucursal =true;
        var nombreSucursal = $("#actualizar_nombre").val();
        var idSucursal = $("#id_sucursal_oculto").val();
				var telefonoSucursal = $("#actualizar_telefono").val();
        var correoSucursal = $("#actualizar_correo").val();
				var coloniaSucursal = $("#actualizar_colonia").val();
				var cpSucursal = $("#actualizar_cp").val();
				var calleSucursal = $("#actualizar_calle").val();
				var numExtSucursal = $("#actualizar_exterior").val();
				var numIntSucursal = $("#actualizar_interior").val();
				var idEstadoSucursal= document.getElementById("editEdo").value;
				var idMunicipioSucursal= document.getElementById("editMunicipio").value;
				var idLocalidadSucursal= document.getElementById("idLocalidad").value;
    // Add record
    $.ajax({
      url : '../controller/global-controller.php',
      method : 'POST',
      data: {
              actualizarSucursal: actualizarSucursal,
              idSucursal: idSucursal,
              nombreSucursal: nombreSucursal,
							telefonoSucursal: telefonoSucursal,
              correoSucursal:correoSucursal,
							coloniaSucursal: coloniaSucursal,
							calleSucursal: calleSucursal,
							cpSucursal: cpSucursal,
							numExtSucursal: numExtSucursal,
							numIntSucursal: numIntSucursal,
							idEstadoSucursal: idEstadoSucursal,
							idMunicipioSucursal:idMunicipioSucursal,
							idLocalidadSucursal: idLocalidadSucursal,
            },
      beforeSend: function () {
              // alert(idEstadoSucursal);
       },
      success: function (data) {
        // alert(data);
        // alert(typeof(data));
         // console.log(data);
				 $("#busqueda").val("");
        cargarSucursales("");
				$("#actualizar_modal_sucursal").modal("hide");
        // alert("Datos actualizados correctamente");
// console.log(data);

    },
      error: function(data){
				  // console.log(data);

         // alert("no se pudo actualizar al sucursal");
      }

    });
		Swal.fire({
		position: 'center',
						type: 'success',
						title: 'La sucursal ha sido actualizada',
						showConfirmButton: false,
						timer: 2000
		});
}




function cargarSucursal(consultarSucursal){
//    setInterval (function (){
        $.ajax({
        data: {consultarSucursal: consultarSucursal},
        url: "../controller/global-controller.php?",
        type: "POST",
				beforeSend: function () {
							 // alert(consultarSucursal);
				 },
        success: function (data) {
						// alert(data);
						// console.log(data);
            var i;
            var out = "<table border='1'>";
            for (i in data) {
                out += " <tr><td>Nombre:</td><td class='text-primary'>" +
                        data[i].sucursal+
                        "</td></tr><tr><td>Teléfono:</td><td class='text-primary'>"+
                        data[i].telefono+
                        "</td></tr><tr><td>Correo:</td><td class='text-primary'>"+
                        data[i].correo+
												"</td></tr><tr><td>Calle:</td><td class='text-primary'>"+
                        data[i].calle+
                        "</td></tr><tr><td>N° Exterior:</td><td class='text-primary'>#"+
                        data[i].numeroExt+
                        "</td></tr><tr><td>N° Interior:</td><td class='text-primary'>#"+
                        data[i].numeroInt+
												"</td></tr><tr><td>Colonia:</td><td class='text-primary'>"+
												data[i].colonia+
												"</td></tr><tr><td>Código Postal:</td><td class='text-primary'>"+
												data[i].codigoPostal+
                        "</td></tr><tr><td>Localidad:</td><td class='text-primary'>"+
                        data[i].localidad+
												"</td></tr><tr><td>Municipio:</td><td class='text-primary'>"+
												data[i].municipio+
												"</td></tr><tr><td>Estado:</td><td class='text-primary'>"+
												data[i].estado+
                        "</td></tr>";
            }
            out += "</table>";
            document.getElementById("infoSucursal").innerHTML = out;
        },
		error: function(data){
			 // console.log(data);
		}
    });
//},1000);
}

// function cargarModalEliminarSucursal(eliminarSucursal){
// 	$("#id_sucursal_eliminar_oculto").val(eliminarSucursal);
// 	$("#modal_eliminar_sucursal").modal('show');
// }

function eliminarSucursal(eliminarSucursal){
	// var eliminarSucursal = $("#id_sucursal_eliminar_oculto").val();
	Swal.fire({
	 title: '¿Estas seguro de eliminar a esta sucursal?',
	 type: 'warning',
	 showCancelButton: true,
	 cancelButtonText: 'Cancelar',
	 confirmButtonColor: '#3085d6',
	 cancelButtonColor: '#d33',
	 confirmButtonText: 'Sí, eliminar'
 }).then((result) => {
	 if (result.value) {
	$.ajax({
        url:"../controller/global-controller.php",
        method: "POST",
				data: {eliminarSucursal: eliminarSucursal},
				beforeSend: function (){
					 // alert("se está enviando "+ eliminarSucursal)
				},
        success: function (data) {
					// alert(data);
					// alert(typeof(data));
					// console.log(data);
					$("#busqueda").val("");
					cargarSucursales("");
					$("#modal_eliminar_sucursal").modal("hide");
	        // alert("Sé eliminó el sucursal correctamente");
        },
				error: function (data){
					// alert(data);
					// console.log(data);
					 // alert("no se pudo eliminar el sucursal");
				}


    });
		Swal.fire(
			'¡Eliminada!',
		 'La sucursal ha sido eliminada',
			'success'
		);
		}else{
					 Swal.fire({
		type: 'error',
		title: 'Oops...',
		text: '¡No se elimino la sucursal!'
		});
		}

	});
}
