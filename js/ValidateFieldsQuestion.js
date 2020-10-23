 $(document).ready(function(){
  $("#fquestion").submit(function(e){
	var email= $("#email").val();
	var enunc= $("#enunc").val();
	var resco= $("#resco").val();
	var resin1= $("#resin1").val();
	var resin2= $("#resin2").val();
	var resin3= $("#resin3").val();
	var difi = $("#difi option:selected").val();
	var tema = $("#tema").val();
	var emailestudi= /^[a-z]+[0-9]{3}@(ikasle.ehu.)(eus|es)/;
	var emailprofe=/[a-z]+(.[a-z]+)?@(ehu.)(eus|es)/;
	//var formatopregunta=/[a-zA-Z0-9.!#$%&'*+=?^_`{|}~- ]{10,}/;
	if(email == "" || enunc=="" || resco =="" || resin1 =="" || resin2 =="" || resin3=="" || tema ==""){
		alert("Hay que rellenar todos los campos");
		e.preventDefault();
		return false;
	}
	if(!email.match(emailestudi) && !email.match(emailprofe)){
		alert("El email introducido no es valido");
		e.preventDefault();
		return false;
	}
	var longitud = enunc.length;
	if(longitud<10){
		alert("El enunciado tiene que tener un minimo de 10 caracteres");
		e.preventDefault();
		return false;
	}
	// if(!enunc.match(formatopregunta)){
		// alert("El enunciado tiene que tener un minimo de 10 caracteres");
		// e.preventDefault();
		// return false;
	// }
	return true;
	});
})