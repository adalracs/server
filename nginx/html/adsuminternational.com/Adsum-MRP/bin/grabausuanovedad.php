<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabausuanovedad
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegusuanovedad         Arreglo de datos. 
    $flagnuevousuanovedad    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : cbedoya
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 30-November-2007
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblusuanovedad.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');
 
function grabausuanovedad($iRegusuanovedad,&$flagnuevousuanovedad,&$campnomb,&$usunovcode)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",105); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do{ 
		$nuresult = loadrecordusuanovedad($nuidtemp,$nuconn); 
		if($nuresult == e_empty)
		{
			$iRegusuanovedad[usunovcodigo] = $nuidtemp;
			$usunovcode = $nuidtemp;
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
	if ($iRegusuanovedad)
	{ 
		$iRegtabla["tablnomb"] = "usuanovedad";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "usuanovedad")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		$iRegusuanovedad_to = $iRegusuanovedad; 
		
		while($elementos = each($iRegusuanovedad))
		{
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "usunovcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevousuanovedad = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			
			if($validar == 1)
			{ 
				$flagnuevousuanovedad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}

			$validresult = consulmetausuanovedad($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{			
				$flagnuevousuanovedad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			}
		}
		
		if($iRegusuanovedad[usunovfecfin] && $iRegusuanovedad[usunovfecini]):
			include '../src/FunGen/fncdatediff.php';
			$datediff = datediff("d", $iRegusuanovedad[usunovfecini], $iRegusuanovedad[usunovfecfin]);
			
			if($datediff < 0):
				$flagnuevousuanovedad = 1; 
				$flagerror = 1; 
				
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("La fecha de inicio debe ser mayor a la fecha fin de la novedad")';
				echo '//-->'."\n";
				echo '</script>';
				
				$campnomb['usunovfecini'] = 1;
				$campnomb['usunovfecfin'] = 1;
				
			endif;
			
		endif;
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = insrecordusuanovedad($iRegusuanovedad,$nuconn); 
			
			if($result < 0 )
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevousuanovedad = 1; 
			} 
			if($result > 0)
			{ 
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
}

$iRegusuanovedad[usunovcodigo] = $usunovcodigo; 
$iRegusuanovedad[estnovcodigo] = $estnovcodigo; 
$iRegusuanovedad[usuacodi] = $usuacodigo; 
$iRegusuanovedad[usunovfecini] = $usunovfecini; 
$iRegusuanovedad[usunovfecfin] = $usunovfecfin; 
$iRegusuanovedad[usunovhorini] = $usunovhorini; 
$iRegusuanovedad[usunovhorfin] = $usunovhorfin; 
$iRegusuanovedad[usunovdescri] = $usunovdescri; 

grabausuanovedad($iRegusuanovedad,$flagnuevousuanovedad,$campnomb, $usunovcode);

if(!$flagnuevousuanovedad)
{
	if($arrhecode)
	{
		include_once '../src/FunPerPriNiv/pktblusunovhorext.php';
		$idcon = fncconn();
		
		$nuidtemp = fncnumact(108, $idcon); 
		do{ 
			$nuresult = loadrecordusunovhorextcod($nuidtemp, $idcon); 
			if($nuresult == -3)
				$usnohecodigo = $nuidtemp; 
			$nuidtemp ++; 
		}while ($nuresult != -3); 
		
		$sub_arrhecode = explode(',', $arrhecode);
		
		for($b = 0; $b < count($sub_arrhecode); $b++)
		{
			$iRegusunovhorext['usnohecodigo'] = $usnohecodigo;
			$iRegusunovhorext['hoexotcodigo'] = $sub_arrhecode[$b];
			$iRegusunovhorext['usunovcodigo'] = $usunovcode;
			
			insrecordusunovhorext($iRegusunovhorext, $idcon);
			
			$usnohecodigo++;
		}
		
		$nuresult1 = fncnumprox(108,$usnohecodigo,$idcon);
		unset($arrhecode);
	}
}