<?php
/*
-Todos los derechos reservados
Propiedad intelectual de Adsum (c).
Funcion: WSIncidencia
Decripcion: Web service que permite la crear usuarios
Autor: htascon
Fecha: 19122005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
	require('lib/nusoap.php');
	include('../FunPerSecNiv/fncconn.php');
	include('../FunPerSecNiv/fncclose.php');
	include('../FunPerPriNiv/pktbldattemp.php');
	//Se crea un objeto soap_server
	$servidor = new soap_server();
	$servidor->debug_flag=false;
	//Se define el namespace (esto es para la generaci�n del wsdl)
	$servidor->configureWSDL("FunWebSer", "http://gaia.li.com.co/cmms/src/FunWebSer","http://gaia.li.com.co/cmms/src/FunWebSer/WSincidencias.php");
	$namespace = "http://gaia.li.com.co/cmms/src/FunWebSer";
	$soapaction = "http://gaia.li.com.co/cmms/src/FunWebSer/WSincidencias.php";
	$servidor->wsdl->schemaTargetNamespace = $namespace;
	//Se agrega un tipo complejo de datos ya que se va a trabajar con un arreglo de datos
	$servidor->wsdl->addComplexType('Incidencia', 'complexType', 'struct', 'all', '',
										array(
											'datcod' 		=> array("name" => "datcod", "type" => "xsd:string"),
											'datfechtemp'  	=> array("name" => "datfechtemp",  "type" => "xsd:string"),
											'datfechrep' 	=> array("name" => "datfechrep", "type" => "xsd:string"),
											'datfechasig' 	=> array("name" => "datfechasig", "type" => "xsd:string"),
											'datfechdesp' 	=> array("name" => "datfechdesp", "type" => "xsd:string"),
											'datfechtrab' 	=> array("name" => "datfechtrab", "type" =>  "xsd:string"),
											'datbrig'	   	=> array("name" => "datbrig", "type" =>  "xsd:string"),
											'datdisp'   	=> array("name" => "datdisp", "type" =>  "xsd:string"),
											'datcausa'   	=> array("name" => "datcausa", "type" =>  "xsd:string"),
											'datprogra'   	=> array("name" => "datprogra", "type" =>  "xsd:string")
										));
	$servidor->wsdl->addComplexType( 'ArrayOfstring', 'complexType', 'array', '', 'SOAP-ENC:Array',
										array(),
										array(
											array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'string[]')),
										'xsd:string');

	//Se registran las funciones, con el tipo de dato que reciben, y el que es devuelto.
	$servidor->register("insIncidencias", array("Incidencia" => "tns:Incidencia"), array("return" => "xsd:string"),$namespace);
	//-----
	$servidor->register("delIncidencias", array("Incidencia" => "tns:Incidencia"), array("return" => "xsd:string"),$namespace);
	//-----
	$servidor->register("updIncidencias", array("Incidencia" => "tns:Incidencia"), array("return" => "xsd:string"),$namespace);
	
//	$servidor->register("consIncidencias", array("Incidencia" => "tns:Incidencia"), array("return" => "xsd:ArrayOfstring"),$namespace);
//	$servidor->register("listarregistros", array("Incidencia" => "tns:Incidencia"), array("return" => "xsd:ArrayOfstring"),$namespace);

	function insIncidencias($iRegdattemp)
	{
		define("e_connection",-1);
		define("e_db",-2);
	
		$idcon = fncconn();

		if($idcon)
		{
			if ($iRegdattemp)
			{
				$insertdattemp = insrecordattemp($iRegdattemp, $idcon);
				return $insertdattemp;
			}
			else 
				return e_db;
		}
		else
			return e_connection;
	}
	
	function delIncidencias($iRegdattemp)
	{
		define("e_connection",-1);
		define("e_db",-2);
		
		$idcon = fncconn();
		if($idcon)
		{
			if($iRegdattemp['datcod'])
			{
				$deletedattemp = delrecordattemp($iRegdattemp['datcod'], $idcon);
				return $deletedattemp ;
			}
			else 
				return e_db;
		}
		else
			return e_connection;
	}

	function updIncidencias($iRegdattemp)
	{
		define("e_connection",-1);
		define("e_db",-2);
		
		$idcon = fncconn();
		if($idcon)
		{
			if($iRegdattemp['datcod'])
			{
				$updatedattemp = uprecordattemp($iRegdattemp, $idcon);
				return $updatedattemp ;
			}
			else 
				return e_db;
		}
		else
			return e_connection;
	}

	// Enviar el resultado como una respuesta SOAP por HTTP
	@$servidor->service($HTTP_RAW_POST_DATA);
	//exit();
?>
