$(document).ready(function() {
	  $("#boton").click(function(){
		  $.get('../xml/Users.xml', function(d){
			var correo = $("#email").val();
			var telefono = $("#tele");
			var nombre = $("#nombre");
			var apellido = $("#apel");
			telefono.val("");
			nombre.val("");
			apellido.val("");
			
			var listacorreos = $(d).find('email');
			var valor;
			for (var i = 0; i < listacorreos.length; i++)
			{
				valor= listacorreos[i].childNodes[0].nodeValue;
				if(correo === valor){
					var listateles =$(d).find("telefono");
					telefono.val(listateles[i].childNodes[0].nodeValue);
					var listanombre =$(d).find("nombre");
					nombre.val(listanombre[i].childNodes[0].nodeValue);
					var listaapel1 =$(d).find("apellido1");
					var apellido1=listaapel1[i].childNodes[0].nodeValue;
					var listaapel2 =$(d).find("apellido2");
					var apellido2=listaapel2[i].childNodes[0].nodeValue;
					var apellidosfinal= apellido1+" "+apellido2;
					apellido.val(apellidosfinal);
				}
			}
			var valortelefono = telefono.val();
			if (valortelefono ===""){
				alert("Este correo no está registrado en la UPV/EHU. Introduzca otro.");
			}
	  })})
});