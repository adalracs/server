<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacierreoe
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcierreoe         Arreglo de datos.
$flagnuevocierreoe    Bandera de validaci�n
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
include_once ( '../src/FunPerPriNiv/pktblreporteopp.php');
include_once ( '../src/FunPerPriNiv/pktbloe.php');
include_once ( '../src/FunPerPriNiv/pktblcampo.php');
include_once ( '../src/FunPerPriNiv/pktbltabla.php');
include_once ( '../src/FunGen/buscacaracter.php');
include_once ( '../src/FunGen/fncmsgerror.php');
include_once( '../src/FunGen/fncnombexs.php');

function grabacierreoe(&$iRegcierreoe,&$flagnuevocierreoe,&$campnomb,$oeestacodigo)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",266);
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
		$nuresult = loadrecordcierreoe($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcierreoe[cieordcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegcierreoe)
	{
		$iRegtabla["tablnomb"] = "cierreoe";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "cierreoe")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegcierreoe_b = $iRegcierreoe;

		while($elementos = each($iRegcierreoe))
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
							$flagnuevocierreoe = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocierreoe = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetacierreoe($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocierreoe = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='cieordcodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecordcierreoe($iRegcierreoe[cieordcodigo], $nuconn);
		
				if($valcodi > -3)
				{
					$flagnuevocierreoe = 1;
					$flagerror = 1;
					$campnomb[cieordcodigo] = 1;
					$campnomb[err] = 'Codigo existente o invalido';
					unset ($valcodi);
				}
			}
			unset ($validresult);
		}
        
		if(!$oeestacodigo)
		{
			$flagnuevocierreoe = 1;
			$flagerror = 1;
			$campnomb['oeestacodigo'] = 1;
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		

		if($flagerror != 1)
		{
			$result = insrecordcierreoe($iRegcierreoe,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocierreoe=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				$iRegoe['ordentcodigo'] = $iRegcierreoe['ordentcodigo'];
    			$iRegoe['oeestacodigo'] = $oeestacodigo;
    			$iRegoe['usuacodigo'] = $iRegcierreoe['usuacodi'];
    			$iRegoe['ordentfecfin'] = $iRegcierreoe['cieordfecha'];
    			$iRegoe['ordenthorfin'] = $iRegcierreoe['cieordhora'];
    			uprecordoe2($iRegoe,$nuconn);
    			fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iRegcierreoe[cieordcodigo] = $cieordcodigo;
$iRegcierreoe[ordentcodigo] = $ordentcodigo;
$iRegcierreoe[cieordfecha] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegcierreoe[cieordhora] = $hora;
$iRegcierreoe[usuacodi] = $usuacodi;
$iRegcierreoe[cieorddescri] = $cieorddescri;
$iRegcierreoe[cieordtipo] = 1;//gestion

grabacierreoe($iRegcierreoe,$flagnuevocierreoe,$campnomb,$oeestacodigo);

if(!$flagnuevocierreoe)
{
	$idcon = fncconn();
	
	if($oeestacodigo > 2)
	{
		if($arroe) $arrObjsoe = explode(',',$arroe);
		
		for( $a = 0; $a < count($arrObjsoe); $a++)
		{
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjsoe[$a],$idcon);
			uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 3/*estado aceptado*/),$idcon);
		}
	}
	else
	{
		if($arroe) $arrObjsoe = explode(',',$arroe);
		
		for( $a = 0; $a < count($arrObjsoe); $a++)
		{
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjsoe[$a],$idcon);
			uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 5/*estado recibido*/),$idcon);
		}
	}
	
	fncclose($idcon);
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablcierreoe.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}

?>