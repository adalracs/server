<?php 
	include_once('../src/FunPerPriNiv/pktblsemaforoestado.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombeditexs.php');

function editasemaforoestado($iRegsemaforoestado,&$flageditarsemaforoestado,&$campnomb,&$codigo){ 
	
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
	
	if ($iRegsemaforoestado){ 
		$iRegtabla["tablnomb"] = "semaforoestado";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++){
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "semaforoestado"){
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegsemaforoestado)){ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0){
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "semestcodigo"){
					if($sbregcampo["campnomb"] == $elementos[0]){
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0){
							if($elementos[1] == ""){
								$campnomb[$elementos[0]] = 1;
								$flageditarsemaforoestado = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1){ 
				$flageditarsemaforoestado = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetasemaforoestado($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1){ 
				$flageditarsemaforoestado = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
			/*if($elementos[0]=='tipdesnombre'){
				if($elementos[1] != null){
					$validnombre =  fncnombeditexs('tipodespacho',$iRegtipodespacho,$elementos[0],$elementos[1],'tipdescodigo',$iRegtipodespacho[tipdescodigo],$nuconn);
					
					if ($validnombre == 1){
						fncmsgerror(errorNombExs);
						$flageditartipodespacho = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else{
					$flageditartipodespacho = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;					
				}
			}*/
		} 
		if($flagerror == 1){
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1){ 
			$result = uprecordsemaforoestado($iRegsemaforoestado,$nuconn); 
			
			if($result < 0 ){ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarsemaforoestado=1; 
			} 
			if($result > 0){ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablsemaforoestado.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 

if($semestverde >= $semestnaranj  or $semestnaranj >= $semestrojo or $semestrojo >= $semestnegro or $semestnegro < $semestrojo){
	$flageditarsemaforoestado = 1;
	echo '<script language="javascript">'; 
	echo '<!--//'."\n"; 
	echo 'alert("Error:\n Verifique la información")'; 
	echo '//-->'."\n"; 
	echo '</script>'; 
	
	if($semestverde >= $semestnaranj)
		$campnomb[semestverde] = 1;
	if($semestnaranj >= $semestrojo )
		$campnomb[semestnaranj] = 1;
	if($semestrojo >= $semestnegro)
		$campnomb[semestrojo] = 1;
	if($semestnegro < $semestrojo)
		$campnomb[semestnegro] = 1;
	
}else{

	$iRegsemaforoestado[semestcodigo] = $semestcodigo; 
	$iRegsemaforoestado[semestverde] = $semestverde; 
	$iRegsemaforoestado[semestnaranj] = $semestnaranj;  
	$iRegsemaforoestado[semestrojo] = $semestrojo;
	$iRegsemaforoestado[semestnegro] = $semestnegro; 
	editasemaforoestado($iRegsemaforoestado,$flageditarsemaforoestado,$campnomb,$codigo);                                   
}
?> 