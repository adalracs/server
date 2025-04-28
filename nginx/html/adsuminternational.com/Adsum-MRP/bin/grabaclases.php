<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaclases
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegclase         Arreglo de datos. 
    $flagnuevoclase    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktblclases.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
 
function grabaclases($iRegclases,&$flagnuevoclase,&$campnomb){ 
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
		$nuresult = loadrecordclases($nuidtemp,$nuconn); 
		if($nuresult == e_empty){ 
			$iRegclases[clasecodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegclases){ 
		$iRegtabla["tablnomb"] = "clases";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++){
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "clases"){
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegclases)){
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0){
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "clasecodigo"){
					if($sbregcampo["campnomb"] == $elementos[0]){
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0){
							if($elementos[1] == ""){
								$campnomb[$elementos[0]] = 1;
								$flagnuevoclase = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			
			if($validar == 1){ 
				$flagnuevoclase = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			} 
			$validresult = consulmetaclases($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1){ 
				$flagnuevoclase = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			} 
			
			if($elementos[0]=='clasenombre'){
				if($elementos[1] != null){
					$validnombre =  fncnombexs('clases',$iRegclases,$elementos[0],$elementos[1],$nuconn);
					
					if ($validnombre == 1){
						fncmsgerror(errorNombExs);
						$flagnuevoclase = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else{
					$flagnuevoclase = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		} 
		if($flagerror == 1){
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1){ 
			$result = insrecordclases($iRegclases,$nuconn); 
			
			if($result < 0 ){ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoclase = 1; 
			} 
			if($result > 0){ 
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegclases[clasecodigo] = $clasecodigo; 
$iRegclases[clasenombre] = $clasenombre; 
$iRegclases[clasedescri] = $clasedescri; 
$iRegclases[clasevalor] = $clasevalor; 

grabaclases($iRegclases,$flagnuevoclase,$campnomb); 
?> 
