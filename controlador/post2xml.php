<?php
/**
 * Archivo: post2xml.php
 * Usuario: alesosa
 * Fecha: 01/10/13
 * Hora: 11:19 AM
 * Proyecto: webservice
 */



$xml = new SimpleXMLElement('<datos/>');
$data = $xml->addChild('dato');
foreach ($_POST as $postElem => $postValue){
    $data->addChild($postElem, $postValue);
}

//Header('Content-type: text/xml');
print($xml->asXML());


















?>