<?php 
	ini_set('display_errors',1);	
	include_once ('../src/FunGen/fncnumprox.php'); 
	include_once ('../src/FunGen/fncnumact.php'); 
	include_once ( '../src/FunGen/fncmsgerror.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproducto.php'); 
	include_once ( '../src/FunPerPriNiv/pktblcpdesadetope.php'); 
	include_once ( '../src/FunPerPriNiv/pktblcamperdesarr.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproductoseguimiento.php'); 

	define("grabaEx",3);
	define("errorIng",35);
	define("id1",269);
	
	//se valida campos personalizados de desarrollo
	include_once ('validacamperdesarr.php');
	if(!$flagnuevovistadesarrollo)
	{
		$idcon = fncconn();
		//Consecutivo para producto - padreitem
		$nuidtemp = fncnumact(129,$idcon);	
		do
		{
			$nuresult = loadrecordproducpadreitem($nuidtemp,$idcon);
			if($nuresult == e_empty)
				$iRegProducpadreitem[propadcodigo] = $nuidtemp - 1;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($nuidtemp);
		//almancena la estructura del pedido en la tabla producto padre item
		//se explosiona el array de tabla2
		if($arrtabla2) $arrObject = explode(':|:', $arrtabla2);
		////se borra los registros actuales si existen en la tabla produc padre item de tinta o adhesivo
		$resulta = delrecordproducpadreitem_tinta_adhe($produccodigo,$idcon);
		////se recorre el array
		for($i = 0; $i < count($arrObject); $i++)
		{
			//se explosiona por comodin ':-:'
			$arr = explode(':-:',$arrObject[$i]);
			//se explosiona por comodin ',' nota para el desempeño y tipo en caso de ser adhesivo
			$arr2 = explode(',',$arr[4]);
			//
			//se valida que sea solo tinta y adhesivo 25 o 23 en tabla padre item como configuracion de desarrollo
			if($arr[1] == 25 || $arr[1] == 23)
			{
				////se crea el ireg correspondiente a produc padre item
				$iRegProducpadreitem[propadcodigo] = $iRegProducpadreitem[propadcodigo] + 1;
				$iRegProducpadreitem[produccodigo] = $produccodigo;
				$iRegProducpadreitem[paditecodigo] = $arr[1];
				$iRegProducpadreitem[propadcalib] = $arr[3]; /* campo para almacenar calibre del item*/
				$iRegProducpadreitem[propadcolor] = $$objColor;
				$iRegProducpadreitem[propaddesem] = $arr2[1];
				$iRegProducpadreitem[propadtipo] = $arr2[2];
				$iRegProducpadreitem[propadindex] = ($i + 1);
				//inserta regsitros en padre item
				$resultado = insrecordproducpadreitem($iRegProducpadreitem,$idcon);
			}
		}	
		//se actualiza el consecutico de produc padre item
		if($resultado)
			fncnumprox(129,$iRegProducpadreitem[propadcodigo] + 1,$idcon);

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
		$iRegproductoseguimiento['prosegnombre']= "Gestionado {OK}";
		$iRegproductoseguimiento['usuacodi']=$usuacodi;
		$iRegproductoseguimiento['produccodigo']=$produccodigo;
		$iRegproductoseguimiento['prosegfecha']=date("Y-m-d");
		$iRegproductoseguimiento['proseghora']=date("h:i,a");
		$iRegproductoseguimiento['modulocodigoorg']= 3;//var conf modulo de desarrollo

		//condicion para pedido con impresion salta a proceso 4 dispensing
		if($tipo_impresion == 'interna' || $tipo_impresion == 'externa'){

			updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 4),$idcon);
			$iRegproductoseguimiento['modulocodigodes']= 4;//var conf modulo de dispensing
			if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
				fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 

			}

		}
		//condicion para pedido sin impresion salta a proceso 5 planeacion
		if($tipo_impresion == 'sin_impresion'){

			updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 5),$idcon);
			$iRegproductoseguimiento['modulocodigodes']= 5;//var conf modulo de planeacion
			if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
				fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 

			}

		}
		$flagnuevovistadesarrollo = 1;
		fncclose($idcon);
		//se llama el graba de campos personalizados
		include 'grabacamperdesarr.php';

		fncmsgerror(grabaEx);
		//se direcciona al maestro
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablvistadesarrollo.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
		
?>