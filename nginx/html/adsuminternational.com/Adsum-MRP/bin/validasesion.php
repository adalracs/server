<?php
/* 
Funci�n:		validasesion
Descripcion: 	verifica si el usuario tiene permisos de accesar a un componente
Parametros:		$usuacodigo	codigo del usuario
				$codigo		codigo de la forma
				$nuConn		conexi�n a db
Retorno:		1 = Tiene permisos
				0 = No tiene permisos � Error de base de datos o de conecci�n 
Autor: 			lfolaya
Fecha: 			01-November-2004 
				Modificaci�n | Fecha | Autor 
*/ 
function validasesion($usuacodi,$codigo,$nuConn)
{
	$sbSql = "select * from usuagrup where usuacodi=".$usuacodi;
	$nuResult = pg_exec($nuConn,$sbSql);
	if($nuResult)
	{ 
		$nuCantRow = pg_numrows($nuResult); 
		if($nuCantRow > 0)
		{
			$row = pg_fetch_row($nuResult,0);
			$sbSql1 = "select * from grupcomp where grupcodi=".$row[0]." and mecocodi = ".$codigo;
			$nuResult1 = pg_exec($nuConn,$sbSql1);
			$nuCantRow1 = pg_numrows($nuResult1); 
			if($nuCantRow1 > 0)
			{
				$flag = 1;
				return $flag;
			}
			
		}
		else
		{
			$flag = 0;
			return $flag;
		}
		
	}
}
?>