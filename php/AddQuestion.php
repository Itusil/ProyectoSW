<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
  <?php 
if(true){
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
	</script>";}else{?>
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
	<?php } ?>
</body>
</html>