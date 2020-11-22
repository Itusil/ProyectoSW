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
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	<fieldset>
    <legend>Buscar pregunta</legend>
		<td><br>
		<form id='fquestion' name='fquestion' action="ClientGetQuestion.php?<?php $email=$_GET["email"]; echo "email=$email&"; $img=$_GET["img"]; echo "img=$img"; ?>" method="POST">
			<label for="email">Id:*</label>
			<input type="text" id="id" name="id" size="30"><br><br>
			<text id="resautor" style="color:blue; font-weight: bold"></text><br><br>
			<text id="resenunc" style="color:blue; font-weight: bold"></text><br><br>
			<text id="resresco" style="color:blue; font-weight: bold"></text><br><br>
			<input type="submit" id="boton" value="Buscar!"><br><br>
		</form>
			</td>
	</fieldset>
	<?php include "servicesConfig.php"; ?>
	<?php 
	require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    $soapclient = new nusoap_client($getQuestion);
    if (isset($_POST['id'])){
    $pregunta = $soapclient->call('getPregunta',array( 'x'=>$_POST['id']));
	if($pregunta['autor']==""){
		echo "<script>$('#resautor').text('ERROR, no hay pregunta con ese id');$('#resautor').css({'color':'red','font-weight':'bold'}); </script>";
	}else{
		$autor=$pregunta['autor'];
		$enunc=$pregunta['enunc'];
		$resco=$pregunta['resco'];
		echo "<script>$('#resautor').text('Autor: $autor'); </script>";
		echo "<script>$('#resenunc').text('Enunciado: $enunc'); </script>";
		echo "<script>$('#resresco').text('Respuesta correcta: $resco'); </script>";
	}
	}
	?>
	
  <?php include '../html/Footer.html' ?>
</body>
</html>
