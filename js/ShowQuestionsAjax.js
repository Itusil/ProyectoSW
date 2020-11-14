xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{document.getElementById('respuestaXML').innerHTML=xmlhttp.responseText; }
}
function pedirDatos(){
	//xmlhttp.open("GET","../xml/Questions.xml");
	xmlhttp.open("GET","../php/ShowXMLQuestionsAjax.php");
	xmlhttp.send();
}

function resetear(){
	document.getElementById('respuestaXML').innerHTML='';
	document.getElementById('pregAnadida').innerHTML='';
	document.getElementById("enunc").value="";
	document.getElementById("resco").value="";
	document.getElementById("resin1").value="";
	document.getElementById("resin2").value="";
	document.getElementById("resin3").value="";
	document.getElementById("tema").value="";
	
}