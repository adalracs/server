<?php
ini_set('display_errors', 0);
/**
 * Funcion Load Data: 
 * Opcion de subir cubos de datos desde un archivo, desde esta funcion se valida, filtra y clasifica la informacion
 * para el proceso de almacenamiento de datos
 *
 * @param string $uploaddir_			ruta de acceso al archivo
 * @param string $file					nombre del archivo a cargar (.{[desconocido]}) plano
 * @param string {array} $arr_column	arreglo con el nombre de los campos configurados en la DB
 * @param integer $err					Numero de errores que arroja al intentar cargar la informacion
 * @param date $inicio_carga			Fecha / Hora de Carga
 * @param resource $idconn				IDResource de conexion a la DB
 * 
 * @property Adsum Parquesoft
 * @author cbedoya
 * @access 2010-10-15
 */
function load_data($uploaddir_, $file, $separator, $arr_column)
{
	$arr_index = array();
	$swh_col = 0; 								// indice de inicio (Nombre de cada una de las columnas)
	$swh_index = 0;
	
	$fpCub = fopen($uploaddir_.$file, 'r'); 	// aqui el nombre del archivo que se deasea cargar al temporal
	
	while (!feof($fpCub)) 
	{
		$buffer = fgets($fpCub, 4096);
		$fields = explode($separator, $buffer);
		unset($buffer);
		
		if($swh_col == 0)						//Index de Campos y validacion
		{
			for($a = 0; $a < count($fields); $a++)
			{
				if($arr_column[trim($fields[$a])])
					$arr_index[$arr_column[trim($fields[$a])]] = $a;
			}
			$swh_col++;
			unset($a);
		} 
		else
		{
			foreach($arr_index as $key => $value)
			{
				if(trim($fields[$value]) == '')
					$arr_data[$swh_index][$key] = null;
				else
					$arr_data[$swh_index][$key] = trim($fields[$value]);
			}	
			$swh_index ++;
		}
	}
	return $arr_data;
}