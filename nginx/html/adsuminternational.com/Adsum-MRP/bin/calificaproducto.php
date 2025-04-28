<?php 
//by ralvear ramiro-ok@hotmail.com
	ini_set('display_errors',1);
	include ( '../src/FunGen/fncnumprox.php'); 
	include ( '../src/FunGen/fncnumact.php'); 
	include ( '../src/FunGen/fncmsgerror.php'); 
	include ( '../src/FunPerPriNiv/pktblproducto.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproductoseguimiento.php'); 

	$flagcalificarproducto=1;
	
	define("grabaEx",3);
	define("errorIng",35);
	define("id",112);
	define("id1",269);

	$idcon = fncconn();

	//consulta dinamica de la calificacion del producto
	$rsvarCal = dinamicscancptpdetope(array("produccodigo" => $produccodigo ,"cptprocodigo" => 1000),$idcon);

	//consecutivo para la tabla campo personalizado
	$nuidtemp = fncnumact(id,$idcon);	
	do
	{
		$nuresult = loadrecordcptpdetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$codigo_cptodo = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	unset($nuidtemp);

	//consecutivo para codigo producto seguimiento
	$nuidtemp = fncnumact(id1,$idcon);	
	do
	{
		$nuresult = loadrecordproductoseguimiento($nuidtemp,$idcon);
		if($nuresult == e_empty){
			$iRegproductoseguimiento['prosegcodigo'] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	unset($nuidtemp);

	//seguimiento del producto
	$iRegproductoseguimiento['prosegnombre']= ($arrRatings)? $arrRatings : 0 ;
	$iRegproductoseguimiento['usuacodi']=$usuacodi;
	$iRegproductoseguimiento['produccodigo']=$produccodigo;
	$iRegproductoseguimiento['prosegfecha']=date("Y-m-d");
	$iRegproductoseguimiento['proseghora']=date("h:i,a");
	$iRegproductoseguimiento['modulocodigoorg']= 1;//var conf modulo de ventas


	//valida sin hay calificacion para actualizar el registro o insertar
	if($rsvarCal < 0)
	{
		//crear el ireg de campo personalizado
		$iRegCptpdetope['cptodocodigo'] = $codigo_cptodo;
		$iRegCptpdetope['cptprocodigo'] = 1000;
		$iRegCptpdetope['usuacodi'] = $usuacodi;
		$iRegCptpdetope['cptprovalor'] = ($arrRatings > 0)? 'VEN,'.$arrRatings : 0 ;
		$iRegCptpdetope['cptprofecha'] = date('Y-m-d');
		$iRegCptpdetope['cptpronota'] = 'Calificacion del producto '.$sbreg['produccodigo'];
		$iRegCptpdetope['produccodigo'] = $produccodigo;
		//inserta el registro de campo personalizado
		$res = insrecordcptpdetope($iRegCptpdetope,$idcon);
		if($res)
			fncnumprox(id,$iRegCptpdetope['cptodocodigo'] + 1,$idcon); 
		//valida para avanzar de proceso o permancer
		if($tipevecodigo != '3')
		{
			//si no tiene campos marcardos avanza de proceso
			//cuando es nuevo muestra o modificacion avanza a fichas tecnicas proceso 2
			if($arrRatings <= 0){

				updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 2),$idcon);
				$iRegproductoseguimiento['modulocodigodes']= 2;//var conf modulo de desarrollo => bandeja pv
				if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
					fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
				}

			}
		}
		else
		{
			//si no tiene campos marcardos avanza de proceso
			//cuando es repeticion avanza a planeacion proceso 5
			if($arrRatings <= 0){
			
				updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 5),$idcon);
				$iRegproductoseguimiento['modulocodigodes']= 5;//var conf modulo de planeacion
				if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
					fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
				}

			}
		}
	}
	else
	{
		//crear el ireg de campo personalizado
		$rwvarCal = fncfetch($rsvarCal,0);
		$iRegCptpdetope['cptodocodigo'] = $rwvarCal['cptodocodigo'];
		$iRegCptpdetope['cptprocodigo'] = 1000;
		$iRegCptpdetope['usuacodi'] = $usuacodi;
		$iRegCptpdetope['cptprovalor'] = ($arrRatings > 0)? 'VEN,'.$arrRatings : 0 ;
		$iRegCptpdetope['cptprofecha'] = date('Y-m-d');
		$iRegCptpdetope['cptpronota'] = $rwvarCal['cptpronota'];
		$iRegCptpdetope['produccodigo'] = $rwvarCal['produccodigo'];
		//actualiza el registro de campo personalizado
		$res = uprecordcptpdetope($iRegCptpdetope,$idcon);
		//valida para avanzar de proceso o permancer
		if($tipevecodigo != '3')
		{
			//si no tiene campos marcardos avanza de proceso
			//cuando es nuevo muestra o modificacion avanza a fichas tecnicas proceso 2
			if($arrRatings <= 0){

				updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 2),$idcon);
				$iRegproductoseguimiento['modulocodigodes']= 2;//var conf modulo de desarrollo => bandeja pv
				if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
					fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
				}

			}
		}
		else
		{
			//si no tiene campos marcardos avanza de proceso
			//cuando es repeticion avanza a planeacion proceso 5
			if($arrRatings <= 0){

				updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 5),$idcon);
				$iRegproductoseguimiento['modulocodigodes']= 5;//var conf modulo de planeacion
				if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
					fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
				}

			}
		}
	}


	//campo de observacion de otros
	$campotros = "";
	//validacion de campo otros
	if(!$otros)
		$otros = '-';
	//codificacion de otros en tabla de campos personalizados
	if($tipitecodigo == 1) $campotros = "1017";
	if($tipitecodigo == 2) $campotros = "1018";
	if($tipitecodigo == 3) $campotros = "1019";
	if($tipitecodigo == 4) $campotros = "1020";
	if($tipitecodigo == 5) $campotros = "1021";
	if($tipitecodigo == 6) $campotros = "1022";

	//conusulta el registro de otros
	$rsvarOtros = dinamicscancptpdetope(array("produccodigo" => $produccodigo ,"tipprocodigo" =>$tipitecodigo, "cptprocodigo" =>$campotros ),$idcon);
	//si no tiene campo de otros se inserta
	//consecutivo para la tabla campo personalizado
	$nuidtemp = fncnumact(id,$idcon);	
	do
	{
		$nuresult = loadrecordcptpdetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$codigo_cptodo_otros = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);


	//valida sin hay calificacion para actualizar el registro o insertar
	if($rsvarOtros < 0)
	{
		//registro de campo personalizado de otros
		$iRegCptpdetopeotros['cptodocodigo'] = $codigo_cptodo_otros;
		$iRegCptpdetopeotros['cptprocodigo'] = $campotros;
		$iRegCptpdetopeotros['usuacodi'] = $usuacodi;
		$iRegCptpdetopeotros['cptprovalor'] = $otros;
		$iRegCptpdetopeotros['cptprofecha'] = date('Y-m-d');
		$iRegCptpdetopeotros['cptpronota'] = 'Otros Motivos del producto '.$sbreg['produccodigo'];
		$iRegCptpdetopeotros['produccodigo'] = $produccodigo;
		$res_ = insrecordcptpdetope($iRegCptpdetopeotros,$idcon);
		if($res_)
			fncnumprox(id,$iRegCptpdetopeotros['cptodocodigo'] + 1,$idcon); 
	}
	//si  tiene campo de otros se actualiza
	else
	{
		//registro de campo personalizado de otros
		$rsvarOtros = fncfetch($rsvarOtros,0);
		$iRegCptpdetopeotros['cptodocodigo'] = $rsvarOtros['cptodocodigo'];
		$iRegCptpdetopeotros['cptprocodigo'] = $campotros;
		$iRegCptpdetopeotros['usuacodi'] = $usuacodi;
		$iRegCptpdetopeotros['cptprovalor'] = $otros;
		$iRegCptpdetopeotros['cptprofecha'] = date('Y-m-d');
		$iRegCptpdetopeotros['cptpronota'] = $rsvarOtros['cptpronota'];
		$iRegCptpdetopeotros['produccodigo'] = $rsvarOtros['produccodigo'];
		$res_ = uprecordcptpdetope($iRegCptpdetopeotros,$idcon);
	}	
		
	if($res < 0)
	{
		fncmsgerror(errorIng);
	}
	else
	{
		fncmsgerror(grabaEx);
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
		
	fncclose($idcon);
		
?>