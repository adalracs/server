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
include ( '../src/FunPerPriNiv/pktblequipocamperequipo.php');

function grabaequipocamperequipo($iRegequipocamperequipo)
{
	$nuconn = fncconn();
	$result = insrecordequipocamperequipo($iRegequipocamperequipo,$nuconn);
	
	if($result < 0 )
	{
		ob_end_clean();
		//$flagnuevoequipocamperequipo = 1;
	}
	fncclose($nuconn);
}

	foreach ($arr_campers as $w)
	{
		$arr_def = explode(":-:",$w);
		$iRegequipocamperequipo["equipocodigo"]  = $equipocod;
		$iRegequipocamperequipo["capeeqcodigo"]  = $arr_def[0];
		$iRegequipocamperequipo["capeeqvalor"]  = $arr_def[1];
		
		grabaequipocamperequipo($iRegequipocamperequipo);
	}
?>

