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
			$emailestudi= "/^[a-z]+[0-9]{3}@(ikasle.ehu.)(eus|es)/";
			$emailprofe="/[a-z]+(.[a-z]+)?@(ehu.)(eus|es)/";
			$file_get = $_FILES['fotoASubir']['name'];
			$temp = $_FILES['fotoASubir']['tmp_name'];
			$email= $_GET["email"];
			$foto = $_GET["img"];

			$file_to_saved = "../images/".$file_get; //Documents folder, should exist in       your host in there you're going to save the file just uploaded
			move_uploaded_file($temp, $file_to_saved);
			//echo $file_to_saved;
			if($_POST["email"] == null || $_POST["enunc"] == null || $_POST["resco"] == null  || $_POST["resin1"] == null  || $_POST["resin2"] == null  || $_POST["resin3"] == null  || $_POST["difi"] == null  || $_POST["tema"] == null){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Hay que rellenar los campos obligatorios</p>';
				echo "<p> <a href='QuestionFormWithImage.php?email=$email&img=$foto'> Volver atras</a>";
			}elseif(!preg_match($emailestudi, $_POST['email']) && !preg_match($emailprofe, $_POST['email']) ){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Formato de email incorrecto</p>';
				echo "<p> <a href='QuestionFormWithImage.php?email=$email&img=$foto'> Volver atras</a>";
			}else if (strlen($_POST["enunc"]) <10 ){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Enunciado muy corto</p>';
				echo "<p> <a href='QuestionFormWithImage.php?email=$email&img=$foto'> Volver atras</a>";
			}else{
				$link = new mysqli($server, $user, $pass, $basededatos);
				$sql = "INSERT INTO preguntasconimagen(email,enunc,resco,resin1,resin2,resin3,difi,tema,img) values('" . $_POST["email"] . "','" . $_POST["enunc"] . "' ,'" . $_POST["resco"] ."' ,'" . $_POST["resin1"] ."', '" . $_POST["resin2"] ."' , '" . $_POST["resin3"] ."' , '" . $_POST["difi"] ."' , '" . $_POST["tema"] ."', '".$file_to_saved."' )";
				if (!mysqli_query($link ,$sql))
					{
						die('Error: ' . mysqli_error($link));
					}
				echo '<p style="color:green; font-size:20px; font-weight: bold;">Una respuesta añadida</p>';
				echo "<p> <a href='ShowQuestionsWithImage.php?email=$email&img=$foto'> Ver registros </a>";
				mysqli_close($link); 
			}

 ?>









    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
