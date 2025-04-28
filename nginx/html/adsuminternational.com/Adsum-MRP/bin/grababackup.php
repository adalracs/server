<?php
/*
Todos los derechos reservados
Propiedad intelectual de Adsum (c).
Funcion         : loadrecordbackup
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$idcon	    	id de conexión.
$tablnomb	    Nombre de las tablas
$index   	    Numero de tablas
$cont    	    Contador auxiliar
$file    	    Contiene el archivodone sera guardado los datos
Autor           : lfolaya - ariascos
Fecha           : 13062005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunGen/fncmsgerror.php');
function loadrecordbackup($idcon,$tablnomb,$index,$cont,$file,$nombre)
{
	define("backEx",19);

	$nuResult = loadrecordtablnomb($idcon,$tablnomb[$cont]);
	$numRegsul = fncnumreg($nuResult);

	fwrite($file,""."\n");
	fwrite($file,"-- Datos de la tabla ".$tablnomb[$cont]."\n");
	fwrite($file,""."\n");

	if($numRegsul > 0)
	{
		for($i = 0; $i < $numRegsul; $i++)
		{
			$sbreResult = fncfetch($nuResult,$i);
			$count = count($sbreResult)/2;
			$arrcamp = null;
			$insrecord = "INSERT INTO ".$tablnomb[$cont]." VALUES (";
			for($k = 0; $k < $count; $k++)
			{
				if($k +1 == $count)
				if($sbreResult[$k] != null)
				$arrcamp = $arrcamp."'".$sbreResult[$k]."'";
				else
				$arrcamp = $arrcamp."NULL";
				elseif($sbreResult[$k] != null)
				$arrcamp = $arrcamp."'".$sbreResult[$k]."',";
				else
				$arrcamp = $arrcamp."NULL,";
			}
			$endrecord = ");";
			$arrRecord = $insrecord.$arrcamp.$endrecord;
			gzwrite($file,$arrRecord."\n");
		}
	}
	$cont = $cont + 1;
	if ($index > $cont)
	{
		die(loadrecordbackup($idcon,$tablnomb,$index,$cont,$file,$nombre));
	}
	else
	{
		gzclose($file);
		echo '<script language = "javascript">';
		echo '<!--//'."\n";
		echo 'location ="ingrnuevbackup.php?codigo='.$codigo.'&saveas=1;"';
		echo '//-->'."\n";
		echo '</script>';
	}
}

$idcon = fncconn();

//Hallamos todas las tablas
$result = fullscantabla($idcon);
$numReg = fncnumreg($result);

if($numReg > 0)
{
	$file = gzopen("../src/FunMig/".$nombre.".gz","w9");
	
	for ($i =0; $i < $numReg; $i++)
	{
		$arr = fncfetch($result,$i);
		$tablNom[] = $arr['tablnomb'];
	}
	$tablNom[] = "tabla";
	$tablNom[] = "campo";
	$numReg = $numReg + 2;
	$cont = 0;
	loadrecordbackup($idcon,$tablNom,$numReg,$cont,$file,$nombre);
}
?>
