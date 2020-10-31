<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	<?php include '../php/DbConfig.php' ?>
	<?php
		$connection = new mysqli($server, $user, $pass, $basededatos);
		$sql = "SELECT * FROM preguntasconimagen";
		$result = mysqli_query($connection ,$sql);
		
		$ruta="../images/";

		echo "<table border=1>"; 
		echo "<tr>";
		echo "<th>Num</th>";
		echo "<th>Email</th>";
		echo "<th>Enunciado</th>";
		echo "<th>Resp. correcta</th>";
		echo "<th>Resp. incorrecta 1</th>";
		echo "<th>Resp. incorrecta 2</th>";
		echo "<th>Resp. incorrecta 3</th>";
		echo "<th>Dificultad</th>";
		echo "<th>Tema</th>";
		echo "<th>Imagen</th>";
		

		while($row  = mysqli_fetch_array($result)){  
			echo "<tr>";
			echo "<td>". $row["numpre"] . "</td>";
			echo "<td>" . $row["email"] . "</td>";
			echo "<td>" . $row["enunc"] . "</td>";
			echo "<td>"	. $row["resco"] . "</td>";
			echo "<td>"	. $row["resin1"] . "</td>";
			echo "<td>" . $row["resin2"] . "</td>";
			echo "<td>" . $row["resin3"] . "</td>";
			echo "<td>" . $row["difi"] . "</td>";
			echo "<td>" . $row["tema"] . "</td>";
			if(strcmp($ruta, $row["img"])!=0){
				echo "<td> <img src=\" " . $row["img"] . " \" width=\"150px\"> </td>";
			}else{
				echo "<td> Sin imagen </td>";
			}
			echo "</tr>"; 
		}

		echo "</table>"; 

		mysqli_close($connection); 

?>







    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
