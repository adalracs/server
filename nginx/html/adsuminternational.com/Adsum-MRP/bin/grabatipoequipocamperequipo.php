<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabatipoequipocamperequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegtipoequipocamperequipo         Arreglo de datos.
$flagnuevotipoequipocamperequipo    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : lfolaya
Fecha           : 19092006
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
*/
include ( '../src/FunPerPriNiv/pktbltipoequipocamperequipo.php');

function grabatipoequipocamperequipo($iRegtipoequipocamperequipo,&$flagnuevotipoequipocamperequipo,&$campnomb)
{
	$nuconn = fncconn();
	$result = insrecordtipoequipocamperequipo($iRegtipoequipocamperequipo,$nuconn);
	
	if($result < 0 )
	{
		ob_end_clean();
		$flagnuevotipoequipocamperequipo = 1;
	}
	fncclose($nuconn);
}
$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);

for($i=0; $i<$numposic; $i++)
{
	$iRegtipoequipocamperequipo["tipequcodigo"]  = $tipequcod;
	$iRegtipoequipocamperequipo["capeeqcodigo"]  = $valposic[$i];

	grabatipoequipocamperequipo($iRegtipoequipocamperequipo, $flagnuevotipoequipocamperequipo,$campnomb);
}
?>