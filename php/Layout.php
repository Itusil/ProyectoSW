<?php
        session_start();  
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
<section class="main" id="s1">
    <div>

      <h2>Quiz: el juego de las preguntas</h2><br>
      <img src="../images/quiz.jpg" height="75"><br><br>
	  <h2 style='color:blue;'>Los mejores quizzers!</h2><br>
	    <?php 
		include '../php/DbConfig.php';
		$link = new mysqli($server, $user, $pass, $basededatos);
		$sql = "SELECT * FROM puntuaciones ORDER BY puntuacion DESC LIMIT 10;";
		$result = mysqli_query($link ,$sql);
		

		echo "<table border=1>"; 
		echo "<tr>";
		echo "<th>Posición</th>";
		echo "<th>Nick</th>";
		echo "<th>Puntución</th>";
		echo "<th>Fecha</th>";
		echo "</tr>";
		$pos = 1;
		while($row  = mysqli_fetch_array($result)){  
			echo "<tr>";
			if($pos == 1){
				echo "<td style='background-color:#C9B037'>$pos</td>";
				echo "<td style='background-color:#C9B037'>". $row["nick"] . "</td>";
				echo "<td style='background-color:#C9B037'>" . $row["puntuacion"] . "</td>";
				echo "<td style='background-color:#C9B037'>" . $row["fecha"] . "</td>";
			}else if ($pos == 2){
				echo "<td style='background-color:#D7D7D7'>$pos</td>";
				echo "<td style='background-color:#D7D7D7'>". $row["nick"] . "</td>";
				echo "<td style='background-color:#D7D7D7'>" . $row["puntuacion"] . "</td>";
				echo "<td style='background-color:#D7D7D7'>" . $row["fecha"] . "</td>";
			}else if ($pos == 3){
				echo "<td style='background-color:#AD8A56'>$pos</td>";
				echo "<td style='background-color:#AD8A56'>". $row["nick"] . "</td>";
				echo "<td style='background-color:#AD8A56'>" . $row["puntuacion"] . "</td>";
				echo "<td style='background-color:#AD8A56'>" . $row["fecha"] . "</td>";
			}else{
				echo "<td>$pos</td>";
				echo "<td>". $row["nick"] . "</td>";
				echo "<td>" . $row["puntuacion"] . "</td>";
				echo "<td>" . $row["fecha"] . "</td>";
				echo "</tr>";
			}
			$pos += 1;
 
		}

		echo "</table>"; 

		mysqli_close($link); ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
