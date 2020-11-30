<div id='page-wrap'>

  <?php if(isset($_SESSION["email"])){?>
	<header class='main' id='h1'>
		<?php $email = $_SESSION["email"];?>
	    <span class="right"><a href="LogOut.php">Logout</a></span>
		<span class="right"><?php  echo "$email";?></span>
		<?php if($_SESSION["img"] == "../images/"){$foto="../images/def.jpg";?>
			<img src="../images/def.jpg" height="50px" >
		<?php }else{ ?>
			<img src="<?php $foto = $_SESSION["img"]; echo "$foto"; ?>" height="50px" >
		<?php } ?>
		
		</header>
		<nav class='main' id='n1' role='navigation'>
		  <span><a href='Layout.php'>Inicio</a></span>
		  <?php 		
		  if ($_SESSION["tipo"] == "profe"){
			echo "<span><a href='HandlingQuizesAjax.php'>Gestionar preguntas</a></span>";
			echo "<span><a href='ClientGetQuestion.php'>Obtener datos pregunta</a></span>";
		 }else if($_SESSION["tipo"] == "estu"){
			 echo "<span><a href='HandlingQuizesAjax.php'>Gestionar preguntas</a></span>";
		 }else if($_SESSION["tipo"] == "admin"){
			 echo "<span><a href='HandlingAccounts.php'>Gestionar usuarios</a></span>";
		 }

?>
		  <span><a href='Credits.php'>Creditos</a></span>

		</nav>
  <?php }else{?>
  	<header class='main' id='h1'>
		<span class="right" ><a href="SignUp.php">Registro</a></span>
		<span class="right" ><a href="LogIn.php">Login</a></span>
		<span class="right" >Anonimo</span>
		<img src="../images/anon.jpg" height="50px" >
	</header>
	<nav class='main' id='n1' role='navigation'>
	  <span><a href='Layout.php'>Inicio</a></span>
	  <span><a href='Credits.php'>Creditos</a></span>
	</nav>
  <?php }?>
  


