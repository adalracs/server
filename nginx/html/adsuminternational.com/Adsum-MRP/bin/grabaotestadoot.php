<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaotestadoot
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegotestadoot         Arreglo de datos.
$flagnuevootestadoot    Bandera de validación
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versión 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
30122005	Implementacion			mstroh
*/
include ( '../src/FunPerPriNiv/pktblotestadoot.php');

function grabaotestadoot($iRegotestadoot,&$flagnuevootestadoot,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",43);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordotestadoot($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegotestadoot[otestcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial
	$result = insrecordotestadoot($iRegotestadoot,$nuconn);

	if($result < 0 )
	{
		ob_end_clean();
//		fncmsgerror(errorReg);
		$flagnuevootestadoot=1;
	}
	if($result > 0)
	{
		$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
//		fncmsgerror(grabaEx);
	}
	fncclose($nuconn);
}
$iRegotestadoot[otestcodigo]  = $otestcodigo;
$iRegotestadoot[ordtracodigo] = $codigoot;
$iRegotestadoot[otestacodigo] = $otestacodigo;
$iRegotestadoot[otestorigen]  = $otestacodigo;
$iRegotestadoot[otestfecini]  = date('Y-m-d');
$iRegotestadoot[otesthorini]  = date('H:i');
$iRegotestadoot[otestfecfin]  = $otestfecfin;
$iRegotestadoot[otesthorfin]  = $otesthorfin;
grabaotestadoot($iRegotestadoot,$flagnuevootestadoot,$campnomb);
?>