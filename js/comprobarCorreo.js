$(document).ready(function(){
	var correo=1;
	var contra=1;
  $("#email").change(function(){
	let valemail = $("#email").val()
	$.ajax({
			url: 'ClientVerifyEnrollment.php?email='+valemail,
			type: 'GET',
			dataType: "html",
			contentType: false,
			processData: false,
			success:function(datos){
				if (datos == "NO"){
					let error = "<text style='color:red; font-weight:bold;'>Este email no es VIP </text><br><br>";
					$('#resVIP').fadeIn().html(error);
					correo=0;
					comprobar();
				}else{
					let OK = "<text style='color:green; font-weight:bold;'>Este email es VIP </text><br><br>";
					$('#resVIP').fadeIn().html(OK);
					correo=1;
					comprobar();
			}},
			cache : false,
			error:function(){
				$('#resVIP').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
	}});
	});
	
	//Lo he dejado sin funcionar cambiar verify cliente y poner $get
    $("#pass").change(function(){
	let valemail = $("#pass").val()
	$.ajax({
			url: 'ClientVerifyPass.php?pass='+valemail+"&codigo=1010",
			type: 'GET',
			dataType: "html",
			contentType: false,
			processData: false,
			success:function(datos){
				if (datos == "SIN SERVICIO"){
					let sinser = "<text style='color:red; font-weight:bold;'>ERROR: El servicio no funciona</text><br><br>";
					$('#resCON').fadeIn().html(sinser);
					contra=0;
					comprobar();
				}else if (datos == "INVALIDA"){
					let error = "<text style='color:red; font-weight:bold;'>Esta contraseña no es segura, pruebe otra </text><br><br>";
					$('#resCON').fadeIn().html(error);
					contra=0;
					comprobar();
				}else{
					let OK = "<text style='color:green; font-weight:bold;'>Esta contraseña es segura </text><br><br>";
					$('#resCON').fadeIn().html(OK);
					contra=1;
					comprobar();
			}},
			cache : false,
			error:function(){
				$('#resCON').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
	}});
	});

	function comprobar(){
		if(correo==1 && contra ==1){
			$("#boton").prop("disabled",false);
		}else{
			$("#boton").prop("disabled",true);
		}
	}
  
  
});