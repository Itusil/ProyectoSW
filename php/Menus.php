<div id='page-wrap'>
<!--<header class='main' id='h1'>-->
  <!--<span class="right" ><a href="registro">Registro</a></span>
  <span class="right" ><a href="login">Login</a></span>
  <span class="right" style="display:none;"><a href="/logout">Logout</a></span>-->
  <?php if(isset($_GET["email"])){?>
	<header class='main' id='h1'>
	    <span class="right"><a href="LogOut.php">Logout</a></span>
		<span class="right">
		<?php $email = $_GET["email"]; echo "$email"; ?></span>
		<?php if($_GET["img"] == "../images/"){$foto="../images/def.jpg";?>
			<img src="../images/def.jpg" height="50px" >
		<?php }else{ ?>
			<img src="<?php $foto = $_GET["img"]; echo "$foto"; ?>" height="50px" >
		<?php } ?>
		</header>
		<nav class='main' id='n1' role='navigation'>
		  <span><a href='Layout.php<?php echo"?email=$email&img=$foto";?>'>Inicio</a></span>
		  <span><a href='QuestionFormWithImage.php<?php echo"?email=$email&img=$foto";?>'> Insertar Pregunta</a></span>
		  <span><a href='ShowQuestionsWithImage.php<?php echo"?email=$email&img=$foto";?>'> Ver Preguntas</a></span> 
		  <span><a href='Credits.php<?php echo"?email=$email&img=$foto";?>'>Creditos</a></span>
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
  


