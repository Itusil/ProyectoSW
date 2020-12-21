<?php
        session_start();  
?>
<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="google-signin-client_id" content="642356419201-6anlle64tonqahimvuvra3qn3mftrj5q.apps.googleusercontent.com">


  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <?php include '../html/Head.html'?>
</head>
<style>
.g-signin2{
  width: 100%;
}

.g-signin2 > div{
  margin: 0 auto;
}
</style>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
		<fieldset>
    <legend>Introduce tu login</legend>
		<td><br>
		<form id='fquestion' name='fquestion' action="LogIn.php" method="POST" enctype="multipart/form-data">
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" size="30"><br><br>
			<label for="pass">Contraseña:*</label>
			<input type="password" id="pass" name="pass" size="20"><br><br>
			<input type="submit" id="boton" value="Login"><br><br>
		</form>
			</td>
	</fieldset><br>
	    </div>
	<text style="color:blue; font-size:20px; text-align:center;font-weight: bold;">No te acuerdas de la contraseña?</text>
	<text style="color:blue; font-size:20px; text-align:center;">Haz click <a href="RecoverPasswordPetition.php">aquí</a></text>
	<br><br>
	<text style="color:blue; font-size:20px; text-align:center;font-weight: bold;">Si lo prefieres puedes hacer Log In social:</text><br><br>
	<div class="g-signin2" data-onsuccess="onSignIn"></div>
	<div id="feedbackAjax"></div>
	<?php include 'cleanOldUsers.php';?>
	<script> function onSignIn(googleUser) {
			  var profile = googleUser.getBasicProfile();
			  var imagen = profile.getImageUrl();
			  var email = profile.getEmail();
			  xmlhttp = new XMLHttpRequest();
			  var params = "imagen=".concat(imagen).concat("&email=").concat(email);
			  xmlhttp.open("POST","../php/AddSessionVariables.php"); //Save login details for $_SESSION variable
			  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			  xmlhttp.send(params);
			  	Swal.fire({
						  icon: 'success',
						  title: 'Bienvenido usuario <br> '.concat(email),
						  allowOutsideClick: false,
						  showDenyButton: false,
						  showCancelButton: false,
						  confirmButtonText: `De acuerdo`,
						  denyButtonText: `No`,
						}).then((result) => {
				  if (result.isConfirmed) {
					window.location.href = 'Layout.php';  }
				});
				  
			
			  

			}
	</script>
	  </section>

	<?php include '../php/DbConfig.php' ?>
		<?php 
		function estaLogeado($email_){
			$usuarios = simplexml_load_file('../xml/UserCounter.xml');
			foreach ($usuarios->xpath('//usuario') as $usuario)
			{
				$email = $usuario['email'];
				if($email == $email_){
					return true;
				}}
			return false;
			}	
				
		if (isset($_POST['email'])){
				$bol=0;
				$link = new mysqli($server, $user, $pass, $basededatos);
				$emailseguro=mysqli_real_escape_string($link, strip_tags($_POST["email"]));
				$passsegura=mysqli_real_escape_string($link, strip_tags($_POST["pass"]));
				$passCryp = crypt($passsegura,'$5$rounds=5000$ArenItur$');
				
				include 'cleanOldUsers.php'; //Borramos los usuarios que llevan inactivos 5 minutos
				
				$sql = "SELECT * FROM usuario WHERE usuario.email='" . $emailseguro . "' AND usuario.pass='" . $passCryp. "'";
				$usuario = mysqli_query($link ,$sql);
				if(mysqli_num_rows($usuario) == 0){
					echo '<p style="color:red; font-size:20px; font-weight: bold;">LOGIN INCORRECTO</p>';
				}else if(estaLogeado($_POST["email"])){
					echo '<p style="color:red; font-size:20px; font-weight: bold;">Este usuario ha iniciado sesión en otra pestaña y ha realizado una acción hace menos de cinco minutos. <br> Cierre la otra pestaña o, si ha cerrado la pestaña sin hacer LogOut, espere 5 minutos.</p>';
				}else{
					$row  = mysqli_fetch_array($usuario);
					if($row['estado'] != "Activo"){
						echo '<p style="color:red; font-size:20px; font-weight: bold;">Este usuario está bloqueado <br> Por favor, contacte con el administrador</p>';
					}else{
						$_SESSION['email'] = $row["email"];
						$email = $_SESSION['email'];
						$_SESSION['img'] = $row["imagen"];
						$_SESSION['tipo'] = $row["tipo"];
						$tipo =$_SESSION['tipo'];
						include("./IncreaseGlobalCounter.php");
						echo "<script> window.alert('bienvenido usuario $email'); window.location.href = 'Layout.php';</script> ";
				}	
				}
				mysqli_close($link); 
			}
 ?>
	
  <?php include '../html/Footer.html' ?>
</body></html>
