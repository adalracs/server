<?php
	if(file_exists('../../../img/pics_'.$ruth.'/'.$image))
	{
		$rs_buffer_del = @unlink('../../../img/pics_'.$ruth.'/'.$image);
		echo $rs_buffer_del;
	}
	else
		echo 'noexist';