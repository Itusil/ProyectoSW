<?php
//incluimos la clase nusoap.php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//creamos el objeto de tipo soapclient.
//http://www.mydomain.com/server.php se refiere a la url
//donde se encuentra el servicio SOAP que vamos a utilizar.
//$soapclient = new nusoap_client( 'http://localhost/LABS/Proyecto1SW/php/VerifyPassWS.php?wsdl ',true);
//OJO! EL TIO NO PONE LO DE ?wsldl
include "servicesConfig.php";
$soapclient = new nusoap_client($verifypass);



//Llamamos la función que habíamos implementado en el Web Service
//e imprimimos lo que nos devuelve
if (isset($_GET['pass'])){
	$resultado = $soapclient->call('comprobarContrasena',array( 'x'=>$_GET['pass'], 'y'=>$_GET['codigo']));
echo $resultado;
}
?>