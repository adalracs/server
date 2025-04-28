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
	include_once('../src/FunPerPriNiv/pktbltarea.php');
	include_once('../src/FunPerPriNiv/pktblhistoriaot.php');
	include_once( '../src/FunGen/fncnumprox.php');
	include_once ( '../src/FunGen/fncnumact.php');
	
	
	$idconn =fncconn();
	include_once('../src/FunPerPriNiv/pktblprogramacion.php');
	$sbregLista=loadrecordfulltareaprogramacion($arrregtarequipo,$idconn);
  
	//include_once('../src/FunGen/fncsumdate.php');
	$datefin = fncsumdate($prografecini,$prograhorini,$sbregLista[tareottiedur]);
	$dateini = $prografecini."/".$prograhorini;

	$dateotini = explode("/",$dateini);
	$dateotfin = explode("/",$datefin);
	
	
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
	$ordtranumpro = $progranumgru;
	
	
	
	include_once('../src/FunPerPriNiv/pktblusuariotareot.php');

	$declare = 1;
	
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
	
	//include('grabaprogramot.php');
	
	$ircRecord[progracodigo] = $sbregLista[progracodigo];
	$datenewprogram = fncsumdate($prografecini,$prograhorini,$frechors);
	$dateprogramini = explode("/",$datenewprogram);

	$ircRecord[prografecini] =  $dateprogramini[0];
	$ircRecord[prograhorini] =  $dateprogramini[1];
	$ircRecord[prograrepot] = 1;		
	$nuconn = fncconn();
	if ($ircRecord[progracodigo]!=null) {
		$nuResult = uprecordprogramacion($ircRecord,$nuconn);				
					}				
	
	fncclose($nuconn);
		
?>
