<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaitemtareot
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegitemtareot         Arreglo de datos.
$flagnuevoitemtareot    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

//include ( '../src/FunGen/fncnumprox.php');
//include ( '../src/FunGen/fncnumact.php');
//include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblitemtareot.php');
//include ( '../src/FunGen/buscacaracter.php');
//include ( '../src/FunGen/fncmsgerror.php');

function grabaitemtareot($iRegitemtareot,&$flagnuevoitemtareot,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_4",54);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	$nuidtemp = fncnumact(id_4,$nuconn);
	do
	{
		$nuresult = loadrecorditemtareot($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegitemtareot[itemtarecodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if ($iRegitemtareot)
	{
		$result = insrecorditemtareot($iRegitemtareot,$nuconn);
		if($result < 0 )
		{
			ob_end_clean();
			fncmsgerror(errorReg);
			$flagnuevoitemtareot=1;
		}
		if($result > 0)
		{
			$nuresult1 = fncnumprox(id_4,$nuidtemp,$nuconn);
			//fncmsgerror(grabaEx);
		}
		fncclose($nuconn);
	}
}
?> 
