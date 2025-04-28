<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabareporotherramie
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegreporotherramie         Arreglo de datos.
$flagnuevoreporotherramie    Bandera de validación
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versión 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo									| Autor 	|
 08082005  Unificación con la función grabareportot	 jcortes
*/

/*include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblreporotherramie.php');
/*include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php'); */

function grabareporotherramie($iRegreporotherramie,&$flagnuevoreporotherramie,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("idreporotherramie",61);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	$nuidtemp = fncnumact(idreporotherramie,$nuconn);
	do
	{
		$nuresult = loadrecordreporotherramie($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegreporotherramie[rephercodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}
	while ($nuresult != e_empty);
	if ($iRegreporotherramie)
	{
		while($elementos = each($iRegreporotherramie))
		{
			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				fncmsgerror(errorCar);
				$flagnuevoreporotherramie = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}
			$validresult =
			consulmetareporotherramie($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flagnuevoreporotherramie = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				unset ($validresult);
				break;
			}
		}
		if($flagerror != 1)
		{
			$result = insrecordreporotherramie($iRegreporotherramie,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoreporotherramie=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(idreporotherramie,$nuidtemp,$nuconn);
				//	No utilice esta parte si va a utilizar la llave primaria como serial
				//fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}
/*
$iRegreporotherramie[rephercodigo] = $rephercodigo;
$iRegreporotherramie[reportcodigo] = $reportcodigo;
$iRegreporotherramie[transhercodigo] = $transhercodigo;
grabareporotherramie($iRegreporotherramie,$flagnuevoreporotherramie,$campnomb);
*/
?>