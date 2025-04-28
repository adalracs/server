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
	include('../FunPerPriNiv/pktblbienesinmueble.php');
	//Se crea un objeto soap_server
	$servidor = new soap_server();
	$servidor->debug_flag=false;
	//Se define el namespace (esto es para la generaci�n del wsdl)
	$servidor->configureWSDL("FunWebSer", "http://gaia.li.com.co/cmms/src/FunWebSer","http://gaia.li.com.co/cmms/src/FunWebSer/WSbienesimueble.php");
	$namespace = "http://gaia.li.com.co/cmms/src/FunWebSer";
	$soapaction = "http://gaia.li.com.co/cmms/src/FunWebSer/WSbienesimueble.php";
	$servidor->wsdl->schemaTargetNamespace = $namespace;
	//Se agrega un tipo complejo de datos porque se trabajara con arreglo de datos
	$servidor->wsdl->addComplexType('Bienesinmueble', 'complexType', 'struct', 'all', '',
										array(
												'bieninmucodigo'	   => array("name" => "bieninmucodigo", "type" => "xsd:string"),
												'bieninmunombre'  => array("name" => "bieninmunombre",  "type" => "xsd:string"),
												'bieninmudescri' => array("name" => "bieninmudescri", "type" => "xsd:string")
										));
	$servidor->wsdl->addComplexType( 'ArrayOfstring', 'complexType', 'array', '', 'SOAP-ENC:Array',
										array(),
										array(
											array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'string[]')),
										'xsd:string');
	//Se registran las funciones, con el tipo de dato que reciben, y el que es devuelto.
	$servidor->register("insBienesInmueble", array("Bienesinmueble" => "tns:Bienesinmueble"), array("return" => "xsd:string"),$namespace);
	//-----
	$servidor->register("updBienesInmueble", array("Bienesinmueble" => "tns:Bienesinmueble"), array("return" => "xsd:string"),$namespace);
	// End register...
	function insBienesInmueble($iRegbienesinmueble)
	{
		define("e_connection",-1);
		define("e_db",-2);
	
		$idcon = fncconn();

		if($idcon)
		{
			if ($iRegbienesinmueble)
			{
				$insertbienesinmueble = insrecordbienesinmueble($iRegbienesinmueble, $idcon);
				return $insertbienesinmueble;
			}
			else 
				return e_db;
		}
		else
			return e_connection;
	}
// 		Edición de bienes inmueble
	function updBienesInmueble($iRegbienesinmueble)
	{
		$idcon = fncconn();
		if($idcon)
		{
			if($iRegbienesinmueble)
			{
				$updatebienesinmueble = uprecordbienesinmueble($iRegbienesinmueble, $idcon);
				return $updatebienesinmueble ;
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
