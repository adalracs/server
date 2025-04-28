<?php	

	$idcon = fncconn();
	$arrequipo = loadrecordequipo($equipocodigo,$idcon);
	$codequipo = $equipocodigo;
	
	$sistemcodigo = $arrequipo[sistemcodigo];
	$arrsistema = loadrecordsistema($sistemcodigo,$idcon);
	
	$plantacodigo = $arrsistema[plantacodigo];
	$arrplanta = loadrecordplanta($plantacodigo,$idcon);
	
?>