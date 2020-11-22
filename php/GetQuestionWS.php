<?php 
    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
$server = new soap_server();
$server->configureWSDL('WSCourse', 'urn:WSCourse');

// definimos el tipo complejo (arreglo asociativo, ='struct') de detalles de curso

$server->wsdl->addComplexType(
'questiondetails',
'complexType',
'struct',
'all',
'',
array(
	'autor' => array('name' => 'autor', 'type' => 'xsd:string'),
	'enunc' => array('name' => 'enunc', 'type' => 'xsd:string'),
	'resco' => array('name' => 'resco', 'type' => 'xsd:string')
)
);


$server->register('getPregunta',           // nombre método
array('id' => 'xsd:int'),            //  parametros entrantes al servicio
array('return' => 'tns:questiondetails'),          // valor(es) retornado(s)
'urn:WSCourse',                                            // namespace (espacio de nombre)
'urn:WSCourse#getPregunta',         // acción SOAP
'rpc',                                                                 // estílo
'encoded',                                                       // tipo de uso
'Devuelve los datos de la pregunta'    // documentación
);

function getPregunta($x){
	include '../php/DbConfig.php';
	$link = new mysqli($server, $user, $pass, $basededatos);
	$sql = "SELECT * FROM preguntasconimagen WHERE preguntasconimagen.numpre='$x'";
	$pregunta = mysqli_query($link ,$sql);
	if (mysqli_num_rows($pregunta) == 0){ //Caso id no existe
		$res = array(
                'autor'=>'',
                'enunc'=>'',
                'resco'=>'',
            );
		return $res;
	}else{
		$row  = mysqli_fetch_array($pregunta);
		$res = array(
                'autor'=>$row["email"],
                'enunc'=>$row["enunc"],
                'resco'=>$row["resco"],
            );
		return $res;
		}	
	mysqli_close($link); 
}

$server->service(file_get_contents("php://input"));



?>