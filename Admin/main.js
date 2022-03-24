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
         "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarP'>Editar</button><button class='btn btn-danger btnBorrarP'>Borrar</button></div></div>"  
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

     tablaMesa = $("#tablaMesa").DataTable({
        "columnDefs":[{
         "targets": -1,
         "data":null,
         "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarM'>Editar</button><button class='btn btn-danger btnBorrarM'>Borrar</button></div></div>"  
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

    $("#divImg").children().removeAttr('disabled','disabled');
    $("#divImg").show();            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
}); 


$('#formPlatillos').submit(function(e){
	
	e.preventDefault()
    console.log("Si entro");

    if (opcion == 1)
        url = './bd/Ajax.php?action=altaPlatillo';
    else if (opcion == 2)
        url = `./bd/Ajax.php?action=editarPlatillo&id=${id}`;
        
    console.log(url); 

	$.ajax({
		url:url,
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
            precio = `${data[0].precio} $`;
            tipo = data[0].tipo;
            detalles = data[0].detalles;
            imagen = `<img height="170px" width="250px" src='data:image/jpg;base64,${data[0].imagen}'></img>`
            

            if(opcion == 1){tablaPlatillos.row.add([id,nombre,precio,tipo,detalles,imagen]).draw();}
            else{tablaPlatillos.row(fila).data([id,nombre,precio,tipo,detalles,imagen]).draw();}
		}
	})
    $("#modalCRUD").modal("hide"); 
});



$(document).on("click", ".btnBorrarP", function(){    
    fila = $(this);
    id = $(this).closest("tr").find('td:eq(0)').text();
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "./bd/Ajax.php?action=borrarPlatillo",
            type: "POST",
            dataType: "json",
            data: {id:id},
            success: function(data){
                console.log(data)
                tablaPlatillos.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

$(document).on("click", ".btnEditarP", function(){
    fila = $(this).closest("tr");

    id = fila.find('td:eq(0)').text();
    nombre = fila.find('td:eq(1)').text();
    precio = fila.find('td:eq(2)').text();
    tipo = fila.find('td:eq(3)').text();
    detalles = fila.find('td:eq(4)').text();
    

    precio = precio.replace('$',' ');
    precio = parseInt(precio);
    
    

    $("#nombre").val(nombre);
    $("#precio").val(precio);
    $("#tipo").val(tipo);
    $("#detalles").val(detalles);
    $("#imagen").val(null);

    opcion = 2; //editar
    
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Platillo"); 
    $("#divImg").children().attr("disabled","disabled");
    $("#divImg").hide();
    $("#modalCRUD").modal("show");  
    
});

//Gestion de mesas

$("#btnNuevaMesa").click(function(){
    $("#formMesa").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Mesa");     
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
}); 


$(document).on("click", ".btnEditarM", function(){
    fila = $(this).closest("tr");
    id = fila.find('td:eq(0)').text();
    capacidad = fila.find('td:eq(1)').text();
    disponibilidad = fila.find('td:eq(2)').text();
    
    $("#numMesa").val(id);
    $("#capacidad").val(capacidad);
    $("#disponibilidad").val(disponibilidad);
    opcion = 2; 
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Mesa");  
    
       

    $("#modalCRUD").modal("show");  
    
});

$('#formMesa').submit(function(e){
	
	e.preventDefault()
    console.log("Si entro");

    if (opcion == 1)
        url = './bd/Ajax.php?action=altaMesa';
    else if (opcion == 2)
    url = `./bd/Ajax.php?action=editarMesa&id=${id}`;
        
    console.log(url); 
     

	$.ajax({
		url:url,
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
            capacidad = data[0].capacidad;
            disponibilidad = data[0].disponibilidad;
            
            if(opcion == 1){tablaMesa.row.add([id,capacidad,disponibilidad]).draw();}
            else{tablaMesa.row(fila).data([id,capacidad,disponibilidad]).draw();}
		}
	})
    $("#modalCRUD").modal("hide"); 
});

$(document).on("click", ".btnBorrarM", function(){    
    fila = $(this);
    id = $(this).closest("tr").find('td:eq(0)').text();
    console.log(id);
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "./bd/Ajax.php?action=borrarMesa",
            type: "POST",
            dataType: "json",
            data: {id:id},
            success: function(data){
                console.log(data)
                tablaMesa.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

});