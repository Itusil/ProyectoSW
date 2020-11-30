<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
  <script src="../js/ShowQuestionsAjax.js"></script>
  <script src="../js/AddQuestionsAjax.js"></script>
  <script src="../js/CountQuestions.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="../js/alterarUsuarios.js"></script>


</head>
<style>
</style>
<body>
  <?php if(!isset($_SESSION['tipo']) || ($_SESSION['tipo']!="admin")){
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
	</script>";
  }else{
?>
  <?php include '../php/Menus.php' ?>

  <section class="main" id="s1">
	<h3 style="color:blue; font-weight:bold;">Todos los usuarios</h3><br><br>
	<?php include '../php/DbConfig.php' ?>
	<?php
		$connection = new mysqli($server, $user, $pass, $basededatos);
		$sql = "SELECT * FROM usuario";
		$result = mysqli_query($connection ,$sql);
		
		$ruta="../images/";

		echo "<table border=1>"; 
		echo "<tr>";
		echo "<th>Correo</th>";
		echo "<th>Contraseña</th>";
		echo "<th>Tipo</th>";
		echo "<th>Imagen</th>";
		echo "<th>Estado</th>";
		echo "<th>Bloqueo</th>";
		echo "<th>Borrar</th>";
		

		while($row  = mysqli_fetch_array($result)){  
			if($row["tipo"] != "admin"){
				echo "<tr>";
				echo "<td>" . $row["email"] . "</td>";
				echo "<td>" . $row["pass"] . "</td>";
				if($row["tipo"] == "profe"){
					echo "<td>Profesor</td>";
				}else{
					echo "<td>Estudiante</td>";
				}	
				if(strcmp($ruta, $row["imagen"])!=0){
					echo "<td> <img src=\" " . $row["imagen"] . " \" width=\"75px\"> </td>";
				}else{
					echo "<td> Sin imagen </td>";
				}
				$email = $row["email"];
				echo "<td>"	. $row["estado"] . "</td>";
				$emailstr= strval($email);
				echo "<td><button onClick=\"cambiar(";
				echo "'";
				echo "$emailstr";
				echo "'";
				echo ")\">Cambiar Estado</button></td>";
				echo "<td><button onClick=\"borrar(";
				echo "'";
				echo "$emailstr";
				echo "'";
				echo ")\">Borrar usuario</button></td>";
				echo "<td></td>";
				echo "</tr>"; 
		}
		}

		echo "</table>"; 

		mysqli_close($connection); 

?>
		
  </section>
  <?php include '../html/Footer.html' ?>
</body>
  <?php }?>
</html>

