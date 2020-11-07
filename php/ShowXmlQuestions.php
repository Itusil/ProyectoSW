<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
<meta charset="utf-8">
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	<?php	
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
	?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
