<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaservicioplanta
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegservicioplanta         Arreglo de datos.
$flagnuevoservicioplanta    Bandera de validación
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versión 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
27122005	Implementacion			mstroh
*/

include ( '../src/FunPerPriNiv/pktblservicioplanta.php');

function grabaservicioplanta($iRegservicioplanta,&$flagnuevoservicioplanta,&$campnomb, $flag_c)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_serplan", 65);
	define("errorReg", 1);
	define("errorCar", 2);
	define("grabaEx", 3);
	define("compinst", 4);
	define("venccomp", 5);
	define("compactu", 6);
	define("fecvalid", 7);
	define("errormail", 8);
	define("editaEx", 9);
	$nuidtemp = fncnumact(id_serplan,$nuconn);
	do
	{
		$nuresult = loadrecordservicioplanta($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegservicioplanta[serplacodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial
	$result = insrecordservicioplanta($iRegservicioplanta,$nuconn);
	if($result < 0 )
	{
		ob_end_clean();
//		fncmsgerror(errorReg);
		$flagnuevoservicioplanta = 1;
	}
	if($result > 0)
	{
		if($flag_c == 1)
		{		
			fncmsgerror(grabaEx);
		}
		$nuresult1 = fncnumprox(id_serplan,$nuidtemp,$nuconn);
	}
	fncclose($nuconn);
}

$iRegservicioplanta[serplacodigo] = $serplacodigo;
$iRegservicioplanta[plantacodigo] = $plantacodigo;
$iRegservicioplanta[servicicodigo] = $servicicodigo;

grabaservicioplanta($iRegservicioplanta,$flagnuevoservicioplanta,$campnomb);

$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);
$flagcount = 0;

for($i=0; $i<$numposic; $i++)
{
	$iRegservicioplanta["serplacodigo"]  = "";
	$iRegservicioplanta["plantacodigo"]  = $plantacode;
	$iRegservicioplanta["servicicodigo"] = $valposic[$i];
	$flagcount++;
	grabaservicioplanta($iRegservicioplanta, $flagnuevoservicioplanta, $campnomb, $flagcount);
}
?> 