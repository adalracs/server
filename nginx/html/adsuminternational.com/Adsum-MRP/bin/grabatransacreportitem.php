<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabatransacreportitem 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegtransacitem         Arreglo de datos. 
    $flagnuevotransacitem    Bandera de validación 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versión 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
| Fecha 	| Motivo																| Autor 	|
 10082005	  Usar esta funcion desde el archivo grabareportot, de tal   			 jcortes
			  manera que permitiera al usuario devolver las cantidades de los items
			  utilizadas en la Orden de trabajo.
*/ 
  
/*include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktbltransacitem.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php');*/
 
function grabatransacreportitem($iRegtransacitem,$iRegvalidaitem,&$flagnuevotransacitem,&$campnomb,&$transitecodigo)
{ 
	
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("idtransacitem",50); 
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

	$nuidtemp = fncnumact(idtransacitem,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordtransacitem($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegtransacitem[transitecodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	
	if ($iRegtransacitem) 
	{ 
		while($elementos = each($iRegtransacitem)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				echo "<br>".$elementos[0]." : ".$elementos[1];
				$flagnuevotransacitem = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetatransacitem($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevotransacitem = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
			if($elementos[0] == "transitecantid" && $elementos[1] < 0)
			{
				fncmsgerror(validcan); 
				$flagnuevotransacitem = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			}
			
		}
	 
		if($flagerror != 1)
		{
			if($iRegtransacitem[itemcodigo] && $iRegtransacitem[transitecantid])
			{
				$validdispon = validadisponibilidaditem($iRegvalidaitem,$iRegtransacitem[transitecantid],
				$iRegtransacitem[tipmovcodigo],$nuconn);
				if($validdispon > 0)
				{
					$result = insrecordtransacitem($iRegtransacitem,$nuconn);
					if($result < 0 )
					{
						ob_end_clean();
						fncmsgerror(errorReg);
						$flagnuevotransacitem=1;
					}					
					if($result > 0)
					{
						$transitecodigo = $iRegtransacitem[transitecodigo];
						$nuresult1 = fncnumprox(idtransacitem,$nuidtemp,$nuconn);
						//No utilice esta parte si va a utilizar la llave primaria como serial
						//fncmsgerror(grabaEx);
					}
				}else 
				{
					$flagnuevotransacitem=1;
				}
			}else
			{
				fncmsgerror(errorReg);
				$flagnuevotransacitem=1;
			}
			fncclose($nuconn);
		}
	} 
	
}
/*$transitetotal = $transitecantid * $itemvalor;
$iRegtransacitem[transitecodigo] = $transitecodigo; 
$iRegtransacitem[tipmovcodigo] = $tipmovcodigo; 
$iRegtransacitem[itemcodigo] = $itemcodigo; 
$iRegtransacitem[transitefecha] = $transitefecha; 
$iRegtransacitem[transitecantid] = $transitecantid; 
$iRegtransacitem[transitetotal] = $transitetotal; 
$iRegtransacitem[usuacodi] = $usuacodi; 

$iRegvalidaitem[itemcodigo] = $itemcodigo; 
$iRegvalidaitem[itemcanmin] = $itemcanmin;
$iRegvalidaitem[itemcanmax] = $itemcanmax;
$iRegvalidaitem[itemdispon] = $itemdispon;
grabatransacreportitem($iRegtransacitem,$iRegvalidaitem,$flagnuevotransacitem,$campnomb);*/

/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : validadisponibilidaditem
Decripcion      : Valida y actualiza la tabla item
Parametros      : Descripicion 
    $arritem         Arreglo de datos. 
    $transaccan    	 cantidad
    $tipomovi		 Codigo de tipomovi
    
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : lfolaya 
Fecha           : 26012005
Historial de modificaciones 
| Fecha 	| Motivo																| Autor 	| 
 12082005	  Usar esta funcion desde el archivo grabareportot, de tal   			 jcortes
			  manera que permitiera al usuario devolver las cantidades de los items
			  utilizadas en la Orden de trabajo.
*/ 
function validadisponibilidaditem($arritem,$transaccan,$tipomovi,$idcon)
{
	$sbregtipomovi = loadrecordtipomovi($tipomovi,$idcon);
	
	if($sbregtipomovi[tipmovtipo] > 0)
	{
		$sumitem = $arritem[itemdispon] + $transaccan;
		if($sumitem >= 0)
		{
			updateitemdispon($arritem[itemcodigo],$sumitem,$idcon);
			
			if($sumitem > $arritem[itemcanmax])
			{
				/*echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Execedio la capacidad máxima")';
				echo '//-->'."\n";
				echo '</script>';*/
				return 1;
			}
			elseif ($sumitem < $arritem[itemcanmin])
			{
				/*echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Execedio la capacidad minima")';
				echo '//-->'."\n";
				echo '</script>';*/
				return 1;
			}
			else 
			{
				return 1;
			}
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
	elseif ($sbregtipomovi[tipmovtipo] < 1)
	{
		
		$resitem = $arritem[itemdispon] - $transaccan;
		if($resitem >= 0)
		{
			updateitemdispon($arritem[itemcodigo],$resitem,$idcon);
					
			if($resitem > $arritem[itemcanmax])
			{
				/*echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Execedio la capacidad máxima")';
				echo '//-->'."\n";
				echo '</script>';*/
				return 1;
			}
			elseif ($resitem < $arritem[itemcanmin])
			{
				/*echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Execedio la capacidad minima")';
				echo '//-->'."\n";
				echo '</script>';*/
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
}
?>