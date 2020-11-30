<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<?php if(!isset($_SESSION['tipo']) || $_SESSION['tipo']!="profe" ){
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
	}else{?>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	<fieldset>
    <legend>Buscar pregunta</legend>
		<td><br>
		<form id='fquestion' name='fquestion' action="ClientGetQuestion.php" method="POST">
			<label for="email">Id:*</label>
			<input type="text" id="id" name="id" size="30"><br><br>
			<text id="resautor" style="color:blue; font-weight: bold"></text><br><br>
			<text id="resenunc" style="color:blue; font-weight: bold"></text><br><br>
			<text id="resresco" style="color:blue; font-weight: bold"></text><br><br>
			<input type="submit" id="boton" value="Buscar!"><br><br>
		</form>
			</td>
	</fieldset>
	<?php include "servicesConfig.php"; ?>
	<?php 
	require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    $soapclient = new nusoap_client($getQuestion);
    if (isset($_POST['id'])){
    $pregunta = $soapclient->call('getPregunta',array( 'x'=>$_POST['id']));
	if($pregunta['autor']==""){
		echo "<script>$('#resautor').text('ERROR, no hay pregunta con ese id');$('#resautor').css({'color':'red','font-weight':'bold'}); </script>";
	}else{
		$autor=$pregunta['autor'];
		$enunc=$pregunta['enunc'];
		$resco=$pregunta['resco'];
		echo "<script>$('#resautor').text('Autor: $autor'); </script>";
		echo "<script>$('#resenunc').text('Enunciado: $enunc'); </script>";
		echo "<script>$('#resresco').text('Respuesta correcta: $resco'); </script>";
	}
	}
	?>
	</div>
	</section>
	
  <?php include '../html/Footer.html' ?>
	<?php } ?>
</body>
</html>
