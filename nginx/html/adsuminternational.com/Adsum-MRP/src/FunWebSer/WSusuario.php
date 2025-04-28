<?php
/*
-Todos los derechos reservados
Propiedad intelectual de Adsum (c).
Funcion: WSusuario
Decripcion: Web service que permite la crear usuarios
Autor: mstroh
Fecha: 19122005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
	require('lib/nusoap.php');
	include('../FunPerSecNiv/fncconn.php');
	include('../FunPerSecNiv/fncclose.php');
	include('../FunPerPriNiv/pktblusuario.php');
	//Se crea un objeto soap_server
	$servidor = new soap_server();
	$servidor->debug_flag=false;
	//Se define el namespace (esto es para la generaci�n del wsdl)
	$servidor->configureWSDL("FunWebSer", "http://gaia.i.com.co/cmms/src/FunWebSer","http://gaia.li.com.co/cmms/src/FunWebSer/WSusuario.php");
	$namespace = "http://gaia.li.com.co/cmms/src/FunWebSer";
	$soapaction = "http://gaia.li.com.co/cmms/src/FunWebSer/WSusuario.php";
	$servidor->wsdl->schemaTargetNamespace = $namespace;
	//Se agrega un tipo complejo de datos porque se trabajara con arreglo de datos
	$servidor->wsdl->addComplexType('Usuario', 'complexType', 'struct', 'all', '',
										array(
												'usuacodi'	   => array("name" => "usuacodi", "type" => "xsd:string"),
												'cargocodigo'  => array("name" => "cargocodigo",  "type" => "xsd:string"),
												'departcodigo' => array("name" => "departcodigo", "type" => "xsd:string"),
												'tipusucodigo' => array("name" => "tipusucodigo", "type" => "xsd:string"),
												'usuanomb'	   => array("name" => "usuanomb", "type" => "xsd:string"),
												'usuapass'	   => array("name" => "usuapass", "type" =>  "xsd:string"),
												'usuaacti'	   => array("name" => "usuaacti", "type" =>  "xsd:string"),
												'usuadocume'   => array("name" => "usuadocume", "type" =>  "xsd:string"),
												'usuanombre'   => array("name" => "usuanombre", "type" =>  "xsd:string"),
												'usuapriape'   => array("name" => "usuapriape", "type" =>  "xsd:string"),
												'usuasegape'   => array("name" => "usuasegape", "type" =>  "xsd:string"),
												'usuatelefo'   => array("name" => "usuatelefo","type" =>  "xsd:string"),
												'usuacontac'   => array("name" => "usuacontac", "type" =>  "xsd:string"),
												'usuatelcon'   => array("name" => "usuatelcon", "type" =>  "xsd:string"),
												'usuadirecc'   => array("name" => "usuadirecc", "type" =>  "xsd:string"),
												'usuaemail'    => array("name" => "usuaemail", "type" =>  "xsd:string"),
												'usuavalhor'   => array("name" => "usuavalhor", "type" =>  "xsd:string"),
												'usuaactiot'   => array("name" => "usuaactiot", "type" =>  "xsd:string")
										));
	$servidor->wsdl->addComplexType( 'ArrayOfstring', 'complexType', 'array', '', 'SOAP-ENC:Array',
										array(),
										array(
											array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'string[]')),
										'xsd:string');
	//Se registran las funciones, con el tipo de dato que reciben, y el que es devuelto.
	$servidor->register("insUsuario", array("Usuario" => "tns:Usuario"), array("return" => "xsd:string"),$namespace);
	//-----
	$servidor->register("updUsuario", array("Usuario" => "tns:Usuario"), array("return" => "xsd:string"),$namespace);
	$servidor->register("updUsuarioactiusuario", array("Usuario" => "tns:Usuario"), array("return" => "xsd:string"),$namespace);
	// End register...
	function insUsuario($iRegusuario)
	{
		define("e_connection",-1);
		define("e_db",-2);
	
		$idcon = fncconn();

		if($idcon)
		{
			if ($iRegusuario)
			{
				$insertusuario = insrecordusuario($iRegusuario, $idcon);
				return $insertusuario;
			}
			else 
				return e_db;
		}
		else
			return e_connection;
	}
// 		Edición de usuarios
	function updUsuario($iRegusuario)
	{
		$idcon = fncconn();
		if($idcon)
		{
			if($iRegusuario)
			{
				$updateusuario = uprecordusuario($iRegusuario, $idcon);
				return $updateusuario ;
			}
			else 
				return e_db;
		}
		else
			return e_connection;
	}
	
	function updUsuarioactiusuario($iRegusuario)
	{
		$idcon = fncconn();
		if($idcon)
		{
			if($iRegusuario)
			{
				$updateusuario = uprecordusuarioacti($iRegusuario, $idcon);
				return $updateusuario ;
			}
			else 
				return e_db;
		}
		else
			return e_connection;
	}
	// 	Enviar el resultado como una respuesta SOAP por HTTP
	$servidor->service($HTTP_RAW_POST_DATA);
	//exit();
