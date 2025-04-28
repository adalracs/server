<?php
class conex
{
	var $nuConn;
	function conexion($isbuser,$isbpass,$sbDatabase,$nuPuerto,$sbHost)
	{
		
	$nuConn = pg_connect(' dbname= '.$sbDatabase .' port= '.$nuPuerto .' host= '.$sbHost .' user= '.$isbuser .' password= '.$isbpass);	
	if ($nuConn) {
		return $nuConn;
	}
	else {
		return 'No hubo conexion';
	}
	}
}
?>