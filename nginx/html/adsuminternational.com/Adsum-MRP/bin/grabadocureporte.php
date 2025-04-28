<?php 
include ( '../src/FunPerPriNiv/pktbldocureporte.php'); 


//función que elimina recursivamente todo el contenido de un directorio dado 
function deleteRecursive($carpeta)
{ 
	$rf_buff = opendir($carpeta); 
	while ($archivo = readdir($rf_buff))
	{ 
		if( $archivo !='.' && $archivo !='..' )
		{
			if (is_dir( $carpeta.$archivo))
				deleteRecursive($carpeta.$archivo.'/');
			else
				unlink($carpeta.$archivo); 
		} 
	} 
	closedir($rf_buff);
	
	rmdir($carpeta);
} 


/**
 * Funcion move_to
 * 
 * @param $origen
 * @param $destino
 * @return none
 */
function move_to($origen, $destino, $file)
{ 
	$dir_ = '../doc/upload/reportot/';
	$desdir_ = $dir_.$destino.'/';
	
	if(!file_exists($dir_))
		$rs_buffer_log = @mkdir($dir_, 0775);

	if(!file_exists($desdir_))
		$rs_buffer_log = @mkdir($desdir_, 0775);
	
	copy($origen.$file, $desdir_.$file); 
	unlink($origen.$file); 
}  


/**
 * Todos lo derechos reservados
 * Propiedad intelectual de Adsum (c)
 * 
 * Funcion grabadocureporte
 * @date 2011-07-05
 * 
 * @param $iRegdocureporte
 * @param $flagnuevodocureporte
 * @return $flagnuevodocureporte integer
 */
function grabadocureporte($iRegdocureporte,&$flagnuevodocureporte, $usuacodi)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9);
	
	if ($iRegdocureporte) 
	{ 
		$result = insrecorddocureporte($iRegdocureporte,$nuconn); 
		if($result < 0 ) 
		{ 
			ob_end_clean(); 
			fncmsgerror(errorReg); 
			$flagnuevodocureporte = 1; 
		} 
		if($result > 0) 
			move_to('../doc/upload/temp'.$usuacodi.'/', 'repcod'.$iRegdocureporte['reportcodigo'], $iRegdocureporte['docrepnombre']);
	}
	fncclose($nuconn);  
}