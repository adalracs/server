<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabatipoequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegtipoequipo         Arreglo de datos.
$flagnuevotipoequipo    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunPerPriNiv/pktbltipocomponen.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include( '../src/FunGen/fncnombexs.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');

function grabatipocomponen($iRegtipocomponen, &$flagnuevotipocomponen, &$campnomb, &$tipcomcod)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",96);
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
	define("errorIng",35);

	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordtipocomponen($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegtipocomponen[tipcomcodigo] = $nuidtemp;
			$tipcomcod = $iRegtipocomponen[tipcomcodigo];
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if($iRegtipocomponen)
	{
		$iRegtabla["tablnomb"] = "tipocomponen";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);

			if($sbregtabla[tablnomb] == "tipocomponen")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegtipocomponen))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "tipcomcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevotipocomponen= 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevotipocomponen = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetatipocomponen($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevotipocomponen = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
/*
			if(($elementos[0] == 'tipcomnombre') || ($elementos[0] == 'tipcomacroni'))
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('tipocomponen', $iRegtipocomponen, $elementos[0], $elementos[1], $nuconn);

					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevotipocomponen= 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevotipocomponen = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			*/
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = insrecordtipocomponen($iRegtipocomponen,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevotipocomponen=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
				fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}
$iRegtipocomponen[tipcomcodigo] = $tipcomcodigo;
$iRegtipocomponen[tipcomnombre] = $tipcomnombre;
$iRegtipocomponen[tipcomdescri] = $tipcomdescri;
$iRegtipocomponen[tipcomcampo]  = $tipcomcampo;
$iRegtipocomponen[tipcomacroni] = $tipcomacroni;

grabatipocomponen($iRegtipocomponen,$flagnuevotipoequipo,$campnomb,$tipcomcod);

if(!$flagnuevotipocomponen)
{
	if($arreglo_aux)
	{
		include('grabatipocomponencamperequipo.php');
		unset($arreglo_aux);
	}
}
?>