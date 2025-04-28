<?php 
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaplanta($iRegplanta,&$flageditarplanta,&$campnomb,&$codigo)
{
	$nuconn = fncconn();
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("fecvalid",7);
	define("editaEx",9);
	define("errorNombExs",18);
	define("errorValneg",23);
	define("errorIng", 35);

	if ($iRegplanta)
	{
		$iRegtabla["tablnomb"] = "planta";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);

			if($sbregtabla[tablnomb] == "planta")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegplanta))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "plantacodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarplanta = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flageditarplanta = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			$validresult = consulmetaplanta($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarplanta = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0]=='plantanombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('planta',$iRegplanta,$elementos[0],$elementos[1],'plantacodigo',$iRegplanta[plantacodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarplanta = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flageditarplanta = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}

			if($elementos[0]=='plantacapaci' && $elementos[1] < 0)
			{
				fncmsgerror(errorValneg);
				$flageditarplanta = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = uprecordplanta($iRegplanta,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarplanta=1;
			}
			fncclose($nuconn);
		}
	}
}

if(empty($arreglo_aux))
{
	echo '<script language="JavaScript">'."\n";
	echo "<!--//"."\n";
	echo "alert('Debe escoger al menos un servicio');"."\n";
	echo "//-->"."\n";
	echo '</script>';
	$flageditarplanta = 1;
}
else 
{
	$iRegplanta[plantacodigo] = $plantacodigo;
	$iRegplanta[plantabieninmu] = $plantabieninmu;
	$iRegplanta[plantanombre] = $plantanombre;
	$iRegplanta[plantaencarg] = $plantaencarg;
	$iRegplanta[plantaubicac] = $plantaubicac;
	$iRegplanta[plantaarea]   = $plantaarea;
	$iRegplanta[plantadescri] = $plantadescri;
	$iRegplanta[ciudadcodigo] = $ciudadcodigo;
	$iRegplanta[plantaencman] = $plantaencman;
	$iRegplanta[plantacapaci] = $plantacapaci;
	$iRegplanta[unidadcodigo] = $unidadcodigo;
	editaplanta($iRegplanta,$flageditarplanta,$campnomb,$flagerror);
// -----------------------------	
	$plantacode = $plantacodigo;
	if(!$flageditarplanta)
	{ 
		include("editaservicioplanta.php");
			
		echo '<script language="JavaScript">'."\n";
		echo '<!--//'."\n";
		echo 'alert(\'Proceso exitoso\')'."\n";
		echo 'location ="maestablplanta.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
}
?> 
