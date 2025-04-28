<?php 

function fncloadfileconf($file)
{
	define("_DISPLAYCONF", $file);
	
	$filePtr = file(_DISPLAYCONF);
	
	if(is_array($filePtr))
	{
		foreach ($filePtr as $v) {
			if($v[0] != "#")
			{
				$string_params = explode("=", rtrim($v));
				$sbregMail[$string_params[0]] = $string_params[1];				
			}
		}
		return $sbregMail;
	}
}