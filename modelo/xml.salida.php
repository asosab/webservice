<?php
/*se pueden editar los datos en este espacio*/

$modelo = isSet($modelo)?$modelo:"INCES";

include "xml/$modelo/xml.datos.php"; // Cargo el modelo de los datos a incluir en el xml
include "xml/$modelo/xml.modelo.php"; // Cargo el modelo xml con datos ya incluidos
$xmlstr = trim($xmlstr);
echo $xmlstr;
?>