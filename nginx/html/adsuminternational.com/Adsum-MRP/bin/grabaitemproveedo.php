<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaitemproveedo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegitemproveedo         Arreglo de datos.
$flagnuevoitemproveedo    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblitemproveedo.php');

function grabaitemproveedo($iRegitemproveedo, &$flagnuevoitemproveedo, &$campnomb, $flag_c)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_itprove", 79);
	define("errorReg", 1);
	define("errorCar", 2);
	define("grabaEx", 3);
	define("compinst", 4);
	define("venccomp", 5);
	define("compactu", 6);
	define("fecvalid", 7);
	define("errormail", 8);
	define("editaEx", 9);
	
	$nuidtemp = fncnumact(id_itprove,$nuconn);
	do
	{
		$nuresult = loadrecorditemproveedo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegitemproveedo[iteprocodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	$result = insrecorditemproveedo($iRegitemproveedo,$nuconn);
	if($result < 0 )
	{
		ob_end_clean();
//		fncmsgerror(errorReg);
		$flagnuevoitemproveedo = 1;
	}
	if($result > 0)
	{
//		if($flag_c == 1)
//		{		
//			fncmsgerror(grabaEx);
//		}
		$nuresult1 = fncnumprox(id_itprove,$nuidtemp,$nuconn);
	}
	fncclose($nuconn);
}

$valposic  = explode(",", $proveedor);
$numposic  = count($valposic);
$flagcount = 0;

for($i=0; $i<$numposic; $i++)
{
	$iRegitemproveedo["iteprocodigo"]  = "";
	$iRegitemproveedo["proveecodigo"]  = $valposic[$i];
	$iRegitemproveedo["itemcodigo"]    = $itemcodigo;
	$flagcount++;
	grabaitemproveedo($iRegitemproveedo, $flagnuevoitemproveedo, $campnomb, $flagcount);
}