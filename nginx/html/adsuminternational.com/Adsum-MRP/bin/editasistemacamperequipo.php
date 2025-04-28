<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabasistemcamperequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegsistemacamperequipo         Arreglo de datos.

Retorno         :
true	= 1
false	= 0
Autor           : lfolaya
Fecha           : 19092006
Historial de modificaciones
| Fecha 	| Motivo									| Autor 	|
 07-09-2007  Adaptación de campos personalizados		 cbedoya
*/
include ( '../src/FunPerPriNiv/pktblsistemacamperequipo.php');

function grabasistemcamperequipo($iRegsistemacamperequipo)
{
	$nuconn = fncconn();
	$result = insrecordsistemacamperequipo($iRegsistemacamperequipo,$nuconn);
	
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
	$resultDel = delrecordsistemacamperequipoAll($sistemcodigo,$nuconn);
	fncclose($nuconn);
	foreach ($arr_campers as $w)
	{
		$arr_def = explode(":",$w);
		$iRegsistemacamperequipo["sistemcodigo"]  = $sistemcodigo;
		$iRegsistemacamperequipo["capeeqcodigo"]  = $arr_def[0];
		$iRegsistemacamperequipo["capeeqvalor"]  = $arr_def[1];
		
		grabasistemcamperequipo($iRegsistemacamperequipo);
	}
}
?>

