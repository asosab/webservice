<?php
/**
 * Archivo: xml.modelo.php
 * Usuario: alesosa
 * Fecha: 30/09/13
 * Hora: 06:05 PM
 * Proyecto: webservice
 */

$xmlstr = <<<XML
<?xml version='1.0'?>
<datos url="http://150.185.8.76/~alejandro/webservice/" puerto="80">
 <dato>
  <rif>$rif</rif>
  <razon_social>$razon_social</razon_social>
 </dato>
</datos>
XML;
