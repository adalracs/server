<?php 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/fncvaliddate.php');
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function editatransacherramie($iRegtransacherramie,$iRegvalidaherramie,&$flageditartransacherramie,&$campnomb,&$codigo) 
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
	define("validcan",11); 
	
	if ($iRegtransacherramie)
	{
		while($elementos = each($iRegtransacherramie))
		{
			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				fncmsgerror(errorCar);
				$flageditartransacherramie = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}
			
			$validresult = consulmetatransacherramie($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditartransacherramie = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				unset ($validresult);
				break;
			}
			
			if($elementos[0] == "transhercanti" && $elementos[1] < 0)
			{
				fncmsgerror(validcan); 
				$flagnuevotransacherramie = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			}
		}
		if($flagerror != 1)
		{
			$validfecha = fncvaliddate($iRegtransacherramie[transherfecha]);
			if ($validfecha > 0 )
			{
				if($iRegtransacherramie[herramcodigo] && $iRegtransacherramie[transhercanti])
				{ 
					$validdispon = validadisponibilidad($iRegvalidaherramie,$iRegtransacherramie[transhercanti],$iRegtransacherramie[tipmovcodigo],$iRegtransacherramie[transhercodigo],$nuconn);
					if($validdispon > 0)
					{
						$result = uprecordtransacherramie($iRegtransacherramie,$nuconn);
						if($result < 0 )
						{
							ob_end_clean();
							fncmsgerror(errorReg);
							$flageditartransacherramie=1;
						}
						if($result > 0)
						{
							fncmsgerror(editaEx);
							echo '<script language="javascript">';
							echo '<!--//'."\n";
							echo 'location ="maestabltransacherramie.php?codigo='.$codigo.';"';
							echo '//-->'."\n";
							echo '</script>';
						}
						
					}else 
					{
						$flagnuevotransacherramie = 1;
					}
				}else
				{
					fncmsgerror(errorReg);
					$flagnuevotransacherramie = 1;
				}
				fncclose($nuconn);
			}else 
			{
				fncmsgerror(fecvalid); 
				$flagnuevotransacherramie = 1;
			}
		}
	}
}
$transhertotal = $transhercanti * $herramvalor;
$iRegtransacherramie[transhercodigo] = $transhercodigo;
$iRegtransacherramie[tipmovcodigo] = $tipmovcodigo; 
$iRegtransacherramie[herramcodigo] = $herramcodigo; 
$iRegtransacherramie[transherfecha] = $transherfecha; 
$iRegtransacherramie[transhercanti] = $transhercanti; 
$iRegtransacherramie[transhertotal] = $transhertotal; 
$iRegtransacherramie[usuacodi] = $usuacodic; 
$iRegvalidaherramie[tipmovcodigo] = $tipmovcodigo; 
$iRegvalidaherramie[transhercanti] = $transhercanti; 
$iRegvalidaherramie[herramcodigo] = $herramcodigo;
$iRegvalidaherramie[herramdispon] = $herramdispon;
editatransacherramie($iRegtransacherramie,$iRegvalidaherramie,$flageditartransacherramie,$campnomb,$codigo); 

