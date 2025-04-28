<?php
include ( '../src/FunPerPriNiv/pktblpuc.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editapuc($iRegpuc,&$flageditarpuc,&$campnomb,&$codigo)
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

	if ($iRegpuc) 
	{ 
		$iRegtabla["tablnomb"] = "puc";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla['tablnomb'] == "puc")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegpuc_b = $iRegpuc;
				
		while($elementos = each($iRegpuc))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "puccodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarpuc = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarpuc = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetapuc($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarpuc = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			unset ($validresult);
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = uprecordpuc($iRegpuc,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarpuc=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablpuc.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegpuc['puccodigo'] = $puccodigo;
$iRegpuc['pucnumero'] = $pucnumero;
$iRegpuc['pucnombre'] = $pucnombre;
$iRegpuc['pucdescri'] = $pucdescri;
$iRegpuc['tipcuecodigo'] = $tipcuecodigo;

editapuc($iRegpuc,$flageditarpuc,$campnomb,$codigo);

?> 
