<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaunimedida
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegunimedida         Arreglo de datos.
$flagnuevounimedida    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblunimedida.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabaunimedida($iRegunimedida,&$flagnuevounimedida,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",49);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorNombExs",18);
	define("errorAcrExs",21);
	define("errorIng",35);
	
//	$nuidtemp = fncnumact(	id,$nuconn);
//	do
//	{
//		$nuresult = loadrecordunimedida($nuidtemp,$nuconn);
//		if($nuresult == e_empty)
//		{
//			$iRegunimedida[unidadcodigo] = $nuidtemp;
//		}
//		$nuidtemp ++;
//	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegunimedida)
	{
		$iRegtabla["tablnomb"] = "unimedida";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "unimedida")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegunimedida_b = $iRegunimedida;
		
		while($elementos = each($iRegunimedida))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "unidadcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevounimedida = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevounimedida = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaunimedida($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevounimedida = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='unidadnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('unimedida',$iRegunimedida_b,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevounimedida = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flagnuevounimedida = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			
			if($elementos[0]=='unidadacra')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('unimedida',$iRegunimedida_b,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorAcrExs);
						$flagnuevounimedida = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flagnuevounimedida = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = insrecordunimedida($iRegunimedida,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevounimedida=1;
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
$iRegunimedida[unidadcodigo] = $unidadcodigo;
$iRegunimedida[unidadnombre] = $unidadnombre;
$iRegunimedida[unidadacra] = $unidadacra;
$iRegunimedida[unidaddescri] = $unidaddescri;
grabaunimedida($iRegunimedida,$flagnuevounimedida,$campnomb);
?> 
