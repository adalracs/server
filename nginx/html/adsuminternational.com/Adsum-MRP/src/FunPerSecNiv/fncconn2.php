<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : fncconn
Decripcion      : Abre la conexion. 
Autor           : ariascos
Fecha           : 04-oct-2001  
*/
function fncconn()
{
	ini_set('display_errors',1);
	$server = '169.254.224.165\Prueba-Plas';
	$database = 'UNO85C-CM';
	$user = 'PRUEBA';
	$password = 'PRUEBA';
	$conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
	if ($conexión)
	{echo 'Eureka';}
	else { echo 'Veamos a ver que pasa';}
	
/*
	
	$isbuser='Plasticel-20111206';
	$isbpass='Plasticel-20111206';
	$sbDatabase = 'Plasticel-20111206';
	$_SESSION[manicato] = 'public';
	$nuPuerto = 5432;
	$sbHost = '127.0.0.1';
	$nuConn = pg_connect(' dbname= '.$sbDatabase .' port= '.$nuPuerto .' host= '.$sbHost .' user= '.$isbuser .' password= '.$isbpass);	
	return $nuConn;*/
}

function fncconn2(){
	//$mdbFilename2 = 'Driver={Relativity (*.rcg)};DSN=adsumcguno.dsn;Catalog=\\\\169.254.224.165\\prueba-plas\\UNO85C-CM.rct;';
	$mdbFilename2 = 'Driver={Relativity (*.rcg)};DSN=adsumcguno.dsn;Catalog=\\\\169.254.224.165\\prueba-plas\\UNO85C-CM.rct;';
	$user = '';
	$password = '';
	$conexion = odbc_connect ( $mdbFilename2, $user, $password );
	return $conexion;
	
//$usuario = "PRUEBA";
//$clave="PRUEBA";
}
?>
