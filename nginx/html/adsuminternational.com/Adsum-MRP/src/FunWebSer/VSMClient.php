<?php 
ini_set("display_errors", "1");
require('lib/nusoap.php');

function crearUsuario( $login, $nombres, $apellidos, $email, $clave )
{
	
	$client = new soapclient('http://pbsi.parquesoft.local/inet/vsmliPE/ws/vsmwsservice.php?wsdl', true);
	$err = $client->getError();
	if ($err) {
    		// Display the error
    		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    		// At this point, you know the call that follows will fail
	}
	$usuario = array('login' => $login, 'nombres' => $nombres, 'apellidos' => $apellidos, 'email' => $email, 'clave' => $clave );
	//echo "<pre>"; print_r($client); echo "</pre>";

	$response = $client->call('crearUsuario', array('usuario' => $usuario), "http://tempuri.org/","document" ); 

     	echo '<pre>';
     	print_r($client->request);
     	print_r($client->response);
     	echo '</pre>';

	if ($client->fault) { 
		$error_response = "FAULT: <p>Code: {$client->faultcode}<br />"; 
		$error_response .= "String: {$client->faultstring}"; 
		return $error_response;
	} else { 
		return $response; 
	} 

}

function eliminarUsuario( $login )
{
	$param = array('login' => $login );

	$client = new soapclient('http://pbsi.parquesoft.local/linet/vsmliPE/ws/vsmwsservice.php?wsdl', true);
	$err = $client->getError();
	if ($err) {
	    	// Display the error
    		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    		// At this point, you know the call that follows will fail
	}
	$response = $client->call('eliminarUsuario', $param, "http://tempuri.org/", "document" ); 
     	echo '<pre>';
     	print_r($client->request);
     	print_r($client->response);
     	echo '</pre>';

	if ($client->fault) { 
		$error_response = "FAULT: <p>Code: {$client->faultcode}<br />"; 
		$error_response .= "String: {$client->faultstring}"; 
		return $error_response;
	} else { 
		return $response; 
	} 
}
$r = crearUsuario( 'wilsacos5', 'w s', 's a', 'wilsan@vianet.ws', '111111');
//$r = eliminarUsuario ("wilsan1");

echo "R:<pre>"; print_r($r); echo "</pre>";

?> 

