<?php 
include ( '../src/FunPerPriNiv/pktblfestivo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editafestivo($iRegfestivo,&$flageditarfestivo,&$campnomb,&$codigo)
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
	
	if ($iRegfestivo)
	{ 
		$iRegtabla["tablnomb"] = "festivo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "festivo")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}
		
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegfestivo))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "festivcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarfestivo = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1)
			{ 
				$flageditarfestivo = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetafestivo($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{ 
				$flageditarfestivo = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
			
			/*
			if($elementos[0]=='festivnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('festivo',$iRegfestivo,$elementos[0],$elementos[1],'festivcodigo',$iRegfestivo[festivcodigo],$nuconn);
					
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarfestivo = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flageditarfestivo = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;					
				}
			}
			*/
		} 
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = uprecordfestivo($iRegfestivo,$nuconn); 
			
			if($result < 0 )
			{			
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarfestivo=1; 
			} 
			if($result > 0)
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablfestivo.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
}

$iRegfestivo[festivcodigo] = $festivcodigo; 
$iRegfestivo[festivnombre] = $festivnombre; 
$iRegfestivo[festivdescri] = $festivdescri; 
$iRegfestivo[festivdia] = $festivdia;
$iRegfestivo[festivmes] = $festivmes;
$iRegfestivo[festivano] = $festivano;
$iRegfestivo[festivtodano] = $festivtodano;

if(!$festivano)
	$iRegfestivo[festivtodano] = 1;

$iRegfestivo[festivmovdia] = $festivmovdia;
$iRegfestivo[festivtipo] = $festivtipo;
	
editafestivo($iRegfestivo,$flageditarfestivo,$campnomb,$codigo); 