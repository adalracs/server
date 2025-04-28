<?php 
include ( '../src/FunPerPriNiv/pktbloereporteoppreportepn.php');
include ( '../src/FunPerPriNiv/pktblreporteopp.php');
include ( '../src/FunPerPriNiv/pktbloe.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabaoe(&$iRegoe,&$flagnuevooe,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",265);
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
	define("e_empty",-3); 

	$nuidtemp = fncnumact(id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordoe($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{  
			$iRegoe[ordentcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegoe)
	{
		$iRegtabla["tablnomb"] = "oe";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "oe")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegoe_b = $iRegoe;
		

		while($elementos = each($iRegoe))
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
								$flagnuevooe = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevooe = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetaoe($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevooe = 1;
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
			$result = insrecordoe($iRegoe,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevooe=1;
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

$iRegoe[oeestacodigo] = $oeestacodigo;
$iRegoe[ordentfecgen] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegoe[ordenthorgen] = $hora;
$iRegoe[plantacodigo] = $plantacodigo;
$iRegoe[ordoppcodigo] = $ordoppcodigo;
$iRegoe[usuacodi] = $usuacodi;
$iRegoe[ordentnumept] = $ordentnumept;
$iRegoe[ordentdescri] = $ordentdescri;

grabaoe($iRegoe,$flagnuevooe,$campnomb);

if(!$flagnuevooe)
{
	$idcon = fncconn();
	
	//----------------------------------REPORTE DE ENTREGA------------------------------------------
	if($arroe) $arrObjsoe = explode(',',$arroe);
	
	for( $a = 0; $a < count($arrObjsoe); $a++)
	{
		$iRegoereporteoppreportepn['ordentcodigo'] = $iRegoe[ordentcodigo];
		$iRegoereporteoppreportepn['reoppncodigo'] = $arrObjsoe[$a];
		insrecordoereporteoppreportepn($iRegoereporteoppreportepn,$idcon);
		$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjsoe[$a],$idcon);
		uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 4/*estado entregado*/),$idcon);
	}
	
	fncclose($idcon);
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestabloe.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
?> 
