<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaequipocamperequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegequipocamperequipo         Arreglo de datos.
$flagnuevoequipocamperequipo    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : lfolaya
Fecha           : 19092006
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
*/
include ( '../src/FunPerPriNiv/pktblcomponencamperequipo.php');

function grabacomponcamperequipo($iRegcomponcamperequipo)
{
	$nuconn = fncconn();
	$result = insrecordcomponencamperequipo($iRegcomponcamperequipo,$nuconn);
	
	if($result < 0 )
	{
		ob_end_clean();
		//$flagnuevoequipocamperequipo = 1;
	}
	fncclose($nuconn);
}
if($arr_campers)
{
	$nuconn = fncconn();
	$resultDel = delrecordcomponencamperequipoAll($componcodigo,$nuconn);
	fncclose($nuconn);
	foreach ($arr_campers as $w)
	{
		$arr_def = explode(":",$w);
		$iRegcomponcamperequipo["componcodigo"]  = $componcodigo;
		$iRegcomponcamperequipo["capeeqcodigo"]  = $arr_def[0];
		$iRegcomponcamperequipo["capeeqvalor"]  = $arr_def[1];
		
		grabacomponcamperequipo($iRegcomponcamperequipo);
	}
}
?>

