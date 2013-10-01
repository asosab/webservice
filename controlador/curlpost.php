<?php
if(!isset($xmlstr)){die("Este archivo no puede ser llamado directamente");}
/*
  Este archivo recibe las siguientes variables para trabajar:
    $xmlstr la cadena que contiene el xml
    $url la url a donde se envía el xml por post
    $puerto el puerto a donde se envía el archivo
*/
$data = $xmlstr;
$curlerror = "";
$puerto = isSet($puerto)?$puerto:4443;

$tuCurl = curl_init();
curl_setopt($tuCurl, CURLOPT_URL, $url);
curl_setopt($tuCurl, CURLOPT_PORT , $puerto);
curl_setopt($tuCurl, CURLOPT_VERBOSE, 0);
curl_setopt($tuCurl, CURLOPT_HEADER, 0);
curl_setopt($tuCurl, CURLOPT_SSLVERSION, 3);
//certificado ****************************************************
curl_setopt($tuCurl, CURLOPT_SSLCERT, getcwd() . "/cert/servidor_certificado.pem");
curl_setopt($tuCurl, CURLOPT_SSLKEY, getcwd() . "/cert/servidor_llave.pem");
curl_setopt($tuCurl, CURLOPT_CAINFO, getcwd() . "/cert/ca.pem");
//**************************************************************/*
curl_setopt($tuCurl, CURLOPT_POST, 1);
curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $data);
curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml", "Content-length: ".strlen($data)));

$respuesta = curl_exec($tuCurl);
if(!curl_errno($tuCurl)){
  $info = curl_getinfo($tuCurl);
  echo "<b>Envio exitoso.</b> A tomado " . $info['total_time'] . " segundos enviar el xml<br />\n";
  echo "Respuesta del servidor remoto: -->$respuesta<--<br />\n";
} else {
  $curlerror = curl_error($tuCurl);
  echo 'Curl error: "' . $curlerror . "\"<br />\n";
}
curl_close($tuCurl);
?>
