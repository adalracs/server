<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaherramieproveedo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegherramieproveedo         Arreglo de datos.
$flagnuevoherramieproveedo    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
24012006	Implementacion			mstroh
*/
include ( '../src/FunPerPriNiv/pktblherramieproveedo.php');

function grabaherramieproveedo($iRegherramieproveedo, &$flagnuevoherramieproveedo, &$campnomb, $flag_c)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_herprove", 70);
	define("errorReg", 1);
	define("errorCar", 2);
	define("grabaEx", 3);
	define("compinst", 4);
	define("venccomp", 5);
	define("compactu", 6);
	define("fecvalid", 7);
	define("errormail", 8);
	define("editaEx", 9);
	
	$nuidtemp = fncnumact(id_herprove,$nuconn);
	do
	{
		$nuresult = loadrecordherramieproveedo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegherramieproveedo[herprocodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	$result = insrecordherramieproveedo($iRegherramieproveedo,$nuconn);
	if($result < 0 )
	{
		ob_end_clean();
//		fncmsgerror(errorReg);
		$flagnuevoherramieproveedo = 1;
	}
	if($result > 0)
	{
//		if($flag_c == 1)
//		{		
//			fncmsgerror(grabaEx);
//		}
		$nuresult1 = fncnumprox(id_herprove,$nuidtemp,$nuconn);
	}
	fncclose($nuconn);
}
$valposic  = explode(",", $arreglo_aux);
$numposic  = count($valposic);
$flagcount = 0;

for($i=0; $i<$numposic; $i++)
{
	$iRegherramieproveedo["herprocodigo"]  = "";
	$iRegherramieproveedo["proveecodigo"]  = $valposic[$i];
	$iRegherramieproveedo["herramcodigo"]  = $herramcodigo;
	$flagcount++;
	grabaherramieproveedo($iRegherramieproveedo, $flagnuevoherramieproveedo, $campnomb, $flagcount);
}
?>