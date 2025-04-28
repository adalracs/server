<?php
	include "../FunPerSecNiv/fncconn.php";
	include "../FunPerPriNiv/pktblplanta.php";
	include "../FunGen/cargainput.php";

	include "xcompress.php";
	include "zip.php";
	include "tar.php";

	function compressChar($plantas)
	{
		$dir_ = '../';
	
		if(!file_exists('Chart'.date("Ymd")))
			$rs_buffer_log = @mkdir('Chart'.date("Ymd"), 0775);

		$arrplantas = explode(',',$plantas);	
			
		$idcon = fncconn();
		for($a = 0; $a < count($arrplantas); $a++)
			copy('../FunChart/tmp-upload-images/graph_data'.$arrplantas[$a].'.png', 'Chart'.date("Ymd").'/chart_'.str_replace(" ", "_", strtoupper(cargaplantanombre($arrplantas[$a], $idcon))).'.png'  );
		
		$compress = new Zip();
		$compress->compressFolder('Chart'.date("Ymd"));
			
		if( $compress->saveFile('Chart'.date("Ymd").'.zip') )
			return 'Chart'.date("Ymd");
		else
			return -1; 
	}
	
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
	
	$path = compressChar($plantas);
	deleteRecursive($_SERVER['DOCUMENT_ROOT'].'/prjli/src/FunCompress/'.$path.'/');
	
	header("Content-type: application/zip");
	header("Content-Disposition: attachment; filename=$path.zip");
	header("Content-Transfer-Encoding: binary");
	readfile($path.'.zip');	
	
	unlink($path.'.zip');
//$compress = new Tar();
//$compress->extract("./test.zip", "./decomp1/");
//$compress->extract("./bin.tar.gz", "./");
//	if( $compress->saveFile("./sof.zip") )
//		echo 'Guardado con exito';
//	else
//		echo 'Error guardando'; 
