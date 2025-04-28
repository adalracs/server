<?php
	$uploaddir_img = '../../../img/pics_'.$ruth.'/';

	if(!file_exists($uploaddir_img))	
		$rs_buffer_log = @mkdir($uploaddir_img, 0777);	

	$uploadfile = $uploaddir_img.basename($_FILES['userfile']['name']);

	if(!file_exists($uploadfile))
	{
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
			echo "success";
		}else{
	  		echo "error";
	  	}

	}
	else{
		echo "error_exist";
	}