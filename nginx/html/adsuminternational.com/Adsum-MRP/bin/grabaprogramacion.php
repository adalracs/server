<?php

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblprogramacion.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fnctimecmp.php');
include ( '../src/FunGen/fncsumdate.php');



/**
 * Todos los derechos reservados
 * Propiedad intelectual de Adsum (c).
 * Funcion grabaprogramacion
 * Valida la data a grabar y la lleva al paquete.
 * 
 * @param $iRegprogramacion
 * @param $iRegotvalid
 * @param $flagnuevoprogramacion
 * @param $campnomb
 * @param $codigoprog
 * @param $empleacod
 * @return unknown_type
 */
function grabaprogramacion($iRegprogramacion,$iRegotvalid,&$flagnuevoprogramacion,&$campnomb,&$progracode)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("idgrupprog", 231);
	define("idprogramacion", 63);
	define("errorReg", 1);
	define("errorCar", 2);
	define("grabaEx", 3);
	define("compinst", 4);
	define("venccomp", 5);
	define("compactu", 6);
	define("fecvalid", 7);
	define("errormail", 8);
	define("editaEx", 9);
	define("errorIng", 35);
	define("e_empty",-3);

	$nuidtemp = fncnumact(idprogramacion,$nuconn);

	do{
		$nuresult = loadrecordprogramacionserial($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegprogramacion[progracodigo] = $nuidtemp;
			$progracode = $iRegprogramacion[progracodigo];
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if ($iRegprogramacion)
	{
		$iRegtabla["tablnomb"] = "programacion";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);

		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);

			if($sbregtabla[tablnomb] == "programacion")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		
		$iRegCampo["tablcodi"] = $tablcodi;
		while($elementos = each($iRegprogramacion))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "progracodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");

						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoprogramacion = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
				
			if($elementos[0] == "plantacodigo" && $elementos[1] == null)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == "prioricodigo" && $elementos[1] == null)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
				
			if($elementos[0] == "prografecini" && $elementos[1] == null)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == "prograhorini" && $elementos[1] == null)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			/*
			 if($elementos[0] == "progratiedur")
			 {
				if(($elementos[1] == null) || ($elementos[1] <= 0))
				{
					$flagnuevoprogramacion = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}

			if($elementos[0] == "progranota" && $elementos[1] == null)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == "progracantid")
			{
				if(($elementos[1] == null) || ($elementos[1] <= 0))
				{
					$flagnuevoprogramacion = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			*/
			if($elementos[0] == "tipmancodigo" && $elementos[1] == null)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
		}

		while($elementtareot = each($iRegotvalid))
		{
			if($elementtareot[0] == "tareacodigo" && $elementtareot[1] == null)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementtareot[0]] = 1;
			}

			if($elementtareot[0] == "tiptracodigo" && $elementtareot[1] == null)
			{
				$flagnuevoprogramacion = 1;
				$flagerror = 1;
				$campnomb[$elementtareot[0]] = 1;
			}
		}

		if($flagerror == 1)
			fncmsgerror(errorIng);

		if($flagerror != 1)
		{
			$result = insrecordprogramacion($iRegprogramacion,$nuconn);
				
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoprogramacion=1;
			}
				
			if($result > 0)
				$nuresult1 = fncnumprox(idprogramacion,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
		}
	}
}


if($filterindex  && $equipocodigocmbx)
{
	$nuconn = fncconn();
	$nuresult = loadequipocodigo($equipocodigocmbx, $nuconn);
	
	if($nuresult > 0)
	{	
		$equipocodigo = $nuresult[equipocodigo];
		$sistemcodigo = $nuresult[sistemcodigo];
		$plantacodigo = $nuresult[plantacodigo];
	}	
}	

($optiedur == 2) ? $progratiedur1 = $progratiedur / 60 : $progratiedur1 = $progratiedur;

$iRegprogramacion[progracodigo] = $progracodigo;
$iRegprogramacion[prioricodigo] = $prioricodigo;
$iRegprogramacion[equipocodigo] = $equipocodigo;
$iRegprogramacion[sistemcodigo] = $sistemcodigo;
$iRegprogramacion[plantacodigo] = $plantacodigo;
$iRegprogramacion[componcodigo] = $componcodigo;
$iRegprogramacion[tipmedcodigo] = $tipmedcodigo;
$iRegprogramacion[usuacodi] = $usuacodi;
$iRegprogramacion[prografecgen] = date("Y-m-d");
$iRegprogramacion[prograhorgen] = date("H:i");
$iRegprogramacion[prografrecue] = $prografrecue;
$iRegprogramacion[prografecini] = $prografecini;
$iRegprogramacion[prograhorini] = '00:00';
$iRegprogramacion[progratiedur] = $progratiedur1;
$iRegprogramacion[progranota]	= $progranota;
$iRegprogramacion[tipmancodigo] = $tipmancodigo;
$iRegprogramacion[prograacti] = 1;
$iRegprogramacion[progranumgru] = $progranumgru;
$iRegprogramacion[prograrepot] = 'f';
$iRegprogramacion[prografechfutur]= $prografecini;
$iRegprogramacion[tipcomcodigo] = $tipcomcodigo;

$iRegotvalid[tiptracodigo] = $tiptracodigo;
$iRegotvalid[tareacodigo]  = $tareacodigo;

grabaprogramacion($iRegprogramacion,$iRegotvalid,$flagnuevoprogramacion,$campnomb,$codigoprog);

if(!$flagnuevoprogramacion)
{
	$flagotinicial = true;
	
	$codigoot = NULL;
	$codigotareot = NULL;
	$tareotnota = "---";
	$tareottiedur = $progratiedur1;
	
	include('grabatareot.php');
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'alert(\'Grabado exitoso\');'."\n";
	echo '//-->'."\n";
	echo '</script>';

	unset(
		$plantacodigo,
		$sistemcodigo,
		$equipocodigo,
		$componcodigo,
		$tareacodigo,
		$tiptracodigo,
		$progratiedur,
		$prografrecue,
		$tipmedcodigo,
		$prioricodigo,
		$prografecini,
		$horini,
		$minini,
		$tipmancodigo,
		$otestacodigo,
		$arr_detalle,
		$campnomb,
		$tipcomcodigo
	);
}