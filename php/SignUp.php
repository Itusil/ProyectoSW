<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>-->
  <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
  <script src="../js/comprobarCorreo.js"></script>
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
    <legend>Introduce tus datos</legend>
		<td><br>
		<form id='fquestion' name='fquestion' action="SignUp.php" method="POST" enctype="multipart/form-data">
			<p>Que eres?*</p><br>
			<input type="radio" id="profe" name="tipo" value="profe">
			<label for="profe">Profesor</label>
			<input type="radio" id="estu" name="tipo" value="estu">
			<label for="estu">Estudiante</label><br><br>
			<label for="email">Email:*</label>
			<input type="text" id="email" name="email" size="30"><br><br>
			<text id="resVIP"></text>
			<label for="nom">Nombre y apellidos:* (respeta las mayusculas)</label>
			<input type="text" id="nom" name="nom" size="40"><br><br>
			<label for="pass">Contraseña:*</label>
			<input type="password" id="pass" name="pass" size="20"><br><br>
			<text id="resCON"></text>
			<label for="pass2">Repetir contraseña:*</label>
			<input type="password" id="pass2" name="pass2" size="20"><br><br>
			<label for="fotoASubir">Insertar imagen:</label>
			<input type="file" accept="image/*" name="fotoASubir" id="fotoASubir"><br><br>
			<input type="submit" id="boton" value="Registrarse"><br><br>
		</form>
			</td>
	</fieldset>
	<?php include '../php/DbConfig.php' ?>
		<?php 
		//hacer el isset con tipop
		if (isset($_POST['email'])){
			$emailestudi= "/^[a-z]+[0-9]{3}@(ikasle.ehu.)(eus|es)/";
			$emailprofe="/[a-z]+(.[a-z]+)?@(ehu.)(eus|es)/";
			$file_get = $_FILES['fotoASubir']['name'];
			$temp = $_FILES['fotoASubir']['tmp_name'];
			$formNombre = "/[A-Z][a-z]+ [A-Z][a-z]+( [A-Z][a-z]+)?/";

			$file_to_saved = "../images/".$file_get; //Documents folder, should exist in       your host in there you're going to save the file just uploaded
			move_uploaded_file($temp, $file_to_saved);
			//echo $file_to_saved;
			if(!isset($_POST['tipo'])){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Elegir profesor o estudiante</p>';
			}elseif($_POST["email"] == null || $_POST["nom"] == null || $_POST["pass"] == null  || $_POST["pass2"] == null){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Hay que rellenar los campos obligatorios</p>';
			}elseif(!(preg_match($emailestudi, $_POST['email']) && $_POST['tipo'] == "estu") && !(preg_match($emailprofe, $_POST['email']) && $_POST['tipo'] == "profe")){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Formato de email incorrecto o incorrecto para el tipo elegido (Ej:ser profesor y email de alumno)</p>';
			}else if(!preg_match($formNombre, $_POST['nom'])){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR en el nombre</p>';
			}else if (strlen($_POST["pass"]) <6 ){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: La contraseña tiene que ser mayor de 6 de longitud</p>';
			}else if (strcmp($_POST["pass"], $_POST["pass2"])!=0){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Las contraseñas no coinciden</p>';
			}else{
				$link = new mysqli($server, $user, $pass, $basededatos);
				$sql = "INSERT INTO usuario(tipo,email,nombre,pass,imagen) values('" . $_POST["tipo"] . "','" . $_POST["email"] . "' ,'" . $_POST["nom"] ."' ,'" . $_POST["pass"] ."', '".$file_to_saved."' )";
				if (!mysqli_query($link ,$sql))
					{
						die('Error: ' . mysqli_error($link));
					}
				echo '<script> window.alert("Usuario registrado correctamente!!"); window.location.href = "LogIn.php";</script> ';
				mysqli_close($link); 
			}
		}
 ?>
	
	
	
	
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
	<!--<script src="../js/ValidateFieldsQuestion.js"></script>-->
</body>
</html>

