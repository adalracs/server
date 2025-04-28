<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacomponencamperequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcomponencamperequipo         Arreglo de datos.
Retorno         :
true	= 1
false	= 0
Autor           : lfolaya
Fecha           : 19092006
Historial de modificaciones
| Fecha 	| Motivo				              | Autor 	|
 26-08-2007  Adaptacion de campos personalizados   cbedoya
             a  componente

*/
include ( '../src/FunPerPriNiv/pktblcomponencamperequipo.php');

function grabacomponencamperequipo($iRegcomponcamperequipo)
{
	$nuconn = fncconn();
	$result = insrecordcomponencamperequipo($iRegcomponcamperequipo,$nuconn);
	
	if($result < 0 )
	{
		ob_end_clean();
	}
	fncclose($nuconn);
}

	foreach ($arr_campers as $w)
	{
		$arr_def = explode(":",$w);
		$iRegcomponcamperequipo["componcodigo"]  = $componeqcamprr;
		$iRegcomponcamperequipo["capeeqcodigo"]  = $arr_def[0];
		$iRegcomponcamperequipo["capeeqvalor"]  = $arr_def[1];
		
		grabacomponencamperequipo($iRegcomponcamperequipo);
	}
?>

