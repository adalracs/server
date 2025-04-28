<?php 
	//ini_set('diplay_errors',1);
	ini_set('memory_limit', '512M');
	include ('../FunPerSecNiv/fncconn.php');
	include ('../FunPerSecNiv/fncclose.php');
	include ('../FunPerSecNiv/fncnumreg.php');
	include ('../FunPerPriNiv/pktblwsitem.php');
	include ('../FunPerPriNiv/pktblitemdesa.php');
	include ( '../FunGen/fncnumprox.php'); 
	include ( '../FunGen/fncnumact2.php'); 
	require_once('lib2/nusoap.php');
	
	$idcon = fncconn();
	
	$rsWsitem = dinamicscanopwsitem(array( 'wsitemfecini' => date('Y-m-d'), 'wsitemresult' => 1), array('wsitemfecini' => '=', 'wsitemresult' => '='), $idcon);
	$nrWsitem = fncnumreg($rsWsitem);
	
	$rsWsitem1 = dinamicscanopwsitem(array( 'wsitemfecini' => date('Y-m-d'), 'wsitemresult' => 5), array('wsitemfecini' => '=', 'wsitemresult' => '='), $idcon);
	$nrWsitem1 = fncnumreg($rsWsitem1);
	//$usuacodi = 94322900;
	if( $usuacodi > 0 && ($nrWsitem <= 0 && $nrWsitem1 <= 0) )
	{

			$nuidtemp = fncnumact2(131,$idcon);	
			do
			{
				$nuresult = loadrecordwsitem($nuidtemp,$idcon);
				if($nuresult == e_empty)
					$iRegWsitem['wsitemcodigo'] = $nuidtemp;
				$nuidtemp ++;
			}while ($nuresult != e_empty);
			
			$wsitemcodigo1 = $iRegWsitem['wsitemcodigo'];
			$iRegWsitem['wsitemfecini'] = date('Y-m-d');
			$rwhora = getdate(time());
			$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
			$iRegWsitem['wsitemhorini'] = $hora;
			$iRegWsitem['usuacodi'] = $usuacodi;
			$iRegWsitem['wsitemresult'] = 5;//en ejecucion
		
			if(insrecordwsitem($iRegWsitem,$idcon) > 0)
				fncnumprox(131,$nuidtemp,$idcon); 
				
			unset($iRegWsitem);
		
			$clave_semaforo = 33;  // Clave de ejemplo para el semaforo
			$sem_id = sem_get ($clave_semaforo, 1);	
			
			if (! sem_acquire ($sem_id)):
   				$respond = ($respond)?$respond.',unexpected_error' : 'unexpected_error' ;
   			endif;
	
			//$cliente = new nusoap_client('http://190.85.249.95/itemService.php?wsdl',true);
			$cliente = new nusoap_client('http://190.26.218.173/itemService.php?wsdl',true);
			$cliente -> response_timeout = 3600;
	
			$parametros = array ('item' => '');
			$respuesta = $cliente -> call('getItem', $parametros);
	
			if($cliente -> fault)
			{
				$error[] = array('error' => $cliente -> faultcode, 'msj' => $cliente -> faultstring);
				$respond = 'fault_error';
			}
			else
			{	
				if(!$respuesta)
					$respond= ($respond)? $respond.',server_error' : 'server_error';
			}
			
	
	 		if (! sem_release ($sem_id)):
	 			echo $respond = ($respond)? $respond.',semaphore_error' : 'semaphore_error';
    		endif;
	    
    		if(!$respond)	
	    		$respond = 'unexpected_error';
    	
    		if($respuesta)
    			$respond = 'successful_update';
	    	
			if($respuesta)
			{
				for($i=0;$i<count($respuesta);$i++)
				{
					$respuesta[$i]['fechacarga'] = date("Y-m-d H:i:s");
					$itedesnombre = str_replace('"',' ',$respuesta[$i]['itedesnombre']);
					$itedesnombre = str_replace("'"," ",$itedesnombre);
					$itedesnombre = str_replace(';',' ',$itedesnombre);    
					$itedeslinea = str_replace('"',' ',$respuesta[$i]['itedeslinea']);
					$itedeslinea = str_replace("'"," ",$itedeslinea);
					$itedeslinea = str_replace('"',' ',$itedeslinea);
					$itedescantoc = str_replace('"',' ',$respuesta[$i]['itedescantoc']);
					$itedescantoc = str_replace("'"," ",$itedescantoc);
					$itedescantoc = str_replace('"',' ',$itedescantoc);
					$itedescantec = str_replace('"',' ',$respuesta[$i]['itedescantec']);
					$itedescantec = str_replace("'"," ",$itedescantec);
					$itedescantec = str_replace('"',' ',$itedescantec);   
					$respuesta[$i]['itedesnombre'] = $itedesnombre;
					$respuesta[$i]['itedeslinea'] = $itedeslinea;
					$respuesta[$i]['itedescantoc'] = $itedescantoc;
					$respuesta[$i]['itedescantec'] = $itedescantec;
					
					$rsItem = loadrecorditemdesa($respuesta[$i]['itedescodigo'],$idcon);
					if($rsItem > 0)
					{
						$act++;
						$res = uprecorditemdesa1($respuesta[$i],$idcon);
						if($res > 0)
						{
						 	$act_a++;
					 		$registros_actualizados[] = $respuesta[$i];
						}
						else
						{
							$act_a_error;
							$error_actualizar[] = $respuesta[$i];
						}	
					}
					else
					{
						$ins++;
						$res = insrecorditemdesa1($respuesta[$i],$idcon);
						if($res > 0)
						{
						 	$ins_i++;
					 		$registros_insertados[] = $respuesta[$i];
					 	}
					 	else
					 	{
						 	$ins_i_error ++;
					 		$error_insertar[] = $respuesta[$i];
					 	}
					}
				}
			}
		
			if(!$act) $act = 0;
			if(!$act_a) $act_a = 0;
			if(!$act_a_error) $act_a_error = 0;
			if(!$ins) $ins = 0;
			if(!$ins_i) $ins_i = 0;
			if(!$ins_i_error) $ins_i_error = 0;
			
			echo '<font size="8"><b>proceso finalizado</b></font><br>';
			echo '<font size="5"><b>respuesta : '.$respond.'</b></font><br>';
			echo '<font size="5"><b>numero de registros : '.count($respuesta).'</b></font><br>';
			echo '<font size="5"><b>registros a actualizar : '.$act.'</b></font><br>';
			echo '<font size="5"><b>registros actualizados : '.$act_a.'</b></font><br>';
			echo '<font size="5"><b>registros de error al actualizar : '.$act_a_error.'</b></font><br>';
			echo '<font size="5"><b>registros a insertar : '.$ins.'</b></font><br>';
			echo '<font size="5"><b>registros insertados : '.$ins_i.'</b></font><br>';
			echo '<font size="5"><b>registros de error al insertar : '.$ins_i_error.' </b></font><br>';
			
			if($respond == 'successful_update')
			{
				echo '<font size="8"><b>registro de carga (logs)</b></font><br>';
				//para ver de registro o logs de registros insertados
				/*
				echo '<font size="5"><b>registros insertados</b></font><br>';
				for($i=0;$i<count($registros_insertados);$i++)
				{
					echo '<font size="2">
						registro #'.($i+1).' 
						codigo : '.$registros_insertados[$i]['itedescodigo'].'
					 	nombre : '.$registros_insertados[$i]['itedesnombre'].' 
					 	fecha : '.$registros_insertados[$i]['itedesfecha'].'
					 	fecha carga : '.$registros_insertados[$i]['fechacarga'].'  
					 	unidad de medida : '.$registros_insertados[$i]['itedesunimed'].' 
					 	costo : '.$registros_insertados[$i]['itedescosto'].' 
					 	id linea : '.$registros_insertados[$i]['keylinea'].' 
					 	linea : '.$registros_insertados[$i]['itedeslinea'].' 
					 	inventario : '.$registros_insertados[$i]['itedesinvent'].'
					 </font><br>';
				}
				echo '<font size="5"><b>registros actualizados</b></font><br>';
				*/
				//para ver el registro o logs de registros actualizados
				/*
				for($i=0;$i<count($registros_actualizados);$i++)
				{
					echo '<font size="2">
						registro #'.($i+1).' 
						codigo : '.$registros_actualizados[$i]['itedescodigo'].'
					 	nombre : '.$registros_actualizados[$i]['itedesnombre'].' 
					 	fecha : '.$registros_actualizados[$i]['itedesfecha'].' 
					 	fecha carga : '.$registros_insertados[$i]['fechacarga'].'  
					 	unidad de medida : '.$registros_actualizados[$i]['itedesunimed'].' 
					 	costo : '.$registros_actualizados[$i]['itedescosto'].' 
					 	id linea : '.$registros_actualizados[$i]['keylinea'].' 
					 	linea : '.$registros_actualizados[$i]['itedeslinea'].' 
					 	inventario : '.$registros_actualizados[$i]['itedesinvent'].'
					 </font><br>';
				}
				*/
				echo '<font size="5"><b>registros error al insertar '.$ins_i_error.'</b></font><br>';
				for($i=0;$i<count($error_insertar);$i++)
				{
					echo '<font size="2"> 
						registro #'.($i+1).' 
						codigo : '.$error_insertar[$i]['itedescodigo'].'
					 	nombre : '.$error_insertar[$i]['itedesnombre'].' 
					 	fecha : '.$error_insertar[$i]['itedesfecha'].' 
					 	fecha carga : '.$error_insertar[$i]['fechacarga'].'  
					 	unidad de medida : '.$error_insertar[$i]['itedesunimed'].' 
					 	costo : '.$error_insertar[$i]['itedescosto'].' 
					 	id linea : '.$error_insertar[$i]['keylinea'].' 
					 	linea : '.$error_insertar[$i]['itedeslinea'].' 
					 	inventario : '.$error_insertar[$i]['itedesinvent'].'
					 </font><br>';
				}
				echo '<font size="5"><b>registros error al actualizar '.$act_a_error.'</b></font><br>';
				for($i=0;$i<count($error_actualizar);$i++)
				{
					echo '<font size="2">
						registro #'.($i+1).' 
						codigo : '.$error_actualizar[$i]['itedescodigo'].'
					 	nombre : '.$error_actualizar[$i]['itedesnombre'].' 
					 	fecha : '.$error_actualizar[$i]['itedesfecha'].' 
					 	fecha carga : '.$error_actualizar[$i]['fechacarga'].'  
					 	unidad de medida : '.$error_actualizar[$i]['itedesunimed'].' 
					 	costo : '.$error_actualizar[$i]['itedescosto'].' 
					 	id linea : '.$error_actualizar[$i]['keylinea'].' 
					 	linea : '.$error_actualizar[$i]['itedeslinea'].' 
					 	inventario : '.$error_actualizar[$i]['itedesinvent'].'
					 </font><br>';
				}
				$iRegWsitem['wsitemcodigo'] = $wsitemcodigo1;
				$iRegWsitem['wsitemfecfin'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegWsitem['wsitemhorfin'] = $hora;
				$iRegWsitem['wsitemresult'] = 1;//terminado exitoso
				$iRegWsitem['wsitemmensaj'] = $respond;
				uprecordwsitem($iRegWsitem,$idcon);
			}
			else
			{
				$iRegWsitem['wsitemcodigo'] = $wsitemcodigo1;
				$iRegWsitem['wsitemfecfin'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegWsitem['wsitemhorfin'] = $hora;
				$iRegWsitem['wsitemresult'] = 0;//terminado sin exito
				$iRegWsitem['wsitemmensaj'] = $respond;
				uprecordwsitem($iRegWsitem,$idcon);
			}
			
	}
	else
	{
		echo 'Rutina Realizada o En Ejecucion';
	}	
	
	fncclose($idcon);
	
?>