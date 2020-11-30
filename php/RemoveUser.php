<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>
<body>
<?php include '../php/DbConfig.php' ?>
<?php 
if(!isset($_SESSION['tipo']) || ($_SESSION['tipo']!="admin")){
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
	</script>";}else{
	$email=$_GET['email'];
	$link = new mysqli($server, $user, $pass, $basededatos);

	$sql = "DELETE FROM usuario WHERE usuario.email='" . $email."'";
	mysqli_query($link ,$sql);	
	echo "<script> Swal.fire({
	  icon: 'success',
	  title: 'Éxito!',
	  text: 'Usuario elminado correctamente',
	  confirmButtonText: `De acuerdo`,
	  allowOutsideClick: false,
	}).then((result) => {
	  if (result.isConfirmed) {
		window.location.href = 'HandlingAccounts.php';}
	})</script>";
}
?>
</body>
</html>
