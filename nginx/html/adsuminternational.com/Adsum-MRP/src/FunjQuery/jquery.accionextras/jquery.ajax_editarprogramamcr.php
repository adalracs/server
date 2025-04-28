<?php 
	ini_set('display_errors',1);	
	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncsqlrun.php';	
	include '../../FunPerPriNiv/pktblprogramamicroperforado.php';
	include '../../FunPerPriNiv/pktblopp.php';
	include '../../FunPerPriNiv/pktblop.php';	
	include '../../FunGen/cargainput.php';
		
	$idcon = fncconn();
	
	if($arr_programa){
		$arrObject = explode(':|:',$arr_programa);
	}else{
		$respuesta[0]['error'] = 'error';
	}
	
	if($arroppview)
	{
		$array_tmp = explode(',',$arroppview);
		$array_key = array_flip($array_tmp);
	}
	
	for($a = 0;$a < count($arrObject);$a++)
	{
		$arrequipo = explode(',',$arrObject[$a]);
		$equipo = $arrequipo[0];
		for($b= 0;$b<count($arrequipo);$b++)
		{
			if($b>0)
			{
				$ircRecProgramamicroperforado['ordoppcodigo'] = $arrequipo[$b];
				$ircRecProgramamicroperforado['prograindice'] = $b;
				uprecordprogramamicroperforado($ircRecProgramamicroperforado,$idcon);
				$ircRecOpp['ordoppcodigo'] = $arrequipo[$b];
				$ircRecOpp['equipocodigo'] = $equipo;
				$ircRecOpp['ordoppcomfir'] = 0;
				if(is_array($array_key))
				{
					if(array_key_exists($arrequipo[$b], $array_key))
					{
						$ircRecOpp['ordoppcomfir'] = 1;
					}
				}	
				uprecordopp_equipo($ircRecOpp,$idcon);
				$ircRecOp['ordoppcodigo'] = $arrequipo[$b];
				$ircRecOp['equipocodigo'] = $equipo;
				uprecordop_equipo($ircRecOp,$idcon);
			}	
		}
	}
	$respuesta[0]['error'] = 'error-free';
	echo array_to_json($respuesta[0]);
?>