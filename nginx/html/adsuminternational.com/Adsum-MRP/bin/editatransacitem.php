<?php 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/fncvaliddate.php');
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
function editatransacitem($iRegtransacitem,$iRegvalidaitem,&$flageditartransacitem,&$campnomb,&$codigo) 
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
	define("errorIng",35);
	 
	if ($iRegtransacitem) 
	{ 
		$iRegtabla["tablnomb"] = "transacitem";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "transacitem")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegtransacitem))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "transitecodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditartransacitem = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);
			if($validar == 1) 
			{  
				$flageditartransacitem = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			}
			
			$validresult = consulmetatransacitem($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditartransacitem = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0] == "transitecantid" && (($elementos[1] < 0) || ($elementos[1] == "")))
			{
				fncmsgerror(validcan); 
				$flagnuevotransacitem = 1; 
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
				$validfecha = fncvaliddate($iRegtransacitem[transitefecha]);
				if ($validfecha > 0 )
				{
					if($iRegtransacitem[itemcodigo] && $iRegtransacitem[transitecantid])
					{
						$validdispon = validadisponibilidad($iRegvalidaitem,$iRegtransacitem[transitecantid],$iRegtransacitem[tipmovcodigo],$iRegtransacitem[transitecodigo],$nuconn);
						
						if($validdispon > 0)
						{
							$result = uprecordtransacitem($iRegtransacitem,$nuconn); 
							if($result < 0 ) 
							{ 
								ob_end_clean(); 
								fncmsgerror(errorReg); 
								$flageditartransacitem=1; 
							} 
							if($result > 0) 
							{ 
								fncmsgerror(editaEx); 
								echo '<script language="javascript">'; 
								echo '<!--//'."\n"; 
								echo 'location ="maestabltransacitem.php?codigo='.$codigo.';"'; 
								echo '//-->'."\n"; 
								echo '</script>'; 
							} 
						}else 
						{
							$flagnuevotransacitem=1;
						}
					}	
					else
					{
						fncmsgerror(errorReg);
						$flagnuevotransacitem=1;
					}
					fncclose($nuconn); 
				}else 
				{
					fncmsgerror(fecvalid); 
					$flagnuevotransacitem=1;
				}
		} 
	} 
} 
$transitetotal = $transitecantid * $itemvalor;
$iRegtransacitem[transitecodigo] = $transitecodigo; 
$iRegtransacitem[tipmovcodigo] = $tipmovcodigo; 
$iRegtransacitem[itemcodigo] = $itemcodigo; 
$iRegtransacitem[transitefecha] = $transitefecha; 
$iRegtransacitem[transitecantid] = $transitecantid; 
$iRegtransacitem[transitetotal] = $transitetotal; 
$iRegtransacitem[usuacodi] = $usuacodic; 
$iRegtransacitem[bodegacodigo] = $bodegacodigo; 
$iRegtransacitem[pedidocodigo] = $pedidocodigo; 
$iRegtransacitem[itestacodigo] = $itestacodigo; 

$iRegvalidaitem[itemcodigo] = $itemcodigo; 
$iRegvalidaitem[itemcanmin] = $itemcanmin;
$iRegvalidaitem[itemcanmax] = $itemcanmax;
$iRegvalidaitem[itemdispon] = $itemdispon;
editatransacitem($iRegtransacitem,$iRegvalidaitem,$flageditartransacitem,$campnomb,$codigo); 

