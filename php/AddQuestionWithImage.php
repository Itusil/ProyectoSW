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
			$file_get = $_FILES['fotoASubir']['name'];
			$temp = $_FILES['fotoASubir']['tmp_name'];

			$file_to_saved = "../images/".$file_get; //Documents folder, should exist in       your host in there you're going to save the file just uploaded
			move_uploaded_file($temp, $file_to_saved);
			//echo $file_to_saved;
			$link = new mysqli($server, $user, $pass, $basededatos);
			$sql = "INSERT INTO preguntasconimagen(email,enunc,resco,resin1,resin2,resin3,difi,tema,img) values('" . $_POST["email"] . "','" . $_POST["enunc"] . "' ,'" . $_POST["resco"] ."' ,'" . $_POST["resin1"] ."', '" . $_POST["resin2"] ."' , '" . $_POST["resin3"] ."' , '" . $_POST["difi"] ."' , '" . $_POST["tema"] ."', '".$file_to_saved."' )";
			if (!mysqli_query($link ,$sql))
				{
					die('Error: ' . mysqli_error($link));
				}
			echo "1 respuesta añadida";
			echo "<p> <a href='ShowQuestionsWithImage.php'> Ver registros </a>";
			mysqli_close($link); 

 ?>









    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
