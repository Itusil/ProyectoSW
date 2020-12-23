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
			echo "<fieldset>";
			echo "<text style='font-size:30px;color:blue;font-weight:bold;'>Estos son tus resultados:</text><br><br>";
			if($_SESSION['total'] == 0){
				echo "<text style='text-align:center;'>No has contestado ninguna pregunta!!!</text><br><br>";
			}else{
			echo "<text style='text-align:center;font-size:15px;'>Contestadas: </text><text style='font-size:15px;text-align:center;color:blue;font-weight:bold;'>".$_SESSION['total']."</text><br><br>";
			echo "<text style='text-align:center;font-size:15px;'>Acertadas: </text><text style='font-size:15px;text-align:center;color:green;font-weight:bold;'>".$_SESSION['acertadas']."</text><br><br>";
			$promedio = $_SESSION['acertadas'] / $_SESSION['total'] *100;
			
			echo "<text style='text-align:center;'>Un promedio de: </text><text style='text-align:center;color:red;font-weight:bold;'>".$promedio."%</text><br><br>";
			
			//La formula matematica mas justa es el promedio / 100 * el numero total de preguntas - 0.3 por cada fallo
			$puntuacion = (($promedio/100)* $_SESSION['total'])- (0.3 * ($_SESSION['total'] - $_SESSION['acertadas']));

			
			echo "<text style='font-size:15px;color:blue;font-weight:bold;'>Tu puntuacion para el ranking es: $puntuacion</text><br><br>";
			
			$sql = "SELECT * FROM puntuaciones ORDER BY puntuacion DESC LIMIT 10;";
			$result = mysqli_query($link ,$sql);
			$num =1;
			$puntuacionUltimo=0;
			while($row  = mysqli_fetch_array($result)){  
				if($num == 10){//Ultima puntuacion del ranking
					$puntuacionUltimo = $row['puntuacion'];
				}
				$num +=1;
			}
			
			if ($puntuacionUltimo >= $puntuacion){
				$resta = $puntuacionUltimo - $puntuacion;
				echo "<text style='font-size:20px;color:blue'>No entras en el ranking! :( <br>Te has quedado a $resta puntos </text><br><br>";
			}else{
				$_SESSION['valido'] = 1;
				$_SESSION['puntuacionFinal'] = $puntuacion;
				echo "<text style='font-size:20px;color:blue'>Felicidades! Con esa puntuacion entras en el ranking!</text><br><br>";
				echo "<form id='fquestion' name='fquestion' action='insertIntoTopQuizzers.php' method='POST' enctype='multipart/form-data'>
					<label for='nick'>Introduce el nick a mostrar:</label>
					<input type='text' id='nick' name='nick' size='30'><br><br>
					<input type='submit' id='boton' value='Enviar'><br><br>
				</form>";
			}

			
			
			echo "<text style='font-size:20px;color:blue'>Espero que hayas disfrutado</text><br><br>";

			
			
			}
			echo "<form id='fquestion' name='fquestion' action='play.php'>
			<input type='submit' id='boton' value='Volver a jugar'><br><br>
			</form>";
			echo "</fieldset>";
			

			
			
			
			
			
			unset($_SESSION['tema']);
			unset($_SESSION['acertadas']);
			unset($_SESSION['total']);
			unset($_SESSION['todasLasPreg']);
			mysqli_close($link); 

			
  }else{
	 	echo "<script> window.location.href = 'play.php';</script> "; 
  }?>
		
  </section>
  <?php include '../html/Footer.html' ?>
	<!--<script src="../js/ValidateFieldsQuestion.js"></script>-->
</body>
</html>

