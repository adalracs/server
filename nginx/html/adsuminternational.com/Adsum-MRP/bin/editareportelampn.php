<?php 
include ( '../src/FunPerPriNiv/pktblreportelampn.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editareportelampn($iRegreportelampn,&$flageditarreportelampn,&$campnomb,&$codigo)
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

	if ($iRegreportelampn) 
	{ 
		$iRegtabla["tablnomb"] = "reportelampn";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "reportelampn")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegreportelampn_b = $iRegreportelampn;
				
		while($elementos = each($iRegreportelampn))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "relapncodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarreportelampn = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarreportelampn = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetareportelampn($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarreportelampn = 1;
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
			$result = uprecordreportelampn($iRegreportelampn,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarreportelampn=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iRegreportelampn[relapncodigo] = $relapncodigo;
$iRegreportelampn[patestcodigo] = $patestcodigo;
$iRegreportelampn[equipocodigo] = $equipocodigo;
$iRegreportelampn[usuacodi] = $usuacodi;
$iRegreportelampn[relapnfecha] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegreportelampn[relapnhora] = $hora;
$iRegreportelampn[relapndescri] = $relapndescri;
//validacion de campos personalizados
include 'validacamperequipopn.php';

editareportelampn($iRegreportelampn,$flageditarreportelampn,$campnomb,$codigo);

	if(!$flagnuevoreportelampn)
	{
		$idcon = fncconn();
		delrecordcpeqpndetope($relapncodigo,$idcon);
		include 'grabacamperequipopn.php';
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablreportelampn.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';		
		fncclose($idcon);
	}
?> 
