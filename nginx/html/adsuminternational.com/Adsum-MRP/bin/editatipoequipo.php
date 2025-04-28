<?php 
include ( '../src/FunPerPriNiv/pktbltipoequipo.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/fncnombeditexs.php'); 
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php'); 
include ( '../def/tipocampo.php');

function editatipoequipo($iRegtipoequipo, &$flageditartipoequipo, &$campnomb, &$codigo) 
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
		
	if ($iRegtipoequipo) 
	{ 
		$iRegtabla["tablnomb"] = "tipoequipo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "tipoequipo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegtipoequipo))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "tipequcodigo")
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
				$flageditartipoequipo = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetatipoequipo($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditartipoequipo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
	/*		
			if(($elementos[0] == 'tipequnombre') || ($elementos[0] == 'tipequacroni'))
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('tipoequipo', $iRegtipoequipo, $elementos[0], $elementos[1],
												   'tipequcodigo', $iRegtipoequipo[tipequcodigo], $nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditartipoequipo = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flageditartipoequipo = 1;
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
			$result = uprecordtipoequipo($iRegtipoequipo,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditartipoequipo=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestabltipoequipo.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegtipoequipo[tipequcodigo] = $tipequcodigo; 
$iRegtipoequipo[tipequnombre] = $tipequnombre; 
$iRegtipoequipo[tipequdescri] = $tipequdescri; 
$iRegtipoequipo[tipequcampo]  = $tipequcampo;
$iRegtipoequipo[tipequacroni] = $tipequacroni;
editatipoequipo($iRegtipoequipo, $flageditartipoequipo, $campnomb, $codigo); 
if(!$flageditartipoequipo)
{
	if($arreglo_aux)
	{
		include('editatipoequipocamperequipo.php');
	}
}
?>