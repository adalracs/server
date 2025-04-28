<?php 
	include ('grabaeqmanpla.php');
	
	if($file_plano)
	{
		$plano = explode(':-:', $file_plano);
		
		for($b = 0; $b < count($plano); $b++)
		{
			if($plano[$b])
			{
				$field_plano['planoruta'] = '../img/planos/'.$plano[$b];
				$field_planoop['planoruta'] = '=';
				
				$idconn = fncconn();
				$irecord = dinamicscanopplano($field_plano, $field_planoop, $idconn);
				$sbRow = fncfetch($irecord, 0);

				$field_docuequi['equipocodigo'] = $equipocodigo;
				$field_docuequi['planocodigo'] = $sbRow[0];
				
				$result_rs = dinamicscandocuequi($field_docuequi, $idconn);
				
				if($result_rs <= 0)
				{				
					$record_docuequi['equipocodigo'] = $equipocodigo;
					$record_docuequi['planocodigo'] =  $sbRow[0];
					
					grabadocuequi($record_docuequi);
					unset($record_docuequi);
				}
				fncclose($idconn);
			}
		}
	}
	
	if($file_manual)
	{
		$manual = explode(':-:', $file_manual);
		for($b = 0; $b < count($manual); $b++)
		{
			if($manual[$b])
			{
				$field_manual['manualruta'] = '../doc/manuales/'.$manual[$b];
				$field_manualop['manualruta'] = '=';

				$idconn = fncconn();
				$irecord = dinamicscanopmanual($field_manual, $field_manualop, $idconn);
				$sbRow = fncfetch($irecord, 0);
				
				$field_docuequi['equipocodigo'] = $equipocodigo;
				$field_docuequi['manualcodigo'] = $sbRow[0];
				
				$result_rs = dinamicscandocuequi($field_docuequi, $idconn);
				
				if($result_rs <= 0)
				{						
					$record_docuequi['equipocodigo'] = $equipocodigo;
					$record_docuequi['manualcodigo'] =  $sbRow[0];
					
					grabadocuequi($record_docuequi);
					unset($record_docuequi);
				}
				fncclose($idconn);
			}
		}
	}
			
?>