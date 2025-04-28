<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaitemequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegitemequipo         Arreglo de datos.
$flagnuevoitemequipo    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 20062006
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
*/
function grabaitemequipo($iRegitemequipo, &$flagnuevoitemequipo, &$campnomb, $flag_c)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_iteequ", 91);
	define("errorReg", 1);
	define("errorCar", 2);
	define("grabaEx", 3);
	define("compinst", 4);
	define("venccomp", 5);
	define("compactu", 6);
	define("fecvalid", 7);
	define("errormail", 8);
	define("editaEx", 9);

	$nuidtemp = fncnumact(id_iteequ,$nuconn);
	do
	{
		$nuresult = loadrecorditemequipo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegitemequipo[iteequcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	$result = insrecorditemequipo($iRegitemequipo,$nuconn);
	if($result < 0 )
	{
		ob_end_clean();
		//		fncmsgerror(errorReg);
		$flagnuevoitemequipo = 1;
	}
	if($result > 0)
	{
		if($flag_c == 1)
		{
			fncmsgerror(grabaEx);
		}
		$nuresult1 = fncnumprox(id_iteequ,$nuidtemp,$nuconn);
	}
	fncclose($nuconn);
}
$iRegitemequipo["iteequcodigo"]  = "";
$iRegitemequipo["equipocodigo"]  = $equipocodigo;
$iRegitemequipo["itemcodigo"]    = $itemcodigo;

grabaitemequipo($iRegitemequipo, $flagnuevoitemequipo, $campnomb, $flagcount);
?>