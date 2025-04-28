<?php 

	ini_set('display_errors',1);
	
	include ('../src/FunGen/fncnumprox.php'); 
	include ('../src/FunGen/fncnumact.php'); 
	include ( '../src/FunGen/fncmsgerror.php'); 
	include ( '../src/FunPerPriNiv/pktblproducto.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproductoseguimiento.php'); 

	$flagcalificarvistafichatecnica = 1;
	
	define("grabaEx",3);
	define("errorIng",35);
	define("id",112);
	define("id1",269);
	
	$idcon = fncconn();
	$rsvarCal = dinamicscancptpdetope(array("produccodigo" => $produccodigo ,"cptprocodigo" => 1000),$idcon);	
		
	$campotros = "";
	if(!$otros)
		$otros = '-';
		
	if($tipitecodigo == 1) $campotros = "1017";
	if($tipitecodigo == 2) $campotros = "1018";
	if($tipitecodigo == 3) $campotros = "1019";
	if($tipitecodigo == 4) $campotros = "1020";
	if($tipitecodigo == 5) $campotros = "1021";
	if($tipitecodigo == 6) $campotros = "1022";
		
	$rsvarOtros = dinamicscancptpdetope(array("produccodigo" => $produccodigo ,"tipprocodigo" =>$tipitecodigo, "cptprocodigo" =>$campotros ),$idcon);
		
	$nuidtemp = fncnumact(id,$idcon);	
	do
	{
		$nuresult = loadrecordcptpdetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$codigo = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	unset($nuidtemp);

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


	$iRegproductoseguimiento['prosegnombre']=$arrRatings;
	$iRegproductoseguimiento['usuacodi']=$usuacodi;
	$iRegproductoseguimiento['produccodigo']=$produccodigo;
	$iRegproductoseguimiento['prosegfecha']=date("Y-m-d");
	$iRegproductoseguimiento['proseghora']=date("h:i,a");
	$iRegproductoseguimiento['modulocodigoorg']= 2;//var conf modulo de desarrollo => bandej pv


	$rwvarCal = fncfetch($rsvarCal,0);
	$iRegCptpdetope['cptodocodigo'] = $rwvarCal['cptodocodigo'];
	$iRegCptpdetope['cptprocodigo'] = 1000;
	$iRegCptpdetope['usuacodi'] = $rwvarCal['usuacodi'];
	$iRegCptpdetope['cptprovalor'] = ($arrRatings > 0)? 'FIC,'.$arrRatings : 0 ;
	$iRegCptpdetope['cptprofecha'] = date('Y-m-d');
	$iRegCptpdetope['cptpronota'] = $rwvarCal['cptpronota'];
	$iRegCptpdetope['produccodigo'] = $rwvarCal['produccodigo'];
	$res = uprecordcptpdetope($iRegCptpdetope,$idcon);

	if($arrRatings <= 0){

		updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 3),$idcon);
		$iRegproductoseguimiento['modulocodigodes']= 3;//var conf modulo de desarrollo => desarrollo
		if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
			fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
		}

	}else{

		updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 1),$idcon);
		$iRegproductoseguimiento['modulocodigodes']= 1;//var conf modulo de ventas
		if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
			fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
		}

	}	
		
	$nuidtemp = fncnumact(id,$idcon);	
	do
	{
		$nuresult = loadrecordcptpdetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$codigo = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
		
	if($rsvarOtros < 0)
	{
		$iRegCptpdetopeotros['cptodocodigo'] = $codigo;
		$iRegCptpdetopeotros['cptprocodigo'] = $campotros;
		$iRegCptpdetopeotros['usuacodi'] = $usuacodi;
		$iRegCptpdetopeotros['cptprovalor'] = $otros;
		$iRegCptpdetopeotros['cptprofecha'] = date('Y-m-d');
		$iRegCptpdetopeotros['cptpronota'] = 'Otros Motivos del producto '.$sbreg['produccodigo'];
		$iRegCptpdetopeotros['produccodigo'] = $produccodigo;
		$res = insrecordcptpdetope($iRegCptpdetopeotros,$idcon);
		if($res)
			fncnumprox(id,$iRegCptpdetopeotros['cptodocodigo'] + 1,$idcon); 
		
	}
	else
	{
		$rsvarOtros = fncfetch($rsvarOtros,0);
		$iRegCptpdetopeotros['cptodocodigo'] = $rsvarOtros['cptodocodigo'];
		$iRegCptpdetopeotros['cptprocodigo'] = $campotros;
		$iRegCptpdetopeotros['usuacodi'] = $usuacodi;
		$iRegCptpdetopeotros['cptprovalor'] = $otros;
		$iRegCptpdetopeotros['cptprofecha'] = date('Y-m-d');
		$iRegCptpdetopeotros['cptpronota'] = $rsvarOtros['cptpronota'];
		$iRegCptpdetopeotros['produccodigo'] = $rsvarOtros['produccodigo'];
		$res = uprecordcptpdetope($iRegCptpdetopeotros,$idcon);

	}
		
	if($res < 0){
		fncmsgerror(errorIng);
	}else{
		fncmsgerror(grabaEx);
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablvistafichatecnica.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
		
	fncclose($idcon);
		
?>