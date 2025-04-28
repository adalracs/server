<?php
//ini_set('display_errors',1);
include ( '../src/FunPerPriNiv/pktblreporteopp.php');
include ( '../src/FunPerPriNiv/pktbloe.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaoe($iRegoe,&$flageditaroe,&$campnomb,&$codigo)
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

	if ($iRegoe) 
	{ 
		$iRegtabla["tablnomb"] = "oe";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "oe")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegoe_b = $iRegoe;
				
		while($elementos = each($iRegoe))
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
								$flageditaroe = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditaroe = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetaoe($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditaroe = 1;
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
			$result = uprecordoe1($iRegoe,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditaroe=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iRegoe[ordentcodigo] = $ordentcodigo;
$iRegoe[plantacodigo] = $plantacodigo;
$iRegoe[usuacodi] = $usuacodi;
$iRegoe[ordentnumept] = $ordentnumept;
$iRegoe[ordentdescri] = $ordentdescri;

editaoe($iRegoe,$flageditaroe,$campnomb,$codigo);

if(!$flageditaroe)
{
	
	$idcon = fncconn();
	
	if($arroe) $arrObjsoe = explode(',',$arroe);
	if($arroe1) $arrObjsoe1 = array_flip(explode(',',$arroe1));
	
	for( $a = 0; $a < count($arrObjsoe); $a++)
	{
		if(!array_key_exists($arrObjsoe[$a], $arrObjsoe1))
		{
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjsoe[$a],$idcon);
			uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 4/*estado entregado*/),$idcon);
		}
	}
	
	
	if($arroe) $arrObjsoe = array_flip(explode(',',$arroe));
	if($arroe1) $arrObjsoe1 = explode(',',$arroe1);
	
	for( $a = 0; $a < count($arrObjsoe1); $a++)
	{
		if(!array_key_exists($arrObjsoe1[$a], $arrObjsoe))
		{
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjsoe1[$a],$idcon);
			uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 3/*estado entregado*/),$idcon);
		}
	}
	
	fncclose($idcon);
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestabloe.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
	
}

?> 
