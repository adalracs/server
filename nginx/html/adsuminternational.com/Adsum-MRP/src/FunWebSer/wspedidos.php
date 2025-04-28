<?php 
	//ini_set('diplay_errors',1);
	ini_set('memory_limit', '512M');
	include ('../FunPerSecNiv/fncconn.php');
	include ('../FunPerSecNiv/fncclose.php');
	include ('../FunPerSecNiv/fncnumreg.php');
	include ('../FunPerPriNiv/pktblwsitem.php');
	include ('../FunjQuery/jquery.service/jquery.array_json.php');
	require_once('lib2/nusoap.php');
	
	$idcon = fncconn();
	
	$clave_semaforo = 33;  // Clave de ejemplo para el semaforo
	$sem_id = sem_get ($clave_semaforo, 1);	
		
	if (! sem_acquire ($sem_id)):
	   	echo $respuesta[0]['cobolerror'] = 'expected_error';
	   	die;
	endif;
		
	//$cliente = new nusoap_client('http://190.85.249.95/pedidoService.php?wsdl',true);
	$cliente = new nusoap_client('http://190.26.218.173/pedidoService.php?wsdl',true);
	$cliente -> response_timeout = 300;
		
	$parametros = array ('pedido' => $pedido);
	$respuesta = $cliente -> call('listarPedidos', $parametros);
		
	if($cliente -> fault)
	{
		$respuesta = array('error' => $cliente -> faultcode, 'msj' => $cliente -> faultstring);
	}
	else
	{	
		if(!$respuesta)
		{
			$respuesta[0]['cobolerror'] = 'server_error';
			$respuesta[0]['cobolmensaje'] = 'Probablemente el servicio de comunicacion no se encuentra disponible.';
		}
	}
		
	if (! sem_release ($sem_id)):
		 $respuesta[0]['cobolerror'] = 'semaphore_error';
		 $respuesta[0]['cobolmensaje'] = 'Error inesperado...';
		 echo array_to_json($respuesta[0]);
		 die;
	endif;
	 
	fncclose($idcon);
	
	echo array_to_json($respuesta[0]);
?>