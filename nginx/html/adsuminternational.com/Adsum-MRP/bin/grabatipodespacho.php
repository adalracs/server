<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabasegmento
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegsegmento         Arreglo de datos. 
    $flagnuevosegmento    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktbltipodespacho.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
 
function grabatipodespacho($iRegtipodespacho,&$flagnuevotipodespacho,&$campnomb){ 
	$nuconn = fncconn(); 
	
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",103); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);
	$nuidtemp = fncnumact(	id,$nuconn); 
	do{ 
		$nuresult = loadrecordtipodespacho($nuidtemp,$nuconn); 
		if($nuresult == e_empty){ 
			$iRegtipodespacho[tipdescodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
		
	}while ($nuresult != e_empty); 
	
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegtipodespacho){ 
		$iRegtabla["tablnomb"] = "tipodespacho";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		
		for($i=0;$i<$num;$i++){
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "tipodespacho"){
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegtipodespacho)){
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0){
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "tipdescodigo"){
					if($sbregcampo["campnomb"] == $elementos[0]){
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0){
							if($elementos[1] == ""){
								$campnomb[$elementos[0]] = 1;
								$flagnuevotipodespacho = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			
			if($validar == 1){ 
				$flagnuevotipodespacho = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			} 
			$validresult = consulmetatipodespacho($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1){ 
				$flagnuevotipodespacho = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			} 
			
			if($elementos[0]=='tipdesnombre'){
				if($elementos[1] != null){
					$validnombre =  fncnombexs('tipodespacho',$iRegtipodespacho,$elementos[0],$elementos[1],$nuconn);
					
					if ($validnombre == 1){
						fncmsgerror(errorNombExs);
						$flagnuevotipodespacho = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else{
					$flagnuevotipodespacho = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		} 
		if($flagerror == 1){
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1){ 
			$result = insrecordtipodespacho($iRegtipodespacho,$nuconn); 
			
			if($result < 0 ){ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevotipodespacho = 1; 
			} 
			if($result > 0){ 
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegtipodespacho[tipdescodigo] = $tipdescodigo; 
$iRegtipodespacho[tipdesnombre] = $tipdesnombre; 
$iRegtipodespacho[tipdesdescri] = $tipdesdescri; 
grabatipodespacho($iRegtipodespacho,$flagnuevotipodespacho,$campnomb);     
?> 