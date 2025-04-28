<?php
/**
 * JQuery Ajax Procedure buffervisor.js: 
 *
 * @param integer $action		bandera que informa la accion que realiza en el visor [0] Quitar, [1] Añadir
 * @param integer $usuacodi		codigo usuario, se utiliza para el buffer del usuario
 * @param string $filename		nombre del archivo temporal donde se almacena la informacion digital del visor [dgtb_{fecha}-{index}.bff]
 * @param string $row			arreglo que se arma desde algoritmo javascript. Estructura {num_line}|#|{col_n1}|~|{col_n2}|~|...{col_n-}
 * @return string $filename		el valor de este se imprime para que la accion la capture e informe al formulario donde estan los datos
 * 
 * @property Adsum Parquesoft
 * @author ADSUM
 * @access 2010-01-09
 */
	ini_set('display_errors', 0);
	ini_set('max_execution_time', '1800');

	$rs_buffer = 1;
	$_dir = '../../../etc/databuffer/'; //Directorio del buffer
	
//	$_dir_log = '../etc/logs/';

//	if($_SERVER["HTTP_X_FORWARDED_FOR"])
//		$my_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
//	elseif($_SERVER["REMOTE_ADDR"])
//		$my_ip = $_SERVER["REMOTE_ADDR"];
		
//	if(!file_exists($_dir_log))	
//		$rs_buffer_log = @mkdir($_dir_log, 0777);
	
	if(!file_exists($_dir))	
		$rs_buffer = @mkdir($_dir, 0777);

	if(!$filename)
	{
		for($a = 0;$a < 1000;$a++)
			if(!file_exists($_dir.'dgtb'.$usuacodi.'_'.date('Ymd').'-'.$a.'.bff')){ break;}
		$filename = 'dgtb'.$usuacodi.'_'.date('Ymd').'-'.$a.'.bff';
	}
	
	
	$_iReg_array = explode('{#}', $row);
	$a = 0;
	
	if(!file_exists($_dir.$filename))
		$fpCub = fopen($_dir.$filename,"w");
	else
	{
		$gestor = file($_dir.$filename);
	    	$fpCub = fopen($_dir.$filename,"w");
	    
		foreach ($gestor as $linea)
		{
			$a++;//Recorre el número de lineas
		        
        	if($a == $_iReg_array[0])
        	{
        		if($action == 1)
            		fputs($fpCub, $action.'{#}'.  $_iReg_array[1]."\r\n");
            	$find = 1;
        	}
            else 
            	fputs($fpCub, $linea); //Añadimos las líneas que habían en el fichero
        }
	}

    if(!$find)
    	fwrite($fpCub, $action.'{#}'.  $_iReg_array[1]."\r\n");
    fclose($fpCub);
    	
    echo $filename;