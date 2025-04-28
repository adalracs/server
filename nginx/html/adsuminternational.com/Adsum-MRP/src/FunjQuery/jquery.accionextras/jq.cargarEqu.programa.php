<?php 
	ini_set('display_errors',1);	
	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncsqlrun.php';	

	//arr de configuracion
	
	$array = array(
		'1' => 'programaextrusion',
		'2' => 'programalaminado',
		'3' => 'programaflexo',
		'4' => 'programacorte',
		'5' => 'programasellado',
		'6' => 'programatroquelado',
		'7' => 'programapauchado',
		'8' => 'programadoblado',
		'9' => 'programamicroperforado',
		'10' => 'programacorte',
		'12' => 'programavalvulado',
		'13' => 'programacorteextrusion'
		);

	$caminoPktl = '../../FunPerPriNiv/pktbl'.$array[$id].'.php';
	
	if( is_readable($caminoPktl) ){

		require_once ( $caminoPktl );

		$idcon = fncconn();		
		$variableFuncion = 'fullscan'.$array[$id].'disctequipo';

		if( is_callable($variableFuncion) ){
			$rsEquipo = call_user_func($variableFuncion,$idcon);
			$nrEquipo = fncnumreg($rsEquipo);

			for( $a = 0; $a < $nrEquipo; $a++ )
			{
				$rwEquipo = fncfetch( $rsEquipo, $a );
				if($rwEquipo['equipocodigo'])
					$arrequipo = ($arrequipo)? $arrequipo = $arrequipo.','.$rwEquipo['equipocodigo'] : $arrequipo = $rwEquipo['equipocodigo'];
			}

			$respuesta[0]['arrequipo'] = $arrequipo;
			$respuesta[0]['arrconf'] = $array;
		}

		fncclose($idcon);

	}
	
	echo array_to_json($respuesta[0]);
	
?>