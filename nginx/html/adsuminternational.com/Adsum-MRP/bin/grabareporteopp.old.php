8<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabareporteopp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegreporteopp         Arreglo de datos.
$flagnuevoreporteopp    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include_once ( '../src/FunGen/fncnumprox.php');
include_once ( '../src/FunGen/fncnumact.php');
include_once ( '../def/tipocampo.php');
include_once ( '../src/FunPerPriNiv/pktblcampo.php');
include_once ( '../src/FunPerPriNiv/pktbltabla.php');
include_once ( '../src/FunPerPriNiv/pktblreporteoppflagproduccion.php');
include_once ( '../src/FunPerPriNiv/pktblreporteoppdesperdiciopn.php');
include_once ( '../src/FunPerPriNiv/pktblreporteoppmaterialpn.php');
include_once ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
include_once ( '../src/FunPerPriNiv/pktblreporteopptiempopn.php');
include_once ( '../src/FunPerPriNiv/pktblreporteoppmaterial.php');
include_once ( '../src/FunGen/buscacaracter.php');
include_once ( '../src/FunGen/fncmsgerror.php');
include_once( '../src/FunGen/fncnombexs.php');

function grabareporteopp(&$iRegreporteopp,&$flagnuevoreporteopp,&$campnomb,$flagerror,$arrmatrep)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",242);
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
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordreporteopp($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegreporteopp[repoppcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegreporteopp)
	{
		$iRegtabla["tablnomb"] = "reporteopp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "reporteopp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegreporteopp_b = $iRegreporteopp;

		while($elementos = each($iRegreporteopp))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($sbregcampo["campnomb"] == $elementos[0])
				{
					$respuesta = strcmp($sbregcampo["campnotnull"],"t");
					if($respuesta == 0)
					{
						if($elementos[1] == "")
						{
							$campnomb[$elementos[0]] = 1;
							$flagnuevoreporteopp = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoreporteopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetareporteopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoreporteopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='repoppcodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecordreporteopp($iRegreporteopp[repoppcodigo], $nuconn);
		
				if($valcodi > -3)
				{
					$flagnuevoreporteopp = 1;
					$flagerror = 1;
					$campnomb[repoppcodigo] = 1;
					$campnomb[err] = 'Codigo existente o invalido';
					unset ($valcodi);
				}
			}
			
			unset ($validresult);
			
		}
		
		if(!$arrmatrep)
		{
			$flagnuevoreporteopp = 1;
			$flagerror = 1;
			$campnomb[arrmatrep] = 1;
			$campnomb[err] = 'Favor Ingresar Materiales a Asignar.';
			echo '<script language= "javascript">';
			echo '<!--//'."\n";
			echo 'alert("Favor Ingresar Materiales a Asignar.")';
			echo '//-->'."\n";
			echo '</script>';
		}
        
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordreporteopp($iRegreporteopp,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoreporteopp=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
    			$iRegop_opp[opestacodigo] = $iRegreporteopp['opestacodigo'];
    			$iRegop_opp[ordoppcodigo] = $iRegreporteopp['ordoppcodigo'];
    			uprecordop_estado($iRegop_opp,$nuconn);
    			fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}

}


$iRegreporteopp[repoppcodigo] = $repoppcodigo;
$iRegreporteopp[ordoppcodigo] = $ordoppcodigo;
$iRegreporteopp[opestacodigo] = $opestacodigo;
$iRegreporteopp[repoppfecha] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegreporteopp[repopphora] = $hora;
$iRegreporteopp[usuacodi] = $usuacodi;
$iRegreporteopp[repoppdescri] = $repoppdescri;
$iRegreporteopp[repopptipo] = 1;//gestion
$iRegreporteopp[roestacodigo] = '0';//estado en espera

/*
if($tipsolcodigo != 5 && $tipsolcodigo != 6 && $tipsolcodigo != 7 && $tipsolcodigo != 12){$reoppncantun = 1;}else{$reoppncantkg = 1;$reoppncantmt = 1;}
if(validafloat4($reoppncantkg) > 0 || !$reoppncantkg)
{
 	$flagnuevoreporteopp = 1;	
 	$flagerror = 1;
 	$campnomb['reoppncantkg'] = 1;
}

if(validafloat4($reoppncantmt) > 0 || !$reoppncantmt)
{
 	$flagnuevoreporteopp = 1;	
 	$flagerror = 1;
 	$campnomb['reoppncantmt'] = 1;
}

if(validafloat4($reoppncantun) > 0 || !$reoppncantun)
{
 	$flagnuevoreporteopp = 1;	
 	$flagerror = 1;
 	$campnomb['reoppncantun'] = 1;
}
*/

if($arrflagproduccion) $arrObjflagproduccion = explode(',',$arrflagproduccion);
	
for( $a = 0; $a < count($arrObjflagproduccion); $a++)
{
		$objsNumeroBanderas = 'txt_numero'.$arrObjflagproduccion[$a];
		if(validaint4($$objsNumeroBanderas) > 0 || !$$objsNumeroBanderas)
		{
		 	$flagnuevoreporteopp = 1;	
	 		$flagerror = 1;
	 		$campnomb[$objsNumeroBanderas] = 1;
		}
}


if($arrdesperdiciopn) $arrObjdesperdiciopn = explode(',',$arrdesperdiciopn);

for( $a = 0; $a < count($arrObjdesperdiciopn); $a++)
{
	$objrepkilos = 'repkilos_'.$arrObjdesperdiciopn[$a];
	$objrepmetros = 'repmetros_'.$arrObjdesperdiciopn[$a];
	if(validafloat4($$objrepkilos) > 0 || !$$objrepkilos)
	{
	 	$flagnuevoreporteopp = 1;	
	 	$flagerror = 1;
	 	$campnomb[$objrepkilos] = 1;
	}
	
	if(validafloat4($$objrepmetros) > 0 || !$$objrepmetros)
	{
	 	$flagnuevoreporteopp = 1;	
	 	$flagerror = 1;
	 	$campnomb[$objrepmetros] = 1;
	}
}
unset($arrObjdesperdiciopn);


if($$arrtiempopn) $arrObjtiempopn = explode(',',$$arrtiempopn);

for( $a = 0; $a < count($arrObjtiempopn); $a++)
{
	$objrephoraini = 'rephoraini_'.$arrObjtiempopn[$a];
	$objrephorafin = 'rephorafin_'.$arrObjtiempopn[$a];
	if(validatime($$objrephoraini) > 0 || !$$objrephoraini)
	{
	 	$flagnuevoreporteopp = 1;	
	 	$flagerror = 1;
	 	$campnomb[$objrephoraini] = 1;
	}
	
	if(validatime($$objrephorafin) > 0 || !$$objrephorafin)
	{
	 	$flagnuevoreporteopp = 1;	
	 	$flagerror = 1;
	 	$campnomb[$objrephorafin] = 1;
	}
}
unset($arrObjdesperdiciopn);

grabareporteopp($iRegreporteopp,$flagnuevoreporteopp,$campnomb,$flagerror,$arrmatrep);

if(!$flagnuevoreporteopp)
{
	$idcon = fncconn();
	
//----------------------------------REPORTE PN ------------------------------------------
	unset($nuidtemp,$nuresult);
	$nuidtemp = fncnumact(243,$idcon);
	do
	{
		$nuresult = loadrecordreporteoppreportepn($nuidtemp,$idcon);
		if($nuresult == e_empty)
		{
			$iRegreporteoppreportepn['reoppncodigo'] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	
	
	$rsReporteopp = dinamicscanreporteopp(array('ordoppcodigo' => $ordoppcodigo ),$idcon);
	$nrReporteopp = fncnumreg($rsReporteopp);
	$nrReporteopp++;
	
	$iRegreporteoppreportepn['reoppncodigo'] = $iRegreporteoppreportepn['reoppncodigo'];
	$iRegreporteoppreportepn['repoppcodigo'] = $iRegreporteopp['repoppcodigo'];
	$iRegreporteoppreportepn['reoppncantkg'] = $reoppncantkg;
	$iRegreporteoppreportepn['reoppncantmt'] = $reoppncantmt;
	$iRegreporteoppreportepn['reoppncantun'] = $reoppncantun;
	$iRegreporteoppreportepn['reoppnbobina'] = $nrReporteopp;
	$iRegreporteoppreportepn['reoppndescri'] = $reoppndescri;
	$res = insrecordreporteoppreportepn($iRegreporteoppreportepn,$idcon);
	//se actualiza numero proximo
	fncnumprox(243,$iRegreporteoppreportepn['reoppncodigo'] + 1,$idcon); 
		
		
		
		
		

//----------------------------------MATERIAL IMPLICADO PN ------------------------------------------

	unset($nuidtemp,$nuresult,$res);
	
	//CONSECUTIVO PARA MATERIAS PRIMAS
	$nuidtemp_mt = fncnumact(244,$idcon);
	do
	{
		$nuresult_mt = loadrecordreporteoppmaterial($nuidtemp_mt,$idcon);
		if($nuresult_mt == e_empty)
		{
			$iRegreporteoppmaterial['reopmtcodigo'] = $nuidtemp_mt - 1;
		}
		$nuidtemp_mt ++;
	}while ($nuresult_mt != e_empty);
	
	//CONSECUTIVO PARA MATERIALES EN PROCESO {MATERIALES IMPRESOS, MATERIALES LAMINADOS, ETC}
	$nuidtemp_pn = fncnumact(254,$idcon);
	do
	{
		$nuresult_pn = loadrecordreporteoppmaterialpn($nuidtemp_pn,$idcon);
		if($nuresult_pn == e_empty)
		{
			$iRegreporteoppmaterialpn['reopmtcodigo'] = $nuidtemp_pn - 1;
		}
		$nuidtemp_pn ++;
	}while ($nuresult_pn != e_empty);
	
	if($arrmatrep) $arrObjmatrep = explode(':|:',$arrmatrep);
	//SE RECORREO EL ARRAY DE MATERIALES DIFERENCIADOS {0 => MATERIAS PRIMAS , => MATERIAL EN PROCESO}
	for( $a = 0; $a < count($arrObjmatrep); $a++)
	{
		$rowArrObjmatrep = explode(':-:',$arrObjmatrep[$a]);
		//REPORTE DE CONSUMO DE MATERIALES EN PROCESO
		if($rowArrObjmatrep[1] > 0)
		{
			$objconsumo = 'mtconsumo_'.$rowArrObjmatrep[0].'_pn';
			$iRegreporteoppmaterialpn['reopmtcodigo'] = $iRegreporteoppmaterialpn['reopmtcodigo'] + 1;
			$iRegreporteoppmaterialpn['repoppcodigo'] = $iRegreporteopp['repoppcodigo'];
			$iRegreporteoppmaterialpn['reoppncodigo'] = $rowArrObjmatrep[0];
			$res = insrecordreporteoppmaterialpn($iRegreporteoppmaterialpn,$idcon);
			//validacion adicional de error de consecutivo
			if($res < 1)
			{
				unset($nuidtemp_pn,$nuresult_pn);
				
				//CONSECUTIVO PARA MATERIALES EN PROCESO {MATERIALES IMPRESOS, MATERIALES LAMINADOS, ETC}
				$nuidtemp_pn = fncnumact(254,$idcon);
				do
				{
					$nuresult_pn = loadrecordreporteoppmaterialpn($nuidtemp_pn,$idcon);
					if($nuresult_pn == e_empty)
					{
						$iRegreporteoppmaterialpn['reopmtcodigo'] = $nuresult_pn - 1;
					}
					$nuidtemp_pn ++;
				}while ($nuresult_pn != e_empty);
				
				$iRegreporteoppmaterialpn['reopmtcodigo'] = $iRegreporteoppmaterialpn['reopmtcodigo'] + 1;
				$res = insrecordreporteoppmaterialpn($iRegreporteoppmaterialpn,$idcon);
			}
			//se actualiza numero proximo
			fncnumprox(254,$iRegreporteoppmaterialpn['reoppncodigo'] + 1,$idcon); 
		}//REPORTE DE CONSUMO DE MATERIAS PRIMAS
		else
		{
			$iRegreporteoppmaterial['reopmtcodigo'] = $iRegreporteoppmaterial['reopmtcodigo'] + 1;
			$iRegreporteoppmaterial['repoppcodigo'] = $iRegreporteopp['repoppcodigo'];
			$iRegreporteoppmaterial['geoprecodigo'] = $rowArrObjmatrep[0];
			$res = insrecordreporteoppmaterial($iRegreporteoppmaterial,$idcon);
			//validacion adicional de error de consecutivo
			if($res < 1)
			{
				unset($nuidtemp_mt,$nuresult_mt);
				
				//CONSECUTIVO PARA MATERIAS PRIMAS
				$nuidtemp_mt = fncnumact(244,$idcon);
				do
				{
					$nuresult_mt = loadrecordreporteoppmaterial($nuidtemp_mt,$idcon);
					if($nuresult_mt == e_empty)
					{
						$iRegreporteoppmaterial['reopmtcodigo'] = $nuidtemp_mt - 1;
					}
					$nuidtemp_mt ++;
				}while ($nuresult_mt != e_empty);
				
				$iRegreporteoppmaterial['reopmtcodigo'] = $iRegreporteoppmaterial['reopmtcodigo'] + 1;
				$res = insrecordreporteoppmaterial($iRegreporteoppmaterial,$idcon);
			}
			//se actualiza numero proximo
			fncnumprox(244,$iRegreporteoppmaterial['reoppncodigo'] + 1,$idcon); 
		}
	}
		
		
//----------------------------------BANDERAS PN ------------------------------------------

	unset($res);
	
	if($arrflagproduccion) $arrObjflagproduccion = explode(',',$arrflagproduccion);
	
	for( $a = 0; $a < count($arrObjflagproduccion); $a++)
	{
		$objsNumeroBanderas = 'txt_numero'.$arrObjflagproduccion[$a];
		$iRegreporteoppflagproduccion['repoppcodigo'] = $iRegreporteopp['repoppcodigo'];
		$iRegreporteoppflagproduccion['flaprocodigo'] = $arrObjflagproduccion[$a];
		$iRegreporteoppflagproduccion['repflacantun'] = $$objsNumeroBanderas;
		$res = insrecordreporteoppflagproduccion($iRegreporteoppflagproduccion,$idcon);
	}
	
	
//----------------------------------DESPEDICIO PN ------------------------------------------

	unset($res);
	
	if($arrdesperdiciopn) $arrObjdesperdiciopn = explode(',',$arrdesperdiciopn);
	
	for( $a = 0; $a < count($arrObjdesperdiciopn); $a++)
	{
		$objrepkilos = 'repkilos_'.$arrObjdesperdiciopn[$a];
		$objrepmetros = 'repmetros_'.$arrObjdesperdiciopn[$a];
		$iRegreporteoppdesperdiciopn['repoppcodigo'] = $iRegreporteopp['repoppcodigo'];
		$iRegreporteoppdesperdiciopn['despercodigo'] = $arrObjdesperdiciopn[$a];
		$iRegreporteoppdesperdiciopn['reopdecantkg'] = $$objrepkilos;
		$iRegreporteoppdesperdiciopn['reopdecantmt'] = $$objrepmetros;
		$res = insrecordreporteoppdesperdiciopn($iRegreporteoppdesperdiciopn,$idcon);
	}
	
	
	
//----------------------------------TIEMPO PN ------------------------------------------

	unset($res);
	
	if($arrtiempopn) $arrObjtiempopn = explode(',',$arrtiempopn);
	
	for( $a = 0; $a < count($arrObjtiempopn); $a++)
	{
		$objrephoraini = 'rephoraini_'.$arrObjtiempopn[$a];
		$objrephorafin = 'rephorafin_'.$arrObjtiempopn[$a];
		$iRegreporteopptiempopn['repoppcodigo'] = $iRegreporteopp['repoppcodigo'];
		$iRegreporteopptiempopn['tiempocodigo'] = $arrObjtiempopn[$a];
		$iRegreporteopptiempopn['reoptihorini'] = $$objrephoraini;
		$iRegreporteopptiempopn['reoptihorfin'] = $$objrephorafin;
		$res = insrecordreporteopptiempopn($iRegreporteopptiempopn,$idcon);
	}
		
		
 	fncclose($idcon);
 	
 	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablreporteopp.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}

?> 

