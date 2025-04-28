<?php 
include ( '../src/FunPerPriNiv/pktblactividades.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaactividades($iRegactividades,$iRegactividades1,&$flageditaractividades,&$campnomb,&$codigo) 
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
	
	if ($iRegactividades){ 
		$iRegtabla["tablnomb"] = "actividades";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "actividades")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegactividades))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "activicodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditaractividades = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				$flageditaractividades = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetaactividades($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditaractividades = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
		/*	if($elementos[0]=='activinombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('actividades',$iRegactividades,$elementos[0],$elementos[1],'activicodigo',$iRegactividades[activicodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditaractividades = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flageditaractividades = 1;
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
			$result = uprecordactividades($iRegactividades,$iRegactividades1,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditaractividades=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablactividades.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegactividades[activicodigo] = $activicodigo; 
$iRegactividades1[activicodigo] = $activicodigo1; 
$iRegactividades[activinombre] = $activinombre; 
$iRegactividades[actividescri] = $actividescri; 
$iRegactividades[activivalbar] = $activivalbar; 
$iRegactividades[clasecodigo] = $clasecodigo;
$iRegactividades[unidadcodigo] = $unidadcodigo;

editaactividades($iRegactividades,$iRegactividades1,$flageditaractividades,$campnomb,$codigo); 
?> 
