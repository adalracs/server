<?php 
//by ralvear ramiro-ok@hotmail.com
	ini_set('display_errors',1);
	//conectar
	$con = fncconn();
	//consecutivo para campo personalizado
	$nuidtemp_ = fncnumact(142,$con);	
	do
	{
		$nuresult_ = loadrecordsoliprog($nuidtemp_,$con);
		if($nuresult_ == e_empty)
			$iRegsoliprog[solprocodigo] = $nuidtemp_;
		$nuidtemp_ ++;
	}while ($nuresult_ != e_empty);
	//se crea el registro de soliprog {solicitud de programacion}
	$iRegsoliprog[estsolcodigo] = 1;
	$iRegsoliprog[usuacodi] = $usuacodi;				
	$iRegsoliprog[produccodigo] = $produccodigo;
	$iRegsoliprog[solprofecha] = date('Y-m-d');
	$rwhora = getdate(time());
	$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
	$iRegsoliprog[solprohora] = $hora;										
	$iRegsoliprog[plantacodigo] = 1;
	$iRegsoliprog[solprodescri] = 'Generada.';		
	$res = insrecordsoliprog($iRegsoliprog,$con);
	
	if($res > 0)
	{
		echo '<script language= "javascript">';
		echo '<!--//'."\n";
		echo 'alert("Se creo solicitud de programacion #{'.$iRegsoliprog[solprocodigo].'}")';
		echo '//-->'."\n";
		echo '</script>';
		fncnumprox(142,$iRegsoliprog[solprocodigo] + 1,$con); 
	}	
				
?>
