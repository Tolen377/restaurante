$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });


    tablaPlatillos = $("#tablaPlatillos").DataTable({
        "columnDefs":[{
         "targets": -1,
         "data":null,
         "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
        }],
         
     "language": {
             "lengthMenu": "Mostrar _MENU_ registros",
             "zeroRecords": "No se encontraron resultados",
             "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
             "infoFiltered": "(filtrado de un total de _MAX_ registros)",
             "sSearch": "Buscar:",
             "oPaginate": {
                 "sFirst": "Primero",
                 "sLast":"Último",
                 "sNext":"Siguiente",
                 "sPrevious": "Anterior"
              },
              "sProcessing":"Procesando...",
         }
     });

    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Usuario");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = fila.find('td:eq(0)').text();
    nombre = fila.find('td:eq(1)').text();
    email = fila.find('td:eq(2)').text();
    password = fila.find('td:eq(3)').text();
    
    $("#nombre").val(nombre);
    $("#email").val(email);
    $("#password").val(password);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Usuario");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = $(this).closest("tr").find('td:eq(0)').text();
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(data){
                console.log(data)
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    email = $.trim($("#email").val());
    password = $.trim($("#password").val());  
    $.ajax({
        url: "./bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, email:email, password:password, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            email = data[0].email;
            password = data[0].password;
            tipo = data[0].tipo;
            if(opcion == 1){tablaPersonas.row.add([id,nombre,email,password,tipo]).draw();}
            else{tablaPersonas.row(fila).data([id,nombre,email,password,tipo]).draw();}          
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});   

$("#btnNuevoPlatillo").click(function(){
    $("#formPlatillos").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Platillo");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
}); 


$('#formPlatillos').submit(function(e){
	console.log("Si entro");
	e.preventDefault()
	$.ajax({
		url:'./bd/Ajax.php?action=altaPlatillo',
		data: new FormData($(this)[0]),
		cache: false,
		contentType: false,
		processData: false,
		method: 'POST',
		type: 'POST',
        dataType: "json",
		error:err=>{
			console.log(err)
		},
		success:function(data){
			console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            precio = data[0].precio;
            tipo = data[0].tipo;
            detalles = data[0].detalles;

            if(opcion == 1){tablaPlatillos.row.add([id,nombre,precio,tipo,detalles]).draw();}
            else{tablaPlatillos.row(fila).data([id,nombre,precio,tipo,detalles]).draw();}
		}
	})
    $("#modalCRUD").modal("hide"); 
})

});