<?php
//ini_set('display_errors',1);
include ( '../src/FunPerPriNiv/pktblreporteopp.php');
include ( '../src/FunPerPriNiv/pktbllistaempaque.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editalistaempaque($iReglistaempaque,&$flageditarlistaempaque,&$campnomb,&$codigo)
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

	if ($iReglistaempaque) 
	{ 
		$iRegtabla["tablnomb"] = "listaempaque";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "listaempaque")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iReglistaempaque_b = $iReglistaempaque;
				
		while($elementos = each($iReglistaempaque))
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
								$flageditarlistaempaque = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarlistaempaque = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetalistaempaque($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarlistaempaque = 1;
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
			$result = uprecordlistaempaque1($iReglistaempaque,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarlistaempaque=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iReglistaempaque[lisempcodigo] = $lisempcodigo;
$iReglistaempaque[plantacodigo] = $plantacodigo;
$iReglistaempaque[usuacodi] = $usuacodi;
$iReglistaempaque[lisempnumept] = $lisempnumept;
$iReglistaempaque[lisempdireccion] = $lisempdireccion;
$iReglistaempaque[lisempdescri] = $lisempdescri;

editalistaempaque($iReglistaempaque,$flageditarlistaempaque,$campnomb,$codigo);

if(!$flageditarlistaempaque)
{
	
	$idcon = fncconn();
	
	if($arrlistaempaque) $arrObjslistaempaque = explode(',',$arrlistaempaque);
	if($arrlistaempaque1) $arrObjslistaempaque1 = array_flip(explode(',',$arrlistaempaque1));
	
	for( $a = 0; $a < count($arrObjslistaempaque); $a++)
	{
		if(!array_key_exists($arrObjslistaempaque[$a], $arrObjslistaempaque1))
		{
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjslistaempaque[$a],$idcon);
			uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 6/*estado Recibido*/),$idcon);
		}
	}
	
	
	if($arrlistaempaque) $arrObjslistaempaque = array_flip(explode(',',$arrlistaempaque));
	if($arrlistaempaque1) $arrObjslistaempaque1 = explode(',',$arrlistaempaque1);
	
	for( $a = 0; $a < count($arrObjslistaempaque1); $a++)
	{
		if(!array_key_exists($arrObjslistaempaque1[$a], $arrObjslistaempaque))
		{
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjslistaempaque1[$a],$idcon);
			uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 4/*estado entregado*/),$idcon);
		}
	}
	
	fncclose($idcon);
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestabllistaempaque.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
	
}

?> 
