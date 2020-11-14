<?php
	$email=$_GET['email'];
	include('./DecreaseGlobalCounter.php');
	echo '<script> window.alert("Adios, hasta pronto!"); window.location.href = "Layout.php";</script> ';
?>