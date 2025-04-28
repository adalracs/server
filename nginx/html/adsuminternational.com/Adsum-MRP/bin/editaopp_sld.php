<?php 
ini_set('display_errors',1);
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblprogramasellado.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function editaopp(&$iRegopp,&$flageditaropp,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",147);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorIng",35);

	if($iRegopp)
	{
		$iRegtabla["tablnomb"] = "opp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "opp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegopp_b = $iRegopp;

		while($elementos = each($iRegopp))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditaropp = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flageditaropp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetaopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flageditaropp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
		}
		
		if($flageditaropp == 1)
		{
			$flagerror = 1;
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		

		if($flagerror != 1)
		{
			
			$result = uprecordopp1($iRegopp,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditaropp=1;
			}
			if($result > 0)
			{
				fncmsgerror(grabaEx);	
			}
			fncclose($nuconn);
		}
	}

}

$iRegopp[ordoppcodigo] = $ordoppcodigo;
$iRegopp[usuacodi] = $usuacodi;
$iRegopp[ordoppcantkg] = $ordoppcantkg;
$iRegopp[ordoppanchot] = $ordoppanchot;
$iRegopp[equipocodigo] = $equipocodigo;
$iRegopp[plantacodigo] = $plantacodigo;
$iRegopp[ordoppcorte] = '0';
$iRegopp[ordoppcantmt] = $ordoppcantmt;
$iRegopp[ordoppancref] = $ordopprefile;
$iRegopp[ordoppcomfir] = 0;

/*
if(!$arrvelocidadpn)
{
	$campnomb['arrvelocidadpn'] = 1;
	$flageditaropp = 1;
}

if(!$arrajustepn)
{
	$campnomb['arrajustepn'] = 1;
	$flageditaropp = 1;
}
*/

if(!$proceddestin)
{
	$campnomb['proceddestin'] = 1;
	$flageditaropp = 1;
}

editaopp($iRegopp,$flageditaropp,$campnomb);

//al tener grabado exitoso se procede a actualar las op contenidas en la opp
if(!$flageditaropp)
{
	$idcon = fncconn();
	
	unset($arrObject);
	if($arrvelocidadpn) $arrObject = explode(',',$arrvelocidadpn);
	delrecordoppvelocidadpn($iRegopp['ordoppcodigo'],$idcon);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		$iRegoppvelocidadpn['ordoppcodigo'] = $iRegopp['ordoppcodigo'];
		$iRegoppvelocidadpn['velocicodigo'] = $arrObject[$a];
		insrecordoppvelocidadpn($iRegoppvelocidadpn,$idcon);
	}
	
	unset($arrObject);
	if($arrajustepn) $arrObject = explode(',',$arrajustepn);
	delrecordoppajustepn($iRegopp['ordoppcodigo'],$idcon);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		$iRegoppvelocidadpn['ordoppcodigo'] = $iRegopp['ordoppcodigo'];
		$iRegoppvelocidadpn['ajustecodigo'] = $arrObject[$a];
		insrecordoppajustepn($iRegoppvelocidadpn,$idcon);
	}
	
	//SE ACTUALIZAN LAS OP HIJAS DE LA OPP
	unset($arrObject);
	if($arrop) $arrObject = explode(',',$arrop);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		//variables a usar
		$obj_pistas = 'pista_'.$arrObject[$a];
    	//registro de a actualizar
    	$iRegop_opp[ordprocodigo] = $arrObject[$a];
    	$iRegop_opp[opestacodigo] = 2;//programada
    	$iRegop_opp[ordoppcodigo] = $iRegopp['ordoppcodigo'];
    	$iRegop_opp[proceddestin] = $proceddestin;
    	$iRegop_opp[equipocodigo] = $equipocodigo;
    	uprecordop_opp($iRegop_opp,$idcon);
	}
	
	fncclose($idcon);
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablbandejasellado.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}

?>