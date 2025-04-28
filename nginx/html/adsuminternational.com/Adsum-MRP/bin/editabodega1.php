<?php 
include ( '../src/FunPerPriNiv/pktblbodega.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');
function editabodega1($iRegbodega1,&$flageditarbodega1,&$campnomb,&$codigo, $bodegacodigo1)
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

	if ($iRegbodega1) 
	{ 
		$iRegtabla["tablnomb"] = "bodega";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "bodega")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegbodega1_b = $iRegbodega1;
				
		while($elementos = each($iRegbodega1))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "bodegacodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarbodega1 = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarbodega1 = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetabodega($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarbodega1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='bodeganombre')
			{
				$validnombre =  fncnombeditexs('bodega',$iRegbodega1_b,$elementos[0],$elementos[1],'bodegacodigo',$iRegbodega1[bodegacodigo],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditarbodega1 = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$iRegbodega1['bodegacodigoa'] = $bodegacodigo1;
			$result = uprecordbodega($iRegbodega1,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarbodega1=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablbodega1.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegbodega1[bodegacodigo] = $bodegacodigo;
$iRegbodega1[bodeganombre] = $bodeganombre;
$iRegbodega1[bodegaencargado] = $usuacodigo;
$iRegbodega1[bodegaubicac] = $bodegaubicac;
$iRegbodega1[bodegacapaci] = $bodegacapaci;
$iRegbodega1[bodeganota] = $bodeganota;
$iRegbodega1[cencoscodigo] = $cencoscodigo;
$iRegbodega1[bodegatipo] = $bodegatipo;
//$iRegbodega1[ciudadcodigo] = $ciudadcodigo;
editabodega1($iRegbodega1,$flageditarbodega1,$campnomb,$codigo, $bodegacodigo1);
?> 
