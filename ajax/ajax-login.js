$(document).ready(function () {
  nombreUser();
});

function access(){
  var user="";
  var form = $("#form-access").serialize();
          $.ajax({
          url:"http://localhost/Covan/controller/global-controller.php",
                  type: 'POST',
                  data: form
          }).done(function(response){
            if(response=='0'){
              alert('error');
            }else{
              location.href='http://localhost/Covan/pages/proveedores.php';

            }
          });
}
function cerrar()
        {
            $.ajax({
                url:'http://localhost/Covan/controller/global-controller.php?cerrar',
                type:'GET'
            });
           location.href = "http://localhost/Covan";
        }
function nombreUser(){
  var user = $("#nombreUser").val();
  console.log(user);
  $.ajax({
    url:'http://localhost/Covan/controller/class/class-estadisticas.php?nombreUser='+user,
    type:'GET'
});
}