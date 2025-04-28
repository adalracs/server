<?php 
ini_set("display_errors", 1);
include ( '../src/FunPerPriNiv/pktblnoconformemp.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunGen/fncnombexs.php');
include ( '../def/tipocampo.php');

function editanocomformemp(&$iRegnocomformemp,&$flageditarnocomformemp,&$campnomb,&$codigo)
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
	
	if ($iRegnocomformemp) 
	{ 
		$iRegtabla["tablnomb"] = "noconformemp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "noconformemp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegnocomformemp_b = $iRegnocomformemp;

		while($elementos = each($iRegnocomformemp))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != 'nocomcodigo')
				{

					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{

								$campnomb[$elementos[0]] = 1;
								$flagnuevonoconformemp = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{

				$flagnuevonoconformemp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetanoconformemp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				
				$flagnuevonoconformemp = 1;
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
			$result = uprecordnoconformemp($iRegnocomformemp,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarnocomformemp=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iRegnoconformemp["nocomcodigo"] = $nocomcodigo;
$iRegnoconformemp["analiscodigo"] = $analiscodigo;
$iRegnoconformemp["usuacodi1"] = $usuacodi;
$iRegnoconformemp["usuacodi2"] = $usuacodigo;
$iRegnoconformemp["nocomfecha"] = date("Y-m-d");
$iRegnoconformemp["nocomhora"] = date("H:i:s");
$iRegnoconformemp["nocomdescri"] = $nocomdescri;

editanocomformemp($iRegnoconformemp,$flageditarnocomformemp,$campnomb,$codigo);

if(!$flageditarnocomformemp){

	$idcon = fncconn();

	delrecorddocumentnoconformemp($iRegnoconformemp["nocomcodigo"],$idcon);
	if($uploadocumen) $objsuploadocumen = explode("::", $uploadocumen); else unset($objsuploadocumen);
	if($uploadocumensize) $objsuploadocumensize = explode("::", $uploadocumensize); else unset($objsuploadocumensize);

	for($a = 0; $a < count($objsuploadocumen); $a++){

		$iRegdocumentnoconformemp["nocomcodigo"] = $iRegnoconformemp["nocomcodigo"];
		$iRegdocumentnoconformemp["uploadocumen"] = $objsuploadocumen[$a];
		$iRegdocumentnoconformemp["uploadocumensize"] = $objsuploadocumensize[$a];

		insrecorddocumentnoconformemp($iRegdocumentnoconformemp,$idcon);

	}

	fncconn($idcon);

	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablnoconformemp.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';


}

?> 
