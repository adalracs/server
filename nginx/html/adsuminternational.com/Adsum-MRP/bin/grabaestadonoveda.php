<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaestadonoveda
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegestadonoveda         Arreglo de datos. 
    $flagnuevoestadonoveda    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktblestadonoveda.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');
 
function grabaestadonoveda($iRegestadonoveda,&$flagnuevoestadonoveda,&$campnomb)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",106); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do{ 
		$nuresult = loadrecordestadonoveda($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
			$iRegestadonoveda[estnovcodigo] = $nuidtemp; 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
	if ($iRegestadonoveda)
	{ 
		$iRegtabla["tablnomb"] = "estadonoveda";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "estadonoveda")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		$iRegestadonoveda_to = $iRegestadonoveda; 
		
		while($elementos = each($iRegestadonoveda))
		{
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "estnovcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoestadonoveda = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			
			if($validar == 1)
			{ 
				$flagnuevoestadonoveda = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}

			$validresult = consulmetaestadonoveda($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{			
				$flagnuevoestadonoveda = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			} 
			
			
			if($elementos[0]=='estnovnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('estadonoveda',$iRegestadonoveda_to,$elementos[0],$elementos[1],$nuconn);
					
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoestadonoveda = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevoestadonoveda = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = insrecordestadonoveda($iRegestadonoveda,$nuconn); 
			
			if($result < 0 )
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoestadonoveda = 1; 
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

$iRegestadonoveda[estnovcodigo] = $estnovcodigo; 
$iRegestadonoveda[estnovnombre] = $estnovnombre; 
$iRegestadonoveda[estnovacroni] = $estnovacroni; 
$iRegestadonoveda[estnovdescri] = $estnovdescri; 
$iRegestadonoveda[estnovactusu] = 0;

if($estnovactusu)
	$iRegestadonoveda[estnovactusu] = 1;

grabaestadonoveda($iRegestadonoveda,$flagnuevoestadonoveda,$campnomb);