<?php
/**
 * Archivo: lib.php
 * Usuario: alesosa
 * Fecha: 30/09/13
 * Hora: 04:42 PM
 * Proyecto: webservice
 */

/** convierto todo lo enviado por POST en variables  */
if(isSet($_POST)){  // convirtiendo valores enviados por post a variables globales del mismo nombre
    $keys_post = array_keys($_POST);
    foreach ($keys_post as $key_post){
        $$key_post = $_POST[$key_post];
        error_log("variable $key_post viene desde $ _POST");
    }
}

/** convierto todo lo enviado por GET en variables  */
if(isSet($_GET)){ // convirtiendo valores enviados por get a variables globales del mismo nombre
    $keys_get = array_keys($_GET);
    foreach ($keys_get as $key_get){
        $$key_get = $_GET[$key_get];
        error_log("variable $key_get viene desde $ _GET");
    }
}

/** convierto todo lo almacenado en las sesiones en variables  */
if(isSet($_SESSION)){ // convirtiendo valores guardados en la sesión a variables globales del mismo nombre
    $keys_sesion = array_keys($_SESSION);
    foreach ($keys_sesion as $key_sesion){
        $$key_sesion = $_SESSION[$key_sesion];
        error_log("variable $key_sesion viene desde $ _SESSION");
    }
}



function CapturarIp(){
    if (isSet($_SERVER)) {
        if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            $proxy  = $_SERVER["REMOTE_ADDR"];
        } elseif (isSet($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
            $ip = getenv( 'HTTP_X_FORWARDED_FOR' );
            $proxy = getenv( 'REMOTE_ADDR' );
        } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
            $ip = getenv( 'HTTP_CLIENT_IP' );
        } else {
            $ip = getenv( 'REMOTE_ADDR' );
        }
    }
    return $ip;
}















?>