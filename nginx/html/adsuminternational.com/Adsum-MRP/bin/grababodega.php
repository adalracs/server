<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grababodega
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegbodega         Arreglo de datos.
$flagnuevobodega    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblbodega.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grababodega($iRegbodega,&$flagnuevobodega,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",10);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorIng",35);

//	$nuidtemp = fncnumact(id,$nuconn);
//	do
//	{
//		$nuresult = loadrecordbodega($nuidtemp,$nuconn);
//		if($nuresult == e_empty)
//		{
//			$iRegbodega[bodegacodigo] = $nuidtemp;
//		}
//		$nuidtemp ++;
//	}while ($nuresult != e_empty);


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegbodega)
	{
		$iRegtabla["tablnomb"] = "bodega";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "bodega")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegbodega_b = $iRegbodega;

		while($elementos = each($iRegbodega))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
//				if($elementos[0] != "bodegacodigo")
//				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevobodega = 1;
								$flagerror = 1;
							}
						}
					}
//				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevobodega = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
			$validresult = consulmetabodega($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevobodega = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0]=='bodeganombre' && $elementos[1])
			{

				$validnombre =  fncnombexs('bodega',$iRegbodega_b,$elementos[0],$elementos[1],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevobodega = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordbodega($iRegbodega,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevobodega=1;
			}
			if($result > 0)
			{
//				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iRegbodega[bodegacodigo] = $bodegacodigo;
$iRegbodega[bodeganombre] = $bodeganombre;
$iRegbodega[bodegaencargado] = $usuacodigo;
$iRegbodega[bodegaubicac] = $bodegaubicac;
$iRegbodega[bodegacapaci] = $bodegacapaci;
$iRegbodega[bodeganota] = $bodeganota;
//$iRegbodega[ciudadcodigo] = $ciudadcodigo;
$iRegbodega[cencoscodigo] = $cencoscodigo;
$iRegbodega[bodegatipo] = $bodegatipo;

grababodega($iRegbodega,$flagnuevobodega,$campnomb);
?> 
