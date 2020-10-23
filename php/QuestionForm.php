<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<HTML>
<HEAD>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
</HEAD>
<BODY>
  <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
	    <div>
		<form id='fquestion' name='fquestion' action="AddQuestion.php" method="POST">
			<label for="email">Email:*</label>
			<input type="text" id="email" name="email" size="30"><br>
			<label for="enunc">Enunciado de la pregunta:*</label>
			<input type="text" id="enunc" name="enunc" size="100"><br>
			<label for="resco">Respuesta correcta:*</label>
			<input type="text" id="resco" name="resco" size="100"><br>
			<label for="resin1">Respuesta incorrecta 1:*</label>
			<input type="text" id="resin1" name="resin1" size="100"><br>
			<label for="resin2">Respuesta incorrecta 2:*</label>
			<input type="text" id="resin2" name="resin2" size="100"><br>
			<label for="resin3">Respuesta incorrecta 3:*</label>
			<input type="text" id="resin3" name="resin3" size="100"><br>
			<label for="difi">Dificultad:* </label>
			<select name="difi" id="difi">
				<option value="1">Baja</option>
				<option value="2">Media</option>
				<option value="3">Alta</option>
			 </select><br>
			<label for="tema">Tema:*</label>
			<input type="text" id="tema" name="tema" size="20"><br>
			<input type="submit" id="boton" value="Enviar solicitud">
		</form>
		</div>
	</section>
  <?php include '../html/Footer.html' ?>
	<script src="../js/ValidateFieldsQuestion.js"></script>
</BODY>
</HTML>
