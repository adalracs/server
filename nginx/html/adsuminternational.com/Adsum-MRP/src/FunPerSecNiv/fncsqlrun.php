<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : fncsqlrun
Decripcion      : ejecutad una consulta SQL y retorna resultado 
Autor           : cabedoya
Fecha           : 07-jul-2011  
*/

function fncsqlrun($strSgl, $idcon)
{
	define("e_connection",-1); 
	define("e_db",-2); 
	define("e_empty",-3); 
	define("cero",0); 
	
	if($idcon)
	{
		$rsRecord = pg_exec($idcon, $strSgl);
		
		if ($rsRecord)
		{ 
 			$nrRecord = pg_numrows($rsRecord); 
  			
 			if (!$nrRecord)
  				return  e_empty;
  			else
  				return $rsRecord; 
		}
		else
			return  e_db; 
	}
	else
		return  e_connection; 
}