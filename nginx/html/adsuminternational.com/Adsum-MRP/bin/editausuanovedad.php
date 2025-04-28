<?php 
if(!$noAjax):
	include '../src/FunPerSecNiv/fncconn.php';
	include '../src/FunPerSecNiv/fncclose.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetch.php';
endif;

include ( '../src/FunPerPriNiv/pktblusuanovedad.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editausuanovedad($iRegusuanovedad,&$flageditarusuanovedad,&$campnomb,&$codigo)
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
	
	if ($iRegusuanovedad)
	{ 
		$iRegtabla["tablnomb"] = "usuanovedad";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "usuanovedad")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}
		
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegusuanovedad))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "usunovcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarusuanovedad = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1)
			{ 
				$flageditarusuanovedad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetausuanovedad($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{ 
				$flageditarusuanovedad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
		} 
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = uprecordusuanovedad($iRegusuanovedad,$nuconn); 
			
			if($result < 0 )
			{			
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarusuanovedad=1; 
			} 
			if($result > 0)
			{ 
//				fncmsgerror(editaEx); 
//				echo '<script language="javascript">'; 
//				echo '<!--//'."\n"; 
//				echo 'location ="maestablusuanovedad.php?codigo='.$codigo.';"'; 
//				echo '//-->'."\n"; 
//				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
}

$iRegusuanovedad[usunovcodigo] = $usunovcodigo; 
$iRegusuanovedad[estnovcodigo] = $estnovcodigo; 
$iRegusuanovedad[usuacodi] = $usuacodigo; 
$iRegusuanovedad[usunovfecini] = $usunovfecini; 
$iRegusuanovedad[usunovfecfin] = $usunovfecfin; 
$iRegusuanovedad[usunovhorini] = $usunovhorini; 
$iRegusuanovedad[usunovhorfin] = $usunovhorfin; 
$iRegusuanovedad[usunovdescri] = $usunovdescri; 

editausuanovedad($iRegusuanovedad,$flageditarusuanovedad,$campnomb,$codigo);

if(!$flageditarusuanovedad)
{
	if($arrhecode)
	{
		include_once ( '../src/FunGen/fncnumprox.php');
		include_once ( '../src/FunGen/fncnumact.php');
		include_once '../src/FunPerPriNiv/pktblusunovhorext.php';
		
		$array_tmp = explode(',',$arrhecode);
		$array_key = array_flip($array_tmp);
		
		$idcon = fncconn();
		$rs_usunovhorext = loadrecordusunovhorext($usunovcodigo, $idcon);
		
		for($a = 0; $a < count($rs_usunovhorext); $a++):
			if(!array_key_exists($rs_usunovhorext[$a]['ordtracodigo'], $array_key))
				delrecordusunovhorext($rs_usunovhorext[$a]['usnohecodigo'], $idcon);
			else
				$nocreate[$rs_horaextraot[$a]['hoexotcodigo']] = 1;  
		endfor;
		
		$nuidtemp = fncnumact(108, $idcon); 
		do{ 
			$nuresult = loadrecordusunovhorextcod($nuidtemp, $idcon); 
			if($nuresult == -3)
				$usnohecodigo = $nuidtemp; 
			$nuidtemp ++; 
		}while ($nuresult != -3); 
		
		
		for($b = 0; $b < count($array_tmp); $b++):
			if(!$nocreate[$array_tmp[$a]]):
				$iRegusunovhorext['usnohecodigo'] = $usnohecodigo;
				$iRegusunovhorext['hoexotcodigo'] = $array_tmp[$b];
				$iRegusunovhorext['usunovcodigo'] = $usunovcodigo;
				
				insrecordusunovhorext($iRegusunovhorext, $idcon);
			
				$usnohecodigo++;
			endif;
		endfor;
		
		$nuresult1 = fncnumprox(108,$usnohecodigo,$idcon);
		unset($arrhecode);
	}
}