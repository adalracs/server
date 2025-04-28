<?php 
	include ( '../src/FunPerPriNiv/pktblsubzona.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombeditexs.php');

function editasubzona($iRegsubzona,&$flageditarsubzona,&$campnomb,&$codigo){ 
	
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
	define("errorNombExs",18);
	define("errorIng",35);
	
	if ($iRegsubzona){ 
		$iRegtabla["tablnomb"] = "subzona";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++){
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "subzona"){
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegsubzona)){ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0){
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "subzoncodigo"){
					if($sbregcampo["campnomb"] == $elementos[0]){
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0){
							if($elementos[1] == ""){
								$campnomb[$elementos[0]] = 1;
								$flageditarsubzona = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1){ 
				$flageditarsubzona = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetasubzona($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1){ 
				$flageditarsubzona = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
			/*
			if($elementos[0]=='subzonnombre'){
				if($elementos[1] != null){
					$validnombre =  fncnombeditexs('subzona',$iRegsubzona,$elementos[0],$elementos[1],'subzoncodigo',$iRegsubzona[subzoncodigo],$nuconn);
					
					if ($validnombre == 1){
						fncmsgerror(errorNombExs);
						$flageditarsubzona = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else{
					$flageditarsubzona = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;					
				}
			}*/
		} 
		if($flagerror == 1){
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1){ 
			$result = uprecordsubzona($iRegsubzona,$nuconn); 
			
			if($result < 0 ){ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarsubzona=1; 
			} 
			if($result > 0){ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablsubzona.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegsubzona[subzoncodigo] = $subzoncodigo; 
$iRegsubzona[subzonnombre] = $subzonnombre; 
$iRegsubzona[subzondescri] = $subzondescri; 
$iRegsubzona[zonacodigo] = $zonacodigo; 

editasubzona($iRegsubzona,$flageditarsubzona,$campnomb,$codigo); 
?> 
