<?php
include ( '../src/FunPerPriNiv/pktbltarifa.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editatarifa($iRegtarifa,&$flageditartarifa,&$campnomb,&$codigo,&$fildat,&$columnas)
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

	if ($iRegtarifa) 
	{ 
		$iRegtabla["tablnomb"] = "tarifa";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla['tablnomb'] == "tarifa")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegtarifa_b = $iRegtarifa;
				
		while($elementos = each($iRegtarifa))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "tarifacodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditartarifa = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditartarifa = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetatarifa($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditartarifa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			unset ($validresult);
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = uprecordtarifa($iRegtarifa,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditartarifa=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabltarifa.php?codigo='.$codigo.'&columnas='.$columnas.$fildat.'"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegtarifa["tarifacodigo"] =$tarifacodigo;
$iRegtarifa["cencoscodigo"] =$cencoscodigo;
$iRegtarifa["tipsolcodigo"] =$tipsolcodigo;
$iRegtarifa["tarifames"] =$tarifames;
$iRegtarifa["tarifaano"] =$tarifaano;
$iRegtarifa["tarifamod"] =$tarifamod;
$iRegtarifa["tarifamoi"] =$tarifamoi;
$iRegtarifa["tarifacdep"] =$tarifacdep;
$iRegtarifa["tarifasdep"] =$tarifasdep;
$iRegtarifa["tarifaene"] =$tarifaene;
$iRegtarifa["tarifaman"] =$tarifaman;
$iRegtarifa["tarifaotros"] =$tarifaotros ;

editatarifa($iRegtarifa,$flageditartarifa,$campnomb,$codigo,$fildat,$columnas);

?> 
