<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>
</style>
<body>
<?php include '../php/DbConfig.php' ?>
  <?php if(!isset($_SESSION['tipo']) || ($_SESSION['tipo']!="profe" && $_SESSION['tipo']!="estu")){
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
		//Identar inserción
		function formatXml($simpleXMLElement)
		{
			$xmlDocument = new DOMDocument('1.0');
			$xmlDocument->preserveWhiteSpace = false;
			$xmlDocument->formatOutput = true;
			$xmlDocument->loadXML($simpleXMLElement->asXML());

			return $xmlDocument->saveXML();
		}?>
	
		
		<?php 
			$emailestudi= "/^[a-z]+[0-9]{3}@(ikasle.ehu.)(eus|es)/";
			$emailprofe="/[a-z]+(.[a-z]+)?@(ehu.)(eus|es)/";
			$file_get = $_FILES['fotoASubir']['name'];
			$temp = $_FILES['fotoASubir']['tmp_name'];
			$extensio= pathinfo($file_get, PATHINFO_EXTENSION);
			$error = 0;
			if($temp != "" && $extensio != "jpeg"&& $extensio != "png" && $extensio != "jpg" && $extensio != "gif"){
				echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Archivo no es una imagen</p>';
			}else{
				$file_to_saved = "../images/".$file_get; //Documents folder, should exist in       your host in there you're going to save the file just uploaded
				move_uploaded_file($temp, $file_to_saved);
				//echo $file_to_saved;
				if($_POST["email"] == null || $_POST["enunc"] == null || $_POST["resco"] == null  || $_POST["resin1"] == null  || $_POST["resin2"] == null  || $_POST["resin3"] == null  || $_POST["difi"] == null  || $_POST["tema"] == null){
					echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Hay que rellenar los campos obligatorios</p>';
				}elseif(!preg_match($emailestudi, $_POST['email']) && !preg_match($emailprofe, $_POST['email']) ){
					echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Formato de email incorrecto</p>';
				}else if (strlen($_POST["enunc"]) <10 ){
					echo '<p style="color:red; font-size:20px; font-weight: bold;">ERROR: Enunciado muy corto</p>';
				}else{
					//Inserción en xml
					$xml = simplexml_load_file('../xml/Questions.xml');
					$pregunta = $xml->addChild('assessmentItem');
					$pregunta->addAttribute('subject', strip_tags($_POST['tema']));
					$pregunta->addAttribute('author', strip_tags($_POST['email']));
					$itembody = $pregunta->addChild('itemBody'); 
					$itembody->addChild('p',$_POST['enunc']);
					$correctResponse = $pregunta->addChild('correctResponse');
					$response = $correctResponse->addChild('response',strip_tags($_POST['resco']));
					$incorrectResponses = $pregunta->addChild('incorrectResponses'); 
					$incorrectResponses->addChild('response', strip_tags($_POST['resin1']));
					$incorrectResponses->addChild('response', strip_tags($_POST['resin2']));
					$incorrectResponses->addChild('response', strip_tags($_POST['resin3']));
					//Insercion identada:
					$xmlContent = formatXml($xml);
					$nuevoxml = new SimpleXMLElement($xmlContent);
					$nuevoxml->asXML('../xml/Questions.xml');
					echo '<p style="color:green; font-size:20px; font-weight: bold;">Pregunta insertada correctamente en el archivo xml</p>';
					
					//insercion en DB
					$link = new mysqli($server, $user, $pass, $basededatos);
					$sql = "INSERT INTO preguntasconimagen(email,enunc,resco,resin1,resin2,resin3,difi,tema,img) values('" . strip_tags($_POST["email"]) . "','" . strip_tags($_POST["enunc"]) . "' ,'" . strip_tags($_POST["resco"]) ."' ,'" . strip_tags($_POST["resin1"]) ."', '" . strip_tags($_POST["resin2"]) ."' , '" . strip_tags($_POST["resin3"])."' , '" .strip_tags($_POST["difi"]) ."' , '" . strip_tags($_POST["tema"]) ."', '".$file_to_saved."' )";
					if (!mysqli_query($link ,$sql))
						{
							die('Error: ' . mysqli_error($link));
						}
					echo '<p style="color:green; font-size:20px; font-weight: bold;">Una respuesta añadida</p>';
					echo '<script>pedirDatos();</script>';
					mysqli_close($link); 
				}				
			}
	}
 ?>
