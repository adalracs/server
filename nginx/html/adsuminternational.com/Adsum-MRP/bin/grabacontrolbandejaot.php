<?php 
	include ('../src/FunPerSecNiv/fncconn.php');
	include ('../src/FunPerSecNiv/fncclose.php');
	include ('../src/FunPerSecNiv/fncfetch.php');
	include ('../src/FunPerPriNiv/pktbltarea.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include_once ('../src/FunPerPriNiv/pktblequipo.php');
	include_once ( '../src/FunGen/fncnumprox.php');
	include_once ( '../src/FunGen/fncnumact.php');
	
	ini_set("display_errors", 1);
	
	function load_codcascade ($strcode, $level, $idcon)
	{
		include_once ('../src/FunPerPriNiv/pktblcomponen.php');
		include_once ('../src/FunPerPriNiv/pktblsistema.php');
		
		if($level == 1) 
		{
			$_rscomponen = loadrecordcomponen($strcode, $idcon);
			$equipocodigo = $_rscomponen['equipocodigo']; 
		}	
		elseif($level == 2)
			$equipocodigo = $strcode; 
			
		if($equipocodigo)
		{
			$_rsequipo = loadrecordequipo($equipocodigo, $idcon);
			if($_rsequipo > 0)
			{
				$_rssistema = loadrecordsistema($_rsequipo['sistemcodigo'], $idcon);
					
				if($_rssistema > 0)
					return array($equipocodigo, $_rssistema['sistemcodigo'], $_rssistema['plantacodigo']);
			}
		}
	}
	
	
	//========================================
	ini_set('max_execution_time', '1800');
	$idconn = fncconn();
	$rs_buffer = 1;
	$_dir = '../doc/buffer_badeja/';
	$_dir_log = '../doc/buffer_badeja/logs/';
	
	$rs_usuario = loadrecordusuario($usuacodi, $idconn);
	
	if(!file_exists($_dir_log))
		$rs_buffer_log = @mkdir($_dir_log, 0777);
	
	if($_SERVER["HTTP_X_FORWARDED_FOR"])
		$my_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	elseif($_SERVER["REMOTE_ADDR"])
		$my_ip = $_SERVER["REMOTE_ADDR"];
	
	if(!file_exists($_dir))	
		$rs_buffer = @mkdir($_dir, 0777);

		
	if($rs_buffer)
	{
		$filename = $_dir.'prgot_'.date('Ymd').'.ads';
			
		if (file_exists($filename)) 
		{
			include_once '../src/FunGen/fncbandejaot.php';
			
			$fpCub = fopen($filename, 'r'); 	// aqui el nombre del archivo que se deasea cargar al temporal
			$line = 1;
			
			$rs_handle_log = fopen($_dir_log.'lgev_prgot_'.date('Ymd').'.log', "w");
			
			//= Read File =
			while (!feof($fpCub)) 
			{
				$buffer = fgets($fpCub, 4096);
				
				$buffer = str_replace("\r", '',$buffer);
				$buffer = str_replace("\n", '',$buffer);
				
				if($buffer)
					$capture = explode(";",$buffer);
					
				if(!$capture[2])
				{
					 $file = $capture[0];
					 $conten = $capture[0].';enabled;'.$my_ip.chr(10);
					 fwrite($rs_handle_log, date('Y-m-d H:i:s').' => [Usuario tomo archivo "'.$capture[0].'" Para ejecutar :: EX_FILE_CB] '.$rs_usuario['usuanomb'].' IP: '.$my_ip."\n");
					 break;
				}	
				else
				{
					if($capture[2] == $my_ip && $capture[1] != 'disabled')
					{
						$conten = $capture[0].';enabled;'.$my_ip.chr(10);
						$file = $capture[0];
						fwrite($rs_handle_log, date('Y-m-d H:i:s').' => [Usuaurio Selecciono Archivo "'.$capture[0].'" Nuevamente :: P_ERROR_GENERATION]'.$rs_usuario['usuanomb'].' IP: '.$my_ip."\n");
						break;
					}
				}
				$line ++;
				unset($buffer);
			}
			fclose($fpCub);
			//= Read File =
			fclose($rs_handle_log);
			
			if($file)
			{
	    		$gestor = file($filename);
	    		$i = 0;
	    		
	    		$fpCub = fopen($filename,"w");
	    		
	    		foreach ($gestor as $linea)
	    		{
	        		$i++;//Recorre el número de lineas
	        		if($i == $line)
	            		fputs($fpCub,$conten);
	        		else
	            		fputs($fpCub,$linea); //Añadimos las líneas que habían en el fichero
	    		}
				generaot($file, $idconn, $_dir, $_dir_log, $filename, $line, $usuacodi, $my_ip );
			}
		} 
		else 
		{
			include_once('../src/FunPerPriNiv/pktblprogramacion.php');
			
			$rsPrograma = loadrecordbandejaprograma($idconn);
			
			if($rsPrograma)
			{
				//Inicializamos variables [shw]
				$switch = 0;				
				$cube = 0;		
				$ini_row = 0; 		
				$final_row = 249;
				
				while($switch == 0)
				{
					$list_cube .= 'cube_'.$cube.'.cub;disabled;'."\r\n";
					$rs_handle_cube = fopen($_dir.'cube_'.$cube.'.cub', "w");
					
					for($a = $ini_row; $a <= $final_row; $a++ )
					{
						if($rsPrograma[$a]['componcodigo'])
							$arr_codes = load_codcascade($rsPrograma[$a]['componcodigo'], 1, $idconn);
						elseif($rsPrograma[$a]['equipocodigo'])
							$arr_codes = load_codcascade($rsPrograma[$a]['equipocodigo'], 2, $idconn);
						
						 
						$_rsequipo = loadrecordequipo($arr_codes[0], $idcon);
						
						if($_rsequipo['estadocodigo'] != '3')
						{
							if(array_key_exists($a, $rsPrograma))
								$arr_reg = 	'[0][|]'.
											$rsPrograma[$a]['prografecini'].'[|]'. 		//Fecha de inicio [Fecha que genera la ot]
											$rsPrograma[$a]['prograhorini'].'[|]'. 		//Hora de inicio [Fecha que genera la ot]
											$rsPrograma[$a]['prografrecue'].'[|]'. 		//Frecuencia de generacion de ot 
											$rsPrograma[$a]['prografechfutur'].'[|]'. 	//Punto inicio de programacion
											$rsPrograma[$a]['tipmeddescri'].'[|]'. 		//Valor tipo medidor
											$rsPrograma[$a]['tipmedtiempo'].'[|]'. 		//Tipo de medidor [Dias, Horas, Minutos]
											$rsPrograma[$a]['tipmedcodigo'].'[|]'. 		//Tipo de medidor Codigo
											$arr_codes[0].'[||]'. 						//$rsPrograma[$a]['equipocodigo'].'[|]'.
											$rsPrograma[$a]['progracodigo'].'[|]'.		//:: Desde este punto en adelante se agregan los datos 
											$rsPrograma[$a]['tipmancodigo'].'[|]'. 		//:: Que formaran parte de la OT
											$arr_codes[0].'[|]'.						//$rsPrograma[$a]['equipocodigo'].'[|]'.
											$arr_codes[1].'[|]'.						//$rsPrograma[$a]['sistemcodigo'].'[|]'.
											$arr_codes[2].'[|]'.						//$rsPrograma[$a]['plantacodigo'].'[|]'.
											$rsPrograma[$a]['componcodigo'].'[|]'.
											$rsPrograma[$a]['tareacodigo'].'[|]'.
											$rsPrograma[$a]['tiptracodigo'].'[|]'.
											$rsPrograma[$a]['otestacodigo'].'[|]'.
											$rsPrograma[$a]['tareottiedur'].'[|]'.
											$rsPrograma[$a]['tipmedcodigo'].'[|]'.
											$rsPrograma[$a]['prioricodigo'];
							else
							{
								$switch = 1;							
								break;
							}
						}
						
						fwrite($rs_handle_cube, $arr_reg."\r\n");
					}
					fclose($rs_handle_cube);
					
					$ini_row += 250; 		
					$final_row += 250;
					
					$cube ++;
				}
				
				$rs_handle = fopen($filename, "w");
				fwrite($rs_handle, $list_cube);
				fclose($rs_handle);
			}
		}
	}