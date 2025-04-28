<?php 
include ( '../src/FunPerPriNiv/pktblcotizacione.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function editacotizacione($iRegcotizacione,&$flageditarcotizacione,&$campnomb,&$codigo) 
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
	define("errorNoPrvee",33);
	define("errorIng",35);
	 
	if ($iRegcotizacione)
	{ 
		$iRegtabla["tablnomb"] = "cotizacione";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "cotizacione")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegcotizacione))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "cotizacodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarcotizacione = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);
			if($validar == 1) 
			{  
				$flageditarcotizacione = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			}
			
			$validresult = consulmetacotizacione($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarcotizacione = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if (($elementos[0] == "cotiznombre") && ($elementos[1] == null))
			{
				$flageditarcotizacione = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			} 

			
			if (($elementos[0] == "proveecodigo") && ($elementos[1] == null))
			{
				$flageditarcotizacione = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if (($elementos[0] == "cotizafecha") && ($elementos[1] == null))
			{
				$flageditarcotizacione = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if (($elementos[0] == "cotizahora") && ($elementos[1] == null))
			{
				$flageditarcotizacione = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if (($elementos[0] == "cotizdescri") && ($elementos[1] == null))
			{
				$flageditarcotizacione = 1;
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
			$result = uprecordcotizacione($iRegcotizacione,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarcotizacione=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablcotizacione.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegcotizacione[cotizacodigo] = $cotizacodigo; 
$iRegcotizacione[proveecodigo] = $proveecodigo; 
$iRegcotizacione[usuacodi] = $empleacod; 
$iRegcotizacione[cotiznombre] = $cotiznombre; 
$iRegcotizacione[cotizafecha] = $cotizafecha; 
$iRegcotizacione[cotizahora] = $cotizahora; 
$iRegcotizacione[cotizdescri] = $cotizdescri; 
editacotizacione($iRegcotizacione,$flageditarcotizacione,$campnomb,$codigo); 
?> 
