<?php
        session_start();  
?>
<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>-->
  <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/comprobarCorreo.js"></script>


  <?php include '../html/Head.html'?>
</head>
<body>
<?php include '../php/DbConfig.php' ?>
<?php 
$error = 0;
if(!isset($_GET['email'])){
	$error = 1;
}else{
	include '../php/cleanOldRecoverPetitions.php';//Borramos las peticiones de hace mas de una hora
	
	$link = new mysqli($server, $user, $pass, $basededatos);
	$emailseguro=mysqli_real_escape_string($link, strip_tags($_GET["email"]));
		
	$sql = "SELECT * FROM recoverpass WHERE emailcry='$emailseguro';";
	$usuario = mysqli_query($link ,$sql);
	if(mysqli_num_rows($usuario) == 0){
		$error = 1;
	}else{
		$row  = mysqli_fetch_array($usuario);
			$_SESSION['emailRec'] = $row["email"]; //Lo guardamos aqui para evitar hackeos, ya que al cambiar la contraseña se usará este email 
												   //y no el del campo del formulario, pues esta bloqueado por css pero se podría desbloquear
		$email = $_SESSION['emailRec'];
	}
	mysqli_close($link); 
}
if($error == 1){
echo "<script> 
	Swal.fire({
		  icon: 'error',
		  title: 'El enlace es incorrecto o puede que haya pasado mas de 1 hora de la petición y haya caducado. <br> Intentelo de nuevo',
		  allowOutsideClick: false,
		  showDenyButton: false,
		  showCancelButton: false,
		  confirmButtonText: `De acuerdo`,
		  denyButtonText: `No`,
		}).then((result) => {
  if (result.isConfirmed) {
	window.location.href = 'RecoverPasswordPetition.php';  }
})
	</script>"; 
	}else{
?>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	<fieldset>
    <legend>Introduzca su nueva contraseña:</legend>
		<td><br>
		<form id='fquestion' name='fquestion' action="RecoverPassword.php?email=<?php $c = $_GET['email']; echo "$c";?>" method="POST" enctype="multipart/form-data">
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" size="30" style="background-color : #D39E52" readonly value="<?php echo"$email";?>"><br><br>
			<label for="pass">Contraseña:</label>
			<input type="password" id="pass" name="pass" size="20"><br><br>
			<text id="resCON"></text>
			<label for="pass2">Repita la contraseña:*</label>
			<input type="password" id="pass2" name="pass2" size="20"><br><br>
			<input type="submit" id="boton" value="Enviar solicitud"><br><br>
		</form>
		</td>
	</fieldset>
	<?php include '../php/DbConfig.php' ?>			
		
	<?php
	if (isset($_POST['email'])){
		if($_POST['pass'] == "" || $_POST['pass2'] == ""){
			echo '<p style="color:red; font-size:20px; font-weight: bold;">Rellene todos los campos</p>';
		}else{
			if(strcmp($_POST['pass'], $_POST['pass2']) !== 0){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">Las contraseñas no coinciden</p>';
			}else{
				$bol=0;
				$link3 = new mysqli($server, $user, $pass, $basededatos);
				$emailseguro=mysqli_real_escape_string($link3, strip_tags($_SESSION["emailRec"]));
				$passsegura=mysqli_real_escape_string($link3, strip_tags($_POST["pass"]));
				$passCryp = crypt($passsegura,'$5$rounds=5000$ArenItur$');
						
				$sql3 = "UPDATE usuario SET pass = '$passCryp' WHERE email = '$emailseguro';";
				mysqli_query($link3 ,$sql3);
				mysqli_close($link3); 
				echo "<script> 
				Swal.fire({
					  icon: 'success',
					  title: 'Contraseña cambiada correctamente!',
					  allowOutsideClick: false,
					  showDenyButton: false,
					  showCancelButton: false,
					  confirmButtonText: `De acuerdo`,
					  denyButtonText: `No`,
					}).then((result) => {
			  if (result.isConfirmed) {
				window.location.href = 'LogIn.php';  }
			})
				</script>";
				
				
			}
		}
	}
	?>
	
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
	<?php } ?>

</body>
</html>

