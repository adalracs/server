<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
*  Descripcion: realiza una consulta que devuelve los datos
* 				de un componente
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
include('../src/FunPerPriNiv/pktblcomponen.php');

if (isset($_GET) && (count($_GET) > 0))
{
	if (isset($_GET['componcodigo']))
	{
		$idcon = fncconn();
		$arrcomponen = loadrecordcomponen($componcodigo, $idcon);
		$strResponse = "c|".$arrcomponen['componcodigo'].",".$arrcomponen['componnombre'];
		fncclose($idcon);

		echo $strResponse;
	}
}
?>