<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabahistoriaot
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReghistoriaot         Arreglo de datos.
$flagnuevohistoriaot    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo								| Autor 	|
02012006	Implementacion							mstroh
05012006	Implementaci�n al nuevo modelo		mstroh
*/

// $flagotinicial: Indica que el archivo ha sido incluido en grabaot.php
if(!$flagotinicial)
{
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include ( '../src/FunPerPriNiv/pktbltransaction.php');
}
include ( '../src/FunGen/fncconverttime.php');
include ( '../src/FunPerPriNiv/pktblhistoriaot.php');
include ( '../src/FunPerPriNiv/pktblreportot.php');
include ( '../src/FunPerPriNiv/pktblcierreot.php');

function grabahistoriaot($iReghistoriaot,&$flagnuevohistoriaot,&$campnomb, $flagot)
{
	$nuconn = fncconn();

	define("id_hisot", 68);
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

	$nuidtemp = fncnumact(id_hisot,$nuconn);
	do
	{
		$nuresult = loadrecordhistoriaot($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReghistoriaot[histotcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if($flagot)
	{
		$result = insrecordhistoriaot($iReghistoriaot,$nuconn);
		unset($flagot);

		if($result < 0 )
		{
			ob_end_clean();
			//fncmsgerror(errorReg);
			$flagnuevohistoriaot = 1;
		}

		if($result > 0)
		{
			//No utilice esta parte si va a utilizar la llave primaria como serial
			$nuresult1 = fncnumprox(id_hisot,$nuidtemp,$nuconn);
			fncmsgerror(grabaEx);
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'location ="maestablot.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
		}
		fncclose($nuconn);
	}
	else
	{
		if($iReghistoriaot)
		{
			$iRegtabla["tablnomb"] = "historiaot";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
				if($sbregtabla[tablnomb] == "historiaot")
				{
					$tablcodi = $sbregtabla['tablcodi'];
					break;
				}
			}

			$iRegCampo["tablcodi"]=$tablcodi;
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			while($elementos = each($iReghistoriaot))
			{
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
				if($num>0)
				{
					$sbregcampo = fncfetch($resultcampo,0);
					if($elementos[0] != "histotcodigo")
					{
						if($sbregcampo["campnomb"] == $elementos[0])
						{
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							if($respuesta == 0)
							{
								if($elementos[1] == "")
								{
									$campnomb[$elementos[0]] = 1;
									$flagnuevohistoriaot = 1;
									$flagerror = 1;
								}
							}
						}
					}
				}
				$validar = buscacaracter($elementos[1]);

				if($validar == 1)
				{
					$flagnuevohistoriaot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}

				if(($elementos[0] != "histotfecfin") && ($elementos[0] != "histotcodigo"))
				{
					$validresult = consulmetahistoriaot($elementos[0],$elementos[1],$nuconn);

					if($validresult == 1)
					{
						$flagnuevohistoriaot = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validresult);
					}
				}
			}

			if($flagerror == 1)
			{
				fncmsgerror(errorIng);
			}

			if($flagerror != 1)
			{
				$validhistoriaot = sethistoriaot($iReghistoriaot, $nuconn);

				$result = insrecordhistoriaot($iReghistoriaot,$nuconn);
				if($result < 0 )
				{
					ob_end_clean();
					fncmsgerror(errorReg);
					$flagnuevohistoriaot=1;
				}
				if($result > 0)
				{
					//No utilice esta parte si va a utilizar la llave primaria como serial
					$nuresult1 = fncnumprox(id_hisot,$nuidtemp,$nuconn);
					fncmsgerror(grabaEx);
				}
				fncclose($nuconn);
			}
		}
	}
}
//---------------
//$flagotinicial: Indica que el archivo ha sido incluido en grabaot.php
//---------------
if($flagotinicial)
{
	$idcon = fncconn();
	$arr_ot = loadrecordot($codigoot, $idcon);
	fncclose($idcon);
	$iReghistoriaot['histotcodigo'] = $histotcodigo;
	$iReghistoriaot['ordtracodigo'] = $codigoot;
	$iReghistoriaot['histothorini'] = $arr_ot['ordtrahorgen'];
	$iReghistoriaot['histotfecini'] = $arr_ot['ordtrafecgen'];
	$iReghistoriaot['histothorfin'] = $histothorfin;
	$iReghistoriaot['histotfecfin'] = $histotfecfin;
	$iReghistoriaot['histotsecuen'] = 0;
	$iReghistoriaot['histotfin'] 	= $histotfin;
	$iReghistoriaot['usuacodi'] 	= $usuacodi;
	$iReghistoriaot['histotdescri'] = $ordtradescri;
	$iReghistoriaot['otestacodigo'] = $otestacodigo;

	grabahistoriaot($iReghistoriaot, $flagnuevohistoriaot, $campnomb, $flagotinicial);
}
else
{
	$iReghistoriaot['histotcodigo'] = $histotcodigo;
	$iReghistoriaot['ordtracodigo'] = $ordtracodigo;
	$iReghistoriaot['histothorini'] = date('H:i');
	$iReghistoriaot['histotfecini'] = date('Y-m-d');
	$iReghistoriaot['histothorfin'] = $histothorfin;
	$iReghistoriaot['histotfecfin'] = $histotfecfin;
	$iReghistoriaot['histotsecuen'] = $histotsecuen;
	$iReghistoriaot['histotfin']    = $histotfin;
	$iReghistoriaot['usuacodi']     = $usuacodic;
	$iReghistoriaot['histotdescri'] = $histotdescri;
	$iReghistoriaot['otestacodigo'] = $otestacodigo;
	$flagotinicial = false;

	grabahistoriaot($iReghistoriaot, $flagnuevohistoriaot, $campnomb, $flagotinicial);

	if(!$flagnuevohistoriaot)
	{
		if($flagrport)
		{
			// Capturamos los datos para el registro de reporde de OT
			$iRegreportot["reportcodigo"] = $reportcodigo;
			$iRegreportot["ordtracodigo"] = $ordtracodigo;
			$iRegreportot["tipmancodigo"] = $tipmancodigo_h;
			$iRegreportot["prioricodigo"] = $prioricodigo_h;
			$iRegreportot["tiptracodigo"] = $tiptracodigo_h;
			$iRegreportot["tareacodigo"]  = $tareacodigo_h;
			$iRegreportot["reportfecha"]  = date('Y-m-d');
			$iRegreportot["reporttiedur"] = $reporttiedur;
			$iRegreportot["reportdescri"] = $histotdescri;
			
			grabareportot($iRegreportot, $flagnuevoreportot, $codigoreportot);
			
			if(!$flagnuevoreportot)
			{
				include('grabatransaction.php');
			}
		}
		
		if($flagcclosed)
		{
			$arr_reportot = loadrecordreportot($ordtracodigo, $idcon);
			
			if(is_array($arr_reportot))
			{
				$reportcodigo = $arr_reportot["reporcodigo"];
			}
			$iRegcierreot["cierotcodigo"] = $cierotcodigo;
			$iRegcierreot["usuacodi"] 	  = $usuacodic;
			$iRegcierreot["tipcumcodigo"] = $tipcumcodigo_h;
			$iRegcierreot["reportcodigo"] = $reportcodigo;
			$iRegcierreot["cierotfecfin"] = date('Y-m-d');
			$iRegcierreot["cierothorfin"] = date('H:i');
			$iRegcierreot["cierotdescri"] = $histotdescri;
			
			grabacierreot($iRegcierreot,$flagnuevocierreot,$campnomb);
		}
	}
}
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : sethistoriaot
Decripcion      : Genera la secuencia (histotsecuen) y actualiza las respectivas fechas en los registros previos de historiaot
de historiaot que coinciden con los parametros
Parametros      : Descripicion
$arr         	: Arreglo de datos.
$idcon    		: ID de conexion
Retorno         :
true	= 1
false	= 0
Autor           : mstroh
Fecha           : 05012006
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
*/
function sethistoriaot(&$arr, $idcon)
{
	$iRegvalida['ordtracodigo'] = $arr['ordtracodigo'];
	$ccount = 0;

	$idres = dinamicscanhistoriaot($iRegvalida, $idcon);

	if(!is_numeric($idres))
	{
		$num = fncnumreg($idres);

		for($i=0; $i<$num; $i++)
		{
			$arrhistot = fncfetch($idres, $i);

			if($arrhistot['ordtracodigo'] == $iRegvalida['ordtracodigo'])
			{
				if($ccount == 0)
				{
					$maxsecuen = $arrhistot['histotsecuen'];
					$maxseccod = $arrhistot['histotcodigo'];
				}
				else
				{
					if($arrhistot['histotsecuen'] > $maxsecuen)
					{
						$maxsecuen = $arrhistot['histotsecuen'];
						$maxseccod = $arrhistot['histotcodigo'];
					}
				}
			}
			$arr['histotsecuen'] = ($maxsecuen + 1);

			// Actualizo el registro anterior
			$arrupdate = loadrecordhistoriaot($maxseccod, $idcon);

			$arrupdate['histothorfin'] = $arr['histothorini'];
			$arrupdate['histotfecfin'] = $arr['histotfecini'];

			$result = uprecordhistoriaot($arrupdate, $idcon);
			// --
			$ccount++;
		}
	}
}

// --------------------------------------------------------------------------

function grabareportot(&$iRegreportot, &$flagnuevoreportot, &$codigoreportot)
{
	define("idreportothis",34);

	$nuconn = fncconn();
	$nuidtemp = fncnumact(idreportothis,$nuconn);
	do
	{
		$nuresult = loadrecordreportot($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegreportot[reportcodigo] = $nuidtemp;
			$codigoreportot = $iRegreportot[reportcodigo];
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if ($iRegreportot)
	{
		$result = insrecordreportot($iRegreportot,$nuconn);
		
		if($result < 0 )
		{
			ob_end_clean();
			fncmsgerror(errorReg);
			$flagnuevoreportot = 1;
		}
		
		if($result > 0)
		{
			$nuresult1 = fncnumprox(idreportothis,$nuidtemp,$nuconn);
			$flagnuevoreportot = null;
		}
		fncclose($nuconn);
	}
}
// -----------------------------------------------------------------------


// -----------------------------------------------------------------------

function grabacierreot(&$iRegcierreot, &$flagnuevocierreot, &$codigocierreot)
{
	define("idcierreothis",34);

	$nuconn = fncconn();
	$nuidtemp = fncnumact(idcierreothis,$nuconn);
	do
	{
		$nuresult = loadrecordcierreot($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcierreot[cierotcodigo] = $nuidtemp;
			$codigocierreot = $iRegcierreot[cierotcodigo];
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if ($iRegcierreot)
	{
		$result = insrecordcierreot($iRegcierreot,$nuconn);
		
		if($result < 0 )
		{
			ob_end_clean();
			fncmsgerror(errorReg);
			$flagnuevocierreot = 1;
		}
		
		if($result > 0)
		{
			$nuresult1 = fncnumprox(idcierreothis,$nuidtemp,$nuconn);
			$flagnuevocierreot = null;
		}
		fncclose($nuconn);
	}
}
// -----------------------------------------------------------------------
?>