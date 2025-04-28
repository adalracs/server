<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabatransacherramie
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegtransacherramie         Arreglo de datos.
$flagnuevotransacherramie    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 			| Motivo														| Autor 	|
16-ene-2006 		 Implementaci�n de nueva funcionalidad para el borrado de OT.	 mstroh
*/
if(!isset($arr_transacherramie))
{
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
}
if(!isset($arr_transacitem))
{
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
}

function  grabatransacherramie($iRegtransacherramie,$iRegvalidaherramie,&$flagnuevotransacherramie,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_th",71);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("validcan",11);
	define("errorIng",35);

	$nuidtemp = fncnumact(id_th,$nuconn);
	do
	{
		$nuresult = loadrecordtransacherramie($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegtransacherramie[transhercodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if ($iRegvalidaherramie['otflag'] == 1)
	{
		$result = insrecordtransacherramie($iRegtransacherramie, $nuconn);

		if($result < 0 )
		{
			$flagnuevotransacherramie = 1;
		}

		if($result > 0)
		{
			$nuresult1 = fncnumprox(id_th,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
		}
	}
	else
	{
		if ($iRegtransacherramie)
		{
			$iRegtabla["tablnomb"] = "transacherramie";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
				if($sbregtabla[tablnomb] == "transacherramie")
				{
					$tablcodi=$sbregtabla['tablcodi'];
					break;
				}
			}

			$iRegCampo["tablcodi"]=$tablcodi;
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			while($elementos = each($iRegtransacherramie))
			{
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
				if($num>0)
				{
					$sbregcampo = fncfetch($resultcampo,0);
					if($elementos[0] != "transhercodigo")
					{
						if($sbregcampo["campnomb"] == $elementos[0])
						{
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							if($respuesta == 0)
							{
								if($elementos[1] == "")
								{
									$campnomb[$elementos[0]] = 1;
									$flagnuevotransacherramie = 1;
									$flagerror = 1;
								}
							}
						}
					}
				}
				$validar = buscacaracter($elementos[1]);

				if($validar == 1)
				{
					$flagnuevotransacherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				$validresult = consulmetatransacherramie($elementos[0],$elementos[1],$nuconn);

				if($validresult == 1)
				{
					$flagnuevotransacherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
				if($elementos[0] == "herramcodigo" && $elementos[1] == "")
				{
					$flagnuevotransacherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				if($elementos[0] == "transhercanti" && (($elementos[1] < 0) || ($elementos[1] == "")))
				{
					fncmsgerror(validcan);
					$flagnuevotransacherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				if($elementos[0] == "bodegacodigo" && $elementos[1] == "")
				{
					$flagnuevotransacherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}

				if($elementos[0] == "herestcodigo" && $elementos[1] == "")
				{
					$flagnuevotransacherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}

			}
			if($flagerror == 1)
			{
				fncmsgerror(errorIng);
			}

			if($flagerror != 1)
			{
				if($iRegtransacherramie[herramcodigo] && $iRegtransacherramie[transhercanti])
				{
					$validdispon = validadisponibilidad($iRegvalidaherramie,$iRegtransacherramie[transhercanti],$iRegtransacherramie[tipmovcodigo],$nuconn);
					if($validdispon > 0)
					{
						$result = insrecordtransacherramie($iRegtransacherramie,$nuconn);

						if($result < 0 )
						{
							ob_end_clean();
							fncmsgerror(errorReg);
							$flagnuevotransacherramie=1;
						}
						if($result > 0)
						{
							$sumherramie = $iRegvalidaherramie[herramdispon] + $iRegtransacherramie[transhercanti];
							updateherramiedispon($iRegvalidaherramie[herramcodigo],$sumherramie,$idcon);
							$nuresult1 = fncnumprox(id_th,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
							fncmsgerror(grabaEx);
						}
					}
					else
					{
						$flagnuevotransacherramie = 1;
					}
				}
				else
				{
					fncmsgerror(errorReg);
					$flagnuevotransacherramie = 1;
				}
				fncclose($nuconn);
			}
		}
	}
}

if(!isset($arr_transacherramie))
{
	if($bodegatipo == 2):
		$idcon = fncconn();
		$rs_bodega = dinamicscanopbodega(array('usuacodi' => $usuacodigo, 'bodegatipo' => 2), array('usuacodi' => '=', 'bodegatipo' => '='), $idcon);
		
		
		if($rs_bodega > 0):
			$rw_bodega = fncfetch($rs_bodega, 0);
			$iRegtransacherramie[bodegacodigo] = $rw_bodega['bodegacodigo'];
		else:
			$transcbodega = true;
			include 'grababodegatecnico.php';
			$iRegtransacherramie[bodegacodigo] = $bodegacode;
		endif;
	else:
		$iRegtransacherramie[bodegacodigo]   = $bodegacodigo;
	endif;
	
	$transhertotal = $transhercanti * $herramvalor;

	$iRegtransacherramie[transhercodigo] = $transhercodigo;
	$iRegtransacherramie[tipmovcodigo]   = $tipmovcodigo;
	$iRegtransacherramie[herramcodigo]   = $herramcodigo;
	$iRegtransacherramie[transherfecha]  = $transherfecha;
	$iRegtransacherramie[transhercanti]  = $transhercanti;
	$iRegtransacherramie[transhertotal]  = $transhertotal;
	$iRegtransacherramie[usuacodi]       = $usuacodi;
	$iRegtransacherramie[herestcodigo]   = $herestcodigo;

	$idcon = fncconn();
	$rs_herramie = loadrecordherramie($herramcodigo, $idcon);
	
	$iRegvalidaherramie[tipmovcodigo]  = $tipmovcodigo;
	$iRegvalidaherramie[transhercanti] = $transhercanti;
	$iRegvalidaherramie[herramcodigo]  = $rs_herramie[herramcodigo];
	$iRegvalidaherramie[herramdispon]  = $rs_herramie[herramdispon];

	grabatransacherramie($iRegtransacherramie,$iRegvalidaherramie,$flagnuevotransacherramie,$campnomb);
}
else
{
	$num = count($arr_transacherramie);

	for($i=0; $i<$num; $i++)
	{
		$iRegtransacherramie[transhercodigo] = $transhercodigo;
		$iRegtransacherramie[tipmovcodigo]   = 1;
		$iRegtransacherramie[herramcodigo]   = $arr_transacherramie[$i]['herramcodigo'];
		$iRegtransacherramie[transherfecha]  = date('Y-m-d');
		$iRegtransacherramie[transhercanti]  = $arr_transacherramie[$i]['transhercanti'];
		$iRegtransacherramie[transhertotal]  = $arr_transacherramie[$i]['transhertotal'];
		$iRegtransacherramie[usuacodi]       = $usuacodi;
		$iRegtransacherramie[bodegacodigo]   = $arr_transacherramie[$i]['bodegacodigo'];

		$iRegvalidaherramie['otflag'] = 1;

		grabatransacherramie($iRegtransacherramie, $iRegvalidaherramie, $flagnuevotransacherramie, $campnomb);
	}
	return;
}

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : validadisponibilidad
Decripcion      : Valida y actualiza la tabla herramie
Parametros      : Descripicion
$arrherramie         Arreglo de datos.
$transaccan    	 cantidad
$tipomovi		 Codigo de tipomovi

Retorno         :
true	= 1
false	= 0
Autor           : lfolaya
Fecha           : 26012005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
function validadisponibilidad($arrherramie,$transaccan,$tipomovi,$idcon)
{
	$sbregtipomovi = loadrecordtipomovi($tipomovi,$idcon);

	if($sbregtipomovi[tipmovtipo] > 0)
	{
		$sumherramie = $arrherramie[herramdispon] + $transaccan;
		if($sumherramie >= 0)
		{
			return 1;
		}else
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Cantidad no permitida")';
			echo '//-->'."\n";
			echo '</script>';
			return -1;
		}
	}
	elseif ($sbregtipomovi[tipmovtipo] < 1)
	{

		$resherramie = $arrherramie[herramdispon] - $transaccan;
		if($resherramie >= 0)
		{
			updateherramiedispon($arrherramie[herramcodigo],$resherramie,$idcon);
			return 1;
		}else
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Cantidad no permitida")';
			echo '//-->'."\n";
			echo '</script>';
			return -1;
		}
	}
}
?>