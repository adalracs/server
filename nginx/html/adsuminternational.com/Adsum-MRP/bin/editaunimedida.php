<?php 
include ( '../src/FunPerPriNiv/pktblunimedida.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');
function editaunimedida($iRegunimedida,&$flageditarunimedida,&$campnomb,&$codigo, $unidadcodigo)
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
	define("errorAcrExs",21);
	define("errorIng",35);

	if ($iRegunimedida) 
	{ 
		$iRegtabla["tablnomb"] = "unimedida";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "unimedida")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegunimedida_b = $iRegunimedida;
				
		while($elementos = each($iRegunimedida))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "unidadcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarunimedida = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarunimedida = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetaunimedida($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarunimedida = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='unidadnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('unimedida',$iRegunimedida_b,$elementos[0],$elementos[1],
					'unidadcodigo',$iRegplano[unidadcodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarunimedida = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flagnuevounimedida = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			
			if($elementos[0]=='unidadacra')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('unimedida',$iRegunimedida_b,$elementos[0],$elementos[1],
					'unidadcodigo',$iRegplano[unidadcodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorAcrExs);
						$flageditarunimedida = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flagnuevounimedida = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$iRegunimedida['unidadcodigoa'] = $unidadcodigo;
			$result = uprecordunimedida($iRegunimedida,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarunimedida=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablunimedida.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegunimedida[unidadcodigo] = $unidadcodigo;
$iRegunimedida[unidadnombre] = $unidadnombre;
$iRegunimedida[unidadacra] = $unidadacra;
$iRegunimedida[unidaddescri] = $unidaddescri;
editaunimedida($iRegunimedida,$flageditarunimedida,$campnomb,$codigo, $unidadcodigo1);
?> 
