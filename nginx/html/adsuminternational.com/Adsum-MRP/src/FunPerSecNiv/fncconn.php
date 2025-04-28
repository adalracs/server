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
	$isbuser='postgres';
	$isbpass='Renovados-2021';
	$sbDatabase = 'Plasticel-20150818';
	$_SESSION['manicato'] = 'public';
	$nuPuerto = 5432;
	$sbHost = '127.0.0.1';
	$nuConn = pg_connect(' dbname= '.$sbDatabase .' port= '.$nuPuerto .' host= '.$sbHost .' user= '.$isbuser .' password= '.$isbpass);	
	return $nuConn;
}
?>
