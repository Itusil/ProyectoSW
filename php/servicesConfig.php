<?php
$estado = 0; //1 para la nube
if ($estado ==0){
	$verifypass='http://localhost/LABS/Proyecto1SW/php/VerifyPassWS.php';
	$getQuestion='http://localhost/LABS/Proyecto1SW/php/GetQuestionWS.php';
	$ip = 'check';
	$ip2 = 'check';
}else{
	$verifypass='https://swmikel-iturria.000webhostapp.com/Proyecto1SW/php/VerifyPassWS.php';
	$getQuestion='https://swmikel-iturria.000webhostapp.com/Proyecto1SW/php/GetQuestionWS.php';
	$ip = $_SERVER['HTTP_X_REAL_IP'];
	$ip2 = 'check';

}?>