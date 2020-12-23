<?php session_start();
?>
<?php include '../php/DbConfig.php' ?>
<?php 
	$numpre = $_SESSION['numpreAct'];
	$valoracionAct = $_SESSION['valPregAct'] + 1;
	$link = new mysqli($server, $user, $pass, $basededatos);
	$sql = "UPDATE preguntasconimagen SET valoracion=valoracion +1 WHERE numpre='$numpre'";
	mysqli_query($link ,$sql);
	echo "<text style='color:green; font-weight: bold; text-align:center;'>Valoracion actualizada correctamente, la nueva valoracion es de $valoracionAct</text>";
	unset($_SESSION['numpreAct']);
	unset($_SESSION['valPregAct']);
 ?>