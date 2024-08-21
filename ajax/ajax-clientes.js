$(document).ready(function(e){

cargarClientes("");
buscarInformacion();
});


// Esta función se encarga de localizar la información en el input
function buscarInformacion(){
	$(document).on('keyup', '#busqueda', function()
	{
		var valorBusqueda=$(this).val();
		cargarClientes(valorBusqueda);
	});
}

function limpiarModalAgregar(){
	$("#rfc").val("");
	$("#nombre").val("");
	$("#apellidoPaterno").val("");
	$("#apellidoMaterno").val("");
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


function cargarClientes(clientes)
{
	$.ajax({
		url : '../controller/global-controller.php',
		method : 'POST',
		data: {clientes: clientes},
		beforeSend: function () {
				 // alert("enviando" + clientes);
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
                        data[i].rfc +
												"</td><td>" +
				                data[i].apellidoPaterno + " " + data[i].apellidoMaterno +
                        "</td><td>" +
                        data[i].nombre +
                        "</td><td height='10' width='10'><button class='dropdown-item' type='button' data-toggle='modal' onclick='eliminarCliente("+data[i].idCliente+")'>														<i class='fa fa-trash' style='color: red'></i></button></td>\n\ "+
                        		 "<td height='10' width='10'><button class='dropdown-item' type='button' data-toggle='modal' onClick='cargarModalActualizar("+data[i].idCliente+")' >													<i class='fa fa-edit' style='color: #28a745'></i></button></td>\n\ "+
                        		 "<td height='10' width='10'><button class='dropdown-item' type='button' data-toggle='modal' onClick='cargarCliente("+ data[i].idCliente+")' data-target='#modalInformación' ><i class='fa fa-info-circle' style='color: #002752'></i></button></td>\n\
                         \n\
              "
                "</td></tr>";
            }
            out += "</table>";
						document.getElementById("registros_content").innerHTML = out;
	},
	error: function(data){
		// console.log(data);
		 // alert("no se pudo cargar la información");
	}

});
}


function agregarCliente() {

    $.ajax({
      url : '../controller/global-controller.php',
      method : 'POST',
      data: {
              agregarCliente: true,
							rfcCliente: $("#rfc").val(),
              nombreCliente: $("#nombre").val(),
              apellidoPaternoCliente: $("#apellidoPaterno").val(),
							apellidoMaternoCliente: $("#apellidoMaterno").val(),
							telefonoCliente: $("#telefono").val(),
              correoCliente: $("#correo").val(),
							coloniaCliente: $("#colonia").val(),
							calleCliente: $("#calle").val(),
							cpCliente: $("#cp").val(),
							numExtCliente: $("#exterior").val(),
							numIntCliente: $("#interior").val(),
							idEstadoCliente: document.getElementById("idEstado").value,
							idMunicipioCliente: document.getElementById("idMunicipio").value,
							idLocalidadCliente: document.getElementById("idLocalidad").value,
            },
      beforeSend: function () {
             // alert("se está enviando la informacion");
       },
         /*dataType : 'html',*/

      success: function (data) {
         // alert("se ha devuelto" + data);
         // alert(typeof(data));
         // console.log(data);

				limpiarModalAgregar()
        cargarClientes("");
				 // $("#agregar_nuevo_registro_modal").modal("hide");
        // alert("SE AGREGÓ EL CLIENTE EXITOSAMENTE");
    },
      error: function(data){
         //   console.log(data);
				 //  alert(data)
         // alert("no se pudo agregar al cliente");
      }

    });
		Swal.fire({
		position: 'center',
						type: 'success',
						title: 'El proveedor ha sido agregado',
						showConfirmButton: false,
						timer: 2000
		});
}


