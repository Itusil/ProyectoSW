<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="../js/jquery-3.4.1.min.js"></script>
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
	    $tema = $_SESSION['tema'];
		if(!isset($_SESSION['acertadas'])){//Primera vez que entra
			$_SESSION['acertadas'] = 0;
			$_SESSION['total'] = 0;
			$_SESSION['todasLasPreg'] = array();
			$sql = "SELECT * FROM preguntasconimagen WHERE tema = '$tema' ";//Obtenemos todas las preguntas 
			$preguntas = mysqli_query($link ,$sql);
			while($row  = mysqli_fetch_array($preguntas)){  
				array_push($_SESSION['todasLasPreg'],$row);//Guardamos todas las preguntas
			}
		}
		if (empty($_SESSION['todasLasPreg'])){//Comprobamos que queden mas preguntas
			echo "<script>window.location.href = 'showResultsPlay.php';</script> ";

		}else{	
				
			$numparaPreg = rand(0, count($_SESSION['todasLasPreg'])-1);		
			$pregActual = $_SESSION['todasLasPreg'][$numparaPreg];//Obtenemos la pregunta que vamois a hacer ahora
				
			unset($_SESSION['todasLasPreg'][$numparaPreg]); //Borramos la pregunta para que no pueda salir mas
			
			$_SESSION['todasLasPreg'] = array_values($_SESSION['todasLasPreg']);//Reordenamos el array para que no queden huecos
			
			
			//Preparemos la aleatoriedad de la aparición de respuestas
			$respuestaCorrecta = $pregActual['resco']; //guardamos la respuesta correcta
			$arrayConrespuestas =  array($pregActual['resco'], $pregActual['resin1'], $pregActual['resin2'], $pregActual['resin3']); //Guardamos todas las respuesta en un array para que las respuestas sean aleatorias
			
			$num1 = rand(0,count($arrayConrespuestas)-1);//Obtenemos aleatoriamente la primera respuesta que se va a poner
			$res1 = $arrayConrespuestas[$num1];
			
			//Borramos la respuesta que acabamos de meter y reordenamos
			unset($arrayConrespuestas[$num1]); 
			$arrayConrespuestas = array_values($arrayConrespuestas);
			
			//Hacemos lo mismo con el resto de respuestas
			$num2 = rand(0,count($arrayConrespuestas)-1);
			$res2 = $arrayConrespuestas[$num2];
			unset($arrayConrespuestas[$num2]); 
			$arrayConrespuestas = array_values($arrayConrespuestas);
			$num3 = rand(0,count($arrayConrespuestas)-1);
			$res3 = $arrayConrespuestas[$num3];
			unset($arrayConrespuestas[$num3]); 
			$arrayConrespuestas = array_values($arrayConrespuestas);
			$num4 = rand(0,count($arrayConrespuestas)-1);
			$res4 = $arrayConrespuestas[$num4];
			unset($arrayConrespuestas[$num4]); 
			
			
			//Para la valoracion, obtenemos la valoracion actual y el numero de pregunta
			$_SESSION['numpreAct'] = $pregActual['numpre'];
			$_SESSION['valPregAct'] = $pregActual['valoracion'];
			
			echo "<fieldset>";
			echo "<br><text style='text-align:left;font-weight:bold; font-size:20px;color:blue;'>".$pregActual['enunc']."</text><br><br>";
			if($pregActual['img'] != "../images/"){
				echo "<img src='".$pregActual['img']."' style='max-height:50px'><br><br>";
			}
			echo "<form id='fquestion' name='fquestion' action='comprobarRespuesta.php' method='POST' enctype='multipart/form-data'>";
			echo "<text style='text-align:left; font-size:15px;color:blue;'>Respuestas posibles:</text><br><br>";
			echo "<input id='resco' name='resco' type='hidden' value='$respuestaCorrecta'>";
			echo "<input type='radio' name='preg' value='".$res1."'>";
			echo "<label>".$res1."</label><br><br>";
			echo "<input type='radio' name='preg' value='".$res2."'>";
			echo "<label>".$res2."</label><br><br>";
			echo "<input type='radio' name='preg' value='".$res3."'>";
			echo "<label>".$res3."</label><br><br>";
			echo "<input type='radio' name='preg' value='".$res4."'>";
			echo "<label>".$res4."</label><br><br>";
			echo "<input type='submit' id='boton' value='Comprobar respuesta'><br><br>
			</form>";
			echo "</fieldset>";
			echo "<form id='fquestion' name='fquestion' action='showResultsPlay.php'>
			<br><input type='submit' id='boton' value='Mostrar Resultados'><br><br>
			</form>";
		}

  }else{
	 echo "<fieldset>
		<legend>Seleccione tema para jugar:</legend>";
			$sql = "SELECT DISTINCT tema FROM preguntasconimagen";
			$temas = mysqli_query($link ,$sql);
			echo "<br><br>";
			echo "<form id='temaJugar' action='redirect.php' method='POST'>";
			echo "<select name='tema' id='tema'>";

			while($row  = mysqli_fetch_array($temas)){  
				echo "<option value='". $row["tema"] . "'>". $row["tema"] . "</option>";
			}
			echo "</select><br><br>
			<input type='submit' value='Jugar!'><br><br>";
		echo "</form>";
		echo "</fieldset>";

  }?>
		
  </section>
  <?php include '../html/Footer.html' ?>
	<!--<script src="../js/ValidateFieldsQuestion.js"></script>-->
</body>
</html>

