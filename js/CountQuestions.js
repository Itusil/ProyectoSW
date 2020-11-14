setInterval(function (){
$(document).ready(function(){
	$.get('../xml/Questions.xml?q='+ new Date().getTime(), function(d){
		var listacorreos = $(d).find('assessmentItem');
		var correoUsuario=$('#email').val();
		var preguntasUsuario=0;
		var preguntasTotal=0;
			for (var i = 0; i < listacorreos.length; i++)
			{
				valor= $(d).find(listacorreos[i]).attr("author");
				if(correoUsuario == valor){
					preguntasUsuario++;	
				}
				preguntasTotal++;
			}
			$('#cuantasCelda').text(preguntasUsuario+"/"+preguntasTotal);
 });});},2000);

setInterval(function (){
$(document).ready(function(){
	$.get('../xml/UserCounter.xml?q='+ new Date().getTime(), function(d){
		var listacorreos = $(d).find('usuario');
		$('#activosCelda').text(listacorreos.length);
 });
}
);
},2000);



