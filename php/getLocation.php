<?php // set IP address and API access key 
$access_key = '8249e3ea791e655e29fb052c47a228e8';
include "servicesConfig.php";

//PARA LOS DATOS DEL CLIENTE
// Initialize CURL:
$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$api_result = json_decode($json, true);

$ip =$api_result['ip'];
$pais =$api_result['country_name'];
$region =$api_result['region_name'];
$ciudad =$api_result['city'];
$cp=$api_result['zip'];
$latitud=$api_result['latitude'];
$longitud=$api_result['longitude'];

//PARA LOS DATOS DEL SERVIDOR
$ch2 = curl_init('http://api.ipstack.com/'.$ip2.'?access_key='.$access_key.'');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json2 = curl_exec($ch2);
curl_close($ch2);

// Decode JSON response:
$api_result2 = json_decode($json2, true);

// Output the "capital" object inside "location"
$ip2 =$api_result2['ip'];
$pais2 =$api_result2['country_name'];
$region2 =$api_result2['region_name'];
$ciudad2 =$api_result2['city'];
$cp2=$api_result2['zip'];
$latitud2=$api_result2['latitude'];
$longitud2=$api_result2['longitude'];


echo "<table border=1>";
echo "<tr><th></th><th>Cliente</th><th>Servidor</th></tr>";
echo "<tr><td>Dirección ip:</td>";
echo "<td>$ip</td>";
echo "<td>$ip2</td></tr>";
echo "<tr><td>Pais:</td>";
echo "<td>$pais</td>";
echo "<td>$pais2</td></tr>";
echo "<tr><td>Region:</td>";
echo "<td>$region</td>";
echo "<td>$region2</td></tr>";
echo "<tr><td>Ciudad:</td>";
echo "<td>$ciudad</td>";
echo "<td>$ciudad2</td></tr>";
echo "<tr><td>Codigo Postal:</td>";
echo "<td>$cp</td>";
echo "<td>$cp2</td></tr>";
echo "</table>";

?>