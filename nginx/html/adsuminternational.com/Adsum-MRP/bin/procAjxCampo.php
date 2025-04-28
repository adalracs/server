<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Funcion:
* Argumentos:
* Descripcion:
*
* Fecha:
* Autor:
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
*
*/

include('../src/FunPerPriNiv/pktbltabla.php');
include('../src/FunPerPriNiv/pktblcampo.php');
include('../src/FunPerSecNiv/fncnumreg.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunPerSecNiv/fncconn.php');

if (isset($_GET) && (count($_GET) > 0))
{
	$iRegcampo['tablcodi'] = $_GET['tablcodi'];

	$idcon = fncconn();
	$idrescampo = dinamicscancampo($iRegcampo, $idcon);

	if (!is_numeric($idrescampo))
	{
		$numreg = fncnumreg($idrescampo);

		for ($i=0; $i<$numreg; $i++)
		{
			$arrcampo = fncfetch($idrescampo, $i);

			if ($arrcampo['tablcodi'] == $iRegcampo['tablcodi'])
			{
				$str .= $arrcampo['campdesc']."|".$arrcampo['campcodi'].",";
			}
		}
	}
	echo substr($str, 0, strlen($str)-1);
}
?>