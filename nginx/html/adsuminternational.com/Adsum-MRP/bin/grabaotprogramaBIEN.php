<?php

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaotprograma
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$arrregtarequipo         Arreglo de datos.
Retorno         :
true	= 1
false	= 0
Autor           : cbedoya
Fecha           : 12-oct-2007
Historial de modificaciones
| Fecha     | Motivo				| Autor 	|
*/
	$flagotinicial = true;

	$codigoot=NULL;
	$codigotareot=NULL;
	
	include_once('../src/FunPerPriNiv/pktblot.php');
	include_once('../src/FunPerPriNiv/pktblhistoriaot.php');
	
	$idconn =fncconn();
	include_once('../src/FunPerPriNiv/pktblprogramacion.php');
	 
	$sbregLista=loadrecordfulltareaprogramacion($arrregtarequipo,$idconn);
  	
	include_once('../src/FunGen/fncsumdate.php');
	$datefin = fncsumdate($prografecini,$prograhorini,$sbregLista[tareottiedur]);
	$dateini = $prografecini."/".$prograhorini;

	$dateotini = explode("/",$dateini);
	
	$dateotfin=$sbregLista[prografechfutur];
	
	$dateotfin = explode("/",$sbregLista[prografechfutur]);
	
	
	$prografecgen = date("Y-m-d");
	$prograhorgen = date("H:i");
	$tipmancodigo = $sbregLista[tipmancodigo];
	$equipocodigo = $sbregLista[equipocodigo];
	$tipmedcodigo = $sbregLista[tipmedcodigo];
	$sistemcodigo = $sbregLista[sistemcodigo];
	$plantacodigo = $sbregLista[plantacodigo];
	$componcodigo = $sbregLista[componcodigo];
	$usuacodi = $sbregLista[usuacodi];

	$codigoprog = $sbregLista[progracodigo];

	$tareacodigo1 = $sbregLista[tareacodigo];
	$tiptracodigo1 = $sbregLista[tiptracodigo];
	$tareottiedur = $sbregLista[tareottiedur];
	$progranota1 = $sbregLista[tareotnota];
	
	$otestacodigo = $sbregLista[otestacodigo];
	$prioricodigo = $sbregLista[prioricodigo];
	//$tarparotcodigo = $sbregLista[parotcodigo];
	$ordtranumpro = $progranumgru+1;
	
	include_once('../src/FunPerPriNiv/pktblusuariotareot.php');

	$declare=1;
	$iregusuariotareot1 = buscarusuariotareottareotcodigo($sbregLista[tareotcodigo],$idconn);
	for($j = 0; $j< $iregusuariotareot1[cantidad]; $j++){
		if ($iregusuariotareot1[$j][usutarlider] == 't'){
			$empleacod = $iregusuariotareot1[$j][usuacodi]; 
		}else{
			if (!$arreglo_auxdef){
			 	$arreglo_auxdef = $iregusuariotareot1[$j][usuacodi];
			}else{
				$arreglo_auxdef =$arreglo_auxdef.",".$iregusuariotareot1[$j][usuacodi];
			}
		}
	}
	fncclose($idconn);
	include('grabaprogramot.php');
	
	$ircRecord[progracodigo] = $sbregLista[progracodigo];
	
	$ircRecord[prograhorini] =  date("H:i");
	
	$ircRecord[prograrepot]=0;	
	$ircRecord[progranumgru]=$progranumgru;		
	$nuconn =fncconn();		
	
	$arr_fecha = explode("-",$sbregLista[prografecini]);
	$comparativos = mktime(0,0,0,date("m"),date("d"),date("Y"));
	$timestamp2 = mktime(0,0,0,$arr_fecha[1],$arr_fecha[2],$arr_fecha[0]);
	
	if ($comparativos==$timestamp2) {
				
				$frecuencias="+1 day";
				$fechafutur=date("Y-m-d",strtotime($frecuencias,$timestamp2));
				
				$ircRecord[prografecini] =  $fechafutur;
				
				
			}	
			else {
					$ircRecord[prografecini] =  date("Y-m-d");
				}	
	
   		$sbSql = "SELECT  tipomedi.tipmeddescri,tipmedtiempo
			     FROM tipomedi WHERE  tipomedi.tipmedcodigo= ".$sbregLista[tipmedcodigo];
		
		$nuResult = pg_exec($nuconn,$sbSql);
		
		$sbRow = pg_fetch_row($nuResult,0);
	switch ($sbRow[1]){
							case 1:	//Minutos
								
								$timestamp2 = mktime($arr_hora[0],$arr_hora[1],0,0,0,0);
								$frecuencias="+".$sbregLista[prografrecue]."minutes";
						        $fechafutur=date("H:i",strtotime($frecuencias,$timestamp2));
						        
								
								break;
							case 2:	//Horas
								
								
								$timestamp1 = mktime(date('H'),date('i'),0,0,0,0); 
								$timestamp2 = mktime($arr_hora[0],$arr_hora[1],0,0,0,0);
								$frecuencias="+".$sbregLista[prografrecue]."hours";
						        $fechafutur=date("H:i",strtotime($frecuencias,$timestamp2));
						        
								
								break;
							case 3:	//Dias
								$timestamp2 = mktime($arr_hora[0],$arr_hora[1],0,$arr_fecha[1],$arr_fecha[2],$arr_fecha[0]);
								$frecuencias="+".($sbRow[0]*$sbregLista[prografrecue])."day";
								$fechafutur=date("Y-m-d",strtotime($frecuencias,$timestamp2));
						       
								break;
}
   if ($fechafutur=='') {
   $ircRecord[prografechfutur]=$ircRecord[prografecini];
   }
   $progran[numecodi]=231;
				   $progran[numedesc]='progranumgru';
				   $progran[numeprox]=$progranumgru+1;
				  $actualnume=uprecordnumerado($progran,$nuconn);
	$ircRecord[prografechfutur]=$fechafutur;	
	$ircRecord[progranumgru]=	$progran[numeprox];	

	

	$nuResult = uprecordprogramacion($ircRecord,$nuconn);
	fncclose($nuconn);
		
	if($cantequipo==1){
		
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert(\'Grabado exitoso\');'."\n";
		//echo 'location ="maestablprogramacion.php?codigo='.$codigo.';"';

		echo '//-->'."\n";
		echo '</script>';
		echo "<script language='JavaScript'>";
		
		
		echo "	window.open('detallanuevaprogramacionprint.php?ordtranumpro=".$progranumgru."'   ,'text','status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=520');";
		echo "</script>";		
		 
		$idcon=fncconn();
		$resultnumgrup = fncnumprox(98,$progranumgru,$idcon);
		fncclose($idcon);
	}

?>