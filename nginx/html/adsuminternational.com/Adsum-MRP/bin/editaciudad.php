<?php 
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');
function editaciudad($iRegciudad,&$flageditarciudad,&$campnomb,&$codigo) 
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
	if ($iRegciudad) 
	{ 
		$iRegtabla["tablnomb"] = "ciudad";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "ciudad")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegciudad))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "ciudadcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarciudad = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				$flageditarciudad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetaciudad($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarciudad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
			if($elementos[0]=='ciudadnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('ciudad',$iRegciudad,$elementos[0],$elementos[1],'ciudadcodigo',$iRegciudad[ciudadcodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarciudad = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flageditarciudad = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;					
				}
			}
		} 
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1) 
		{ 
			$result = uprecordciudad($iRegciudad,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarciudad=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablciudad.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegciudad[ciudadcodigo] = $ciudadcodigo; 
$iRegciudad[ciudadnombre] = $ciudadnombre; 
$iRegciudad[ciudaddescri] = $ciudaddescri; 
editaciudad($iRegciudad,$flageditarciudad,$campnomb,$codigo); 
?> 
