<?php
session_start();
	//include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunGen/fncsumdate.php');
	include ( '../src/FunGen/fncmsgerror.php');

	$idConn = fncconn();
	if ($idConn) {
			
		$sbSql = "SELECT programacion.progracodigo, programacion.prografecini, programacion.prograhorini, programacion.prografrecue, tipomedi.tipmeddescri, tipomedi.tipmedtiempo,programacion.progranumgru,tipomedi.tipmedcodigo,programacion.prograrepot
			     FROM programacion, tipomedi WHERE programacion.tipmedcodigo = tipomedi.tipmedcodigo  and  programacion.plantacodigo IN (".$GLOBALS[usuaplanta].") ";
		
		$nuResultf = pg_exec($idConn,$sbSql);
		unset($sbSql);
		
		if($nuResultf){
			$nuCantRow = pg_numrows($nuResultf);					
			if($nuCantRow > 0){
				
				for ($i = 0; $i < $nuCantRow; $i++){
					$sbRow = pg_fetch_row($nuResultf,$i);
					$sbLista = array("progracodigo" => $sbRow[0],
								"prografecini" => $sbRow[1],
								"prograhorini" => $sbRow[2],
								"prografrecue" => $sbRow[3],
								"tipomeddescri" => $sbRow[4],
								"tipmedtiempo" => $sbRow[5],
								"progranumgru" => $sbRow[6]
							
					  		   );
					  		   
					  if($sbLista[tipomeddescri]){
						 switch ($sbLista[tipmedtiempo]){
							case 1:	//Minutos
								$frechors = ( $sbLista[prografrecue] * $sbLista[tipomeddescri] ) / 60;
								$arr_hora = explode(":",$sbLista[prograhorini]);
								$timestamp2 = mktime($arr_hora[0],$arr_hora[1],0,0,0,0);
								$frecuencias="+".$sbLista[prografrecue]."minutes";
						        $fechafutur=date("H:i",strtotime($frecuencias,$timestamp2));
						        $comparativos=mktime(date('H'),date('i'),0,0,0,0);
						        $arr_horas = explode(":",$fechafutur);
						        $fechafutur= mktime($arr_horas[0],$arr_horas[1],0,0,0,0);
						        $fechafuturs=date("H:i",strtotime($frecuencias,$timestamp2));
								
								break;
							case 2:	//Horas
								$frechors = ( $sbLista[prografrecue] * $sbLista[tipomeddescri] );
								$arr_hora = explode(":",$sbLista[prograhorini]);
								$timestamp1 = mktime(date('H'),date('i'),0,0,0,0); 
								$timestamp2 = mktime($arr_hora[0],$arr_hora[1],0,0,0,0);
								$frecuencias="+".$sbLista[prografrecue]."hours";
						        $fechafutur=mktime(date("H:i",strtotime($frecuencias,$timestamp2)));
						        $comparativos=mktime(date('H:i'));
						        $fechafuturs=date("H:i",strtotime($frecuencias,$timestamp2));
								
								break;
							case 3:	//Dias
							    $arr_fecha = explode("-",$sbLista[prografecini]);
								$frechors = ( $sbLista[prografrecue] * $sbLista[tipomeddescri] ) * 24;
								
								$frechors = ( $sbLista[prografrecue] * $sbLista[tipomeddescri] ) * 24;
								$comparativos = mktime(0,0,0,date("m"),date("d"),date("Y"));
						        $timestamp2 = mktime(0,0,0,$arr_fecha[1],$arr_fecha[2],$arr_fecha[0]);
						        
						        $frecuencias="+".( $sbLista[prografrecue] * $sbLista[tipomeddescri] )."day";
						        $fechafutur=strtotime($frecuencias,$timestamp2);
						       
						        if ($fechafutur=='') {
						        	
						        	$fechafuturs=date("Y-m-d");
						        	$fechafutur=date("Y-m-d");
						        	
						        }
						        else {
						        	$fechafuturs=date("Y-m-d",strtotime($frecuencias,$timestamp2));
						        }
						        
						      
						        
						       // $comparativos=mktime(date('Y-m-d'));
						       
								break;
						}
						$datenext = fncsumdate(date('Y-m-d'), date('H:i'), $frechors);
						$fechaactivado = explode("/",$datenext);
						
						if ($comparativos==$fechafutur) {                                
							
							
							$prografecini = $sbLista[prografecini];
							$prograhorini = $sbLista[prograhorini];
							$arrregtarequipo = $sbLista[progracodigo];
							$ircRecord[prograrepot] = 1;
							
							
							//for(;;){
								include('grabacronoprograma.php');
								$datenext = fncsumdate($prografecini, $prograhorini, $frechors);
								$infech = explode("/", $datenext);
								
								$prografecini = $infech[0];
								$prograhorini = $infech[1];
								
								/*if($prografecini > $fechaactivado[0])
									break;*/
	
							}
							elseif ($fechafutur<$comparativos ) {
								include_once('../src/FunPerPriNiv/pktblprogramacion.php');
								$ircRecord[prograhorini] = $sbLista[prograhorini];
							$ircRecord[progracodigo] = $sbLista[progracodigo];
							$ircRecord[prograrepot] = 0;
							$ircRecord[prografecini] = $fechafuturs;
							$ircRecord[progranumgru] = $sbLista[progranumgru];
							
								$nuconn = fncconn();
	 				          //$ircRecord[prografecini] = $sbLista[prografecini];
							   
	                           $nuResult = uprecordprogramacion($ircRecord,$nuconn);
	                           fncclose($nuconn);
							}
							elseif ($fechafutur>$comparativos) {
								
								include_once('../src/FunPerPriNiv/pktblprogramacion.php');
								$ircRecord[prograhorini] = $sbLista[prograhorini];
							    $ircRecord[progracodigo] = $sbLista[progracodigo];
							    $ircRecord[prograrepot] = 0;
							    $ircRecord[progranumgru] = $sbLista[progranumgru];
							//$ircRecord[prografecini] = $fechafuturs;
							
								$nuconn = fncconn();
	 				          $ircRecord[prografecini] = $sbLista[prografecini];
							   
	                           $nuResult = uprecordprogramacion($ircRecord,$nuconn);
	                           fncclose($nuconn);
							}
						}
					  }
				}
			}
		}
	//}
?>
