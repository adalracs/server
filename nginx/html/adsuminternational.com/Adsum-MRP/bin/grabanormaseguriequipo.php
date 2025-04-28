<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabanormaseguriequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegservicioplanta         Arreglo de datos.
$flagnuevoservicioplanta    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
27122005	Implementacion			mstroh
*/
include ( '../src/FunPerPriNiv/pktblnormaseguriequipo.php');

function grabanormaseguriequipo($iRegnormaseguriequipo,&$flagnuevonormaseguriequipo,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_1", 89);
	define("errorReg", 1);
	define("errorCar", 2);
	define("grabaEx", 3);
	define("compinst", 4);
	define("venccomp", 5);
	define("compactu", 6);
	define("fecvalid", 7);
	define("errormail", 8);
	define("editaEx", 9);
	$nuidtemp = fncnumact(id_1,$nuconn);
	do
	{
		$nuresult = loadrecordnormaseguriequipo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegnormaseguriequipo[nosequcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial
	$result = insrecordnormaseguriequipo($iRegnormaseguriequipo,$nuconn);
	
	if($result < 0 )
	{
		ob_end_clean();
		//		fncmsgerror(errorReg);
		$flagnuevonormaseguriequipo = 1;
	}
	if($result > 0)
	{
		$nuresult1 = fncnumprox(id_1,$nuidtemp,$nuconn);
	}
	fncclose($nuconn);
}

$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);

for($i=0; $i<$numposic; $i++)
{
	$iRegnormaseguriequipo["nosequcodigo"]  = "";
	$iRegnormaseguriequipo["equipocodigo"]  = $equipocod;
	$iRegnormaseguriequipo["norsegcodigo"]  = $valposic[$i];

	grabanormaseguriequipo($iRegnormaseguriequipo, $flagnuevonormaseguriequipo,$campnomb);
}
?>