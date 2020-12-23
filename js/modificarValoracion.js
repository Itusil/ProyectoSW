xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
	document.getElementById("resVal").innerHTML=xmlhttp.responseText;
	document.getElementById("subVal").innerHTML="";
	document.getElementById("bajVal").innerHTML="";
	}
}

function subirval(){
	xmlhttp.open("GET","../php/UpdateValorationUP.php",true);
	xmlhttp.send();
}

function bajarval(){
	xmlhttp.open("GET","../php/UpdateValorationDOWN.php",true);
	xmlhttp.send();
}



