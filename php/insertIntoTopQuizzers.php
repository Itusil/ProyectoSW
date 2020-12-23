<?php
        session_start();  
?>
<?php
echo "<!DOCTYPE html>
<html>
<head>";
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
echo "</head>
<body>";
if(isset($_SESSION['valido'])){
	include '../php/DbConfig.php';
	$link = new mysqli($server, $user, $pass, $basededatos);
	$fecha = strval(date('Y-m-d'));
	$puntuacion = $_SESSION['puntuacionFinal'];
	$nick = $_POST['nick'];
	$sql = "INSERT INTO puntuaciones (nick, puntuacion, fecha) VALUES ('$nick', $puntuacion, '$fecha')";
	mysqli_query($link ,$sql);
	echo "<script> 
	Swal.fire({
		  icon: 'success',
		  title: 'Puntuacion registrada correctamente!',
		  allowOutsideClick: false,
		  showDenyButton: false,
		  showCancelButton: false,
		  confirmButtonText: `De acuerdo`,
		  denyButtonText: `No`,
		}).then((result) => {
  if (result.isConfirmed) {
	window.location.href = 'Layout.php';  }
})
	</script>"; 
	mysqli_close($link); 
	unset($_SESSION['valido']);
	unset($_SESSION['puntuacionFinal']);
}else{
	echo "<script> 
	Swal.fire({
		  icon: 'error',
		  title: 'Vaya, parece que no deberías estar aqui...',
		  allowOutsideClick: false,
		  showDenyButton: false,
		  showCancelButton: false,
		  confirmButtonText: `De acuerdo`,
		  denyButtonText: `No`,
		}).then((result) => {
  if (result.isConfirmed) {
	window.location.href = 'Layout.php';  }
})
	</script>"; 
}
echo "</body>";
echo "</html>"
?>