// POST PARA MODIFICAR ARTICULOS

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


    // POST PARA CREAR ARTICULOS

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
                    $("#resultado").html("Procesando, espere por favor...");},
                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#resul").html(response);
                    var activarVentana=document.getElementById('container-mensage')
                        activarVentana.style.display='block'
                        crear.style.display='none'	
                    }

});

});
})


// POST PARA ELIMINAR ARTICULOS

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
                    $("#resultado").html("Procesando, espere por favor...");},
                    success:  function (response) { 
                        $("#resul").html(response);
                    var activarVentana=document.getElementById('container-mensage')
                        activarVentana.style.display='block'
                        modificarEliminar.style.display='none'		
            }

});

});
})



// POST PARA MODIFICAR USUARIOS

$(document).ready(function(){
    $('#confCambiosUser').click(function(){
        vacios=validarFormVacio('frmUser');
if(vacios > 0){
alert("Debes llenar todos los campos!!");
return false;
}

dato=$('#frmUser').serialize();

$.ajax({
type:"POST",
url:"modificarPOST.php",
data:dato,
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


    // POST PARA CREAR ARTICULOS

    $(document).ready(function(){
    $('#confCrearUser').click(function(){
        vacios=validarFormVacio('frmCrearUser');
if(vacios > 0){
alert("Debes llenar todos los campos!!");
return false;
}

datoCrear=$('#frmCrearUser').serialize();

$.ajax({
type:"POST",
url:"crearPOST.php",
data:dato,
beforeSend: function () {
                    $("#resultado").html("Procesando, espere por favor...");},
                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    $("#resul").html(response);
                    var activarVentana=document.getElementById('container-mensage')
                        activarVentana.style.display='block'
                        crear.style.display='none'	
                    }

});

});
})


// POST PARA ELIMINAR ARTICULOS

$(document).ready(function(){
    $('#confEliminarUser').click(function(){
        vacios=validarFormVacio('frmUser');
if(vacios > 0){

}

datosEliminar=$('#frmUser').serialize();

$.ajax({
type:"POST",
url:"eliminarPOST.php",
data:dato,
beforeSend: function () {
                    $("#resultado").html("Procesando, espere por favor...");},
                    success:  function (response) { 
                        $("#resul").html(response);
                    var activarVentana=document.getElementById('container-mensage')
                        activarVentana.style.display='block'
                        modificarEliminar.style.display='none'		
            }

});

});
})