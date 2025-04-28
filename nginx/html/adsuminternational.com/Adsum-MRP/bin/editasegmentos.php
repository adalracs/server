<?php 
	include ( '../src/FunPerPriNiv/pktblsegmentos.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombeditexs.php');

function editasegmentos($iRegsegmentos,&$flageditarsegmentos,&$campnomb,&$codigo){ 
	
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
	
	if ($iRegsegmentos){ 
		$iRegtabla["tablnomb"] = "segmentos";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++){
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "segmentos"){
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegsegmentos)){ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0){
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "segmencodigo"){
					if($sbregcampo["campnomb"] == $elementos[0]){
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0){
							if($elementos[1] == ""){
								$campnomb[$elementos[0]] = 1;
								$flageditarsegmentos = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1){ 
				$flageditarsegmentos = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetasegmentos($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1){ 
				$flageditarsegmentos = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
			if($elementos[0]=='segmennombre'){
				if($elementos[1] != null){
					$validnombre =  fncnombeditexs('segmentos',$iRegsegmentos,$elementos[0],$elementos[1],'segmencodigo',$iRegsegmentos[segmencodigo],$nuconn);
					
					if ($validnombre == 1){
						fncmsgerror(errorNombExs);
						$flageditarsegmentos = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else{
					$flageditarsegmentos = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;					
				}
			}
		} 
		if($flagerror == 1){
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1){ 
			$result = uprecordsegmentos($iRegsegmentos,$nuconn); 
			
			if($result < 0 ){ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarsegmentos=1; 
			} 
			if($result > 0){ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablsegmentos.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegsegmentos[segmencodigo] = $segmencodigo; 
$iRegsegmentos[segmennombre] = $segmennombre; 
$iRegsegmentos[segmendescri] = $segmendescri; 
editasegmentos($iRegsegmentos,$flageditarsegmentos,$campnomb,$codigo); 
?> 