<?php
//Sacado como hacer desde aqui: https://shareurcodes.com/blog/create%20a%20soap%20web%20service%20in%20php%20using%20nusoap
error_reporting(0);
//incluimos la clase nusoap.php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
//$ns="http://localhost/LABS/Proyecto1SW/php/";

$server = new soap_server;
//$server->configureWSDL('VerifyPassWS',$ns);
$server->configureWSDL('VerifyPassWS',"urn:soapdemo");
//$server->wsdl->schemaTargetNamespace=$ns;


//registramos la función que vamos a implementar
$server->register('comprobarContrasena',
array('x'=>'xsd:string', 'y'=>'xsd:int'),
array('z'=>'xsd:string'));
//$ns);

//implementamos la función
function comprobarContrasena ($x, $y){
	if ($y != 1010){
		return "SIN SERVICIO";
	}else{
		$fichero = file_get_contents('../txt/toppasswords.txt');
		$valido="INVALIDA";
		if(strpos($fichero,$x) === false){
				$valido="VALIDA";
		}
		return $valido;
	}
}
//llamamos al método service de la clase nusoap antes obtenemos los valores de los parámetros
// if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
// $server->service($HTTP_RAW_POST_DATA);
$server->service(file_get_contents("php://input"));
?>