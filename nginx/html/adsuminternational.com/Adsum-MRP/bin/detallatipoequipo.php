<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Funcion:
* Argumentos:
* Descripcion:
*
* Fecha: 15022006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
*
*/
if(!$flageditartipoequipo)
	include('../src/FunPerPriNiv/pktblcampo.php');

define(acr, "equipo");

if(!empty($sbreg["tipequcampo"]))
{
	$idcon = fncconn();
	$value = explode(",", $sbreg["tipequcampo"]);

	foreach ($value as $v)
	{
		$arr_campo = loadrecordcampo($v, $idcon);
		$tipequcampo[str_replace(acr, "", $arr_campo["campnomb"])] = 1;
	}
	fncclose($idcon);
}
// -------------------------------------------------------------------------
?>