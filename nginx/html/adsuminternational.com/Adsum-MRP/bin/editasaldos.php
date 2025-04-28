<?php
ini_set('display_errors',1); 
include ( '../src/FunPerPriNiv/pktblsaldos.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editasaldos($iRegsaldos,&$flageditarsaldos,&$campnomb,&$codigo)
{
	$nuconn = fncconn();
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

	if ($iRegsaldos) 
	{ 
		$iRegtabla["tablnomb"] = "saldos";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "saldos")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegsaldos_b = $iRegsaldos;
				
		while($elementos = each($iRegsaldos))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "itedescodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarsaldos = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarsaldos = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetasaldos($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarsaldos = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='itedescodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecorditemdesa($iRegsaldos[itedescodigo], $nuconn);
		
				if($valcodi == -3)
				{
					$flagnuevosaldos = 1;
					$flagerror = 1;
					$campnomb[itedescodigo] = 1;
					$campnomb[err] = 'Codigo existente o invalido';
					unset ($valcodi);
				}
			}
			unset ($validresult);
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		
		if($flagerror != 1)
		{
			$result = uprecordsaldos($iRegsaldos,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarsaldos=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablsaldos.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegsaldos[saldoscodigo] = $saldoscodigo;
$iRegsaldos[itedescodigo] = $itedescodigo;
$iRegsaldos[saldosubicac] = $saldosubicac;
$iRegsaldos[saldosposici] = $saldosposici;
$iRegsaldos[saldosancho] = $saldosancho;
$iRegsaldos[saldoscalib] = $saldoscalib;
$iRegsaldos[saldosformula] = $saldosformula;
$iRegsaldos[saldoscantkg] = $saldoscantkg;
$iRegsaldos[saldoscantmt] = $saldoscantmt;
$iRegsaldos[saldostipinv] = 1;
$iRegsaldos[saldosdescri] = $saldosdescri;

editasaldos($iRegsaldos,$flageditarsaldos,$campnomb,$codigo);
?> 