function cargarModalActualizar(consultarCliente) {
    // Add User ID to the hidden field for furture usage
    $("#id_usuario_oculto").val(consultarCliente);
    $("#actualizar_modal_usuario").modal('show');
    $.ajax({
      url : '../controller/global-controller.php',
      method : 'POST',
      data: {consultarCliente: consultarCliente},
      beforeSend: function () {
             // alert("se está enviando: " + consultarCliente);
       },
         /*dataType : 'html',*/
      success: function (data) {
        // alert("se ha recibido: " + data);
        for (i = 0; i < data.length; i++) {
        // Assing existing values to the modal popup fields
				$("#actualizar_rfc").val(data[i].rfc);
        $("#actualizar_nombre").val(data[i].nombre);
        $("#actualizar_apellidoPaterno").val(data[i].apellidoPaterno);
				$("#actualizar_apellidoMaterno").val(data[i].apellidoMaterno);
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
         // alert("ha ocurrido un error en cargarModalActualizar");
      }

    });
    // Open modal popup
}

function actualizarCliente() {
    $.ajax({
      url : '../controller/global-controller.php',
      method : 'POST',
      data: {
              actualizarCliente: true,
              idCliente:$("#id_usuario_oculto").val(),
							rfcCliente: $("#actualizar_rfc").val(),
              nombreCliente: $("#actualizar_nombre").val(),
              apellidoPaternoCliente: $("#actualizar_apellidoPaterno").val(),
							apellidoMaternoCliente: $("#actualizar_apellidoMaterno").val(),
							telefonoCliente: $("#actualizar_telefono").val(),
              correoCliente:$("#actualizar_correo").val(),
							coloniaCliente: $("#actualizar_colonia").val(),
							calleCliente: $("#actualizar_calle").val(),
							cpCliente: $("#actualizar_cp").val(),
							numExtCliente: $("#actualizar_exterior").val(),
							numIntCliente: $("#actualizar_interior").val(),
							idEstadoCliente: document.getElementById("editEdo").value,
							idMunicipioCliente:document.getElementById("editMunicipio").value,
							idLocalidadCliente: document.getElementById("idLocalidad").value,
            },
      beforeSend: function () {
              // alert(idEstadoCliente);
       },
      success: function (data) {
        // alert(data);
        // alert(typeof(data));
         // console.log(data);
				 $("#busqueda").val("");
        cargarClientes("");
				$("#actualizar_modal_usuario").modal("hide");
        // alert("Datos actualizados correctamente");
// console.log(data);

    },
      error: function(data){
				 //  console.log(data);
         // alert("no se pudo actualizar al cliente");
      }

    });

		Swal.fire({
		position: 'center',
						type: 'success',
						title: 'El cliente ha sido actualizado',
						showConfirmButton: false,
						timer: 2000
		});

}




function cargarCliente(consultarCliente){
//    setInterval (function (){
        $.ajax({
        data: {consultarCliente: consultarCliente},
        url: "../controller/global-controller.php?",
        type: "POST",
				beforeSend: function () {
							 // alert(consultarCliente);
				 },
        success: function (data) {
						// alert(data);
						// console.log(data);
            var i;
            var out = "<table border='1'>";
            for (i in data) {
                out += " <tr><td>RFC:</td><td class='text-primary'>" +
                        data[i].rfc +
                        "</td></tr><tr><td>Nombre:</td><td class='text-primary'>" +
                        data[i].nombre +
                        "</td></tr><tr><td>Primer Apellido:</td><td class='text-primary'>" +
                        data[i].apellidoPaterno +
                        "</td></tr><tr><td>Segundo Apellido:</td><td class='text-primary'>" +
                        data[i].apellidoMaterno+
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
            document.getElementById("infoCliente").innerHTML = out;
        },
		error: function(data){
			// console.log(data);
		}
    });
//},1000);
}


function eliminarCliente(eliminarCliente){

	// var eliminarCliente = $("#id_usuario_oculto").val();
	Swal.fire({
	 title: '¿Estas seguro de eliminar a este cliente?',
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
				data: {eliminarCliente: eliminarCliente},
				beforeSend: function (){
					 // alert("se está enviando "+ eliminarCliente)
				},
        success: function (data) {
					// alert(data);
					// alert(typeof(data));
					// console.log(data);
					$("#busqueda").val("");
					cargarClientes("");
					// alert("debajo de cargar clientes");
					$("#modalEliminar").modal("hide");
					// alert("debajo de esconder clientes");
	        // alert("Sé eliminó el cliente correctamente");
        },
				error: function (data){
					// alert(data);
					// console.log(data);
					// alert("no se pudo elimnar el cliente");
				}
			});
			Swal.fire(
				'¡Eliminado!',
			 'El cliente ha sido eliminado',
				'success'
			);
			}else{
						 Swal.fire({
			type: 'error',
			title: 'Oops...',
			text: '¡No se elimino al cliente!'
			});
			}

    });
}
