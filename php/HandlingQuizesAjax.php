<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
  <script src="../js/ShowQuestionsAjax.js"></script>
  <script src="../js/AddQuestionsAjax.js"></script>
  <script src="../js/CountQuestions.js"></script>
  <script src="../js/LogOutOnClose.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>
</style>
<body>
  <?php if(!isset($_SESSION['tipo']) || ($_SESSION['tipo']!="profe" && $_SESSION['tipo']!="estu")){
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
	}else{
?>
  <?php include '../php/Menus.php' ?>

  <section class="main" id="s1">
    <div id="activos">
	    <legend>Usuarios Activos</legend>
		<table>
			<tr><td><text id="activosCelda"></text></td></tr>
		</table>
	</div>
  	<div id="cuantas">
	    <legend>Mis preguntas/totalpreguntas</legend>
		<table id="cuatasTAB">
			<tr><td><text id="cuantasCelda"></text></td></tr>
		</table>
	</div>
    <div>
		<fieldset>
    <legend>Introduce tu pregunta</legend>
		<td><br>
		<form id='fquestion' name='fquestion'  method="POST" enctype="multipart/form-data">
			<label for="email">Email:*</label>
			<input type="text" id="email" name="email" size="30" style="background-color : #D39E52" readonly value="<?php $email = $_SESSION["email"]; echo"$email";?>"><br><br>
			<label for="enunc">Enunciado de la pregunta:*</label>
			<input type="text" id="enunc" name="enunc" size="100"><br><br>
			<label for="resco">Respuesta correcta:*</label>
			<input type="text" id="resco" name="resco" size="100"><br><br>
			<label for="resin1">Respuesta incorrecta 1:*</label>
			<input type="text" id="resin1" name="resin1" size="100"><br><br>
			<label for="resin2">Respuesta incorrecta 2:*</label>
			<input type="text" id="resin2" name="resin2" size="100"><br><br>
			<label for="resin3">Respuesta incorrecta 3:*</label>
			<input type="text" id="resin3" name="resin3" size="100"><br><br>
			<label for="difi">Dificultad:* </label>
			<select name="difi" id="difi">
				<option value="1">Baja</option>
				<option value="2">Media</option>
				<option value="3">Alta</option>
			 </select><br><br>
			<label for="fotoASubir">Insertar imagen:</label>
			<input type="file" accept="image/*" name="fotoASubir" id="fotoASubir"><br><br>
			<label for="tema">Tema:*</label>
			<input type="text" id="tema" name="tema" size="20"><br><br>	
		</form>
			</td>
	</fieldset>
    </div>
	<input type="button" id="botXML" value="Ver preguntas" onclick="pedirDatos()">
	<input type="button" id="botINS" value="Enviar solicitud">
	<input type="button" id="botRES" value="Reset" onclick="resetear()"><br>
	<div id="pregAnadida"></div>
	<div id="respuestaXML"></div>
		
  </section>
  <?php include '../html/Footer.html' ?>
	<!--<script src="../js/ValidateFieldsQuestion.js"></script>-->
</body>
  <?php }?>
</html>

