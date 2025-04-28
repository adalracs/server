<?php 

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunPerPriNiv/pktblsoliprog.php');
include ( '../src/FunPerPriNiv/pktblop.php');
include ( '../src/FunPerPriNiv/pktblopextrusion.php');    
include ( '../src/FunPerPriNiv/pktblgestionsoliprog.php');    
include ( '../src/FunPerPriNiv/pktblgestionsoliprogmat.php');    
include ( '../src/FunPerPriNiv/pktblplanearutaitempv.php');    
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include( '../src/FunGen/fncnombeditexs.php');

//validaciones manuales para solicitud de programacion de extrusion
//evita un solicitud con unagestion incompleta
if(!$arropsoliext)
{
	//se llena la variable campnomb con los campos faltantes
	$campnomb['arropsoliext'] = 1;
	//se activan las banderas de intento de grabado
	$flageditarvistasoliextru = 1;
}
//evita un solicitud con unagestion incompleta
/*
if(!$arrmatsoliextru)
{
	//se llena la variable campnomb con los campos faltantes
	$campnomb['arrmatsoliextru'] = 1;
	//se activan las banderas de intento de grabado
	$flageditarvistasoliextru = 1;
}
*/
//valida los campos cuando se genera una orden de produccion
if($arropsoliext)
{
	unset($arrObject);//se setea la variable
	if($arropsoliext) $arrObject = explode(':|:',$arropsoliext);
	for($a = 0;$a< count($arrObject);$a++){
		$arr = explode(':-:',$arrObject[$a]);
		//objetos a utilizar
		$obj_cantidad = 'cantidad_'.$arr[1].'_'.$a;
		$obj_ancho = 'ancho_'.$arr[1].'_'.$a;
		//validacion de cantidad a produccir
		if(validaint4($$obj_cantidad) > 0 || !$$obj_cantidad){$campnomb['cantidad_'] = 1;$flageditarvistasoliextru = 1;}
		//validacion de ancho a extruir
		if(validaint4($$obj_ancho) > 0 || !$$obj_ancho){$campnomb['ancho_'] = 1;$flageditarvistasoliextru = 1;}
	}
}
//valida los campos cuando se genera una orden de produccion
if($arrmatsoliextru)
{
	unset($arrObject);
	if($arrmatsoliextru) $arrObject = explode(',',$arrmatsoliextru);
	for($a = 0;$a< count($arrObject);$a++){
		//objetos a utilizar
		$obj_consumo = 'consumo_'.$arrObject[$a];
		//validacion de consumo o cantidad a asingar
		if(validaint4($$obj_consumo) > 0 || !$$obj_consumo){$campnomb['consumo_'] = 1;$flageditarvistasoliextru = 1;}
	}
}
//valida los campos cuando se genera una orden de produccion
if($arrtarsoliextru)
{
	unset($arrObject);
	if($arrtarsoliextru) $arrObject = explode(',',$arrtarsoliextru);
	for($a = 0;$a< count($arrObject);$a++){
		//objetos a utilizar
		$obj_ancho = 'ancho_'.$arrObject[$a];
		$obj_anchoc = 'ancho_corte_'.$arrObject[$a];
		$obj_dif_mm = 'dif_mm_'.$arrObject[$a];
		$obj_dif_kg = 'dif_kg_'.$arrObject[$a];
		$obj_destino = 'destino_'.$arrObject[$a];
		//validacion de consumo o cantidad a asingar
		if(validaint4($$obj_ancho) > 0 || !$$obj_ancho){$campnomb['_ancho_'] = 1;$flageditarvistasoliextru = 1;}
		//validacion de ancho a cortar
		if(validaint4($$obj_anchoc) > 0 || !$$obj_anchoc){$campnomb['ancho_corte_'] = 1;$flageditarvistasoliextru = 1;}
		//validacion de diferencia en milimetros (mm)
		if(validaint4($$obj_dif_mm) > 0 || !$$obj_dif_mm){$campnomb['dif_mm_'] = 1;$flageditarvistasoliextru = 1;}
		//validacion de diferencia en kilogramos (kg)
		if(validafloat4($$obj_dif_kg) > 0 || !$$obj_dif_kg){$campnomb['dif_kg_'] = 1;$flageditarvistasoliextru = 1;}
		//validacion de destino
		if(!$$obj_destino){$campnomb['destino_'] = 1;$flageditarvistasoliextru = 1;}
	}
}
//si no hay error en el formulario registra las ordenes y gestiones
if(!$flageditarvistasoliextru)
{	
	//conectar
	$nuconn_op = fncconn();
	//escaneo a la tabla planea padreitem
	$nr_op = 0;
	$rsPlaneapadreitem = dinamicscanplaneapadreitem(array("produccodigo" => $produccodigo),$nuconn_op);
	//consulta numero de materiales planeados
	$nrPlaneapadreitem = fncnumreg($rsPlaneapadreitem);
	//recorre consulta
	for($i=0;$i<$nrPlaneapadreitem;$i++)
	{
		//trae registo de padre item dependiendo de su indice
		$rwPlaneapadreitem = fncfetch($rsPlaneapadreitem,$i);
		$rwpadreitem = loadrecordpadreitem($rwPlaneapadreitem['paditecodigo'],$nuconn_op);
		//consulta su el material es extruido
		if($rwpadreitem['paditeextrui'] == 't')
		{
			//objetos a usar
			$obj_material = 'material_'.$nr_op;
			$obj_calibre = 'calibre_'.$nr_op;
			$obj_cant_kg = 'cant_kg_'.$nr_op;
			$obj_cant_mt = 'cant_mt_'.$nr_op;
			$obj_ancho = 'ancho_'.$nr_op;
			$obj_formulacion = 'formulacion_'.$nr_op;
			//valor de los objetos
			$$obj_material = $rwpadreitem['paditecodigo'];
			$$obj_calibre = $rwPlaneapadreitem['plapadcalib'];
			$$obj_cant_kg = $rwPlaneapadreitem['plapadcantkg'];
			$$obj_cant_mt = $rwPlaneapadreitem['plapadcantmt'];
			$$obj_ancho = $rwPlaneapadreitem['plapadanchoi'];
			$$obj_formulacion = $rwPlaneapadreitem['formulcodigo'];
			$nr_op++;
		}
	}
	//se recorre el array de ordenes de produccion para su respectiva creacion
	if($arropsoliext)
	{
		define("editaEx",9);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$nuconn_op);
		do
		{
			$nuresult = loadrecordop($nuidtemp,$nuconn_op);
			if($nuresult == e_empty)
			{
				$iRegop[ordprocodigo] = $nuidtemp - 1;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		//	se inicio el recorrido del array
		unset($arrObject);//se sera la variable
		if($arropsoliext) $arrObject = explode(':|:',$arropsoliext);
		//se recorre el array explosianado
		for($a = 0;$a< count($arrObject);$a++){
			$arr = explode(':-:',$arrObject[$a]);
			//objetos a utilizar
			$obj_material_ = 'material_'.$arr[2];
			$obj_calibre = 'calibre_'.$arr[2];
			$obj_formulacion = 'formulacion_'.$arr[2];
			$obj_cantidad = 'cantidad_'.$arr[1].'_'.$a;
			$obj_ancho = 'ancho_'.$arr[1].'_'.$a;
			$obj_refile = 'refile_'.$arr[1].'_'.$a;		
			//----------------------------------------------------
			//calculo metraje
			$rwPadreitem = loadrecordpadreitem($$obj_material_,$nuconn_op);
			$cant_mts = $$obj_cantidad / ($$obj_ancho * ($rwPadreitem['paditedensid'] * $$obj_calibre) ) * 1000000;
			//record para orden de produccion
			$iRegop[ordprocodigo] = $iRegop[ordprocodigo] + 1;
			$iRegop[solprocodigo] = $solprocodigo;
			$iRegop[usuacodi] = $usuacodi;
			$iRegop[ordprofecgen] = date('Y-m-d');
			$rwhora = getdate(time());
			$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
			$iRegop[ordprohorgen] = $hora;
			$iRegop[plantacodigo] = 1;//planta yumbo
			$iRegop[ordproacti] = 1;//orden activa
			$iRegop[procedcodigo] = $procedcodigo;
			$iRegop[opestacodigo] = 1;//creada esta inicial
			//se inserta el registro de orden de produccion
			$res = insrecordop($iRegop,$nuconn_op);
			//record para el detalle para la gestion de la op
			$iRegopextrusion[ordprocodigo] = $iRegop[ordprocodigo];
			$iRegopextrusion[paditecodigo] = $$obj_material_;
			$iRegopextrusion[ordprocalib] = $$obj_calibre;
			$iRegopextrusion[formulcodigo] = $$obj_formulacion;
			$iRegopextrusion[ordprocantid] = $$obj_cantidad;
			$iRegopextrusion[ordproanchop] = $$obj_ancho;
			$iRegopextrusion[ordprometros] = $cant_mts;
			$iRegopextrusion[ordproanchom] = $ancho;
			$iRegopextrusion[ordpropista] = $nropistas;
			$iRegopextrusion[ordprorefile] = $$obj_refile;
			//
			//se le inserta el registro detallado de la operacion de produccion
			$res = insrecordopextrusion($iRegopextrusion,$nuconn_op);
		}
	}
	if($res > 0)
	{
		fncmsgerror(editaEx);
	}
	//se actualiza el consecutico de produc padre item
	fncnumprox(145,$iRegop[ordprocodigo] + 1,$nuconn_op); 
	//desconectar
	fncclose($nuconn_op);
	//conectar
	$nuconn_ges = fncconn();
	//valida los materiales asignados en una gestion
	if($arrmatsoliextru)
	{
		//consecutivo de gestion de orden de produccion
		$nuidtemp = fncnumact(146,$nuconn_ges);
		do
		{
			$nuresult = loadrecordgestionsoliprog($nuidtemp,$nuconn_ges);
			if($nuresult == e_empty)
			{
				$iReggestionsoliprog[gessolcodigo] = $nuidtemp - 1;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		//se crea el registro de la nueva gestion 
		$iReggestionsoliprog[gessolcodigo] = $iReggestionsoliprog[gessolcodigo] +1;
		$iReggestionsoliprog[solprocodigo] = $solprocodigo;
		$iReggestionsoliprog[usuacodi] = $usuacodi;
		$iReggestionsoliprog[solprofecha] = date('Y-m-d');
		$rwhora = getdate(time());
		$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
		$iReggestionsoliprog[solprohora] = $hora;
		$iReggestionsoliprog[solprodescri] = $solprodescri;
		$res = insrecordgestionsoliprog($iReggestionsoliprog,$nuconn_ges);
		//inicia el reccorrido del array de gestiones
		unset($arrObject);
		if($arrmatsoliextru) $arrObject = explode(',',$arrmatsoliextru);
		for($a = 0;$a< count($arrObject);$a++){
			//objetos a utilizar
			$obj_consumo = 'consumo_'.$arrObject[$a];
			//se crea el registro de la nueva gestion de materiales
			$iReggestionsoliprogmat[gessolcodigo] = $iReggestionsoliprog[gessolcodigo];
			$iReggestionsoliprogmat[itedescodigo] = $arrObject[$a];
			$iReggestionsoliprogmat[gessolcantid] = $$obj_consumo;
			$res = insrecordgestionsoliprogmat($iReggestionsoliprogmat,$nuconn_ges);
		}
	}
	//se actualiza el consecutico de produc padre item
	fncnumprox(146,$iReggestionsoliprog[gessolcodigo] + 1,$nuconn_ges); 
	//desconectar
	fncclose($nuconn_ges);
	//conectar
	$nuconn_tar = fncconn();
	//valida los campos cuando se genera una orden de produccion
	if($arrtarsoliextru)
	{
		//consecutivo de gestion de orden de produccion
		$nuidtemp = fncnumact(139,$nuconn_tar);
		do
		{
			$nuresult = loadrecordplanearutaitempv($nuidtemp,$nuconn_tar);
			if($nuresult == e_empty)
			{
				$iRegplanearutaitempv[plarutcodigo] = $nuidtemp - 1;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($arrObject);
		if($arrtarsoliextru) $arrObject = explode(',',$arrtarsoliextru);
		for($a = 0;$a< count($arrObject);$a++){
			//	objetos a utilizar
			$obj_ancho = 'ancho_'.$arrObject[$a];
			$obj_anchoc = 'ancho_corte_'.$arrObject[$a];
			$obj_dif_mm = 'dif_mm_'.$arrObject[$a];
			$obj_dif_kg = 'dif_kg_'.$arrObject[$a];
			$obj_destino = 'destino_'.$arrObject[$a];
			//se crea el registro de planearuteitempv ruta del pedidoventa
			$iRegplanearutaitempv[plarutcodigo] = $iRegplanearutaitempv[plarutcodigo] + 1;  
			$iRegplanearutaitempv[produccodigo] = $produccodigo;
			$iRegplanearutaitempv[procedcodigo] = 14;//procedimiento corte de reproceso
			$iRegplanearutaitempv[plarutcorter] = $$obj_anchoc.','.$$obj_destino.','.$$obj_dif_mm.','.$$obj_dif_kg;//corte de reproceso
			$iRegplanearutaitempv[plarutorden] = 0;//para no dañar el orden de la ruta
			$iRegplanearutaitempv[estsolcodigo] = 1;//Estado de la solicitud generado
			$res = insrecordplanearutaitempv($iRegplanearutaitempv,$nuconn_tar);
		}
	}
	//se actualiza el consecutico de produc padre item
	fncnumprox(139,$iRegplanearutaitempv[plarutcodigo] + 1,$nuconn_tar); 
	//desconectar
	fncclose($nuconn_tar);
	/*
	 * despues que se registran los diferentes eventos de la gestion 
	 * se reporta en la tabla de {planearutaitempv} que la solicutud de extrucion 
	 * cambia de estado referentes a la tabla de {soliprogestado}
	 */
	//conectar
	$nuconn_soliprog = fncconn();
	//se crea el registro para actualizar planearuteitempv ruta del pedidoventa
	$iRegplanearutaitempv_[plarutcodigo] = $plarutcodigo;//programada 
	$iRegplanearutaitempv_[estsolcodigo] = 2;//programada 
	uprecordplanearutaitempvestado($iRegplanearutaitempv_,$nuconn_soliprog);
	//desconectar
	fncclose($nuconn_soliprog);
	$flageditarvistasoliextru = 1;
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablvistasoliextru.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
?>