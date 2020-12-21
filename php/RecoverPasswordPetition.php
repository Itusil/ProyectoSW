<?php
        session_start();  
?>
<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	<fieldset>
    <legend>Recuperación de contraseña</legend>
		<td><br>
		<form id='fquestion' name='fquestion' action="RecoverPasswordPetition.php" method="POST" enctype="multipart/form-data">
			<label for="email">Introduzca el email asociado a la cuenta:</label>
			<input type="text" id="email" name="email" size="30"><br><br>
			<input type="submit" id="boton" value="Enviar solicitud"><br><br>
		</form>
		</td>
	</fieldset>
	<?php include '../php/DbConfig.php' ?>			
		
	<?php 
		if (isset($_POST['email'])){
				$bol=0;
				$link = new mysqli($server, $user, $pass, $basededatos);
				$emailseguro=mysqli_real_escape_string($link, strip_tags($_POST["email"])); //Veo que el email sea seguro
				$sql = "SELECT * FROM usuario WHERE EMAIL ='$emailseguro';";
				$usuario = mysqli_query($link ,$sql);//Introduzco en la BD
				
				if(mysqli_num_rows($usuario) == 0){ //No existe ese usuario en la BD
					echo '<p style="color:red; font-size:20px; font-weight: bold;">No existe ningun usuario con ese email</p>';
				}else{
					$row  = mysqli_fetch_array($usuario);
					$nombre = $row['nombre'];
					$emailcry = crypt($emailseguro,'$5$rounds=5000$IturriaS$'); //Encripto el email (será lo que mande al usuario)
					$fecha = date('Y-m-d H:i:s'); //Saco la fecha actual

					$sql = "INSERT INTO recoverpass(fecha, email,emailcry) VALUES ('$fecha', '$emailseguro', '$emailcry')";
					$usuario = mysqli_query($link ,$sql);//Introduzco en la BD
					
					//Creo las variables para enviar el email
					$to = $emailseguro;//Destinatario
					$subject = "Recuperar contraseña"; //Asunto
					
					//Mensaje
					$message = "
					<html>
					<head>
					</head>
					<body>
					<h3 style='font-size:25px;color:blue;'>Estimado $nombre </h3>
					<p style='font-size:20px;'>Hemos recibido la petición de restablecimiento de contrasena. <br> Si ha sido usted, haga click en el boton de abajo </p>
					<form id='fquestion2' name='fquestion2' action='https://swmikel-iturria.000webhostapp.com/Proyecto1SW/php/RecoverPassword.php?email=$emailcry' method='POST' enctype='multipart/form-data'>
						<input type='submit' value='Recuperar contraseña' />
					</form>
					<p>Si el botón no funciona, haga click <a href='https://swmikel-iturria.000webhostapp.com/Proyecto1SW/php/RecoverPassword.php?email=$emailcry'>aquí</a></p>
					</body>
					</html>";
					
					//Cabeceras 
					$headers = "MIME-Version: 1.0"."\r\n";
					$headers .= "Content-Type:text/html;charset=UTF-8"."\r\n";


					mail($to,$subject,$message, $headers);
					
					echo "<script> 
						Swal.fire({
							  icon: 'success',
							  title: 'Email enviado correctamente! Si no aparece consulte la bandeja de SPAM',
							  allowOutsideClick: false,
							  showDenyButton: false,
							  showCancelButton: false,
							  confirmButtonText: `De acuerdo`,
							  denyButtonText: `No`,
							}).then((result) => {
					  if (result.isConfirmed) {
						window.location.href = 'Layout.php';  }
					})
						</script>"; //Lanzo mensaje de exito
				}
				mysqli_close($link); 
			}
		
 ?>
	
	
	
	
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>

