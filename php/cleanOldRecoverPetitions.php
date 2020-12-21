<?php 
	$link2 = new mysqli($server, $user, $pass, $basededatos);
	$date=date_create(strval(date("Y-m-d H:i:s"))); //Creamos la fecha actual
	date_sub($date,date_interval_create_from_date_string("1 hour")); //Le restamos una hora
	$fechaParaBorrar = date_format($date,"Y-m-d H:i:s"); //La ponemos en el formato que nos interesa
	$sql2 = "DELETE FROM recoverpass WHERE fecha < '$fechaParaBorrar';"; //Ejectuamos la sentencia para borrar las soliciutdes de hace mas de una hora
	$usuario = mysqli_query($link2 ,$sql2);
	mysqli_close($link2); 
?>