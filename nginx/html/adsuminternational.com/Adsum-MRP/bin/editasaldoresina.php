<?php

include ( "../src/FunPerPriNiv/pktblsaldo.php");
include ( "../src/FunPerPriNiv/pktblcampo.php");
include ( "../src/FunPerPriNiv/pktbltabla.php");
include ( "../def/tipocampo.php");
include ( "../src/FunGen/buscacaracter.php");
include ( "../src/FunGen/fncmsgerror.php");
include ( "../src/FunGen/fncnombeditexs.php");

function editasaldoresina($iRegsaldoresina,&$flageditarsaldoresina,&$campnomb,&$codigo, $tipestcodigo)
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

	if ($iRegsaldoresina) 
	{ 
		$iRegtabla["tablnomb"] = "saldo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla['tablnomb'] == "saldo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegsaldoresina_b = $iRegsaldoresina;
				
		while($elementos = each($iRegsaldoresina))
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
								$flageditarsaldoresina = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarsaldoresina = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetasaldo($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarsaldoresina = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='itedescodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecorditemdesa($iRegsaldoresina['itedescodigo'], $nuconn);
		
				if($valcodi == -3)
				{
					$flagnuevosaldo = 1;
					$flagerror = 1;
					$campnomb['itedescodigo'] = 1;
					$campnomb['err'] = 'Codigo existente o invalido';
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
			$result = uprecordsaldo($iRegsaldoresina,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarsaldoresina=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);

				if($tipestcodigo <= 1){

					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'location ="maestablsaldoresina.php?codigo='.$codigo.';"';
					echo '//-->'."\n";
					echo '</script>';
				}else{

					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'location ="maestablhistosaldoresina.php?codigo='.$codigo.';"';
					echo '//-->'."\n";
					echo '</script>';
				}

			}
			fncclose($nuconn);
		}
	}
}

$iRegsaldoresina['saldocodigo'] = $saldocodigo;
$iRegsaldoresina['itedescodigo'] = $itedescodigo;
$iRegsaldoresina['saldoubicaci'] = "Saldo Resina";
$iRegsaldoresina['saldoposicio'] = "Saldo Resina";
$iRegsaldoresina['saldoformula'] = "Saldo Resina";
$iRegsaldoresina['saldocantkgs'] = $saldocantkgs;
$iRegsaldoresina['saldocantmts'] = 1;
$iRegsaldoresina['saldotipoinv'] = 2;//inventario de saldo {Resinas}
$iRegsaldoresina['lotecodigo'] = $lotecodigo;
$iRegsaldoresina['saldodescri'] = $saldodescri;

editasaldoresina($iRegsaldoresina,$flageditarsaldoresina,$campnomb,$codigo, $tipestcodigo);

?> 
