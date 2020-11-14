<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>-->
  <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
</head>
<style>
#img_url {
  background: #ddd;
  width:100px;
  height: 90px;
  display: block;
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
	</fieldset>
	<?php include '../php/DbConfig.php' ?>
		<?php 
		function estaLogeado($email_){
			$usuarios = simplexml_load_file('../xml/UserCounter.xml');
			$esta =0;
			foreach ($usuarios->xpath('//usuario') as $usuario)
			{
				$email = $usuario['email'];
				if($email == $email_){
					$esta=1;
				}
			}
			if($esta==0){
				return false;
			}else{
				return true;
			}
		}			
		
		
		//hacer el isset con tipop
		if (isset($_POST['email'])){
				$bol=0;
				$link = new mysqli($server, $user, $pass, $basededatos);
				$sql = "SELECT * FROM usuario WHERE usuario.email='" . $_POST["email"] . "' AND	usuario.pass='" . $_POST["pass"] . "'";
				$usuario = mysqli_query($link ,$sql);
				if(mysqli_num_rows($usuario) == 0){
					echo '<p style="color:red; font-size:20px; font-weight: bold;">LOGIN INCORRECTO</p>';
				}else if(estaLogeado($_POST["email"])){
					echo '<p style="color:red; font-size:20px; font-weight: bold;">Este usuario ya esta logeado en otra pestaña</p>';
				}else{
					$row  = mysqli_fetch_array($usuario);
					$email = $row["email"];
					$foto = $row["imagen"];
					include("./IncreaseGlobalCounter.php");
					echo "<script> window.alert('bienvenido usuario $email'); window.location.href = 'Layout.php?email=$email&img=$foto';</script> ";
				}	
				mysqli_close($link); 
			}
 ?>
	
	
	
	
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
	<!--<script src="../js/ValidateFieldsQuestion.js"></script>-->
</body>
</html>

