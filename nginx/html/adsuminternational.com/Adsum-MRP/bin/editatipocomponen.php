<?php 
include ( '../src/FunPerPriNiv/pktbltipocomponen.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/fncnombeditexs.php'); 
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php'); 
include ( '../def/tipocampo.php');

function editatipocomponen($iRegtipocomponen, &$flageditartipocomponen, &$campnomb, &$codigo) 
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
		
	if ($iRegtipocomponen) 
	{ 
		$iRegtabla["tablnomb"] = "tipocomponen";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "tipocomponen")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegtipocomponen))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "tipcomcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditartipoequipo = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);
			if($validar == 1) 
			{ 
				$flageditartipocomponen = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetatipocomponen($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditartipocomponen = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			/*
			if(($elementos[0] == 'tipcomnombre') || ($elementos[0] == 'tipcomacroni'))
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('tipocomponen', $iRegtipocomponen, $elementos[0], $elementos[1],
												   'tipcomcodigo', $iRegtipocomponen[tipcomcodigo], $nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditartipocomponen = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flageditartipocomponen = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}*/
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		 
		if($flagerror != 1) 
		{ 
			$result = uprecordtipocomponen($iRegtipocomponen,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditartipocomponen=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestabltipocomponen.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegtipocomponen[tipcomcodigo] = $tipcomcodigo; 
$iRegtipocomponen[tipcomnombre] = $tipcomnombre; 
$iRegtipocomponen[tipcomdescri] = $tipcomdescri; 
$iRegtipocomponen[tipcomcampo]  = $tipcomcampo;
$iRegtipocomponen[tipcomacroni] = $tipcomacroni;
editatipocomponen($iRegtipocomponen, $flageditartipocomponen, $campnomb, $codigo); 
if(!$flageditartipocomponen)
{
	if($arreglo_aux)
	{
		include('editatipocomponencamperequipo.php');
	}
}
?>