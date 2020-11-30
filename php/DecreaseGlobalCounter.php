<?php	
$usuarios = simplexml_load_file('../xml/UserCounter.xml');
foreach($usuarios->usuario as $usuario)
{
	if($usuario['email'] == $email) {
		$dom=dom_import_simplexml($usuario);
		$dom->parentNode->removeChild($dom);
	}
}
$usuarios->asXml('../xml/UserCounter.xml')
?>


