<?php
/**
 * Archivo: listar_modelos.php
 * Usuario: alesosa
 * Fecha: 01/10/13
 * Hora: 05:41 PM
 * Proyecto: webservice
 */


$arr = array();

if($gestor=opendir('./modelo/xml/'))
{
    while (($archivo=readdir($gestor))!==false)
    {
        if ((!is_file($archivo))and($archivo!='.')and($archivo!='..'))
            $arr[]=$archivo;
    }
    closedir($gestor);
}

echo json_encode($arr);


















?>