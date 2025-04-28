<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaclienteot
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegclienteot         Arreglo de datos. 
    $flageditarclientot    Bandera de validaci�n 
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
	//include ( '../src/FunPerPriNiv/pktbltareot.php');
	//include("../src/FunPerPriNiv/pktblclienteot.php");
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombexs.php');

 function grabaclienteot($iRegclienteot,$iRegot,&$flageditarclientot,&$campnomb,$codigo){ 
		
	$nuconn = fncconn();
	if ($iRegclienteot){ 
		if($flagerror == 1){
			fncmsgerror(35);
		}
		if($flagerror != 1){ 
			$result = uprecordclienteot($iRegclienteot,$iRegot,$nuconn);
			
			if($result < 0 ){ 
				ob_end_clean(); 
				fncmsgerror(1); 
				$flageditarclientot = 1; 
			} 
			if($result > 0){ 
				//fncmsgerror(9); 
				fncmsgerror(9); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablotservicio.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	}
}	


if($ciudad && $clientsolici && $servicicodigo && $tareacodigo && $clientfecco && $clientfecsol && $prioricodigo && $segmencodigo){

	include_once('../src/FunGen/fncsumdate.php');
	include_once('../src/FunPerPriNiv/pktblrequeritiempo.php');
	
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
	
	$idcnx = fncconn();
	$iregciudad = loadrecordciudad($ciudad,$idcnx);
	$iregtarea = loadrecordtarea($tareacodigo,$idcnx);

	$iregrequeri[segmencodigo] = $segmencodigo;
	$iregrequeri[subsegcodigo] = $subsegcodigo;
	$iregrequeri[reqtieproceso] = $iregtarea[tareaproces];
	$iregrequeri[reqtietipciu] = $iregciudad[ciudadtipo];
	$iregrequeri[servicicodigo] = $servicicodigo;	
	
	$iregrequeriop[segmencodigo] = "=";
	$iregrequeriop[subsegcodigo] = "=";
	$iregrequeriop[reqtieproceso] = "=";
	$iregrequeriop[reqtietipciu] = "=";
	$iregrequeriop[servicicodigo] = "=";
	
	$sblista = dinamicscanoprequeritiempo($iregrequeri,$iregrequeriop,$idcnx);

	if($sblista > 0){
		$fechafin = explode("/", fncsumdate($ordtrafecini,$ordtrahorini,$sblista[0][reqtievalor]));
		
	}else{
		echo '<script language= "javascript">';
		echo '<!--//'."\n";
		echo 'alert("No se encontro requerimiento de tiempo para esta orden")';
		echo '//-->'."\n";
		echo '</script>';
		$flageditarclientot = 1;
	}
	
	
	if(!$flageditarclientot){
	
		$foo1 = explode(":",$horini.":".$minini);
	
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
		
		$foo2 = explode(":",$horfin.":".$minfin);
		
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
		
		$iRegot[tareothorini] =$ordtrahorini;
		$iRegot[tareotfecini] = $ordtrafecini;
		$iRegot[tareothorfin] =$fechafin[1];
		$iRegot[tareotfecfin] = $fechafin[0];
		$iRegot[ordtrafecini] = $ordtrafecini;
		$iRegot[ordtrahorini] = $ordtrahorini;	
		$iRegot[ordtrafecfin] = $fechafin[0];
		$iRegot[ordtrahorfin] = $fechafin[1];
		$iRegot[servicicodigo] = $servicicodigo;
		$iRegot[tareacodigo] = $tareacodigo;	
		$iRegot[prioricodigo] = $prioricodigo;
		$iRegot[tareottiedur] = $sblista[0][reqtievalor];
		
		$iregClienteot[ordtracodigo] = $ordtracodigo;
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
		
		grabaclienteot($iregClienteot,$iRegot,$flageditarclientot,$campnomb,$codigo); 

	}
}else{
	fncmsgerror(35); 
	$flageditarclientot = 1;
}
?> 
