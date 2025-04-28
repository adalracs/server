<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaoperacio
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegoperacio         Arreglo de datos.
$flagnuevooperacio    Bandera de validaci�n
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
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');

function grabaoperacio($iRegoperacio,&$flagnuevooperacio,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",37);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("errorOper", 34);
	define("errorIng", 35);
	define("errorNombExs",18);

	$nuidtemp = fncnumact(	id,$nuconn);
	do
	{
		$nuresult = loadrecordoperacio($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegoperacio[operaccodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegoperacio)
	{
		$iRegtabla["tablnomb"] = "operacio";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "operacio")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegoperacio))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "operaccodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevooperacio = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevooperacio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaoperacio($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevooperacio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			if($elementos[0] == "tipopecodigo" && $elementos[1] == null) 
			{ 
				$flagnuevooperacio = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			}
			if($elementos[0] == "operacvalor" && $elementos[1] == null) 
			{ 
				$flagnuevooperacio = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			}

//			if($elementos[0] == 'tipopecodigo')
//			{
//				if ($elementos[1] != "")
//				{
//					$sbRegnomb = array($elementos[0], "operacfecha");
//					$sbRegvalu = array($elementos[1], $iRegoperacio["operacfecha"]);
//
//					$validnombre =  fncnombexs('operacio',$iRegoperacio,$sbRegnomb,$sbRegvalu,$nuconn);
//					if ($validnombre == 1)
//					{
//						fncmsgerror(errorNombExs);
//						$flagnuevooperacio = 1;
//						$flagerror = 1;
//						$campnomb[$elementos[0]] = 1;
//						unset ($validnombre);
//					}
//				}
//				else 
//				{
//					$flagnuevooperacio = 1;
//					$flagerror = 1;
//					$campnomb[$elementos[0]] = 1;
//				}
//			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordoperacio($iRegoperacio,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevooperacio=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}
$iRegoperacio[operaccodigo] = $operaccodigo;
$iRegoperacio[tipopecodigo] = $tipopecodigo;
$iRegoperacio[operacvalor] = $operacvalor;
$iRegoperacio[operacfecha] = $operacfecha;
grabaoperacio($iRegoperacio,$flagnuevooperacio,$campnomb);
?> 
