<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaplanta
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegplanta         Arreglo de datos.
$flagnuevoplanta    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabaplanta($iRegplanta,&$flagnuevoplanta,&$campnomb,&$flagerror)
{
	$nuconn = fncconn();
	$flagerror = 0;
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",1);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("errorNombExs",18);
	define("errorValneg",23);
	define("errorIng",35);

	$nuidtemp = fncnumact(	id,$nuconn);
	do
	{
		$nuresult = loadrecordplanta($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegplanta[plantacodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegplanta)
	{
		$plantacode = $iRegplanta["plantacodigo"];
		
		$iRegtabla["tablnomb"] = "planta";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "planta")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegplanta))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "plantacodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoplanta = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoplanta = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaplanta($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoplanta = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0] == 'plantanombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('planta',$iRegplanta,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoplanta = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flagnuevoplanta = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}

			if($elementos[0]=='plantacapaci' && $elementos[1] < 0)
			{
				fncmsgerror(errorValneg);
				$flagnuevoplanta = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror < 1)
		{
			$result = insrecordplanta($iRegplanta,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoplanta=1;
				unset ($flagerror);
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
//				fncmsgerror(grabaEx);
				return $plantacode;
			}
			fncclose($nuconn);
		}

	}
}
if(empty($arreglo_aux))
{
	echo '<script language="JavaScript">'."\n";
	echo "<!--//"."\n";
	echo "alert('Debe escoger al menos un servicio');"."\n";
	echo "//-->"."\n";
	echo '</script>';
	
	$flagnuevoplanta = 1;
}
else 
{
	$iRegplanta[plantacodigo] = $plantacodigo;
	$iRegplanta[plantanombre] = $plantanombre;
	$iRegplanta[plantaencarg] = $plantaencarg;
	$iRegplanta[plantaubicac] = $plantaubicac;
	$iRegplanta[plantaarea] = $plantaarea;
	$iRegplanta[plantadescri] = $plantadescri;
	$iRegplanta[ciudadcodigo] = $ciudadcodigo;
	$iRegplanta[plantaencman] = $plantaencman;
	$iRegplanta[plantacapaci] = $plantacapaci;
	$iRegplanta[unidadcodigo] = $unidadcodigo;
	$iRegplanta[plantabieninmu] = $plantabieninmu;
	$plantacode = grabaplanta($iRegplanta,$flagnuevoplanta,$campnomb,$flagerror);
	
	if(!$flagnuevoplanta)
	{
		include("grabaservicioplanta.php");
		unset($arreglo_aux);
	}
}
?> 
