<?php session_start();
?>
<?php
	$email=$_SESSION['email'];
	include('./DecreaseGlobalCounter.php');
	session_destroy();
	echo '<script> window.alert("Adios, hasta pronto!"); window.location.href = "Layout.php";</script> ';
?>