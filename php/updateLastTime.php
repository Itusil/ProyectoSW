<?php	
$usuarios = simplexml_load_file('../xml/UserCounter.xml');
foreach($usuarios->usuario as $usuario)
{
	if($usuario['email'] == $_SESSION['email']) {
		$usuario['lastTime'] = date("Y-m-d H:i:s");
	}
}
$usuarios->asXml('../xml/UserCounter.xml')
?>