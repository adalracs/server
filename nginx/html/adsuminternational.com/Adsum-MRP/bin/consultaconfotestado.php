<?php
/*
Propiedad intelectual de Adsum.
Funcion         : consultaconfotestado
Decripcion      : consulta el archivo ot.conf y extrae su contenido dos array.
Parametros      : Descripicion
   $arrval     arreglo que contiene los valores de cada estado.
   $arrlog     arreglo que contiene el orden de cada estado.
Retorno         :
Autor           : lfolaya
Fecha           : 23-Junio-2005
*/
function consultaconfotestado(&$arrval,&$arrlog)
{
	//Extrae el contenido en una array según la cantidad de lineas
	$hi = file('../etc/ot.conf');
	for($i = 0; $i < count($hi); $i++)
	{
		if($flag == 2)
			if(rtrim($hi[$i]) == "[/Valor por estado]")
				$i = $i + 1;
			else 
				$arrval[] = rtrim($hi[$i]);
		if($flag == 1)
			if(rtrim($hi[$i]) == "[/Orden logico]")
			{
				$flag = 2;
				$i = $i + 1;
			}else 
				$arrlog[] = rtrim($hi[$i]);
		if(rtrim($hi[$i]) == "[Orden logico]")
			$flag = 1;
	}
}
	
?>
