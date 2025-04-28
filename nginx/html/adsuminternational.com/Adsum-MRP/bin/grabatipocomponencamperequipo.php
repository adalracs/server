<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabatipocomponencamperequipo
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
include ( '../src/FunPerPriNiv/pktbltipocomponencamperequipo.php');

function grabatipocomponencamperequipo($iRegtipocomponencamperequipo,&$flagnuevotipocomponencamperequipo,&$campnomb)
{
	$nuconn = fncconn();
	$result = insrecordtipocomponencamperequipo($iRegtipocomponencamperequipo,$nuconn);
	
	if($result < 0 )
	{
		ob_end_clean();
		$flagnuevotipocomponencamperequipo = 1;
	}
	fncclose($nuconn);
}
$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);

for($i=0; $i<$numposic; $i++)
{
	$iRegtipocomponencamperequipo["tipcomcodigo"]  = $tipcomcod;
	$iRegtipocomponencamperequipo["capeeqcodigo"]  = $valposic[$i];

	grabatipocomponencamperequipo($iRegtipocomponencamperequipo, $flagnuevotipocomponencamperequipo,$campnomb);
}
?>