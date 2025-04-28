<?php 
include ( '../src/FunPerPriNiv/pktblbodega.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');
function editabodega($iRegbodega,&$flageditarbodega,&$campnomb,&$codigo, $bodegacodigo1)
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

	if ($iRegbodega) 
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
		$iRegbodega_b = $iRegbodega;
				
		while($elementos = each($iRegbodega))
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
								$flageditarbodega = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarbodega = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetabodega($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarbodega = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='bodeganombre')
			{
				$validnombre =  fncnombeditexs('bodega',$iRegbodega_b,$elementos[0],$elementos[1],'bodegacodigo',$iRegbodega[bodegacodigo],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditarbodega = 1;
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
			$iRegbodega['bodegacodigoa'] = $bodegacodigo1;
			$result = uprecordbodega($iRegbodega,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarbodega=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablbodega.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegbodega[bodegacodigo] = $bodegacodigo;
$iRegbodega[bodeganombre] = $bodeganombre;
$iRegbodega[bodegaencargado] = $usuacodigo;
$iRegbodega[bodegaubicac] = $bodegaubicac;
$iRegbodega[bodegacapaci] = $bodegacapaci;
$iRegbodega[bodeganota] = $bodeganota;
$iRegbodega[cencoscodigo] = $cencoscodigo;
$iRegbodega[bodegatipo] = $bodegatipo;
//$iRegbodega[ciudadcodigo] = $ciudadcodigo;
editabodega($iRegbodega,$flageditarbodega,$campnomb,$codigo, $bodegacodigo1);
?> 
