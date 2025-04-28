<?php

include ( '../src/FunPerPriNiv/pktblitemdesa.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include( '../src/FunGen/fncnombeditexs.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../def/tipocampo.php');

function editaitemcalidad($iRegitemcalidad,&$flageditaritemcalidad,&$campnomb,&$codigo, $flagerror)
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

	if ($iRegitemcalidad) 
	{ 
		$iRegtabla["tablnomb"] = "itemdesa";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "itemdesa")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegitemcalidad_b = $iRegitemcalidad;
				
		while($elementos = each($iRegitemcalidad))
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
								$flageditaritemcalidad = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditaritemcalidad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetaitemdesa($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditaritemcalidad = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		
		if($flagerror != 1)
		{
			$result = uprecorditemdesa3($iRegitemcalidad,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditaritemcalidad=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablitemcalidad.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegitemcalidad["itedescodigo"] = $itedescodigo;
$iRegitemcalidad["tipitemcodigo"] = $tipitemcodigo;
$iRegitemcalidad["itedesespeci"] = $itedesespeci;


if(!$tipitemcodigo){

	$flagerror = 1;
	$campnomb["tipitemcodigo"] = 1;
	$flageditaritemcalidad = 1;
}

editaitemcalidad($iRegitemcalidad,$flageditaritemcalidad,$campnomb,$codigo, $flagerror);
?> 
