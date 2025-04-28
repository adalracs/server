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
if(!$flageditartiposistema)
	include('../src/FunPerPriNiv/pktblcampo.php');

define(acr, "sistema");

if(!empty($sbreg["tipsiscampo"]))
{
	$idcon = fncconn();
	$value = explode(",", $sbreg["tipsiscampo"]);

	foreach ($value as $v)
	{
		$arr_campo = loadrecordcampo($v, $idcon);
		$tipsiscampo[str_replace(acr, "", $arr_campo["campnomb"])] = 1;
	}
	fncclose($idcon);
}
// -------------------------------------------------------------------------
?>