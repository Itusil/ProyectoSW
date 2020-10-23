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
			$link = new mysqli($server, $user, $pass, $basededatos);
			$sql = "INSERT INTO preguntas(email,enunc,resco,resin1,resin2,resin3,difi,tema) values('" . $_POST["email"] . "','" . $_POST["enunc"] . "' ,'" . $_POST["resco"] ."' ,'" . $_POST["resin1"] ."', '" . $_POST["resin2"] ."' , '" . $_POST["resin3"] ."' , '" . $_POST["difi"] ."' , '" . $_POST["tema"] ."' )";
			if (!mysqli_query($link ,$sql))
				{
					die('Error: ' . mysqli_error($link));
				}
			echo "1 respuesta añadida";
			echo "<p> <a href='ShowQuestions.php'> Ver registros </a>";
			mysqli_close($link); 

?>


    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>