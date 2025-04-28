<?php
include ( '../src/FunPerPriNiv/pktblsaldo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editasaldo($iRegsaldo,&$flageditarsaldo,&$campnomb,&$codigo, $tipestcodigo)
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

	if ($iRegsaldo) 
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
		$iRegsaldo_b = $iRegsaldo;
				
		while($elementos = each($iRegsaldo))
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
								$flageditarsaldo = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarsaldo = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetasaldo($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarsaldo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='itedescodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecorditemdesa($iRegsaldo['itedescodigo'], $nuconn);
		
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
			$result = uprecordsaldo($iRegsaldo,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarsaldo=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);

				if($tipestcodigo <= 1){

					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'location ="maestablsaldo.php?codigo='.$codigo.';"';
					echo '//-->'."\n";
					echo '</script>';
				}else{

					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'location ="maestablhistosaldo.php?codigo='.$codigo.';"';
					echo '//-->'."\n";
					echo '</script>';
				}

			}
			fncclose($nuconn);
		}
	}
}

$iRegsaldo['saldocodigo'] = $saldocodigo;
$iRegsaldo['itedescodigo'] = $itedescodigo;
$iRegsaldo['saldoubicaci'] = $saldoubicaci;
$iRegsaldo['saldoposicio'] = $saldoposicio;
$iRegsaldo['saldoformula'] = $saldoformula;
$iRegsaldo['saldocantkgs'] = $saldocantkgs;
$iRegsaldo['saldocantmts'] = $saldocantmts;
$iRegsaldo['saldotipoinv'] = 1;//inventario de saldo {Laminas / Peliculas}
$iRegsaldo['lotecodigo'] = $lotecodigo;
$iRegsaldo['saldodescri'] = $saldodescri;

editasaldo($iRegsaldo,$flageditarsaldo,$campnomb,$codigo, $tipestcodigo);

?> 
