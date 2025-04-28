<?php
	$uploaddir_plano = '../img/planos/';


	if(!file_exists($uploaddir_plano))	
		$rs_buffer_log = @mkdir($uploaddir_plano, 0777);	

	$uploadfile = $uploaddir_plano . basename($_FILES['userfile']['name']);

	if(!file_exists($uploadfile))
	{
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
		{
			include_once('grabaeqmanpla.php');

			$record_plano['planonombre'] = basename($_FILES['userfile']['name']);
			$record_plano['planoruta'] =  $uploadfile;
			grabaplano($record_plano);

			echo "success";
		}
		else
	  		echo "error";
	}
	else
		echo "error_exist";