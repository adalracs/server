<?php 
	if(file_exists('../../'.$file))
	{
		$rs_buffer_del = @unlink('../../'.$file);
		echo $rs_buffer_del;
	}
	else
		echo 'noexist';