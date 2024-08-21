//Se ejecuta cuando la pagina HTML se haya cargado.
$(document).ready(function () {
    mostrarEmpleado();
    buscarEmpleadobyNombre();
});
//------------------------->
//Muestra todos los empleados de la base de datos en una tabla.
function mostrarEmpleado() {
    // Se traé el id de la sucursal que pertenece.
    var sucursal = 1; 
    $.ajax({
        //Se realiza la petición AJAX enviando el id de la sucursal para mostrar a los empleados.
        url: "http://localhost/COVAN/controller/global-controller.php?mostrarEmpleado=" + sucursal,
        method: "GET",
        beforeSend: function () {
            //Muestra una pantalla de craga.
            mostrarSpinner();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            ocultarSpinner();
            var txt = "";
            txt += "<table border='1'>";
            //Con este ciclo FOR se llenan los datos con HTML.
            for (var i in data) {
                txt += "<tr style='" + data[i].estiloEliminar + "'>\n\
      <td>" + data[i].empleado + "</td>\n\
      \n\<td>" + data[i].apellidoPaterno + "</td>\n\
      \n\<td>" + data[i].apellidoMaterno + "</td>\n\
      \n\<td>" + data[i].edad + "</td>\n\
      \n\<td>" + data[i].sexo + "</td>\n\
      \n\<td height='10' width='10'><button class='dropdown-item' type='button' id='visualizar' onclick='visualizarEmpleado(" + data[i].idEmpleado + ")' data-toggle='modal' data-target='#ModalVisualizar' ><i class='fas fa-eye' style='color: #002752'></i></button></td>\n\
      \n\<td height='10' width='10'><button class='dropdown-item' type='button' id='editar' data-toggle='modal' data-target='#ModalEditar' onclick='userToEdit(" + data[i].idEmpleado + ")' data-target='#modalActualizar'><i class='fas fa-user-edit' style='color: #28a745'></i></button></td>\n\
      \n\</td><td height='10' width='10'><button class='dropdown-item' id='eliminar' type='button' data-toggle='modal' onclick='eliminar(" + data[i].idEmpleado + ")'><i class='fas fa-user-times' style='color: red' ></i></button></td>\n\
      \n\
       </tr>";
            }
            txt += "</table>"
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("empleado").innerHTML = txt;
        }
    });
}
//--------------------------------------------------------------------------------------------------------->
//función para llamar a varias funciones
function activarFunciones() {
    consultarEstadosAg();
    consultarSucursales();
    consultarTurno();

}
//------------------------------------------------------------------------------------------------->
// Valida que todo el formulario este lleno, si lo hace regresara un TRUE de lo contrario un FALSE.
function validarFormulario() {
    if ($("#nombre").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo NOMBRE no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        $("#nombre").focus();
        return false;
    }
    if ($("#paterno").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo APELLIDO PATERNO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo PATERNO directamente.
        $("#paterno").focus();
        return false;
    }
    if ($("#materno").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo APELOLIDO MATERNO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo MATERNO directamente.
        $("#materno").focus();
        return false;
    }
    if ($("#curp").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo CURP no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo CURP directamente.
        $("#curp").focus();
        return false;
    }
    if ($("#rfc").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo RFC no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo RFC directamente.
        $("#rfc").focus();
        return false;
    }
    if ($("#calle").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo CALLE no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo CALLE directamente.
        $("#calle").focus();
        return false;
    }
    if ($("#numeroext").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo NÚMERO EXTERIOR no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo NUMERO EXT directamente.
        $("#numeroext").focus();
        return false;
    }
    if ($("#numeroint").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo NÚMERO INTERIOR no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo NUMERO INT directamente.
        $("#numeroint").focus();
        return false;
    }
    if ($("#m").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo MUNICIPIO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo MUNICIPIO directamente.
        $("#m").focus();
        return false;
    }
    if ($("#l").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo LOCALIDAD no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo LOCALIDAD directamente.
        $("#l").focus();
        return false;
    }
    if ($("#sexo").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo SEXO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo SEXO directamente.
        $("#sexo").focus();
        return false;
    }
    if ($("#edad").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo EDAD no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo EDAD directamente.
        $("#edad").focus();
        return false;
    }
    if ($("#cpostal").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo CODIGO POSTAL no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo CODIGO POSTAL directamente.
        $("#cpostal").focus();
        return false;
    }
    if ($("#colonia").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo COLONIA no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo COLONIA directamente.
        $("#colonia").focus();
        return false;
    }
    //Si todos los campos no se encuentran vasios se retorna un TRUE.
    return true;
}
//--------------------------------------------------------------------------------------------------------------------->
//Función para obetner los datos del nuevo empleado.
function getDataEmployee() {
    //Se valida el formulario.
    if (validarFormulario()) {
        // Se obtienen los datos del formulario.
        var form = $("#form_account").serialize();
        // Se envian los datos del empleado al controlador mediante AJAX.
        $.ajax({
            url: "http://localhost/COVAN/controller/global-controller.php",
            data: form,
            method: "POST",
            success: function (datos) {
            }, error: function (datos) {
                $(document).ready(function () {
                    //Se manda a llamar a la función para cargar el nuevo registro.
                    mostrarEmpleado();
                });
            }
        });
        //Se avisa al usuario que se agrego al empleado correctamente.
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Empleado nuevo ha sido guardado',
            showConfirmButton: false,
            timer: 2000
        });             
        //Se cierra el modal.
        $("#cancelar").trigger("click");
        //Se limpia todo el formulario.
        $('#form_account').trigger("reset");
    }
}
//---------------------------------------------------------------------------------------------------------------------------------------> 
//Consulta los estados para el formulario de editar empleado
function consultarEstadosEd() { 
    var estados = "estados";
    //Se realiza una petición AJAX enviendo el valor estados
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?estadoEmpleado=" + estados,
        method: "GET",
        beforeSend: function () {
            //Muestra una pantalla de carga
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga
            SweetAlert.close();
            var option = "<select class='form-control' id='SelectEditarEdo' name='estado' onchange='buscarMunicipioEdit()'> <option></option>";
            //Ciclo para recorrer y llenar los datos con HTML
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idEstado + ">" + data[i].estado + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo en la interfaz HTML
            document.getElementById("estadoE").innerHTML = option;
        }
    });
}
//-------------------------------------------------------------------------------------------------------------------------->
//Consulta los estados para el formulario de agregar empleados
function consultarEstadosAg() { 
    var estados = "estados";
//    Se realiza la petición ajax para obtener la información de la BD.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?estadoEmpleado=" + estados,
        method: "GET",
        beforeSend: function () {
            //Se muestra la pantalla de carga
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga
            SweetAlert.close();
            var option = "<select class='form-control' id='SelectAgregarEdo' name='estado' onchange='buscarMunicipio()'><option></option>";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idEstado + ">" + data[i].estado + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("estadoA").innerHTML = option; 
        }
    });
}
//-------------------------------------------------------------------------------------------------------->
//Consulta los municipios para el formulario de agregar empleados.
function buscarMunicipio() { 
    //Se trae el valor selecionado con su id.
    var idEstado = document.getElementById("SelectAgregarEdo").value; 
//    Mediante AJAX se realiza la petición al controlador con el id del estado para traer los municipios.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idestadoEmpleado=" + idEstado,
        method: "GET",
        beforeSend: function () {
            //Se muestra una pantalla de carga.
            Swal.showLoading();
        },
        success: function (data) {
//          Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='SelectAgregarMun' name='municipio' onchange='buscarLocalidades()'> <option></option>";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idMunicipio + ">" + data[i].municipio + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("municipioA").innerHTML = option;

        }
    });
}
//---------------------------------------------------------------------------------------------------------------------------->
//Consulta los municipios para el formulario de agregar empleados.
function buscarLocalidades() {
    //Se trae el valor selecionado con su id.
    var idMunicipio = document.getElementById("SelectAgregarMun").value;
//    Mediante AJAX se realiza la petición al controlador con el id del estado para traer los municipios.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idmunicipioEmpleado=" + idMunicipio,
        method: "GET",
        beforeSend: function () {
            //Se muestra una pantalla de carga.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='SelectAgregarLoc' name='localidad'>";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idLocalidad + ">" + data[i].localidad + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("localidadA").innerHTML = option;

        }
    });

}
//----------------------------------------------------------------------------------------------------------------->
//Se muestan todos los datos del empleado.
function visualizarEmpleado(id) { 
    //Mediante AJAX se realiza la petición al controlador enviendo el id.
    $.ajax({
        //Datos que se envian a traves de ajax.
        data: id, 
        url: 'http://localhost/COVAN/controller/global-controller.php?idEmpleado=' + id, 
        //método de envio.
        type: 'get', 
        beforeSend: function () {
            //Se muestra una pantalla de carga para el usuario.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var txt = "";
            //Con este ciclo se llenan los datos con HTML
            for (var i in data) {
                txt += "\n\<div class='row'>\n\
      \n\<div class='col-md-4'>\n\
      \n\<div class='form-group'>\n\
      \n\<strong><label for='nombre'>Nombre:</label></strong>\n\
      \n\<p class='form-control-static'>" + data[i].empleado + "</p>\n\
      \n\</div>\n\
      \n\</div>\n\
      \n\<div class='col-md-4'>\n\
      \n\<div class='form-group'>\n\
          \n\<strong><label for='nombre'>Apellido paterno:</label></strong>\n\
          \n\<p class='form-control-static'>" + data[i].apellidoPaterno + "</p>\n\
    \n\</div>\n\
    \n\</div>\n\
    \n\<div class='col-md-4'>\n\
        \n\<div class='form-group'>\n\
            \n\<strong><label for='nombre'>Apellido materno:</label></strong>\n\
          \n\<p class='form-control-static'>" + data[i].apellidoMaterno + "</p>\n\
        \n\</div>\n\
    \n\</div>\n\
    \n\</div>\n\
\n\
\n\<div class='row'>\n\
      <div class='col-md-4'>\n\
      \n\<div class='form-group'>\n\
      \n\<strong><label for='nombre'>Curp:</label></strong>\n\
      \n\<p class='form-control-static'>" + data[i].curp + "</p>\n\
      \n\</div>\n\
      \n\</div>\n\
      \n\<div class='col-md-4'>\n\
      <div class='form-group'>\n\
          <strong><label for='nombre'>Rfc:</label></strong>\n\
          <p class='form-control-static'>" + data[i].rfc + "</p>\n\
        </div>\n\
    </div>\n\
\n\<div class='col-md-4'>\n\
      <div class='form-group'>\n\
          <strong><label for='nombre'>Fecha de registro.:</label></strong>\n\
          <p class='form-control-static'>" + data[i].fecha + "</p>\n\
        </div>\n\
    </div>\n\
\n\
\n\
      \n\</div>\n\
\n\<div class='row'>\n\
\n\<div class='col-md-3'>\n\
       \n\<div class='form-group'>\n\
       \n\<strong><label for='calle'>Colonia:</label></strong>\n\
          \n\<p class='form-control-static'>" + data[i].colonia + "</p>\n\
        \n\</div>\n\
         \n\</div>\n\
    \n\<div class='col-md-3'>\n\
       \n\<div class='form-group'>\n\
       \n\<strong><label for='calle'>Calle:</label></strong>\n\
          \n\<p class='form-control-static'>" + data[i].calle + "</p>\n\
        \n\</div>\n\
         \n\</div>\n\
    \n\<div class='col-md-3'>\n\
       \n\ <div class='form-group'>\n\
       \n\     <strong><label for='numero'>Número exterior:</label></strong>\n\
       \n\   <p class='form-control-static'>" + data[i].numeroExt + "</p>\n\
      \n\  </div>\n\
    \n\</div>\n\
    \n\<div class='col-md-3'>\n\
       \n\ <div class='form-group'>\n\
       \n\     <strong><label for='numero'>Número interior:</label></strong>\n\
       \n\   <p class='form-control-static'>" + data[i].numeroInt + "</p>\n\
       \n\ </div>\n\
    \n\</div>\n\
\n\</div>\n\
\n\<div class='row'>\n\
    \n\<div class='col-md-3'>\n\
        \n\<div class='form-group'>\n\
            \n\<strong><label for='estado'>Estado:</label></strong>\n\
      \n\<p class='form-control-static'>" + data[i].estado + "</p>\n\
   \n\</div>\n\
    \n\</div>\n\
    \n\<div class='col-md-3'>\n\
       \n\ <div class='form-group'>\n\
           \n\ <strong><label for='municipio'>Municipio:</label></strong>\n\
      \n\<p class='form-control-static'>" + data[i].municipio + "</p>\n\
   \n\</div>\n\
    \n\</div>\n\
    \n\<div class='col-md-3'>\n\
        \n\<div class='form-group'>\n\
           \n\ <strong><label for='localidad'>Localidad:</label></strong>\n\
    \n\ <p class='form-control-static'>" + data[i].localidad + "</p>\n\
   \n\</div>\n\
    \n\</div>\n\
\n\<div class='col-md-3'>\n\
        \n\<div class='form-group'>\n\
           \n\ <strong><label for='localidad'>Codigo postal:</label></strong>\n\
    \n\ <p class='form-control-static'>" + data[i].codigoPostal + "</p>\n\
   \n\</div>\n\
    \n\</div>\n\
\n\</div>\n\
\n\<div class='row'>\n\
   \n\ <div class='col-md-4'>\n\
      \n\ <div class='form-group'>\n\
           \n\<strong><label for='turno'>Turno:</label></strong>\n\
     \n\ <p class='form-control-static'>" + data[i].turno + "</p>\n\
   \n\</div>\n\
    \n\</div>\n\
    \n\<div class='col-md-4'>\n\
        \n\<div class='form-group'>\n\
           \n\ <strong><label for='sexo'>Sexo:</label></strong>\n\
      \n\<p class='form-control-static'>" + data[i].sexo + "</p>\n\
   \n\</div>\n\
   \n\ </div>\n\
    \n\<div class='col-md-4'>\n\
        \n\<div class='form-group'>\n\
            \n\<strong><label for='edad'>Edad:</label></strong>\n\
         \n\ <p class='form-control-static'>" + data[i].edad + " años</p>\n\
        \n\</div>\n\
    \n\</div>\n\
\n\</div>\n\
\n\ <div class='form-group'>\n\
          \n\<strong><label for='sucursal'>Sucursal:</label></strong>\n\
      \n\<p class='form-control-static'>" + data[i].sucursal + "</p>\n\
   \n\</div>\n\
\n\<hr/> \n\
\n\<div class='row'>\n\
\n\<div class='col-md-12'><button type='button' class='btn btn-primary btn-block' data-toggle='modal' data-target='#ModalAgregarSistema' id='botonUsuario' onclick='obtenerIdDelUsuario(" + data[i].idEmpleado + ");'>Agregar empleado al sistema</button></div>\n\
</div>\n\
 ";
            }
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("MbodyVisualizar").innerHTML = txt;
        }
    });
    //La función valida si el empleado ya tiene su usuario para el sistema.
    validarRegistroU(id);
}
//---------------------------------------------------------------------------------------------------------------------------------->
//Muestra el municipio que le pertenece al empleado.
function buscarMunicipioEdit() {
    //Se trae el valor selecionado con su id.
    var idEstado = document.getElementById("SelectEditarEdo").value; 
    //Mediante AJAX se reliza la petición al controlador enviendo el id para traer todos los datos que le pertenecen al mismo.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idestadoEmpleado=" + idEstado,
        //Metodo de envio.
        method: "GET",
        beforeSend: function () {
            //Se muestra pantalla de carga.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='SelectEditarMun' name='municipio'  onchange='buscarLocalidadEdit()'> <option></option>";
            //Con este ciclo se llenan los datos con HTML. 
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idMunicipio + ">" + data[i].municipio + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz
            document.getElementById("municipioE").innerHTML = option;
        }
    });
}
//----------------------------------------------------------------------------------------------------------------------->
//Con esta función muestra más municipios a escojer para el usuaurio.
function consultarMasMunicipios(id) {
    //Mediante AJAX se realiza una petición al controlador para traer los demás municipio.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idestadoEmpleado=" + id,
        //Metodo de envio.
        method: "GET", 
        beforeSend: function () {
            //Se muestra pantalla de carga.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='SelectEditarMun' name='municipio'  onchange='buscarLocalidadEdit()'> <option></option>";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idMunicipio + ">" + data[i].municipio + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("municipioE").innerHTML = option;
        }
    });
}
//----------------------------------------------------------------------------------------------------------------------------------->
//Con esta función muestra más localidades a escojer para el usuaurio.
function consultarMasLocalidades(id) {
    //Mediante AJAX se realiza una petición al controlador para traer las demás localidades.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idmunicipioEmpleado=" + id,
        //Metodo de envio.
        method: "GET",
        beforeSend: function () {
            //Se muestra una pantalla de carga de datos.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='SelectEditarLoc' name='localidad'>";
           //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idLocalidad + ">" + data[i].localidad + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("localidadE").innerHTML = option;

        }
    });
}
//-------------------------------------------------------------------------------------------------------------------------->
//Con esta función muestra las localidades para el formulario editar usuario.
function buscarLocalidadEdit() {
    //Se trae el valor selecionado con su id.
    var idMunicipio = document.getElementById("SelectEditarMun").value;
    //Mediante AJAX se realiza una petición al controlador para traer las localidades.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idmunicipioEmpleado=" + idMunicipio,
        //Metodo de envio.
        method: "GET",
        beforeSend: function () {
            //Se muestra una pantalla de carga de datos.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='SelectEditarLoc' name='localidad'>";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idLocalidad + ">" + data[i].localidad + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("localidadE").innerHTML = option;

        }
    });

}
//------------------------------------------------------------------------------------------------------------------>
//En esta función se consulta y se muestra los datos del empleados y del usuario.
function userToEdit(id) {
    $.ajax({
        data: id, //Datos que se envian a traves de ajax.
        url: 'http://localhost/COVAN/controller/global-controller.php?idEmpleado=' + id, //archivo que recibe la peticion
        type: 'get', //Método de envio.     
        beforeSend: function () {
            //Se muestra pantalla de carga de datos.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var txt = "<form method='post' id='formEditar' >";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                txt += "\n\
        \n\<div class='input-group mb-3'>\n\
     \n\<div class='input-group-prepend'>\n\
        \n\<span class='input-group-text'>Empleado</span>\n\
      \n\</div>\n\
          \n\<input type='text' class='form-control' id='nombreE' name='nombreEditar' placeholder='Nombre(s).' required value='" + data[i].empleado + "'>\n\
      \n\<input type='text' class='form-control' id='paternoE' name='paterno' placeholder='Apellido paterno.' required value='" + data[i].apellidoPaterno + "'>\n\
     \n\<input type='text' class='form-control' id='maternoE' name='materno' placeholder='Apellido materno.' required value='" + data[i].apellidoMaterno + "'>\n\
    \n\</div>\n\
\n\<div class='row'>\n\
      <div class='col-md-6'>\n\
      \n\<div class='form-group'>\n\
      \n\<strong><label for='nombre'>Curp:</label></strong>\n\
      \n\<input class='form-control' id='curpE' name='curp' placeholder='Curp' type='text' required value=" + data[i].curp + ">\n\
      \n\</div>\n\
      \n\</div>\n\
      \n\<div class='col-md-6'>\n\
      <div class='form-group'>\n\
          \n\<strong><label for='nombre'>Rfc:</label></strong>\n\
          \n\ <input class='form-control' id='rfcE' name='rfc' placeholder='RFC' type='text' required value=" + data[i].rfc + ">\n\
        </div>\n\
    </div>\n\
\n\
\n\
      \n\</div>\n\
\n\<br>\n\
\n\<div class='input-group mb-3'>\n\
     \n\<div class='input-group-prepend'>\n\
        \n\<span class='input-group-text'>Dirección.</span>\n\
      \n\</div>\n\
\n\<input type='text' class='form-control' id='coloniaE' name='colonia' placeholder='Colonia.' required value='" + data[i].colonia + "'>\n\
          \n\<input type='text' class='form-control' id='calleE' name='calle' placeholder='Calle' required value='" + data[i].calle + "'>\n\
      \n\<input type='number' class='form-control' id='numeroExtE' name='numeroExt' placeholder='Número ext.' required value=" + data[i].numeroExt + ">\n\
     \n\<input type='number' class='form-control' id='numeroIntE' name='NumeroInt' placeholder='Número int.' required value=" + data[i].numeroInt + ">\n\
    \n\</div>\n\
\n\<div class='row'>\n\
    \n\<div class='col-md-3'>\n\
    \n\<strong><label for='estado'>Estado:</label></strong>\n\
        \n\<div class='form-group' id='estadoE'>\n\
      \n\<select class='form-control' name='estado' id='SelectEditarEdo' onchange='buscarMunicipioEdit()' >\n\
        \n\<option value=" + data[i].idEstado + ">" + data[i].estado + "</option>\n\
        \n\<option value='1'>Aguascalientes</option>\n\
        \n\<option value='2'>Baja California</option>\n\
        \n\<option value='3'>Baja California Sur</option>\n\
        \n\<option value='4'>Campeche</option>\n\
        \n\<option value='5'>Coahuila de Zaragoza</option>\n\
        \n\<option value='6'>Colima</option>\n\
        \n\<option value='7'>Chiapas</option>\n\
        \n\<option value='8'>Chihuahua</option>\n\
        \n\<option value='9'>Distrito Federal</option>\n\
        \n\<option value='10'>Durango</option>\n\
        \n\<option value='11'>Guanajuato</option>\n\
        \n\<option value='12'>Guerrero</option>\n\
        \n\<option value='13'>Hidalgo</option>\n\
        \n\<option value='14'>Jalisco</option>\n\
        \n\<option value='15'>México</option>\n\
        \n\<option value='16'>CMichoacán de Ocampo</option>\n\
        \n\<option value='17'>Morelos</option>\n\
        \n\<option value='18'>Nayarit</option>\n\
        \n\<option value='19'>Nuevo León</option>\n\
        \n\<option value='20'>Oaxaca</option>\n\
        \n\<option value='21'>Puebla</option>\n\
        \n\<option value='22'>Querétaro</option>\n\
        \n\<option value='23'>Quintana Roo</option>\n\
        \n\<option value='24'>San Luis Potosí</option>\n\
        \n\<option value='25'>Sinaloa</option>\n\
      \n\</select>\n\
   \n\</div>\n\
    \n\</div>\n\
    \n\<div class='col-md-3'>\n\
     \n\<strong><label for='municipio'>Municipio:</label></strong>\n\
       \n\ <div class='form-group' id='municipioE'>\n\
      \n\<select class='form-control' name='municipio' id='municipio' onchange='consultarMasMunicipios(" + data[i].idEstado + ")' >\n\
        \n\<option value=" + data[i].idMunicipio + ">" + data[i].municipio + "</option>\n\
        \n\<option>Más municipios</option>\n\
      \n\</select>\n\
   \n\</div>\n\
    \n\</div>\n\
    \n\<div class='col-md-3'>\n\
\n\ <strong><label for='localidad'>Localidad:</label></strong>\n\
        \n\<div class='form-group' id='localidadE'>\n\
      \n\<select class='form-control' id='localidadE' name='localidad' onchange='consultarMasLocalidades(" + data[i].idMunicipio + ")'>\n\
        \n\<option value=" + data[i].idLocalidad + ">" + data[i].localidad + "</option>\n\
        \n\<option>Más localidades</option>\n\
      \n\</select>\n\
   \n\</div>\n\
    \n\</div>\n\
\n\<div class='col-md-3'>\n\
\n\ <strong><label for='localidad'>Codigo postal:</label></strong>\n\
        \n\<div class='form-group' id='cpostal'>\n\
\n\<input type='number' class='form-control' id='cpostalE' name='cpostal' placeholder='Codigo postal.' required value=" + data[i].codigoPostal + ">\n\
   \n\</div>\n\
    \n\</div>\n\
\n\</div>\n\
\n\<div class='row'>\n\
   \n\ <div class='col-md-4'>\n\
   \n\<strong><label for='turno'>Turno:</label></strong>\n\
      \n\ <div class='form-group' id='turnosE'>\n\
     \n\ <select class='form-control' id='turnoE' name='turno' onchange='consultarMasTurnos()' > \n\
         \n\<option value=" + data[i].idTurno + ">" + data[i].turno + "</option> \n\
        \n\ <option>Más opciones</option> \n\
       \n\</select>\n\
   \n\</div>\n\
    \n\</div>\n\
    \n\<div class='col-md-4'>\n\
        \n\<div class='form-group'>\n\
           \n\ <strong><label for='sexo'>Sexo:</label></strong>\n\
      \n\ <select class='form-control' id='sexoE' name='sexo' > \n\
         \n\<option value=" + data[i].sex + ">" + data[i].sexo + "</option> \n\
        \n\ <option value='1'>Hombre</option> \n\
         \n\<option value='2'>Mujer</option> \n\
       \n\</select>\n\
   \n\</div>\n\
   \n\ </div>\n\
    \n\<div class='col-md-4'>\n\
        \n\<div class='form-group'>\n\
            \n\<strong><label for='edad'>Edad:</label></strong>\n\
         \n\<input class='form-control' id='edadE' name='edad' placeholder='Edad.' type='number' required value=" + data[i].edad + ">\n\
        \n\</div>\n\
    \n\</div>\n\
\n\</div>\n\
\n\ <div class='form-group' id='sucursalesE'>\n\
          \n\<strong><label for='sucursal'>Sucursal:</label></strong>\n\
      \n\<select class='form-control' id='sucursalE' name='sucursal' onchange='consultarMasSucursales()'>\n\
        \n\<option value=" + data[i].idSucursal + ">" + data[i].sucursal + "</option>\n\
        \n\<option>Más opciones</option>\n\
      \n\</select>\n\
  \n\ </div>\n\
\n\<div class='form-group'> \n\
\n\<input type='hidden' id='idEmpleado' name='idEmpleado' value='" + data[i].idEmpleado + "'>\n\
\n\<input type='hidden' id='idDomicilio' name='idDomicilio' value='" + data[i].idDomicilio + "'>\n\
\n\</div>\n\
\n\<hr/> \n\
\n\<div class='row'>\n\
\n\<div class='col-md-12'><button type='button' class='btn btn-primary btn-block' data-toggle='modal' data-target='#ModalSistemaEditar' id='botonUsuarioEditar' onclick='obtenerIdDelUsuarioEditar(" + data[i].idEmpleado + ");'>Editar datos de usuario del sistema</button></div>\n\
</div>\n\
 ";
            }
            txt += "</form>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("MbodyEditar").innerHTML = txt;
        }
    });
    //Valida si el empleado ya tiene un usuario registrado en el sistema.
    validarUsuario(id);
}
//--------------------------------------------------------------------------------------------------------------------------------->
//Esta función valida si el empleado ya cuenta con un usuario.
function validarUsuario(id) {
    //Mediante AJAX se realiza una petición al controlador para traer los datos que le pertenezcan al id.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idEmpleado=" + id,
        //Metodo de envio.
        method: "GET",
        success: function (data) {
            //Con este ciclo se recorren los datos para realizar una comparación.
            for (var i in data) {
                if (data[i].statusUsuario == 0) {
                    //Deshabilita el botón.
                    $("#botonUsuarioEditar").prop('disabled', true);
                }
            }
        }
    });
}
//---------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función se muestran más turnos para el empleado.
function consultarMasTurnos() {
    var turno = "turno";
    //Mediante AJAX se realiza una petición al controlador para traer los datos de los turnos.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?turnoEmpleado=" + turno,
        //Metodo de envio.
        method: "GET",
        beforeSend: function () {
            //Se muestra una pantalla de carga de datos.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='turno' name='turno' >";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idTurno + ">" + data[i].turno + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("turnosE").innerHTML = option;

        }
    });

}
//--------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función se muestran más sucursales para el empleado.
function consultarMasSucursales() {
    var sucursal = "sucursal";
    //Mediante AJAX se realiza una petición al controlador para traer los datos de las sucursales.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?sucursalEmpleado=" + sucursal,
        //Metodod de envio.
        method: "GET",
        beforeSend: function () {
            //Se muestra una pantalla de carga de datos.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de caraga.
            SweetAlert.close();
            var option = "<select class='form-control' id='sucursal' name='sucursal' >";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idSucursal + ">" + data[i].sucursal + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("sucursalesE").innerHTML = option; 
        }
    });
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------->
//Esta función elimina al empleado seleccionado.
function eliminar(idEmpleado) { 
    //Muestra un mensaje de confirmación.
    Swal.fire({
        title: '¿Estas seguro que quieres eliminar al empleado?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar'
         // Al responder sí al mensaje de alerta, se elimina al empleado y al darle cancelar no se elimina.
    }).then((result) => {
        if (result.value) {
            //Mediante AJAX se realiza una petición al controlador para mandar el id del empleado y eliminarlo.
            $.ajax({
                url: "http://localhost/COVAN/controller/global-controller.php?eliminarEmpleado=" + idEmpleado,
                //Método de envio.
                method: "GET",
                success: function (datos) {
                    //Se carga la tabla de los empleados.
                    mostrarEmpleado();
                }, error: function (datos) {
                }
            });
            //Mensaje de eliminar.
            Swal.fire(
                    '¡Eliminado!',
                    'El empleado ha sido eliminado',
                    'success'
                    );
        }
    });
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//Muestra todas las sucursales en el formulario de agregar empleado.
function consultarSucursales() { 
    var sucursal = "sucursal";
    //Mediante AJAX se realiza una petición al controlador para traer los datos de las sucursales.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?sucursalEmpleado=" + sucursal,
        //Método de envio.
        method: "GET",
        beforeSend: function () {
            //Pantalla de carga de datos.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='sucursal' name='sucursal' >";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idSucursal + ">" + data[i].sucursal + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("sucursales").innerHTML = option; 

        }
    });
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//Se consultan todos los turnos y los muestra en la interfaz.
function consultarTurno() { 
    var turno = "turno";
    //Mediante AJAX se realiza una petición al controlador para traer los datos de los turnos.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?turnoEmpleado=" + turno,
        //Método de envio.
        method: "GET",
        beforeSend: function () {
            //Se muestra pantalla de carga de datos.
            Swal.showLoading();
        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var option = "<select class='form-control' id='turno' name='turno' >";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                option += "\n\
       \n\<option value=" + data[i].idTurno + ">" + data[i].turno + "</option>\n\
      ";
            }
            option += "</select>";
            //Se inyecta el codigo con los datos en la interfaz.
            document.getElementById("turnosA").innerHTML = option;
        }
    });
}
//----------------------------------------------------------------------------------------------------------------------------------->
//En esta función se obtienen los datos a editar del empleado.
function obtenerDatosEditar() {
    //Se valida que todos los no estén vasios.
    if (validarFormularioEditar()) {
        //Muestra un mensaje de confirmación.
        Swal.fire({
            title: '¿Esta seguro que quiere guardar los datos?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí'
        }).then((result) => {
            if (result.value) {
                // Se obtienen los datos del formulario con el id del formulario.
                var form = $("#formEditar").serialize(); 
                //Mediante AJAX se envian los nuevos datos del empleado al controlador.
                $.ajax({
                    url: "http://localhost/COVAN/controller/global-controller.php",
                    data: form,
                    //Método de envio.
                    method: "POST",
                    success: function (datos) {
                    }, error: function (datos) {
                        //Recarga los nuevos datos.
                        $(document).ready(function () {
                            mostrarEmpleado();
                        });
                    }
                });
                //Cierra el modal.
                $("#cancelarE").trigger("click");
                Swal.fire(
                        'Datos guardados',
                        'Empleado actualizado',
                        ''
                        );
            }
        });
    }
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función valida que todo el formulario este lleno, si lo hace regresará un TRUE de lo contrario un FALSE
function validarFormularioEditar() { 
    if ($("#nombreE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo NOMBRE no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        $("#nombreE").focus();       
        return false;
    }
    if ($("#paternoE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo APELLIDO PATERNO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo APELLIDO PATERNO directamente.
        $("#paternoE").focus();       
        return false;
    }
    if ($("#maternoE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo APELOLIDO MATERNO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo APELLIDO MATERNO directamente.
        $("#maternoE").focus();       
        return false;
    }
    if ($("#curpE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo CURP no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo CURP directamente.
        $("#curpE").focus();       
        return false;
    }
    if ($("#rfcE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo RFC no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo RFC directamente.
        $("#rfcE").focus();       
        return false;
    }
    if ($("#calleE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo CALLE no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo CALLE directamente.
        $("#calleE").focus();       
        return false;
    }
    if ($("#numeroExtE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo NÚMERO EXTERIOR no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo NUMERO EXT directamente.
        $("#numeroExtE").focus();       
        return false;
    }
    if ($("#numeroIntE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo NÚMERO INTERIOR no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo NUMERO INT directamente.
        $("#numeroIntE").focus();      
        return false;
    }
    if ($("#coloniaE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo COLONIA no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo COLONIA directamente.
        $("#coloniaE").focus();       
        return false;
    }
    if ($("#municipioEd").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo MUNICIPIO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo MUNICIPIO directamente.
        $("#municipioEd").focus();      
        return false;
    }
    if ($("#localidadEd").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo LOCALIDAD no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo LOCALIDAD directamente.
        $("#localidadEd").focus();       
        return false;
    }
    if ($("#sexoE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo SEXO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo SEXO directamente.
        $("#sexoE").focus();       
        return false;
    }
    if ($("#edadE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo EDAD no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo EDAD directamente.
        $("#edadE").focus();       
        return false;
    }
    if ($("#cpostalE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo CODIGO POSTAL no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo CODIGO POSTAL directamente.
        $("#cpostalE").focus();       
        return false;
    }
    if ($("#coloniaE").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo COLONIA no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo COLONIA directamente.
        $("#coloniaE").focus();       
        return false;
    }
    return true;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------->
//En esta función se verifica que el nombre de usuario no esté ocupado.
function validarNombre() {
    //Se obtiene el valor del input.
    var nombre = $('#usuario').val();
    var idEmpresa = 1;
    
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?",
        //Método de envio.
        method: "POST",
        data: {
            'validarNombreE': nombre,
            'idEmpresa': idEmpresa
        },
        beforeSend: function () {
        },
        success: function (data) {
            //Valida si el nombre no está ocupado por otro registro.
            if (data.length == 0) {
                agregarUsuario();
            } else {
                //Muestra un mensaje de error cuando el nombre ya está ocupado.
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: '¡El nombre de usuario ya esta ocupado!',
                    footer: 'Elija uno diferente'
                });
                // Esta función coloca el foco de escritura del usuario en el campo USUARIO directamente.
                $('#usuario').focus();

            }
        }
    });
}
//------------------------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función agrega un nuevo usuario.
function agregarUsuario() {
    //Valida que todos los no estén vasios.
    if (validarFormularioUsuario()) {
        //Deshabilita el botón para agregar nuevo usuario.
        $(".custom-control-input").attr("disabled", false);
        //Cierra el modal.
        $("#cancelarUsuario").trigger("click");
        // Se obtienen los datos del formulario con el id del formulario.
        var form = $("#form_usuario").serialize();
        //Mediante AJAX se envian los datos al controlador.
        $.ajax({
            url: "http://localhost/COVAN/controller/global-controller.php",
            data: form,
            //Método de envio.
            method: "POST",
            success: function (datos) {
            }, error: function (datos) {
            }
        });
        //Se muestra un mensaje de alerta.
        Swal.fire({
            position: 'center',
            type: 'success',
            title: '¡Se ha creado el usuario correctamente!',
            showConfirmButton: false,
            timer: 1800
        });
        //Se limpa el formulario.
        $('#form_usuario').trigger("reset");
        //Se deshabilita el botón del usuario.
        $("#botonUsuario").prop('disabled', true);
    }
}
//------------------------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función valida que todo el formulario este lleno, si lo hace regresará un TRUE de lo contrario un FALSE
function validarFormularioUsuario() {

    if ($("#usuario").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo USUARIO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo Usuario directamente.
        $("#usuario").focus();       
        return false;
    }
    if ($("#pass").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo CONTRASEÑA no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo CONTRASEÑA directamente.
        $("#pass").focus();       
        return false;
    }
    if ($("#tipoUsuario").val() == "") {
        //Se muestra una alerta al usuario.  
        alert("El campo TIPO DE USUARIO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo TIPO DE USUARIO directamente.
        $("#tipoUsuario").focus();       
        return false;
    }
    $(".custom-control-input").attr("disabled", false);
    return true;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función valida que todo el formulario este lleno, si lo hace regresará un TRUE de lo contrario un FALSE
function validarFormularioUsuarioE() {

    if ($("#usuarioE").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo USUARIO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo USUARIO directamente.
        $("#usuarioE").focus();       
        return false;
    }
    if ($("#passE").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo CONTRASEÑA no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo CONTRASEÑA directamente.
        $("#passE").focus();       
        return false;
    }
    if ($("#tipoUsuarioE").val() == "") {
        //Se muestra una alerta al usuario.
        alert("El campo TIPO DE USUARIO no puede estar vacío.");
        // Esta función coloca el foco de escritura del usuario en el campo TIPO DE USUARIO directamente.
        $("#tipoUsuarioE").focus();       
        return false;
    }
    return true;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
//En esta función se cargan los privilegios segun el tipo de usuario que se asigne.
function asignarPrivilegios() {
    //Se obtienen el valor segun el tipo de usuario.
    var idPrivilegio = document.getElementById("tipoUsuario").value;
    //Cada tipo de usuario tienen su propio valor.
    if (idPrivilegio == 1) {
        //Se asignan los privilegios y se muestra en la vista.
        $("#agregar_Cliente").prop('checked', true);
        $("#modificar_Cliente").prop('checked', true);
        $("#eliminar_Cliente").prop('checked', true);
        $("#agregar_Compra").prop('checked', true);
        $("#modificar_Compra").prop('checked', true);
        $("#eliminar_Compra").prop('checked', true);
        $("#agregar_Empleado").prop('checked', true);
        $("#modificar_empleado").prop('checked', true);
        $("#eliminar_Empleado").prop('checked', true);
        $("#agregar_facturacion").prop('checked', true);
        $("#agregar_usuario").prop('checked', true);
        $("#modificar_usuario").prop('checked', true);
        $("#eliminar_usuario").prop('checked', true);
        $("#agregar_productos").prop('checked', true);
        $("#modificar_productos").prop('checked', true);
        $("#eliminar_productos").prop('checked', true);
        $("#agregar_proveedores").prop('checked', true);
        $("#modificar_proveedores").prop('checked', true);
        $("#eliminar_proveedores").prop('checked', true);
        $("#agregar_sucursales").prop('checked', true);
        $("#modificar_sucursales").prop('checked', true);
        $("#eliminar_sucursales").prop('checked', true);
        $("#agregar_ventas").prop('checked', true);
        $("#cancelar_venta").prop('checked', true);
        $("#registrar_asistencia").prop('checked', true);
        $("#agregar_departamento").prop('checked', true);
        $("#modificar_departamento").prop('checked', true);
        $("#eliminar_departamentos").prop('checked', true);
        $("#estadistica").prop('checked', true);
    } else if (idPrivilegio == 2) {
        $("#agregar_Cliente").prop('checked', true);
        $("#modificar_Cliente").prop('checked', true);
        $("#agregar_Compra").prop('checked', true);
        $("#modificar_Compra").prop('checked', true);
        $("#agregar_Empleado").prop('checked', true);
        $("#modificar_empleado").prop('checked', true);
        $("#agregar_facturacion").prop('checked', true);
        $("#agregar_usuario").prop('checked', true);
        $("#modificar_usuario").prop('checked', true);
        $("#agregar_productos").prop('checked', true);
        $("#modificar_productos").prop('checked', true);
        $("#agregar_proveedores").prop('checked', true);
        $("#modificar_proveedores").prop('checked', true);
        $("#agregar_sucursales").prop('checked', true);
        $("#modificar_sucursales").prop('checked', true);
        $("#agregar_ventas").prop('checked', true);
        $("#cancelar_venta").prop('checked', true);
        $("#registrar_asistencia").prop('checked', true);
        $("#agregar_departamento").prop('checked', true);
        $("#modificar_departamento").prop('checked', true);
        //Se desmarcan los check box.
        $("#estadistica").prop('checked', false);
        $("#eliminar_Cliente").prop('checked', false);
        $("#eliminar_Compra").prop('checked', false);
        $("#eliminar_Empleado").prop('checked', false);
        $("#eliminar_usuario").prop('checked', false);
        $("#eliminar_productos").prop('checked', false);
        $("#eliminar_proveedores").prop('checked', false);
        $("#eliminar_departamentos").prop('checked', false);
        $("#eliminar_sucursales").prop('checked', false);

    } else if (idPrivilegio == 3) {
        //Se desmarcan los check box.
        $("#agregar_Cliente").prop('checked', false);
        $("#modificar_Cliente").prop('checked', false);
        $("#agregar_Compra").prop('checked', false);
        $("#modificar_Compra").prop('checked', false);
        $("#agregar_Empleado").prop('checked', false);
        $("#modificar_empleado").prop('checked', false);
        $("#agregar_facturacion").prop('checked', false);
        $("#agregar_usuario").prop('checked', false);
        $("#modificar_usuario").prop('checked', false);
        $("#agregar_productos").prop('checked', false);
        $("#modificar_productos").prop('checked', false);
        $("#agregar_proveedores").prop('checked', false);
        $("#modificar_proveedores").prop('checked', false);
        $("#agregar_sucursales").prop('checked', false);
        $("#modificar_sucursales").prop('checked', false);
        $("#estadistica").prop('checked', false);
        
        $("#agregar_ventas").prop('checked', true);
        //Se desmarcan los check box.
        $("#cancelar_venta").prop('checked', false);
        $("#registrar_asistencia").prop('checked', false);
        $("#agregar_departamento").prop('checked', false);
        $("#modificar_departamento").prop('checked', false);
        $("#eliminar_Cliente").prop('checked', false);
        $("#eliminar_Compra").prop('checked', false);
        $("#eliminar_Empleado").prop('checked', false);
        $("#eliminar_usuario").prop('checked', false);
        $("#eliminar_productos").prop('checked', false);
        $("#eliminar_proveedores").prop('checked', false);
        $("#eliminar_departamentos").prop('checked', false);
        $("#eliminar_sucursales").prop('checked', false);
    }
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//En esta función se cargan los privilegios en el formulario Editar Usuario segun el tipo de usuario que se asigne.
function asignarPrivilegiosE() {
    //Se obtienen el valor segun el tipo de usuario.
    var idPrivilegio = document.getElementById("tipoUsuarioE").value;
    //Cada tipo de usuario tienen su propio valor.
    if (idPrivilegio == 1) {
        $("#agregar_ClienteE").prop('checked', true);
        $("#modificar_ClienteE").prop('checked', true);
        $("#eliminar_ClienteE").prop('checked', true);
        $("#agregar_CompraE").prop('checked', true);
        $("#modificar_CompraE").prop('checked', true);
        $("#eliminar_CompraE").prop('checked', true);
        $("#agregar_EmpleadoE").prop('checked', true);
        $("#modificar_empleadoE").prop('checked', true);
        $("#eliminar_EmpleadoE").prop('checked', true);
        $("#agregar_facturacionE").prop('checked', true);
        $("#agregar_usuarioE").prop('checked', true);
        $("#modificar_usuarioE").prop('checked', true);
        $("#eliminar_usuarioE").prop('checked', true);
        $("#agregar_productosE").prop('checked', true);
        $("#modificar_productosE").prop('checked', true);
        $("#eliminar_productosE").prop('checked', true);
        $("#agregar_proveedoresE").prop('checked', true);
        $("#modificar_proveedoresE").prop('checked', true);
        $("#eliminar_proveedoresE").prop('checked', true);
        $("#agregar_sucursalesE").prop('checked', true);
        $("#modificar_sucursalesE").prop('checked', true);
        $("#eliminar_sucursalesE").prop('checked', true);
        $("#agregar_ventasE").prop('checked', true);
        $("#cancelar_ventaE").prop('checked', true);
        $("#registrar_asistenciaE").prop('checked', true);
        $("#agregar_departamentoE").prop('checked', true);
        $("#modificar_departamentoE").prop('checked', true);
        $("#eliminar_departamentosE").prop('checked', true);
        $("#estadisticaE").prop('checked', true);
    } else if (idPrivilegio == 2) {
        $("#agregar_ClienteE").prop('checked', true);
        $("#modificar_ClienteE").prop('checked', true);
        $("#agregar_CompraE").prop('checked', true);
        $("#modificar_CompraE").prop('checked', true);
        $("#agregar_EmpleadoE").prop('checked', true);
        $("#modificar_empleadoE").prop('checked', true);
        $("#agregar_facturacionE").prop('checked', true);
        $("#agregar_usuarioE").prop('checked', true);
        $("#modificar_usuarioE").prop('checked', true);
        $("#agregar_productosE").prop('checked', true);
        $("#modificar_productosE").prop('checked', true);
        $("#agregar_proveedoresE").prop('checked', true);
        $("#modificar_proveedoresE").prop('checked', true);
        $("#agregar_sucursalesE").prop('checked', true);
        $("#modificar_sucursalesE").prop('checked', true);
        $("#agregar_ventasE").prop('checked', true);
        $("#cancelar_ventaE").prop('checked', true);
        $("#registrar_asistenciaE").prop('checked', true);
        $("#agregar_departamentoE").prop('checked', true);
        $("#modificar_departamentoE").prop('checked', true);
        //Se desmarcan los check box.
        $("#estadisticaE").prop('checked', false);
        $("#eliminar_ClienteE").prop('checked', false);
        $("#eliminar_CompraE").prop('checked', false);
        $("#eliminar_EmpleadoE").prop('checked', false);
        $("#eliminar_usuarioE").prop('checked', false);
        $("#eliminar_productosE").prop('checked', false);
        $("#eliminar_proveedoresE").prop('checked', false);
        $("#eliminar_departamentosE").prop('checked', false);
        $("#eliminar_sucursalesE").prop('checked', false);

    } else if (idPrivilegio == 3) {
        //Se desmarcan los check box.
        $("#agregar_ClienteE").prop('checked', false);
        $("#modificar_ClienteE").prop('checked', false);
        $("#agregar_CompraE").prop('checked', false);
        $("#modificar_CompraE").prop('checked', false);
        $("#agregar_EmpleadoE").prop('checked', false);
        $("#modificar_empleadoE").prop('checked', false);
        $("#agregar_facturacionE").prop('checked', false);
        $("#agregar_usuarioE").prop('checked', false);
        $("#modificar_usuarioE").prop('checked', false);
        $("#agregar_productosE").prop('checked', false);
        $("#modificar_productosE").prop('checked', false);
        $("#agregar_proveedoresE").prop('checked', false);
        $("#modificar_proveedoresE").prop('checked', false);
        $("#agregar_sucursalesE").prop('checked', false);
        $("#modificar_sucursalesE").prop('checked', false);
        $("#estadisticaE").prop('checked', false);

        $("#agregar_ventasE").prop('checked', true);
        //Se desmarcan los check box.
        $("#cancelar_ventaE").prop('checked', false);
        $("#registrar_asistenciaE").prop('checked', false);
        $("#agregar_departamentoE").prop('checked', false);
        $("#modificar_departamentoE").prop('checked', false);
        $("#eliminar_ClienteE").prop('checked', false);
        $("#eliminar_CompraE").prop('checked', false);
        $("#eliminar_EmpleadoE").prop('checked', false);
        $("#eliminar_usuarioE").prop('checked', false);
        $("#eliminar_productosE").prop('checked', false);
        $("#eliminar_proveedoresE").prop('checked', false);
        $("#eliminar_departamentosE").prop('checked', false);
        $("#eliminar_sucursalesE").prop('checked', false);
    }
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
//Con esta función bloquea todos los checkbox.
function bloquearCheckbox() {
    //Bloquea los checkbox.
    $(".custom-control-input").attr("disabled", true);
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//En esta función habilita los checkbox para la asignación de privilegios.
function habilitarCheckbox() {
    //Muestra un mensaje de confirmación.
    Swal.fire({
        title: '¿Esta seguro que quiere habilitar los privilegios?',
        text: "¡Asignará privilegios a su nuevo usuario!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        //Al responder SÍ al mensaje los checkbox se habilitan.
        if (result.value) {
            $(".custom-control-input").attr("disabled", false);
        }
    });
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//En esta función se asigana el id del usuario a un Input.
function obtenerIdDelUsuario(id) {
    //Bloquea los checkbox.
    bloquearCheckbox();
    //Asigna el id al input.
    $("#idEmpleadoUsuario").val(id);
    //Limpia el formulario.
    $('#form_usuario').trigger("reset");
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//Valida el registro del usuario
function  validarRegistroU(id) {
    //Se realiza una petición AJAX al controlador para traer los datos que pertenezcan al id.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idEmpleado=" + id,
        method: "GET",
        success: function (data) {
            //Con este ciclo se recorren los datos y hace una desición.
            for (var i in data) {
                if (data[i].statusUsuario == 1) {
                    //Deshabilita el botón.
                    $("#botonUsuario").prop('disabled', true);
                }
            }
        }
    });
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//En esta función se obtiene el id del empleado para mostrar los datos del usuario a editar.
function obtenerIdDelUsuarioEditar(id) {
    //Mediante AJAX se obtienen los datos del usuario.
    $.ajax({
        data: id, 
        url: 'http://localhost/COVAN/controller/global-controller.php?idUsuarioSitema=' + id, 
        //Método de envio.
        type: 'get', 
        beforeSend: function () {
            //Se muestra una pantalla de carga de datos.
            Swal.showLoading();
        },

        success: function (data) {
            //Se oculta la pantalla de carga.
            SweetAlert.close();
            var txt = "";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) {
                txt += "\n\
\n\<div class='row'>\n\
      \n\<div class='col-md-4'>\n\
                   \n\ <div class='form-group'>\n\
                        \n\<strong><label for='UsuarioE'>Usuario:</label></strong>\n\
      \n\<input type='text' class='form-control' id='usuarioE' placeholder='Usuario' name='usuarioE' value='" + data[i].usuario + "'>\n\
    \n\<input id='idEmpleadoUsuario' name='idEmpleadoUsuarioE' type='hidden' value=" + id + ">\n\
\n\</div>\n\
               \n\ </div>\n\
                \n\<div class='col-md-4'>\n\
                   \n\ <div class='form-group'>\n\
                        \n\<strong><label for='passE'>Contraseña:</label></strong>\n\
      \n\<input type='text' class='form-control' id='passE' placeholder='Contraseña' name='passE' value='" + data[i].pass + "'>\n\
    \n\</div>\n\
              \n\</div>\n\
                \n\<div class='col-md-4'>\n\
                  \n\  <div class='form-group'>\n\
            \n\<strong><label for='tipoUsuarioE'>Tipo de usuario:</label></strong>\n\
            \n\<select class='form-control' id='tipoUsuarioE' name='tipoUsuarioE' onchange='asignarPrivilegiosE()'>\n\
        \n\<option value= '" + data[i].idTipo + "'>" + data[i].tipoUsuario + "</option>\n\
        \n\<option></option>\n\
        \n\<option value='1'>Administrador</option>\n\
        \n\<option value='2'>General</option>\n\
        \n\<option value='3'>Usuario</option>\n\
      \n\</select>\n\
  \n\ </div>\n\
 \n\</div>\n\
 \n\</div>\n\
\n\
 ";
                //Se consultan los privilegios con el id.
                consultarPriviledosUsuario(id);
            }
            //Se inyecta el codigo con los datos en la interfaz.
            $('#DatosUsuarioEditar').html(txt);
        }
    });
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//En esta función se muestra los privilegios del usuario.
function consultarPriviledosUsuario(id) {
    //Mediante AJAX se obtienen los privilegios del usuario.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php?idPrivilegiosU=" + id,
        //Método de envio.
        method: "GET",
        success: function (data) {
            //Ventas--------------------->
            if (data[0].eliminar == 1) {
                $("#cancelar_ventaE").prop('checked', true);
            } else if (data[0].eliminar == 0) {
                $("#cancelar_ventaE").prop('checked', false);
            }
            if (data[0].insertar == 1) {
                $("#agregar_ventasE").prop('checked', true);
            } else if (data[0].seleccionar == 0) {
                $("#agregar_ventasE").prop('checked', false);
            }
            //----------------------------------->
            //Productos
            if (data[1].insertar == 1) {
                $("#agregar_productosE").prop('checked', true);
            } else if (data[1].insertar == 0) {
                $("#agregar_productosE").prop('checked', false);
            }
            if (data[1].actualizar == 1) {
                $("#modificar_productosE").prop('checked', true);
            } else if (data[1].actualizar == 0) {
                $("#modificar_productosE").prop('checked', false);
            }
            if (data[1].eliminar == 1) {
                $("#eliminar_productosE").prop('checked', true);
            } else if (data[1].eliminar == 0) {
                $("#eliminar_productosE").prop('checked', false);
            }
            //----------------------------------------------------->
            //Clientes
            if (data[2].insertar == 1) {
                $("#agregar_ClienteE").prop('checked', true);
            } else if (data[2].insertar == 0) {
                $("#agregar_ClienteE").prop('checked', false);
            }
            if (data[2].actualizar == 1) {
                $("#modificar_ClienteE").prop('checked', true);
            } else if (data[2].actualizar == 0) {
                $("#modificar_ClienteE").prop('checked', false);
            }
            if (data[2].eliminar == 1) {
                $("#eliminar_ClienteE").prop('checked', true);
            } else if (data[2].eliminar == 0) {
                $("#eliminar_ClienteE").prop('checked', false);
            }
            //------------------------------------------------------>
            //Empleados
            if (data[3].insertar == 1) {
                $("#agregar_EmpleadoE").prop('checked', true);
            } else if (data[3].insertar == 0) {
                $("#agregar_EmpleadoE").prop('checked', false);
            }
            if (data[3].actualizar == 1) {
                $("#modificar_empleadoE").prop('checked', true);
            } else if (data[3].actualizar == 0) {
                $("#modificar_empleadoE").prop('checked', false);
            }
            if (data[3].eliminar == 1) {
                $("#eliminar_EmpleadoE").prop('checked', true);
            } else if (data[3].eliminar == 0) {
                $("#eliminar_EmpleadoE").prop('checked', false);
            }
            //----------------------------------------------------------->
            //Proveedores
            if (data[4].insertar == 1) {
                $("#agregar_proveedoresE").prop('checked', true);
            } else if (data[4].insertar == 0) {
                $("#agregar_proveedoresE").prop('checked', false);
            }
            if (data[4].actualizar == 1) {
                $("#modificar_proveedoresE").prop('checked', true);
            } else if (data[4].actualizar == 0) {
                $("#modificar_proveedoresE").prop('checked', false);
            }
            if (data[4].eliminar == 1) {
                $("#eliminar_usuarioE").prop('checked', true);
            } else if (data[4].eliminar == 0) {
                $("#eliminar_usuarioE").prop('checked', false);
            }
            //----------------------------------------------------------->
            //Sucursales
            if (data[5].insertar == 1) {
                $("#agregar_sucursalesE").prop('checked', true);
            } else if (data[5].insertar == 0) {
                $("#agregar_sucursalesE").prop('checked', false);
            }
            if (data[5].actualizar == 1) {
                $("#modificar_sucursalesE").prop('checked', true);
            } else if (data[5].actualizar == 0) {
                $("#modificar_sucursalesE").prop('checked', false);
            }
            if (data[5].eliminar == 1) {
                $("#eliminar_sucursalesE").prop('checked', true);
            } else if (data[5].eliminar == 0) {
                $("#eliminar_sucursalesE").prop('checked', false);
            }
            //------------------------------------------------------------->
            //Departamentos
            if (data[6].insertar == 1) {
                $("#agregar_departamentoE").prop('checked', true);
            } else if (data[6].insertar == 0) {
                $("#agregar_departamentoE").prop('checked', false);
            }
            if (data[6].actualizar == 1) {
                $("#modificar_departamentoE").prop('checked', true);
            } else if (data[6].actualizar == 0) {
                $("#modificar_departamentoE").prop('checked', false);
            }
            if (data[6].eliminar == 1) {
                $("#eliminar_departamentosE").prop('checked', true);
            } else if (data[6].eliminar == 0) {
                $("#eliminar_departamentosE").prop('checked', false);
            }
            //---------------------------------------------------------------->
            ////Estadisticas
            if (data[7].insertar == 1) {
                $("#estadisticaE").prop('checked', true);
            } else if (data[7].insertar == 0) {
                $("#estadisticaE").prop('checked', false);
            }
            //------------------------>
            //Compras
            if (data[8].insertar == 1) {
                $("#agregar_CompraE").prop('checked', true);
            } else if (data[8].insertar == 0) {
                $("#agregar_CompraE").prop('checked', false);
            }
            if (data[8].actualizar == 1) {
                $("#modificar_CompraE").prop('checked', true);
            } else if (data[8].actualizar == 0) {
                $("#modificar_CompraE").prop('checked', false);
            }
            if (data[8].eliminar == 1) {
                $("#eliminar_CompraE").prop('checked', true);
            } else if (data[8].eliminar == 0) {
                $("#eliminar_CompraE").prop('checked', false);
            }
            //------------------------------------------------------------>
            //Facturación
            if (data[9].insertar == 1) {
                $("#agregar_facturacionE").prop('checked', true);
            } else if (data[9].insertar == 0) {
                $("#agregar_facturacionE").prop('checked', false);
            }
            //----------------------------------------------------------------->
            //Usuarios
            if (data[10].insertar == 1) {
                $("#agregar_usuarioE").prop('checked', true);
            } else if (data[10].insertar == 0) {
                $("#agregar_usuarioE").prop('checked', false);
            }
            if (data[10].actualizar == 1) {
                $("#modificar_usuarioE").prop('checked', true);
            } else if (data[10].actualizar == 0) {
                $("#modificar_usuarioE").prop('checked', false);
            }
            if (data[10].eliminar == 1) {
                $("#eliminar_usuarioE").prop('checked', true);
            } else if (data[10].eliminar == 0) {
                $("#eliminar_usuarioE").prop('checked', false);
            }
            //Asistencia
            if (data[11].insertar == 1) {
                $("#registrar_asistenciaE").prop('checked', true);
            } else if (data[11].insertar == 0) {
                $("#registrar_asistenciaE").prop('checked', false);
            }
            //----------------------------------------------------------->

        }
    });
    //Se bloquean los checkbox.
    bloquearCheckbox();
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
//Con esta función se obtienen los nuevos datos del usuario.
function obtenerNuevosDatosUsuario() {
    //Se valida que todos los campos no estén vasios.
    if (validarFormularioUsuarioE()) {
        //Se cierra el modal.
        $("#cancelarUsuarioE").trigger("click");
        //Se desactivan los checkbox para poder obtener los valores.
        $(".custom-control-input").attr("disabled", false);
        // Se obtienen los datos del formulario con el id del <form>
        var form = $("#form_usuarioEditar").serialize(); 
        //Mediante AJAX se envian los nuevos datos del usuario al controlador.
        $.ajax({
            url: "http://localhost/COVAN/controller/global-controller.php",
            data: form,
            //Método de envio.
            method: "POST",
            success: function (datos) {
            }, error: function (datos) {
            }
        });
        //Se muestra un mensaje de alerta.
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Usuario actualizado',
            showConfirmButton: false,
            timer: 2000
        });
    }
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función muestra una pantalla de carga.
function mostrarSpinner() {
    $("#spinner").css("display", "block");
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
//Con esta función se oculta la pantalla de carga.
function ocultarSpinner() {
    $("#spinner").css("display", "none");
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//En esta función se realiza la busqueda de los empleados por su nombre o apellido paterno o apllido materno.
function buscarEmpleadobyNombre() {
    //Con esta función se activa cada ves que introduscan un dato.
    $(document).on('keyup', '#buscadorEmpleados', function () {
        //Se obtiene los datos del input.
        var buscar = $(this).val();
        if (buscar != "") {
            //Busca el empleados
            mostarEmpleadobyNombre(buscar);
        } else {
            //Si se encuentra vasio se muestran todos los registros.
            mostrarEmpleado();
        }
    });
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//Con esta función muestra al empleado buscado.
function mostarEmpleadobyNombre(nombre) {
    var sucursal = 1;
    //Mediante AJAX se obtienen los datos del empleado que ha sido buscado.
    $.ajax({
        url: "http://localhost/COVAN/controller/global-controller.php",
        //Método de envio.
        method: "POST",
        data: {
            idsucursalEmpleado: sucursal,
            nombreEmpleado: nombre
        },

        beforeSend: function () {
            //Se muestra una pantalla de carga de datos.
            mostrarSpinner();

        },
        success: function (data) {
            //Se oculta la pantalla de carga.
            ocultarSpinner();
            var txt = "";
            txt += "<table border='1'>";
            //Con este ciclo se llenan los datos con HTML.
            for (var i in data) { 
                txt += "<tr style='" + data[i].estiloEliminar + "'>\n\
      <td>" + data[i].empleado + "</td>\n\
      \n\<td>" + data[i].apellidoPaterno + "</td>\n\
      \n\<td>" + data[i].apellidoMaterno + "</td>\n\
      \n\<td>" + data[i].edad + "</td>\n\
      \n\<td>" + data[i].sexo + "</td>\n\
\n\<td height='10' width='10'><button class='dropdown-item' type='button' id='visualizar' onclick='visualizarEmpleado(" + data[i].idEmpleado + ")' data-toggle='modal' data-target='#ModalVisualizar' ><i class='fas fa-eye' style='color: #002752'></i></button></td>\n\
\n\<td height='10' width='10'><button class='dropdown-item' type='button' id='editar' data-toggle='modal' data-target='#ModalEditar' onclick='userToEdit(" + data[i].idEmpleado + ")' data-target='#modalActualizar'><i class='fas fa-user-edit' style='color: #28a745'></i></button></td>\n\
\n\</td><td height='10' width='10'><button class='dropdown-item' id='eliminar' type='button' data-toggle='modal' onclick='eliminar(" + data[i].idEmpleado + ")'><i class='fas fa-user-times' style='color: red' ></i></button></td>\n\
\n\
       </tr>";
            }
            txt += "</table>";
            //Se inyecya el codigo con los datos en la interfaz.
            document.getElementById("empleado").innerHTML = txt; 
        }
    });
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

