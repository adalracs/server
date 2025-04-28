<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaclienteot
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegclienteot         Arreglo de datos. 
    $flagnuevoclienteot    Bandera de validaci�n 
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
	include ( '../src/FunPerPriNiv/pktblot.php');
	include("../src/FunPerPriNiv/pktblclienteot.php");
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombexs.php');

 function grabaclienteot($iRegclienteot,$iRegot,&$flagnuevoclienteot,&$campnomb){ 
		
	$nuconn = fncconn();
	if ($iRegclienteot){ 

		if($flagerror == 1){
			fncmsgerror(35);
		}
		if($flagerror != 1){ 
			$result = insrecordot($iRegot,$nuconn);
			$nuconn = fncconn();
			$result = insrecordtareot($iRegot,$nuconn);
			$nuconn = fncconn();
			$result = insrecordclienteot($iRegclienteot,$nuconn);
			
			if($result < 0 ){ 
				ob_end_clean(); 
				fncmsgerror(1); 
				$flagnuevoclienteot = 1; 
			} 
			if($result > 0){ 
				$nuresult1 = fncnumprox(34,$iRegot[ordtracodigo],$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				$nuresult1 = fncnumprox(38,$iRegot[tareacodigo],$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				//fncmsgerror(3); 
			} 
			fncclose($nuconn); 
		} 
	}
}	


if($ciudad && $clientsolici && $servicicodigo && $tareacodigo && $clientfecco && $clientfecsol && $prioricodigo && $ordtrafecini && $ordtrafecter){
	
	$foo1 = explode(":",$ordhorini.":".$ordminini);
	
	
	if($pasordmerini){
		if($foo1[0] != 12)
			$ordtrahorini = ($foo1[0] + 12).":".$foo1[1];
		if($foo1[0] == 12)
			$ordtrahorini = $foo1[0].":".$foo1[1];
	}elseif($foo1[0] == 12){
		$ordtrahorini = "00:".$foo1[1];
	}else{
		$ordtrahorini = $foo1[0].":".$foo1[1];
	}

	$foo1 = explode(":",$ordhorter.":".$ordminter);
	
	
	if($pasordmerter){
		if($foo1[0] != 12)
			$ordtrahorter = ($foo1[0] + 12).":".$foo1[1];
		if($foo1[0] == 12)
			$ordtrahorter = $foo1[0].":".$foo1[1];
	}elseif($foo1[0] == 12){
		$ordtrahorter = "00:".$foo1[1];
	}else{
		$ordtrahorter = $foo1[0].":".$foo1[1];
	}
	
	if(!$flagnuevoclienteot){
		
		
		$foo1 = explode(":",$horini.":".$minini);
		$foo2 = explode(":",$horfin.":".$minfin);
		
		if($pasadmerini){
			if($foo1[0] != 12)
				$clienthorsol = ($foo1[0] + 12).":".$foo1[1];
			if($foo1[0] == 12)
				$clienthorsol = $foo1[0].":".$foo1[1];				
		}elseif($foo1[0] == 12){
			$clienthorsol = "00:".$foo1[1];
		}else{
			$clienthorsol = $foo1[0].":".$foo1[1];
		}
		
		
		
		if($pasadmerfin){
			if($foo2[0] != 12)
				$clienthorco = ($foo2[0] + 12).":".$foo2[1];
			if($foo2[0] == 12)
				$clienthorco = $foo2[0].":".$foo2[1];
		}elseif($foo2[0] == 12){
			$clienthorco= "00:".$foo2[1];
		}else{
			$clienthorco = $foo2[0].":".$foo2[1];
		}
		
		$dateini = strtotime($ordtrafecini." ".$ordtrahorini);
		$dateact = strtotime($ordtrafecter. " ".$ordtrahorter);
		$df = $dateact - $dateini ;
		$datedif = round($df/60/60);
			
		$nuconn = fncconn();
		$nuidtemp = fncnumact(34,$nuconn);
		do{
			$nuresult = loadrecordot($nuidtemp,$nuconn);
			if($nuresult == e_empty){
				$iRegot[ordtracodigo] = $nuidtemp;
				$codigoot = $iRegot[ordtracodigo];
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
	
		$iRegot[ordtrafecgen] = date("Y-m-d");
		$iRegot[ordtrahorgen] = date("H:i");
		$iRegot[ordtrafecini] = $ordtrafecini;
		$iRegot[ordtrahorini] = $ordtrahorini;	
		$iRegot[ordtrafecfin] = $ordtrafecter;
		$iRegot[ordtrahorfin] = $ordtrahorter;
		$iRegot[ordtratipo] = 0;
		$iRegot[ordtraacti] = 1;	
		$iRegot[usuacodi] = $GLOBALS[usuacodi];
		$iRegot[servicicodigo] = $servicicodigo;
		
		$nuidtemp = fncnumact(38,$nuconn); 
		do{ 
			$nuresult = loadrecordtareot($nuidtemp,$nuconn); 
			if($nuresult == e_empty) 
			{ 
				$iRegot[tareotcodigo] = $nuidtemp; 
				$codigotareot = $iRegot[tareotcodigo];
			} 
			$nuidtemp ++; 
		}while ($nuresult != e_empty); 
	
		$iRegot[tareacodigo] = $tareacodigo;	
		if($clientdatcon)
			$iRegot[tareotnota] = $clientdatcon;
		else	
		$iRegot[tareotnota] = "CREADO";
		
		$iRegot[tareothorini] =$ordtrahorini;
		$iRegot[tareotfecini] = $ordtrafecini;
		$iRegot[tareothorfin] =$ordtrahorter;
		$iRegot[tareotfecfin] = $ordtrafecter;
		$iRegot[otestacodigo] = 1; //Estado Creado
		$iRegot[tareotsecuen] = 0;
		$iRegot[tareottiedur] = $datedif;
		$iRegot[prioricodigo] = $prioricodigo;
		$iRegot[tareotfecgen] = date("Y-m-d");
		$iRegot[tareothorgen] = date("H:i");
		$iRegot[tareotusuasi] = 'f';
		
		$iregClienteot[ordtracodigo] = $codigoot;
		$iregClienteot[clientsolici] = $clientsolici;
		$iregClienteot[clientfecsol] = $clientfecsol;
		$iregClienteot[clienthorsol] = $clienthorsol;
		$iregClienteot[clientfecco] = $clientfecco;
		$iregClienteot[clienthorco] = $clienthorco;
		$iregClienteot[clientnombre] = $clientnombre;
		$iregClienteot[clientdirecc] = $clientdirecc;
		$iregClienteot[clienttelefo] = $clienttelefo;
		$iregClienteot[clientmovil] = $clientmovil;
		$iregClienteot[clientcontac] = $clientcontac;
		$iregClienteot[clienttelcon] = $clienttelcon;
		$iregClienteot[clientcelcon] = $clientcelcon;
		$iregClienteot[clientdatcon] = $clientdatcon;
		$iregClienteot[clientimplan] = $clientimplan;
		$iregClienteot[ciudadcodigo] = $ciudad;
		$iregClienteot[clientdirecb] = $clientdirecb;
		$iregClienteot[clientdireca] = $clientdireca;		
		$iregClienteot[deptocodigo] = $departamento;
		$iregClienteot[segmencodigo] = $segmencodigo;
		$iregClienteot[subsegcodigo] = $subsegcodigo;
		$iregClienteot[clientvalpro] = $clientvalpro;
		
		grabaclienteot($iregClienteot,$iRegot,$flagnuevoclienteot,$campnomb); 
		
		
		if(!$flagnuevoclienteot){
			include_once( '../src/FunPerPriNiv/pktblotactividad.php');
			if($arreglo_act){
				$arrdetall = explode(";",$arreglo_act);
				$idcon = fncconn();
				
				for($i = 0; $i < count($arrdetall); $i++){
					$iRegotactividad[ordtracodigo] = $codigoot;
					$arr_data = explode(":",$arrdetall[$i]);
					
					$iRegotactividad[activicodigo] = $arr_data[0];
					$iRegotactividad[ordactcantid] = $arr_data[1];
						
					$result = insrecordotactividad($iRegotactividad,$idcon); 
				}
					
			}
		
			include_once( '../src/FunPerPriNiv/pktblotitem.php');
			if($arreglo_ite){
				$arrdetall1 = explode(";",$arreglo_ite);
				$idcon = fncconn();
				
				for($i = 0; $i < count($arrdetall1); $i++){
					$iRegotitem[ordtracodigo] = $codigoot;
					$arr_data = explode(":",$arrdetall1[$i]);
	
					$iRegotitem[itemcodigo] = $arr_data[0];
					$iRegotitem[orditecantid] = $arr_data[1];
						
					$result = insrecordotitem($iRegotitem,$idcon); 
				}
					
			}

		
	
			fncmsgerror(3);
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'location ="maestablproyotservicio.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
			unset($arreglo_ite);
			unset($arreglo_act);
		}
	}
}else{
	fncmsgerror(35); 
	$flagnuevoclienteot = 1;
}
?> 