/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : validadisponibilidad
Decripcion      : Valida y actualiza la tabla item
Parametros      : Descripicion 
    $arritem         Arreglo de datos. 
    $transaccan    	 cantidad
    $tipomovi		 Codigo de tipomovi
    $transitecodigo	 Codigo de la transacciï¿½n
    $idcon			 conexiï¿½n db
    
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : lfolaya 
Fecha           : 26012005
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
function validadisponibilidad($arritem,$transaccan,$tipomovi,$transitecodigo,$idcon)
{
	$sbregtipomovi = loadrecordtipomovi($tipomovi,$idcon);
	$sbregtransac = loadrecordtransacitem($transitecodigo,$idcon);
	$sbregtipmovtipo = loadrecordtipomovi($sbregtransac[tipmovcodigo],$idcon);
	
	if($arritem[itemcodigo] == $sbregtransac[itemcodigo])
	{
		if($sbregtipomovi[tipmovtipo] == $sbregtipmovtipo[tipmovtipo])
		{
			if($transaccan == $sbregtransac[transitecantid])
			{
				return 1;
			}else 
			{
				if($sbregtipomovi[tipmovtipo] > 0)
				{
					$sumitem = $arritem[itemdispon] - $sbregtransac[transitecantid] + $transaccan;	
					$result = validadatos($arritem,$sumitem,$idcon);
					return $result;
				}
				elseif ($sbregtipomovi[tipmovtipo] < 1)
				{
					$resitem = $arritem[itemdispon] + $sbregtransac[itemdispon] - $transaccan;
					$result = validadatos($arritem,$resitem,$idcon);
					return $result;
				}
			}
		}
		else 
		{
			if($sbregtipmovtipo[tipmovtipo] > 0)
			{
				$sumitem = $arritem[itemdispon] - $sbregtransac[transitecantid] - $transaccan;
				$result = validadatos($arritem,$sumitem,$idcon);
				return $result;
			}
			elseif ($sbregtipmovtipo[tipmovtipo] < 1)
			{
				$resitem = $arritem[itemdispon] + $sbregtransac[transitecantid] + $transaccan;
				$result = validadatos($arritem,$resitem,$idcon);
				return $result;
			}
		}
	}
	else
	{
		$sbregitem = loadrecorditem($sbregtransac[itemcodigo],$idcon);
		if($sbregtipmovtipo[tipmovtipo] == $sbregtipomovi[tipmovtipo])
		{
			if($sbregtipmovtipo[tipmovtipo] > 0)
			{
				$sumitem = $sbregitem[itemdispon] - $sbregtransac[transitecantid];
				$result = validadatos($sbregitem,$sumitem,$idcon);
				
				$sumitem1 = $arritem[itemdispon] + $transaccan;
				$result1 = validadatos($arritem,$sumitem,$idcon);
				return $result1;
				
			}else
			{
				if($sbregtipmovtipo[tipmovtipo] < 1)
				{
					$sumitem = $sbregitem[itemdispon] + $sbregtransac[transitecantid];
					$result = validadatos($sbregitem,$sumitem,$idcon);
					
					$sumitem1 = $arritem[itemdispon] + $transaccan;
					$result1 = validadatos($arritem,$sumitem1,$idcon);
					return $result1;
				}
			}
		}
		else 
		{
			if($sbregtipmovtipo[tipmovtipo] > 0)
			{
				$sumitem = $sbregitem[itemdispon] - $sbregtransac[transitecantid];
				$result = validadatos($sbregitem,$sumitem,$idcon);
				
				$sumitem1 = $arritem[itemdispon] - $transaccan;
				$result1 = validadatos($arritem,$sumitem1,$idcon);
				return $result1;
			}else
			{
				if($sbregtipmovtipo[tipmovtipo] < 1)
				{
					$sumitem = $sbregitem[itemdispon] + $sbregtransac[transitecantid];
					$result = validadatos($sbregitem,$sumitem,$idcon);
					
					$sumitem1 = $arritem[itemdispon] + $transaccan;
					$result1 = validadatos($arritem,$sumitem1,$idcon);
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
Decripcion      : valida si el dato es permitido y actualiza la tabla item 
Parametros      : Descripicion 
    $arritem         Arreglo de datos. 
    $tipomovi		 Codigo de tipomovi
    $idcon			 Conexiï¿½n db
    
Retorno         : 
		true	= 1 
		false	= -1 
Autor           : lfolaya 
Fecha           : 08022005
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
function validadatos($arritem,$result,$idcon)
{
	if($result >= 0)
	{
		
		updateitemdispon($arritem[itemcodigo],$result,$idcon);
		if($result > $arritem[itemcanmax])
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Execedio la capacidad máxima")';
			echo '//-->'."\n";
			echo '</script>';
			return 1;
		}
		elseif ($result < $arritem[itemcanmin])
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Execedio la capacidad minima")';
			echo '//-->'."\n";
			echo '</script>';
			return 1;
		}
		else 
		{
			return 1;
		}
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
?> 
