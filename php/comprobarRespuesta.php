<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/modificarValoracion.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>
</style>
<body>
  <?php include '../php/Menus.php' ?>

  <section class="main" id="s1">
  <?php 
  include '../php/DbConfig.php';
  $link = new mysqli($server, $user, $pass, $basededatos);
   
  if(isset($_SESSION['tema'])){
		  if(!isset($_POST['preg'])){
			echo "<fieldset>";
			echo "<text style='font-size:20px;color:blue;text-align:center'>Vaya, parece que no has respondido a la pregunta</text><br><br>";
			echo "<text style='font-size:15px;color:blue;text-align:center'>No pasa nada, no se va a tener en cuenta como pregunta contestada</text><br><br>";	
			echo "<form id='fquestion' name='fquestion' action='play.php'>
			<input type='submit' id='boton' value='Siguiente pregunta'><br><br>
			</form>";
			echo "</fieldset>";
			echo "<form id='fquestion' name='fquestion' action='showResultsPlay.php'>
			<br><input type='submit' id='boton' value='Mostrar Resultados'><br><br>
			</form>";
		  }else{
			if(strcmp($_POST['preg'],$_POST['resco'])!== 0){
				echo "<fieldset>";
				echo "<text style='font-size:30px;color:blue;text-align:center'>Vaya...</text><br><br>";
				$respondido = $_POST['preg'];
				$correcto =$_POST['resco'];
				echo "<text style='font-size:20px;color:blue;text-align:center'>No has acertado, tu respuesta ha sido \"$respondido\" y la respuesta correcta era \"$correcto\"</text><br><br>";
				echo "<img src='../images/error.svg.png' height='50px' weight ='50px'>";

				$_SESSION['total'] = $_SESSION['total'] +1;
			}else{
				echo "<fieldset>";
				echo "<text style='font-size:30px;color:blue;text-align:center'>Enhorabuena!</text><br><br>";
				$respondido = $_POST['preg'];
				$correcto =$_POST['resco'];
				echo "<text style='font-size:20px;color:blue;text-align:center'>Has acertado, la respuesta correcta era \"$correcto\"</text><br><br>";
				echo "<img src='../images/bien.svg.png' height='50px' weight ='50px'>";
				$_SESSION['total'] = $_SESSION['total'] +1;
				$_SESSION['acertadas'] = $_SESSION['acertadas'] +1;
				
			}
			$valoracion =$_SESSION['valPregAct'];
			echo "<br><br><text style='text-align:center;color:blue;'> La valoracion actual de la pregunta es de </text><text style='text-align:center;color:green;font-weight:bold'>$valoracion</text><br><text style='font-style: italic;'>¿Te ha gustado la pregunta?</text><br>";
			echo "<a id='subVal' href='javascript:subirval()' style='color: green;'>Sí<a/><text id='resVal'></text><a id='bajVal' href='javascript:bajarval()'  style='color: red;'>No</a></text><br><br>";

			
			
			
			
			echo "<form id='fquestion' name='fquestion' action='play.php'>
			<input type='submit' id='boton' value='Siguiente pregunta'><br><br>
			</form>";
			echo "</fieldset>";
			echo "<form id='fquestion' name='fquestion' action='showResultsPlay.php'>
			<br><input type='submit' id='boton' value='Mostrar Resultados'><br><br>
			</form>";
			
		  }
  }?>
		
  </section>
  <?php include '../html/Footer.html' ?>
	<!--<script src="../js/ValidateFieldsQuestion.js"></script>-->
</body>
</html>

