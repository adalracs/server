<?php 
if(!$noAjax):
	include '../src/FunPerSecNiv/fncconn.php';
	include '../src/FunPerSecNiv/fncclose.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetch.php';
endif;

include ( '../src/FunPerPriNiv/pktblhorasextra.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editahorasextra($iReghorasextra,&$flageditarhorasextra,&$campnomb,&$codigo)
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
	
	if ($iReghorasextra)
	{ 
		$iRegtabla["tablnomb"] = "horasextra";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "horasextra")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}
		
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iReghorasextra))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "horextcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarhorasextra = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1)
			{ 
				$flageditarhorasextra = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetahorasextra($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{ 
				$flageditarhorasextra = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
		} 
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = uprecordhorasextra($iReghorasextra,$nuconn); 
			
			if($result < 0 )
			{			
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarhorasextra=1; 
			} 
			if($result > 0)
			{ 
//				fncmsgerror(editaEx); 
//				echo '<script language="javascript">'; 
//				echo '<!--//'."\n"; 
//				echo 'location ="maestablhorasextra.php?codigo='.$codigo.';"'; 
//				echo '//-->'."\n"; 
//				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
}

$iReghorasextra[horextcodigo] = $horextcodigo; 
$iReghorasextra[usuacodi] = $usuacodigo; 
$iReghorasextra[horextfecha] = $horextfecha; 
$iReghorasextra[horexthorini] = $horexthorini; 
$iReghorasextra[horexthorfin] = $horexthorfin; 
$iReghorasextra[horextdescri] = $horextdescri; 

editahorasextra($iReghorasextra,$flageditarhorasextra,$campnomb,$codigo);

if(!$flageditarhorasextra)
{
	include_once ( '../src/FunGen/fncnumprox.php');
	include_once ( '../src/FunGen/fncnumact.php');
	include_once '../src/FunPerPriNiv/pktblhoraextraot.php';
	
	if($arrheots)
	{
		$array_tmp = explode(',',$arrheots);
		$array_key = array_flip($array_tmp);
	
	
		$idcon = fncconn();
		$rs_horaextraot = loadrecordhoraextraot($horextcodigo, $idcon);
		
		for($a = 0; $a < count($rs_horaextraot); $a++):
			if(!array_key_exists($rs_horaextraot[$a]['ordtracodigo'], $array_key))
				delrecordhoraextraot($rs_horaextraot[$a]['hoexotcodigo'], $idcon);
			else
				$nocreate[$rs_horaextraot[$a]['ordtracodigo']] = 1;  
		endfor;
	
		$nuidtemp = fncnumact(107, $idcon); 
		do{ 
			$nuresult = loadrecordhoraextraotcod($nuidtemp, $idcon); 
			if($nuresult == -3)
				$hoexotcodigo = $nuidtemp; 
			$nuidtemp ++; 
		}while ($nuresult != -3); 
	

		for($a = 0; $a < count($array_tmp); $a++):
			if(!$nocreate[$array_tmp[$a]]):
				$iReghoraextraot['hoexotcodigo'] = $hoexotcodigo;
				$iReghoraextraot['ordtracodigo'] = $array_tmp[$a];
				$iReghoraextraot['horextcodigo'] = $horextcodigo;
				
				insrecordhoraextraot($iReghoraextraot, $idcon);
				$hoexotcodigo++;
			endif;
		endfor;
		
		$nuresult1 = fncnumprox(107,$hoexotcodigo,$idcon);
		unset($arrheots);
	}
}