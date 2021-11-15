// POST PARA MODIFICAR

$(document).ready(function(){
    $('#confirmarCambios').click(function(){
        vacios=validarFormVacio('frmProducts');
if(vacios > 0){
alert("Debes llenar todos los campos!!");
return false;
}

datos=$('#frmProducts').serialize();

$.ajax({
type:"POST",
url:"modificarPOST.php",
data:datos,
beforeSend: function () {
                    $("#resultado").html("Procesando, espere por favor...");},
                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#resultado").html(response);
                    var activarVentana=document.getElementById('container-mensage')
                        activarVentana.style.display='block'
                        modificarEliminar.style.display='none'						
}

});

});
})


    // POST PARA LA TABLA DE CREAR

    $(document).ready(function(){
    $('#confirmarCambiosCrear').click(function(){
        vacios=validarFormVacio('frmProductsCrear');
if(vacios > 0){
alert("Debes llenar todos los campos!!");
return false;
}

datoCrear=$('#frmProductsCrear').serialize();

$.ajax({
type:"POST",
url:"crearPOST.php",
data:datoCrear,
beforeSend: function () {
                    $("#resul").html("Procesando, espere por favor...");},
                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#resul").html(response);
                    var activarVentana=document.getElementById('container-mensage')
                        activarVentana.style.display='block'
                        crear.style.display='none'	
                    }

});

});
})


// POST PARA LA TABLA DE ELIMINAR

$(document).ready(function(){
    $('#confirmarEliminar').click(function(){
        vacios=validarFormVacio('frmProducts');
if(vacios > 0){

}

datosEliminar=$('#frmProducts').serialize();

$.ajax({
type:"POST",
url:"eliminarPOST.php",
data:datosEliminar,
beforeSend: function () {
                    $("#resultado3").html("Procesando, espere por favor...");},
                    success:  function (response) { 
                    var activarVentana=document.getElementById('container-mensage')
                        activarVentana.style.display='block'
                        crear.style.display='none'		
            }

});

});
})