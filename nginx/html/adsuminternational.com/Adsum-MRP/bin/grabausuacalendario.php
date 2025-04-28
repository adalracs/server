<?php 
	delrecordusuacalendario($recordCalendar['calendcodigo'], $idcon);					
	
	for($i = 0; $i < count($arr_tecnico); $i++)
	{
		$iRegusuacalendario['calendcodigo'] = $recordCalendar['calendcodigo'];
		$iRegusuacalendario['usuacodi'] = $arr_tecnico[$i];
		$iRegusuacalendario['usucallider'] = 'f';
		
		if($arr_tecnico[$i] == $usualider)
			$iRegusuacalendario['usucallider'] = 't';
			
		insrecordusuacalendario($iRegusuacalendario, $idcon); 
	}