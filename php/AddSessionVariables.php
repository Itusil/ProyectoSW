<?php session_start();
?>
<?php 
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['img'] = $_POST['imagen'];
	$_SESSION['tipo'] = 'estu';
	$email = $_SESSION['email'];
	include("./IncreaseGlobalCounter.php");
?>