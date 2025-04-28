<?php 
include ( '../src/FunPerPriNiv/pktblrecepcionmercancia.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include( '../src/FunGen/fncnombeditexs.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../def/tipocampo.php');

function editarecepcionmercancia($iRegrecepcionmercancia,&$flageditarrecepcionmercancia,&$campnomb,&$codigo)
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
	
	if ($iRegrecepcionmercancia) 
	{ 
		$iRegtabla["tablnomb"] = "recepcionmercancia";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "recepcionmercancia")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegrecepcionmercancia_b = $iRegrecepcionmercancia;
		
		while($elementos = each($iRegrecepcionmercancia))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "recmercodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarrecepcionmercancia = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarrecepcionmercancia = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetarecepcionmercancia($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarrecepcionmercancia = 1;
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

			$result = uprecordrecepcionmercancia($iRegrecepcionmercancia,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarrecepcionmercancia=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablrecepcionmercancia.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegrecepcionmercancia["recmercodigo"] = $recmercodigo;
$iRegrecepcionmercancia["itedescodigo"] = $itedescodigo;
$iRegrecepcionmercancia["lotecodigo"] = $lotecodigo;
$iRegrecepcionmercancia["unidadcodigo"] = $unidadcodigo;
$iRegrecepcionmercancia["recmercantidad"] = $recmercantidad;
$iRegrecepcionmercancia["recmerordcomp"] = $recmerordcomp;
$iRegrecepcionmercancia["recmernoir"] = $recmernoir;
$iRegrecepcionmercancia["recmernofact"] = $recmernofact;
$iRegrecepcionmercancia["bodegacodigo"] = $bodegacodigo;
$iRegrecepcionmercancia["recmercertificado"] = $recmercertificado;
	
editarecepcionmercancia($iRegrecepcionmercancia,$flageditarrecepcionmercancia,$campnomb,$codigo);

?> 
