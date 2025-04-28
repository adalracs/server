<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabadisponibilidad
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
    $iRegdisponibilidad         Arreglo de datos.
    $flagnuevodisponibilidad    Bandera de validación
Retorno         :
		true	= 1
		false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versión 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

//include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktbldisponibilidad.php');
include ( '../src/FunGen/buscacaracter.php');

function grabadisponibilidad($iRegdisponibilidad,&$flagnuevodisponibilidad,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",3);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorTipArc",6);
	define("errorTamArc",7);
	define("errorSub",8);
	define("subirEx",9);
	define("errorArcExs",10);
	define("errorArcNoExs",11);
	define("bajarEx",12);
	define("errorRutNull",13);
	define("editaEx",14);
	$nuidtemp = fncnumact(	id,$nuconn);
	do
	{
		$nuresult = loadrecorddisponibilidad($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegdisponibilidad[disponcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if ($iRegdisponibilidad)
	{
		while($elementos = each($iRegdisponibilidad))
	{
			//$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				fncmsgerror(errorCar);
				$flagnuevodisponibilidad = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}
			$validresult = consulmetadisponibilidad($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flagnuevodisponibilidad = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				unset ($validresult);
				break;
			}
		}
		if($flagerror != 1)
		{
			$result = insrecorddisponibilidad($iRegdisponibilidad,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevodisponibilidad=1;
			}
			if($result > 0)
			{
				fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}
$iRegdisponibilidad[disponcodigo] = $disponcodigo;
$iRegdisponibilidad[disponnombre] = $disponnombre;
$iRegdisponibilidad[disponresumen] = $disponresumen;
$iRegdisponibilidad[disponimagen] = $irutaarc.$inombarc;
$iRegdisponibilidad[dispondescri] = $dispondescri;
grabadisponibilidad($iRegdisponibilidad,$flagnuevodisponibilidad,$campnomb);
?>
