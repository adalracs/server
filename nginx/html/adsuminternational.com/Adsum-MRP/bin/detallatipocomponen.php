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
if(!$flageditartipocomponen)
	include('../src/FunPerPriNiv/pktblcampo.php');

define(acr, "componen");

if(!empty($sbreg["tipcomcampo"]))
{
	$idcon = fncconn();
	$value = explode(",", $sbreg["tipcomcampo"]);

	foreach ($value as $v)
	{
		$arr_campo = loadrecordcampo($v, $idcon);
		$tipcomcampo[str_replace(acr, "", $arr_campo["campnomb"])] = 1;
	}
	fncclose($idcon);
}
// -------------------------------------------------------------------------
?>