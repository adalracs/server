<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabareporte
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
    $iRegreporte         Arreglo de datos.
    $flagnuevoreporte    Bandera de validacion
Retorno         :
		true	= 1
		false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunGen/fncprintreporttipotrab.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblreporte.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include('../src/FunPerPriNiv/pktbltabla.php');

function grabareportetipotrab($iRegreporte, &$flagnuevoreporte, &$campnomb, $codigo)
{
	/*define("id",90);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);

	$nuconn = fncconn();
	$nuidtemp = fncnumact(id,$nuconn);

	do
	{
		$nuresult = loadrecordreporte($nuidtemp, $nuconn);

		if($nuresult == e_empty)
		{
			$iRegreporte['reportcodigo'] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
*/
	fncprintreporttipotrab($iRegreporte, $codigo, $nuconn);
	$reportselect = $iRegreporte['reportselect'];
}

?>