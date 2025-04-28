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
include ( '../src/FunPerPriNiv/pktbltiposistemacamperequipo.php');

function grabatiposistemacamperequipo($iRegtiposistemacamperequipo,&$flagnuevotiposistemacamperequipo,&$campnomb)
{
	$nuconn = fncconn();
	$result = insrecordtiposistemacamperequipo($iRegtiposistemacamperequipo,$nuconn);
	
	if($result < 0 )
	{
		ob_end_clean();
		$flagnuevotiposistemacamperequipo = 1;
	}
	fncclose($nuconn);
}
$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);

for($i=0; $i<$numposic; $i++)
{
	$iRegtiposistemacamperequipo["tipsiscodigo"]  = $tipsiscod;
	$iRegtiposistemacamperequipo["capeeqcodigo"]  = $valposic[$i];

	grabatiposistemacamperequipo($iRegtiposistemacamperequipo, $flagnuevotiposistemacamperequipo,$campnomb);
}
?>