<?php 
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editagrupcapa($iReggrupcapa,&$flageditargrupcapa,&$campnomb,&$codigo)
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

	if ($iReggrupcapa) 
	{ 
		$iRegtabla["tablnomb"] = "grupcapa";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "grupcapa")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iReggrupcapa_b = $iReggrupcapa;
				
		while($elementos = each($iReggrupcapa))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "grucapcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditargrupcapa = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditargrupcapa = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetagrupcapa($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditargrupcapa = 1;
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
			$result = uprecordgrupcapa($iReggrupcapa,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditargrupcapa=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iReggrupcapa[grucapcodigo] = $grucapcodigo;
$iReggrupcapa[grucapnombre] = $grucapnombre;
$iReggrupcapa[grucapdescri] = $grucapdescri;

editagrupcapa($iReggrupcapa,$flageditargrupcapa,$campnomb,$codigo);

if(!$flageditargrupcapa)
{
	$idcon = fncconn();
	
	if($lstempleado)
	{
		include_once ( '../src/FunGen/fncnumprox.php');
		include_once ( '../src/FunGen/fncnumact.php');
		
		$result = delrecordinsgrupcapa($grucapcodigo, $idcon);
		
		$nuidtemp = fncnumact(106, $idcon);
		do
		{
			$nuresult = loadrecordinsgrupcapa($nuidtemp, $idcon);
			if($nuresult == e_empty)
				$insgrucodigo = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		
		$arrObject = explode(',', $lstempleado);
		
		for($i = 0; $i < count($arrObject); $i++)
		{
			$iReginsgrupcapa[insgrucodigo] = $insgrucodigo;
			$iReginsgrupcapa[grucapcodigo] = $grucapcodigo;
			$iReginsgrupcapa[usuacodi] = $arrObject[$i];
			$resultado = insrecordinsgrupcapa($iReginsgrupcapa,$idcon);
			
			$insgrucodigo ++;
		}
		$nuresult1 = fncnumprox(106,$insgrucodigo,$idcon);
	}
		
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgrupcapa.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}