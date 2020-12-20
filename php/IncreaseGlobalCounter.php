<?php 
		//Identar inserción
		function formatXml($simpleXMLElement)
		{
			$xmlDocument = new DOMDocument('1.0');
			$xmlDocument->preserveWhiteSpace = false;
			$xmlDocument->formatOutput = true;
			$xmlDocument->loadXML($simpleXMLElement->asXML());

			return $xmlDocument->saveXML();
		}
		//Inserción en xml
		$xml = simplexml_load_file('../xml/UserCounter.xml');
		$usuario = $xml->addChild('usuario');
		$usuario->addAttribute('lastTime',date("Y-m-d H:i:s"));
		$usuario->addAttribute('email',$email);
		//Insercion identada:
		$xmlContent = formatXml($xml);
		$nuevoxml = new SimpleXMLElement($xmlContent);
		$nuevoxml->asXML('../xml/UserCounter.xml');
?>