<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : FetchTable
Decripcion      : Recorre la estructura de la base de datos
en busca de las tablas del nombre de las tablas.
Parametros      : Descripicion
Retorno         : Descripicion
Autor           : ariascos
Fecha           : 12082003
*/


function fetchtable()
{
	$nuconn = fncconn();
echo $nuconn." Este es el numero de conexion";
	
	if ($nuconn)
	{
		$sbSql = "SELECT relname FROM  pg_class	WHERE
				relname not like  " . "'" . "pg_%" . "'"
		. " AND relname not like  " . "'" ."%_pkey" ."'"
		. " AND relname not like  " . "'" ."%_index" ."'"
		. " AND relname not like  " . "'" ."pbcat%" ."'"
		. " AND relname not like  " . "'" ."%_seq" ."'"
		. " AND relname not like  " . "'" ."%_pk" . "'"
		. " AND relname not like  " . "'" ."pk_%" . "'"
		. " AND relname not like  " . "'" ."%_fk" ."'"
		. " AND relname not like  " . "'" ."sec%" ."'"
		. " AND relname not like  " . "'" ."tabla%" ."'"
		. " AND relname not like  " . "'" ."campo%" ."'"
		;
		
		$nuResult = pg_exec($nuconn,$sbSql);
		
		if ($nuResult)
		{
			$nuCantRow = pg_numrows($nuResult);
			
			if ($nuCantRow > 0)
			{
				for ($i = 0;$i < $nuCantRow;$i++)
				{
					$sbRow = pg_fetch_row ($nuResult,$i);
					echo "Encontrado item ".$i."\nLlenando tabla ".$sbRow[0]."\n";
					$sbLineaRet = fncingtab($sbRow[0],$sbRow[1]);
				}
			}
		}
		else
		{
			echo"Ha ocurrido un error \n";
		}
	}
	else
	{
		echo"Fallo Intento de Conexion \n";
	}
}
fetchtable();
?>
