<?php
	$uploaddir_manual = '../doc/manuales/';

	if(!file_exists($uploaddir_manual))	
		$rs_buffer_log = @mkdir($uploaddir_manual, 0777);	

	$uploadfile = $uploaddir_manual . basename($_FILES['userfile']['name']);

	if(!file_exists($uploadfile))
	{
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
		{
			include_once('grabaeqmanpla.php');

			$record_manual['manualnombre'] = basename($_FILES['userfile']['name']);
			$record_manual['manualruta'] =  $uploadfile;
			grabamanual($record_manual);

			echo "success";
		}
		else
	  		echo "error";
	}
	else
		echo "error_exist";