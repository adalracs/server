<?php 
include ( '../src/FunPerPriNiv/pktblcierreot.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 

function editacierreot($iRegcierreot,&$flageditarcierreot,&$campnomb,&$codigo) 
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
	define("errorIng",35);
	  
	if ($iRegcierreot) 
	{ 
		$iRegtabla["tablnomb"] = "cierreot";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "cierreot")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegcierreot))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "cierotcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarcierreot = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarcierreot = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetacierreot($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarcierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if ($elementos[0] == "cierotdescri" && $elementos[1] == null)
			{
				$flageditarcierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}			
			
			if ($elementos[0] == "tipcumcodigo" && $elementos[1] == null)
			{
				$flageditarcierreot = 1;
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
			$result = uprecordcierreot($iRegcierreot,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarcierreot=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablcierreot.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegcierreot[cierotcodigo] = $cierotcodigo; 
$iRegcierreot[usuacodi] = $usuacodigo; 
$iRegcierreot[tipcumcodigo] = $tipcumcodigo; 
$iRegcierreot[reportcodigo] = $reportcodigo; 
$iRegcierreot[cierotfecfin] = $cierotfecfin; 
$iRegcierreot[cierothorfin] = $cierothorfin; 
$iRegcierreot[cierotdescri] = $cierotdescri;
editacierreot($iRegcierreot,$flageditarcierreot,$campnomb,$codigo); 
?> 
