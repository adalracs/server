<?php
ini_set('display_errors',1); 
include ( '../src/FunPerPriNiv/pktblformulacion.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaformulacion(&$iRegformulacion,&$flageditarformulacion,&$campnomb,&$codigo)
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

	if ($iRegformulacion) 
	{ 
		$iRegtabla["tablnomb"] = "formulacion";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "formulacion")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegformulacion_b = $iRegformulacion;
				
		while($elementos = each($iRegformulacion))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "formulcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarformulacion = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarformulacion = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetaformulacion($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarformulacion = 1;
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
			$result = uprecordformulacion($iRegformulacion,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarformulacion=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablformulacion.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegformulacion[formulcodigo] = $formulcodigo;
$iRegformulacion[formulnumero] = $formulnumero;
$iRegformulacion[formulfecha] = $formulfecha;
$iRegformulacion[formulcapaa] = $formulcapaa;
$iRegformulacion[formulcapab] = $formulcapab;
$iRegformulacion[formulcapac] = $formulcapac;
$iRegformulacion[usuacodi] = $usuacodi;
$iRegformulacion[formulpadre] = $formulpadre;
$iRegformulacion[formulorden] = $formulorden;

editaformulacion($iRegformulacion,$flageditarformulacion,$campnomb,$codigo);

if(!$flageditarformulacion):
	
	$con = fncconn();
	
	if($arrformulacion) $arrObject = explode(':|:', $arrformulacion);
		$resulta = delrecorditemformul($iRegformulacion[formulcodigo],$con);
		for($i = 0; $i < count($arrObject); $i++):
			$arr = explode(':-:',$arrObject[$i]);
			$iRegItemformul[formulcodigo] = $iRegformulacion[formulcodigo];
			$iRegItemformul[itedescodigo] = $arr[0];
			$iRegItemformul[iteforporcen] = $arr[2];
			$iRegItemformul[iteforcapa] = $arr[1]; 
			$resultado = insrecorditemformul($iRegItemformul,$con);
		endfor;	
		
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablformulacion.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
		
		
	fncclose($con);

endif;
?> 
