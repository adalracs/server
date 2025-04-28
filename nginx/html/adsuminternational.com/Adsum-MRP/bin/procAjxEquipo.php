<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
*  Descripcion: realiza una consulta que devuelve los datos
* 				de un equipo
*
* Fecha: 28092006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
*
*/

include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerPriNiv/pktblequipo.php');

if (isset($_GET) && (count($_GET) > 0))
{
	if (isset($_GET['equipocodigo']))
	{
		$idcon = fncconn();
		$arrequipo = loadrecordequipo($equipocodigo, $idcon);
		$strResponse = "e|".$arrequipo['equipocodigo'].",".$arrequipo['equiponombre'];
		fncclose($idcon);

		echo $strResponse;
	}
}
?>