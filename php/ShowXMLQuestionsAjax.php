<?php session_start();?>
<?php	
	if(!isset($_SESSION['tipo']) || ($_SESSION['tipo']!="profe" && $_SESSION['tipo']!="estu")){
		echo "<script> alert('No deberias estar aqui...');window.location.href = 'Layout.php';</script>"; 
	}else{
	$preguntas = simplexml_load_file('../xml/Questions.xml');
		echo "<table border=1>"; 
		echo "<tr>";
		echo "<th>Autor</th>";
		echo "<th>Enunciado</th>";
		echo "<th>Resp. correcta</th>";
		echo "</tr>";
	foreach ($preguntas->xpath('//assessmentItem') as $pregunta)
	{
		$autor = $pregunta['author'];
		echo "<tr>";
		echo "<td>$autor</td>";
		$itemBody = $pregunta->itemBody;
		echo "<td>$itemBody->p</td>";
		$correctResponse = $pregunta->correctResponse;
		echo "<td>$correctResponse->response</td>";
		echo "</tr>";
		}
	echo "</table>";
	}
	?>