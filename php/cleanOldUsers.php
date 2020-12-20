<?php	
$usuarios = simplexml_load_file('../xml/UserCounter.xml');
$num = 0;
foreach($usuarios->usuario as $usuario)
{
	$userLastTime = new DateTime($usuario['lastTime']);
	$diferenciaDeTiempo = $userLastTime->diff(new DateTime(date("Y-m-d H:i:s")));
	
	$minutes = $diferenciaDeTiempo->days * 24 * 60;
	$minutes += $diferenciaDeTiempo->h * 60;
	$minutes += $diferenciaDeTiempo->i; //Sacamos el total de minutos del usuario actual
	
	if($minutes > 5) {
		$emailimp =  $usuario['email'];
		$usuario->addAttribute('borrar','si'); //Marcamos al usuario para borrado, ya que lleva 5 minutos inactivo
	}
}
$usuarios->asXml('../xml/UserCounter.xml'); //Guardados los cambios, con los que han sido seleccionados para borrado


//Borramos los usuarios marcados para borrar
$usuarios = simplexml_load_file('../xml/UserCounter.xml');
foreach ($usuarios->xpath("//usuario[@borrar='si']") as $usuario)//Esto buscara los usuarios marcados para borrar
{
	unset($usuario[0]);//Borramos el usuario marcado
}	
$usuarios->asXml('../xml/UserCounter.xml');
?>