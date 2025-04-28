<?php 
	include ( '../src/FunPerPriNiv/pktbltipodespacho.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombeditexs.php');

function editatipodespacho($iRegtipodespacho,&$flageditartipodespacho,&$campnomb,&$codigo){ 
	
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
								$flageditartipodespacho = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1){ 
				$flageditartipodespacho = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetatipodespacho($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1){ 
				$flageditartipodespacho = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
			if($elementos[0]=='tipdesnombre'){
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
			}
		} 
		if($flagerror == 1){
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1){ 
			$result = uprecordtipodespacho($iRegtipodespacho,$nuconn); 
			
			if($result < 0 ){ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditartipodespacho=1; 
			} 
			if($result > 0){ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestabltipodespacho.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegtipodespacho[tipdescodigo] = $tipdescodigo; 
$iRegtipodespacho[tipdesnombre] = $tipdesnombre; 
$iRegtipodespacho[tipdesdescri] = $tipdesdescri;   
editatipodespacho($iRegtipodespacho,$flageditartipodespacho,$campnomb,$codigo); 
?> 