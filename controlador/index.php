<?php
/**
 * Archivo: index.php
 * Usuario: alesosa
 * Fecha: 30/09/13
 * Hora: 04:52 PM
 * Proyecto: webservice
 */

include_once("config.php");
include_once("lib.php");
if ($_SERVER['PHP_SELF'] !== $path_inicio."index.php") {exit;}


/** "a" es un parámetro del encabezado,
 * define acciones especiales aparte de
 * sólo escuchar peticiones como servidor
 */
switch ($a) {
    case "lm":
        include_once("listar_modelos.php");
        break;
    case "xml":
        include_once("modelo/xml.salida.php");
        break;
    case "cp":
        include_once("curlpost.php");
        break;
    case "p2x":
        include_once("post2xml.php");
        break;
    case "t":
        include_once("test.php");
        break;
    case "c":
        include_once("cliente.php");
        break;
    default:
        include_once("servidor.php");
        break;
}
?>