/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : validadisponibilidad
Decripcion      : Valida y actualiza la tabla herramie
Parametros      : Descripicion 
    $arrherramie         Arreglo de datos. 
    $transaccan    	 cantidad
    $tipomovi		 Codigo de tipomovi
    
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : lfolaya 
Fecha           : 26012005
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
function validadisponibilidad($arrherramie,$transaccan,$tipomovi,$transhercodigo,$idcon)
{
	$sbregtipomovi = loadrecordtipomovi($tipomovi,$idcon);
	$sbregtransac = loadrecordtransacherramie($transhercodigo,$idcon);
	$sbregtipmovtipo = loadrecordtipomovi($sbregtransac[tipmovcodigo],$idcon);
	
	if($arrherramie[herramcodigo] == $sbregtransac[herramcodigo])	
	{
		if($sbregtipomovi[tipmovtipo] == $sbregtipmovtipo[tipmovtipo])
		{
			if($transaccan == $sbregtransac[transhercanti])
			{
				return 1;
			}else 
			{
				if($sbregtipomovi[tipmovtipo] > 0)
				{
					$sumherramie = $arrherramie[herramdispon] - $sbregtransac[transhercanti] + $transaccan;	
					$result = validadatos($arrherramie,$sumherramie,$idcon);
					return $result;
				}
				elseif ($sbregtipomovi[tipmovtipo] < 1)
				{
					$resherramie = $arrherramie[herramdispon] + $sbregtransac[herramdispon] - $transaccan;
					$result = validadatos($arrherramie,$resherramie,$idcon);
					return $result;
				}
			}
		}
		else 
		{
			if($sbregtipmovtipo[tipmovtipo] > 0)
			{
				$sumherramie = $arrherramie[herramdispon] - $sbregtransac[transhercanti] - $transaccan;
				$result = validadatos($arrherramie,$sumherramie,$idcon);
				return $result;
			}
			elseif ($sbregtipmovtipo[tipmovtipo] < 1)
			{
				$resherramie = $arrherramie[herramdispon] + $sbregtransac[transhercanti] + $transaccan;
				$result = validadatos($arrherramie,$resherramie,$idcon);
				return $result;
			}
		}
	}
	else
	{
		$sbregherramie = loadrecordherramie($sbregtransac[herramcodigo],$idcon);
		if($sbregtipmovtipo[tipmovtipo] == $sbregtipomovi[tipmovtipo])
		{
			if($sbregtipmovtipo[tipmovtipo] > 0)
			{
				$sumherramie = $sbregherramie[herramdispon] - $sbregtransac[transhercanti];
				$result = validadatos($sbregherramie,$sumherramie,$idcon);
				
				$sumherramie1 = $arrherramie[herramdispon] + $transaccan;
				$result1 = validadatos($arrherramie,$sumherramie1,$idcon);
				return $result1;
				
			}else
			{
				if($sbregtipmovtipo[tipmovtipo] < 1)
				{
					$sumherramie = $sbregherramie[herramdispon] + $sbregtransac[transhercanti];
					$result = validadatos($sbregherramie,$sumherramie,$idcon);
					
					$sumherramie1 = $arrherramie[herramdispon] + $transaccan;
					$result1 = validadatos($arrherramie,$sumherramie1,$idcon);
					return $result1;
				}
			}		
		}
		else 
		{
			if($sbregtipmovtipo[tipmovtipo] > 0)
			{
				$sumherramie = $sbregherramie[herramdispon] - $sbregtransac[transhercanti];
				$result = validadatos($sbregherramie,$sumherramie,$idcon);
				
				$sumherramie1 = $arrherramie[herramdispon] - $transaccan;
				$result1 = validadatos($arrherramie,$sumherramie1,$idcon);
				return $result1;
			}else
			{
				if($sbregtipmovtipo[tipmovtipo] < 1)
				{
					$sumherramie = $sbregherramie[herramdispon] + $sbregtransac[transhercanti];
					$result = validadatos($sbregherramie,$sumherramie,$idcon);
					
					$sumherramie1 = $arrherramie[herramdispon] + $transaccan;
					$result1 = validadatos($arrherramie,$sumherramie1,$idcon);
					return $result1;
				}
			}
		}
	}
}

/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : validadatos
Decripcion      : valida si el dato es permitido y actualiza la tabla herramie 
Parametros      : Descripicion 
    $arritem         Arreglo de datos. 
    $tipomovi		 Codigo de tipomovi
    $idcon			 Conexi�n db
Retorno         : 
		true	= 1 
		false	= -1 
Autor           : lfolaya 
Fecha           : 08022005
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
function validadatos($arrherramie,$result,$idcon)
{
	if($result >= 0)
	{
		
		updateherramiedispon($arrherramie[herramcodigo],$result,$idcon);
		return 1;
	}
	else
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Cantidad no permitida")';
		echo '//-->'."\n";
		echo '</script>';
		return -1;
	}
	
}	
	/*
	if($sbregtipomovi[tipmovtipo] > 0)
	{
		$sumherramie = $arrherramie[herramdispon] + $transaccan;
		if($sumherramie >= 0)
		{
			updateherramiedispon($arrherramie[herramcodigo],$sumherramie,$idcon);
			return 1;
		}
		else
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Cantidad no permitida")';
			echo '//-->'."\n";
			echo '</script>';
			return -1;
		}
	}
	elseif ($sbregtipomovi[tipmovtipo] < 1)
	{
		$resherramie = $arrherramie[herramdispon] - $transaccan;
		if($resherramie >= 0)
		{
			updateherramiedispon($arrherramie[herramcodigo],$resherramie,$idcon);
			return 1;
		}else
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Cantidad no permitida")';
			echo '//-->'."\n";
			echo '</script>';
			return -1;
		}
	}
	*/

?> 
