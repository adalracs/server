<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaclasifallelec
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegclasifallelec         Arreglo de datos. 
    $flagnuevoclasifallelec    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktblclasifallelec.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
 
function grabaclasifallelec($iRegclasifallelec,&$flagnuevoclasifallelec,&$campnomb, &$cfalelcode)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",110); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do{ 
		$nuresult = loadrecordclasifallelec($nuidtemp,$nuconn); 
		if($nuresult == e_empty){ 
			$iRegclasifallelec[cfalelcodigo] = $nuidtemp; 
			$cfalelcode = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
	if ($iRegclasifallelec)
	{ 
		$iRegtabla["tablnomb"] = "clasifallelec";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "clasifallelec")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegclasifallelec_b = $iRegclasifallelec;
		
		while($elementos = each($iRegclasifallelec))
		{
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num > 0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "cfalelcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoclasifallelec = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			
			if($validar == 1)
			{ 
				$flagnuevoclasifallelec = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			} 
			$validresult = consulmetaclasifallelec($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{ 
				$flagnuevoclasifallelec = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			} 

			/*if($elementos[0]=='cfalelnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('clasifallelec',$iRegclasifallelec_b,$elementos[0],$elementos[1],$nuconn);
					
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoclasifallelec = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevoclasifallelec = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}*/
		}
		 
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = insrecordclasifallelec($iRegclasifallelec,$nuconn); 
			
			if($result < 0 )
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoclasifallelec = 1; 
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

$iRegclasifallelec[cfalelcodigo] = $cfalelcodigo; 
$iRegclasifallelec[cfalelnombre] = $cfalelnombre; 
$iRegclasifallelec[cfaleldescri] = $cfaleldescri; 
$iRegclasifallelec[cfalelhcolor] = $cfalelhcolor; 

grabaclasifallelec($iRegclasifallelec,$flagnuevoclasifallelec,$campnomb, $cfalelcode); 

if(!$flagnuevoclasifallelec)
{
	include_once '../src/FunPerPriNiv/pktblrangofallelec.php';
	$idcon = fncconn();
	$irecRangofallelec['cfalelcodigo'] = $cfalelcode;
	$irecRangofallelec['ranfeltipo'] = 1;
	$irecRangofallelec['ranfelvalini'] = unfmtCurrency($ranfelvalini1);
	$irecRangofallelec['ranfelvalfin'] = unfmtCurrency($ranfelvalfin1);
	
	insrecordrangofallelec($irecRangofallelec, $idcon);

	$irecRangofallelec['cfalelcodigo'] = $cfalelcode;
	$irecRangofallelec['ranfeltipo'] = 2;
	$irecRangofallelec['ranfelvalini'] = unfmtCurrency($ranfelvalini2);
	$irecRangofallelec['ranfelvalfin'] = unfmtCurrency($ranfelvalfin2);
	
	insrecordrangofallelec($irecRangofallelec, $idcon);
}