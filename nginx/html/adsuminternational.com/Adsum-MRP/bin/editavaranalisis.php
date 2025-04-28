<?php 
ini_set("display_errors", 1);
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editavaranalisis($iRegvaranalisis,&$flageditarvaranalisis,&$campnomb,&$codigo,$flagerror)
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
	
	if ($iRegvaranalisis) 
	{ 
		$iRegtabla["tablnomb"] = "varanalisis";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "varanalisis")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegvaranalisis_b = $iRegvaranalisis;

		while($elementos = each($iRegvaranalisis))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "varanacodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{

								$campnomb[$elementos[0]] = 1;
								$flageditarvaranalisis = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			

			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 

				$flageditarvaranalisis = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}	

			$validresult = consulmetavaranalisis($elementos[0],$elementos[1],$nuconn);
	
			if ($validresult == 1)
			{
				$flageditarvaranalisis = 1;
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
			$result = uprecordvaranalisis($iRegvaranalisis,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarvaranalisis=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablvaranalisis.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegvaranalisis["varanacodigo"] = $varanacodigo;
$iRegvaranalisis["tipcalcodigo"] = $tipcalcodigo;
$iRegvaranalisis["tipitemcodigo"] = $tipitemcodigo;
$iRegvaranalisis["tipsolcodigo"] = $tipsolcodigo;
$iRegvaranalisis["varananombre"] = $varananombre;
$iRegvaranalisis["unidadcodigo"] = $unidadcodigo;
$iRegvaranalisis["usuacodi"] = $usuacodi;
$iRegvaranalisis["varanafecha"] = date("Y-m-d");
$iRegvaranalisis["varanatipespe"] = $varanatipespe;
$iRegvaranalisis["varanadescri"] = $varanadescri;

if( $varanatipespe == 1 || $varanatipespe == 5){

	unset($iRegvaranalisis["varanadetesp"]);
	$iRegvaranalisis["varanatolems"] = $varanatolems;
	$iRegvaranalisis["varanatolemn"] = $varanatolemn;

}else if( $varanatipespe == 2 ){

	unset($iRegvaranalisis["varanatolems"]);
	unset($iRegvaranalisis["varanatolemn"]);
	$iRegvaranalisis["varanadetesp"] = $varanadetespmayor;

}else if( $varanatipespe == 3 ){

	unset($iRegvaranalisis["varanatolems"]);
	unset($iRegvaranalisis["varanatolemn"]);
	$iRegvaranalisis["varanadetesp"] = $varanadetespmenor;

}else{

	unset($iRegvaranalisis["varanatolems"]);
	unset($iRegvaranalisis["varanatolemn"]);
	unset($iRegvaranalisis["varanadetesp"]);

}


if( $tipcalcodigo == 1 && !$tipitemcodigo ){

	$flagerror = 1;
	$campnomb["tipitemcodigo"] = 1;
	$flageditarvaranalisis = 1;

}else if( $tipcalcodigo == 2 && !$tipsolcodigo){

	$flagerror = 1;
	$campnomb["tipsolcodigo"] = 1;
	$flageditarvaranalisis = 1;

}

if( ( $varanatipespe == 1 || $varanatipespe == 5) && ( (!$varanatolems || !$varanatolemn) || ( validafloat4($varanatolems) > 0 || validafloat4($varanatolemn) > 0) ) ){

	$flagerror = 1;
	$campnomb["varanatolems"] = 1;
	$campnomb["varanatolemn"] = 1;
	$flageditarvaranalisis = 1;

}else if( $varanatipespe == 2 && ( !$varanadetespmayor || ( validafloat4($varanadetespmayor) > 0 ) ) ){

	$flagerror = 1;
	$campnomb["varanadetespmayor"] = 1;
	$flageditarvaranalisis = 1;

}else if( $varanatipespe == 3 && ( !$varanadetespmenor || ( validafloat4($varanadetespmenor) > 0 ) ) ){

	$flagerror = 1;
	$campnomb["varanadetespmenor"] = 1;
	$flageditarvaranalisis = 1;

}

editavaranalisis($iRegvaranalisis,$flageditarvaranalisis,$campnomb,$codigo,$flagerror);
?> 
