/*  Show/Hidden popup login */
function show_popup_login(){
	let popup = document.querySelector(".popup-login");
	if(popup.classList.contains('active')){
		popup.classList.remove('active');
	}else{
		popup.classList.add('active');
	}
}

$('#login-form').submit(function(e){
	e.preventDefault()
	$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
	if($(this).find('.alert-danger').length > 0 )
		$(this).find('.alert-danger').remove();
	
	$.ajax({
		url:'ajax.php?action=login',
		method:'POST',
		data:$(this).serialize(),

		error:err=>{
			console.log(err)
			$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
		},

		success:function(resp){
			console.log(resp);
			if(resp == 1){
				location.reload();
			}else{
				$('#login-form').prepend('<div class="alert alert-danger">Email o password son incorrectos.</div>')
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
			}
		}
	})
})


$('#registro-form').submit(function(e){
	console.log("Si entro");
	if ($('#password').val() != $('#passwordV').val()) {
		$('#error').addClass("mostrar");
		return false;
	}
	$('#error').removeClass("mostrar");

	e.preventDefault()
	$.ajax({
		url:'ajax.php?action=registrar',
		data: new FormData($(this)[0]),
		cache: false,
		contentType: false,
		processData: false,
		method: 'POST',
		type: 'POST',
		error:err=>{
			console.log(err)
		},
		success:function(resp){
			console.log(resp);
			if(resp == 1){		
				Swal.fire({
					icon: "success",
					text: "Registrado correctamente",
					timer: 1500, // <- Ocultar 
				});
			} else if (resp == 0) {
				Swal.fire({
					icon: "error",
					text: "Este correo ya se encuentra registrado",
				});
			}
			$('#nombre').val('');
			$('#email').val('');
			$('#password').val('');
			$('#passwordV').val('');
		}
	})
})




