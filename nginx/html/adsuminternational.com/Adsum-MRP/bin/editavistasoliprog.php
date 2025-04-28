<?php
ini_set('display_errors',1);
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunPerPriNiv/pktblsoliprog.php');
include ( '../src/FunPerPriNiv/pktblop.php');
include ( '../src/FunPerPriNiv/pktblopextrusion.php');
include ( '../src/FunPerPriNiv/pktblopflexo.php');
include ( '../src/FunPerPriNiv/pktbloplaminado.php');
include ( '../src/FunPerPriNiv/pktblopcorte.php');
include ( '../src/FunPerPriNiv/pktblopsellado.php');
include ( '../src/FunPerPriNiv/pktbloppauchado.php');
include ( '../src/FunPerPriNiv/pktblopdoblado.php');
include ( '../src/FunPerPriNiv/pktblopmicroperforado.php');
include ( '../src/FunPerPriNiv/pktbloptroquelado.php');
include ( '../src/FunPerPriNiv/pktblopvalvulado.php');
include ( '../src/FunPerPriNiv/pktblgestionsoliprog.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');
//constantes
define("editaEx",9);
//conexion
$idcon = fncconn();
	
$producto = $produccodigo;
include 'cargarcampertippro.php';
	
$producto = $produccodigo;
include 'cargarcamperdesarr.php';
	
$producto = $produccodigo;
include 'cargarcamperplanea.php';
	
include 'cargarconfsoliprog.php';

//adicion
$ancho = str_replace(",", ".", $ancho);
$ancho = str_replace(" ", "", $ancho);

$largo = str_replace(",", ".", $largo);
$largo = str_replace(" ", "", $largo);
//----------------------------------VALIDACION DEL FORMULARIO----------------------------------//
//validacion para tipoimpresion
if(!$tipo_impresion)
{
	$tipo_impresion = 'TEST'; 
	$flageditarvistasoliprog = 1;
	$campnomb['tipo_impresion'] = 1;
}
//validacion para ancho producto
if(!$ancho || validafloat4($ancho) > 0)
{
	$flageditarvistasoliprog = 1;
	$campnomb['ancho'] = 1;
}
//validacion para continuo
if(!$continuo)
{
	$continuo = 'TEST';
	$flageditarvistasoliprog = 1;
	$campnomb['continuo'] = 1;
}
//validacion para numero de repeticiones
if(!$nrorepet)
{
	$nrorepet = 111;
	$flageditarvistasoliprog = 1;
	$campnomb['nrorepet'] = 1;
}
//validacion para rodillo
if(!$rodillo)
{
	$rodillo = 111;
	$flageditarvistasoliprog = 1;
	$campnomb['rodillo'] = 1;
}
//validacion para numero de pistas
if(!$nropistas)
{
	$nropistas = 111;
	$flageditarvistasoliprog = 1;
	$campnomb['nropistas'] = 1;
}
//validacion para tipo de estructura
if(!$tipo_estruc)
{
	$tipo_estruc = 'TEST';
	$flageditarvistasoliprog = 1;
	$campnomb['tipo_estruc'] = 1;
}
//validacion para tamaño del core
/*if(!$tam_core)
{
	$tam_core = 111;
	$flageditarvistasoliprog = 1;
	$campnomb['tam_core'] = 1;
}*/
//validacion para version del arte
if(!$version_arte)
{
	$version_arte = 'TEST';
	$flageditarvistasoliprog = 1;
	$campnomb['version_arte'] = 1;
}
//validacion para ancho de proceso
if(!$anchoproceso)
{
	$anchoproceso = 111;
	$flageditarvistasoliprog = 1;
	$campnomb['anchoproceso'] = 1;
}
//validacion para producto a imprimir
if(!$product_imp)
{
	$product_imp = 11;
	$flageditarvistasoliprog = 1;
	$campnomb['product_imp'] = 1;
}
//validacion para producto a largo
if(!$largo || validafloat4($largo) > 0)
{
	$largo = 111;
	$flageditarvistasoliprog = 1;
	$campnomb['largo'] = 1;
}
//validacion para producto a $pmillar
if(!$pmillar)
{
	$largo = 111;
	$flageditarvistasoliprog = 1;
	$campnomb['pmillar'] = 1;
}
/*
//validacion para producto a fuelle
if(!$fuelle)
{
	$flageditarvistasoliprog = 1;
	$campnomb['fuelle'] = 1;
}
*/
//$campnomb,
UNSET($campnomb,$flageditarvistasoliprog);
if( (!$ancho || validafloat4($ancho) > 0 ) && $tipitecodigo != 5 )
{
	$flageditarvistasoliprog = 1;
	$campnomb['ancho'] = 1;
}
if(!$largo || validafloat4($largo) > 0)
{
	$largo = 111;
	$flageditarvistasoliprog = 1;
	$campnomb['largo'] = 1;
}
//validacion para ancho de proceso
if(!$solprofecest || validadate($solprofecest) > 0)
{
	$flageditarvistasoliprog = 1;
	$campnomb['solprofecest'] = 1;
}
//validacion para total calibre
if(!$total_calibre || validafloat4($total_calibre) > 0)
{
	$flageditarvistasoliprog = 1;
	$campnomb['totalcalibre_cor'] = 1;
}

//----------------------------------VALIDACION EXTRUSION----------------------------------//
if($arrProceso['tabs_solicitud']['ext'][0] > 0){

	if(!$arrmatsoliextru){
		$flageditarvistasoliprog = 1;
		$campnomb['materialasig'] = 1;
	}
	//validacion de necesidad de produccion extrusion
	for($a = 0;$a < count($arrMateriales);$a++)
	{
		if($arrMateriales[$a]['paditeextrui'] == 't')
		{	
			$obj_genordeproduccion = 'genordeproduccion_'.$arrMateriales[$a]['paditecodigo'];
			$obj_cantidadkilos = 'cantkilos_'.$arrMateriales[$a]['paditecodigo'];	
			//validacion para producto a genordeproduccion
			if(!$$obj_genordeproduccion)
			{
				$flageditarvistasoliprog = 1;
				$campnomb[$obj_genordeproduccion] = 1;
			}

			/*else if( (!$$obj_genordeproduccion && !$arrmatsoliextru) || ($$obj_genordeproduccion > 1 && !$arrmatsoliextru))
			{
				$flageditarvistasoliprog = 1;
				$campnomb['materialasig'] = 1;
			}*/
			
			//validacion para producto a kilosgramos de extrusion
			if(!$$obj_cantidadkilos || validafloat4($$obj_cantidadkilos) > 0)
			{
				$flageditarvistasoliprog = 1;
				$campnomb[$obj_cantidadkilos] = 1;
			}
			//validacion para calibre que sea entero y que no este vacio
			if(validafloat4($arrMateriales[$a]['plapadcaliba1']) > 0 || !$arrMateriales[$a]['plapadcaliba1'])
			{
				$campnomb['plapadcaliba1_ext'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para kilogramos que sea entero y que no este vacio
			if(validafloat4($arrMateriales[$a]['plapadcantkg']) > 0 || !$arrMateriales[$a]['plapadcantkg'])
			{
				$campnomb['plapadcantkg_ext'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para metros que sea entero y que no este vacio
			if(validafloat4($arrMateriales[$a]['plapadcantmt']) > 0 || !$arrMateriales[$a]['plapadcantmt'])
			{
				$campnomb['plapadcantmt_ext'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para ancho que sea entero y que no este vacio
			if(validaint4($arrMateriales[$a]['formulcodigo']) > 0 || !$arrMateriales[$a]['formulcodigo'])
			{
				$campnomb['formulnumero_ext'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para ancho que sea entero y que no este vacio
			if(validafloat4($arrMateriales[$a]['plapadanchoi']) > 0 || !$arrMateriales[$a]['plapadanchoi'])
			{
				$campnomb['plapadanchoi_ext'] = 1;
				$flageditarvistasoliprog = 1;
			}
		}
	}
	//valida los campos cuando se genera una orden de produccion
	if($arrmatsoliextru)
	{	
		if($arrmatsoliextru) $rwMatsoliextru = explode(':|:',$arrmatsoliextru);
		//se recorre el arreglo
		for($a = 0;$a< count($rwMatsoliextru);$a++){
			//objetos a utilizar
			$gessolcantid_	 = 'gessolcantid_'.$rwMatsoliextru[$a];
			//validacion de consumo o cantidad a asingar
			if(validaint4($$gessolcantid_) > 0 || !$$gessolcantid_)
			{
				$campnomb[$gessolcantid_] = 1;
				$flageditarvistasoliprog = 1;
			}
		}
	}
	//valida los campos cuando se genera una orden de produccion
	if($arrtarsoliextru)
	{
		if($arrtarsoliextru) $rwTarsoliextru = explode(':|:',$arrtarsoliextru);
		//se recorre el arreglo
		for($a = 0;$a< count($rwTarsoliextru);$a++){
			//objetos a utilizar
			$anchomaterial_ = 'anchomaterial_'.$rwTarsoliextru[$a];
			$anchocorte_ = 'anchocorte_'.$rwTarsoliextru[$a];
			$diferenciamm_ = 'diferenciamm_'.$rwTarsoliextru[$a];
			$diferenciakg_ = 'diferenciakg_'.$rwTarsoliextru[$a];
			$proceddestin_ = 'proceddestin_'.$rwTarsoliextru[$a];
			//validacion de consumo o cantidad a asingar
			if(validaint4($$anchomaterial_) > 0 || !$$anchomaterial_){
				$campnomb['anchomaterial_'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion de ancho a cortar
			if(validaint4($$anchocorte_) > 0 || !$$anchocorte_)
			{
				$campnomb['anchocorte_'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion de diferencia en milimetros (mm)
			if(validaint4($$diferenciamm_) > 0 || !$$diferenciamm_)
			{
				$campnomb['diferenciamm_'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion de diferencia en kilogramos (kg)
			if(validafloat4($$diferenciakg_) > 0 || !$$diferenciakg_)
			{
				$campnomb['diferenciakg_'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion de destino
			if(!$$proceddestin_){
				$campnomb['proceddestin_'] = 1;
				$flageditarvistasoliprog = 1;
			}
		}
	}
}
//----------------------------------FIN VALIDACION EXTRUSION----------------------------------//


//----------------------------------VALIDACION LAMINADO----------------------------------//
$produclam = 1;
if($arrProceso['tabs_solicitud']['lmn'][0] > 0){
	//validacion de necesidad de produccion laminacion
	for($a = 0;$a < count($arrMateriales);$a++)
	{
		if($arrMateriales[$a]['paditecodigo'] == '23')
		{
			$obj_ancholam = 'anchlam2_'.$arrMateriales[$a]['paditecodigo'];
			//validacion para laminado que sea entero y que no este vacio
			if(!$arrMateriales[$a]['laminado'])
			{
				$campnomb['laminado_lmn'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para desempeño que sea entero y que no este vacio
			if(!$arrMateriales[$a]['plapaddesem'])
			{
				$campnomb['plapaddesem_lmn'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para tipo que sea entero y que no este vacio
			if(!$arrMateriales[$a]['plapadtipo'])
			{
				$campnomb['plapadtipo_lmn'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para ancho del material a laminar #2
			if(validaint4($$obj_ancholam) > 0 || !$$obj_ancholam){
				$campnomb[$obj_ancholam] = 1;
				$flageditarvistasoliprog = 1;
			}
			
			$objbreak = 0;
			for($b = 0;$b < count($arrMateriales);$b++)
			{
				$obj_product_lam = 'product_lam_'.($produclam);
				if($arrMateriales[$b]['paditecodigo'] == $$obj_product_lam)
				{
					$objbreak = 1;
					//validacion para calibre que sea entero y que no este vacio
					if(validafloat4($arrMateriales[$b]['plapadcaliba1']) > 0 || !$arrMateriales[$b]['plapadcaliba1'])
					{
						$campnomb['plapadcaliba1_lmn'] = 1;
						$flageditarvistasoliprog = 1;
					}
					//validacion para cantidad de kilogramos que sea entero y que no este vacio
					if(validafloat4($arrMateriales[$b]['plapadcantkg']) > 0 || !$arrMateriales[$b]['plapadcantkg'])
					{
						$campnomb['plapadcantkg_lmn'] = 1;
						$flageditarvistasoliprog = 1;
					}
					//validacion para cantidad de metros que sea entero y que no este vacio
					if(validafloat4($arrMateriales[$b]['plapadcantmt']) > 0 || !$arrMateriales[$b]['plapadcantmt'])
					{
						$campnomb['plapadcantmt_lmn'] = 1;
						$flageditarvistasoliprog = 1;
					}
				}
				if($objbreak > 0)
					break;
			}
			$produclam++;
		}
	}
}
//----------------------------------FIN VALIDACION LAMINADO----------------------------------//


//----------------------------------VALIDACION FLEXOGRAFIA----------------------------------//
if($arrProceso['tabs_solicitud']['flx'][0] > 0){
	//validacion de necesidad de produccion laminacion
	for($a = 0;$a < count($arrMateriales);$a++)
	{
		if($arrMateriales[$a]['paditecodigo'] == $product_imp)
		{
			//validacion para calibre que sea entero y que no este vacio
			if(validafloat4($arrMateriales[$a]['plapadcaliba1']) > 0 || !$arrMateriales[$a]['plapadcaliba1'])
			{
				$campnomb['plapadcaliba1_flx'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para cantidad de kilogramos que sea entero y que no este vacio
			if(validafloat4($arrMateriales[$a]['plapadcantkg']) > 0 || !$arrMateriales[$a]['plapadcantkg'])
			{
				$campnomb['plapadcantkg_flx'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para cantidad de metros que sea entero y que no este vacio
			if(validafloat4($arrMateriales[$a]['plapadcantmt']) > 0 || !$arrMateriales[$a]['plapadcantmt'])
			{
				$campnomb['plapadcantmt_flx'] = 1;
				$flageditarvistasoliprog = 1;
			}
			//validacion para cantidad de metros que sea entero y que no este vacio
			if(validafloat4($arrMateriales[$a]['plapadanchoi']) > 0 || !$arrMateriales[$a]['plapadanchoi'])
			{
				$campnomb['plapadanchoi_flx'] = 1;
				$flageditarvistasoliprog = 1;
			}
		}
	}
}
//----------------------------------FIN VALIDACION FLEXOGRAFIA----------------------------------//

//----------------------------------VALIDACION CORTE----------------------------------//
if($arrProceso['tabs_solicitud']['cor'][0] > 0){
	for($a = 0;$a < 1;$a++)
	{
		//validacion para cantidad de kilogramos que sea entero y que no este vacio
		if(validafloat4($arrMateriales[$a]['plapadcantkg']) > 0 || !$arrMateriales[$a]['plapadcantkg'])
		{
			$campnomb['plapadcantkg_cor'] = 1;
			$flageditarvistasoliprog = 1;
		}
		//validacion para cantidad de metros que sea entero y que no este vacio
		if(validafloat4($arrMateriales[$a]['plapadcantmt']) > 0 || !$arrMateriales[$a]['plapadcantmt'])
		{
			$campnomb['plapadcantmt_cor'] = 1;
			$flageditarvistasoliprog = 1;
		}
		//validacion para cantidad de metros que sea entero y que no este vacio
		if(validafloat4($arrMateriales[$a]['plapadanchoi']) > 0 || !$arrMateriales[$a]['plapadanchoi'])
		{
			$campnomb['plapadanchoi_cor'] = 1;
			$flageditarvistasoliprog = 1;
		}
	}
}
//----------------------------------FINVALIDACION CORTE----------------------------------//


//-----------------------------------VALIDACION CORTE SECUNDARIO------------------------//
/*
if($arrProceso['tabs_solicitud']['crt'][0] > 0){
	for($a = 0;$a < count($arrCorteS);$a++)
	{
		//validacion para cantidad de itemdesa 
		if(validafloat4($arrCorteS[$a]['itedescodigo']) > 0 || !$arrCorteS[$a]['itedescodigo'])
		{
			$campnomb['plapadcantkg_crt'] = 1;
			$flageditarvistasoliprog = 1;
		}
		//validacion para cantidad de ancho de item desa 
		if(validafloat4($arrCorteS[$a]['itedesancho']) > 0 || !$arrCorteS[$a]['itedesancho'])
		{
			$campnomb['itedesancho_crt'] = 1;
			$flageditarvistasoliprog = 1;
		}
		//validacion para cantidad de desperdicio milimetros  de item desa 
		if(validafloat4($arrCorteS[$a]['desperdiciomm']) > 0 || !$arrCorteS[$a]['desperdiciomm'])
		{
			$campnomb['desperdiciomm_crt'] = 1;
			$flageditarvistasoliprog = 1;
		}
		//validacion para cantidad de desperdicio kilos de item desa 
		if(validafloat4($arrCorteS[$a]['desperdiciokg']) > 0 || !$arrCorteS[$a]['desperdiciokg'])
		{
			$campnomb['desperdiciokg_crt'] = 1;
			$flageditarvistasoliprog = 1;
		}
		//validacion para cantidad de desperdicio destino de item desa 
		if(!$arrCorteS[$a]['desperdiciodt'])
		{
			$campnomb['desperdiciodt_crt'] = 1;
			$flageditarvistasoliprog = 1;
		}
		//validacion para cantidad de calibre de item desa 
		if(validafloat4($arrCorteS[$a]['itedescalib']) > 0 || !$arrCorteS[$a]['itedescalib'])
		{
			$campnomb['itedescalib_crt'] = 1;
			$flageditarvistasoliprog = 1;
		}
	}
}*/
//----------------------------------FINVALIDACION CORTE SECUNDARIO----------------------------------//


//---SE OMITE VALIDACION SELLADO, PAUCHADO, DOBLADO, MICROPERFORADO, TROQUELADO, VALVULADO-----//


fncclose($idcon);
//----------------------------------SECCION DE GRABA----------------------------------//

//si no hay error en el formulario registra las ordenes y gestiones
if(!$flageditarvistasoliprog)
{
	$idcon = fncconn();
	//consecutivo para planea item desa almacena cada materia prima con su consumo planeado
	$nuidtemp = fncnumact(146,$idcon);	
	do
	{
		$nuresult = loadrecordgestionsoliprog($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$iReggestionsoliprog['gessolcodigo'] = $nuidtemp - 1;
		$nuidtemp ++;
	}while ($nuresult != e_empty);		
	//se crea el registro de la nueva gestion
	$iReggestionsoliprog['gessolcodigo'] = $iReggestionsoliprog['gessolcodigo'] +1;
	$iReggestionsoliprog['solprocodigo'] = $solprocodigo;
	$iReggestionsoliprog['usuacodi'] = $usuacodi;
	$iReggestionsoliprog['solprofecha'] = date('Y-m-d');
	$rwhora = getdate(time());
	$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
	$iReggestionsoliprog['solprohora'] = $hora;
	$iReggestionsoliprog['solprodescri'] = $solprodescri;
	$res = insrecordgestionsoliprog($iReggestionsoliprog,$idcon);
	//validacion adicional de error de consecutivo
	if($res <= 0)
	{
		//consecutivo para planea item desa
		unset($nuidtemp,$nuresult,$res);
		$nuidtemp = fncnumact(146,$idcon);	
		do
		{
			$nuresult = loadrecordgestionsoliprog($nuidtemp,$idcon);
			if($nuresult == e_empty)
				$iReggestionsoliprog['gessolcodigo'] = $nuidtemp - 1;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		//se re asinga el nuevo indice de codigo
		$iRegPlaneaitemdesa['plaitecodigo'] = $iRegPlaneaitemdesa['plaitecodigo'] + 1;
		//se ingresa el registro
		$res = insrecordplaneaitemdesa($iRegPlaneaitemdesa,$idcon);
	}
	//se actualiza el consecutico de produc padre item
	fncnumprox(146,$iReggestionsoliprog['gessolcodigo'] + 1,$idcon); 

			
			
	fncclose($idcon);
	
	if($arrProceso['tabs_solicitud']['ext'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA EXTRUSION--------------//
		unset($iRegop,$iRegopextrusion,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion extrusion
		for($a = 0;$a < count($arrMateriales);$a++)
		{
			if($arrMateriales[$a]['paditeextrui'] == 't')
			{
				$obj_genordeproduccion = 'genordeproduccion_'.$arrMateriales[$a]['paditecodigo'];
				$obj_cantidadkilos = 'cantkilos_'.$arrMateriales[$a]['paditecodigo'];
				$obj_cantidadmetros = 'cantmetros_'.$arrMateriales[$a]['paditecodigo'];
				//	INGRESO DE ORDENES DE EXTRUSION 
				if($$obj_genordeproduccion < 2)
				{
					do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
					$iRegop['solprocodigo'] = $solprocodigo;
					$iRegop['usuacodi'] = $usuacodi;
					$iRegop['ordprofecgen'] = date('Y-m-d');
					$rwhora = getdate(time());
					$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
					$iRegop['ordprohorgen'] = $hora;
					$iRegop['plantacodigo'] = 1;//planta yumbo
					$iRegop['ordproacti'] = 1;//orden activa
					$iRegop['procedcodigo'] = $arrMateriales[$a]['procedcodigo'];
					$iRegop['opestacodigo'] = 1;//creada esta inicial
					$iRegop['ordprodescri'] = $solprodescri;
					//se inserta el registro de orden de produccion
					$res = insrecordop($iRegop,$idcon);
					//record para el detalle para la gestion de la op
					$iRegopextrusion['ordprocodigo'] = $iRegop['ordprocodigo'];
					$iRegopextrusion['paditecodigo'] = $arrMateriales[$a]['paditecodigo'];
					$iRegopextrusion['ordprocalibr'] = $arrMateriales[$a]['plapadcaliba1'];
					$iRegopextrusion['formulcodigo'] = $arrMateriales[$a]['formulcodigo'];
					$iRegopextrusion['ordprocantkg'] = $$obj_cantidadkilos;
					$iRegopextrusion['ordprocantmt'] = $$obj_cantidadmetros;
					$iRegopextrusion['ordproancext'] = $arrMateriales[$a]['plapadanchoi'];
					$iRegopextrusion['ordproancmat'] = $ancho;
					$iRegopextrusion['ordpropistap'] = $nropistas;
					$iRegopextrusion['ordproancref'] = $arrMateriales[$a]['plapadrefile'];
					$iRegopextrusion['ordpropistae'] = 1;
					$iRegopextrusion['ordprodescri'] = $ordprodescri_ext;
					//se le inserta el registro detallado de la operacion de produccion
					$res = insrecordopextrusion($iRegopextrusion,$idcon);
				}
			}		
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegopextrusion,$nuidtemp);
		unset($iReggestionsoliprog,$rwMatsoliextru);		
		//SE ASIGNAN MATERIALES A LAS ORDEN
		//valida los materiales asignados en una gestion
		if($arrmatsoliextru)
		{
			//consecutivo para planea item desa almacena cada materia prima con su consumo planeado
			$nuidtemp = fncnumact(138,$idcon);	
			do
			{
				$nuresult = loadrecordplaneaitemdesa($nuidtemp,$idcon);
				if($nuresult == e_empty)
					$iRegPlaneaitemdesa['plaitecodigo'] = $nuidtemp - 1;
				$nuidtemp ++;
			}while ($nuresult != e_empty);		
			//se explosiona el array de arrmatplan que contiene los codigo de los materiales elegidos para forma la estructura 
			$arrObject = explode(':|:',$arrmatsoliextru);
			//se borra los registros actuales si existen en la tabla planeaitemdesa
			$resultado = delrecordplaneaitemdesa2($produccodigo,$idcon);
			//se recorre el array
			for($a = 0;$a< count($arrObject);$a++)
			{
				//se consulta el registro de item desa .
				$rowsArrObject = explode(':-:',$arrObject[$a]);
				// item desa es una tabla que se retroalimenta de un web services
				$rwItemdesa = loadrecorditemdesa($rowsArrObject[0],$idcon);
				//se crea objeto para el consumo a cada material
				$obj_consumo = 'gessolcantid_'.$arrObject[$a];
				//se crea el ireg correspondiente a planeaitem desa
				$iRegPlaneaitemdesa['plaitecodigo'] = $iRegPlaneaitemdesa['plaitecodigo'] + 1;
				$iRegPlaneaitemdesa['produccodigo'] = $produccodigo;
				$iRegPlaneaitemdesa['itedescodigo'] = $rowsArrObject[0];
				$iRegPlaneaitemdesa['plaitecantid'] = $$obj_consumo;
				$iRegPlaneaitemdesa['procedcodigo'] = $rowsArrObject[1];
				$iRegPlaneaitemdesa['plaitetipo'] = 2;
				$res = insrecordplaneaitemdesa($iRegPlaneaitemdesa,$idcon);
				//validacion adicional de error de consecutivo
				if($res <= 0)
				{
					//consecutivo para planea item desa
					unset($nuidtemp,$nuresult,$res);
					$nuidtemp = fncnumact(138,$idcon);	
					do
					{
						$nuresult = loadrecordplaneaitemdesa($nuidtemp,$idcon);
						if($nuresult == e_empty)
							$iRegPlaneaitemdesa['plaitecodigo'] = $nuidtemp - 1;
						$nuidtemp ++;
					}while ($nuresult != e_empty);
					//se re asinga el nuevo indice de codigo
					$iRegPlaneaitemdesa['plaitecodigo'] = $iRegPlaneaitemdesa['plaitecodigo'] + 1;
					//se ingresa el registro
					$res = insrecordplaneaitemdesa($iRegPlaneaitemdesa,$idcon);
				}
			}
			//se actualiza el consecutico de produc padre item
			fncnumprox(138,$iRegPlaneaitemdesa['plaitecodigo'] + 1,$idcon); 
		}
		
		//---------------------	TAREAS ADICIONALES PARA MATERIALES ASIGNADOS
		unset($iReggestionsoliprog,$rwMatsoliextru,$iReggestionsoliprog,$nuidtemp);
		unset($iReggestionsoliprog,$rwMatsoliextru,$rwTarsoliextru,$rowsTarsoliextru);
		if($arrtarsoliextru)
		{
			if($arrtarsoliextru) $rwTarsoliextru = explode(':|:',$arrtarsoliextru);
			//se recorre el arreglo
			for($a = 0;$a< count($rwTarsoliextru);$a++){
				$rowsTarsoliextru = explode(':-:',$rwTarsoliextru[$a]);
				$rwItemdesa = loadrecorditemdesa($rowsTarsoliextru[0],$idcon);
				//objetos a utilizar
				$anchomaterial_ = 'anchomaterial_'.$rwTarsoliextru[$a];
				$anchocorte_ = 'anchocorte_'.$rwTarsoliextru[$a];
				$diferenciamm_ = 'diferenciamm_'.$rwTarsoliextru[$a];
				$diferenciakg_ = 'diferenciakg_'.$rwTarsoliextru[$a];
				$proceddestin_ = 'proceddestin_'.$rwTarsoliextru[$a];
				//se crea el registro de planearuteitempv ruta del pedidoventa
				$rwProcedimiento = loadrecordprocedimiento1($tipsolcodigo = 10,$idcon);
				if($rwProcedimiento > 0)
				{
					unset($nuidtemp,$nuresult,$res);
					$nuidtemp = fncnumact(139,$idcon);	
					do
					{
						$nuresult = loadrecordplanearutaitempv($nuidtemp,$idcon);
						if($nuresult == e_empty)
							$iRegplanearutaitempv['plarutcodigo'] = $nuidtemp;
						$nuidtemp ++;
					}while ($nuresult != e_empty);

					$iRegplanearutaitempv['produccodigo'] = $produccodigo;
					$iRegplanearutaitempv['procedcodigo'] = $rwProcedimiento['procedcodigo'];
					$iRegplanearutaitempv['plarutcorter'] = $$anchocorte_.','.$$proceddestin_.','.$$diferenciamm_.','.$$diferenciakg_;//corte de reproceso
					$iRegplanearutaitempv['plarutorden'] = 0;//para no dañar el orden de la ruta
					$iRegplanearutaitempv['estsolcodigo'] = 1;//Estado de la solicitud generado
					insrecordplanearutaitempv($iRegplanearutaitempv,$idcon);

					do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
					$iRegop['solprocodigo'] = $solprocodigo;
					$iRegop['usuacodi'] = $usuacodi;
					$iRegop['ordprofecgen'] = date('Y-m-d');
					$rwhora = getdate(time());
					$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
					$iRegop['ordprohorgen'] = $hora;
					$iRegop['plantacodigo'] = 1;//planta yumbo
					$iRegop['ordproacti'] = 1;//orden activa
					$iRegop['procedcodigo'] = $rwProcedimiento['procedcodigo'];
					$iRegop['opestacodigo'] = 1;//creada esta inicial					
					insrecordop($iRegop,$idcon);

					//record para el detalle para la gestion de la op
					$iRegopcorte['ordprocodigo'] = $iRegop['ordprocodigo'];			
					$iRegopcorte['ordprocalibr'] = $rwItemdesa['itedescalib'];
					$iRegopcorte['ordprocantkg'] = 10;
					$iRegopcorte['ordproanccrt'] = $$anchocorte_;
					$iRegopcorte['ordproancmat'] = $$anchomaterial_;
					$iRegopcorte['ordpropistap'] = 0;
					$iRegopcorte['ordprocantmt'] = 0;		
					$iRegopcorte['ordprotacore'] = $tam_core;		
					$iRegopcorte['ordprodespmm'] = $$diferenciamm_;		
					$iRegopcorte['ordprodespkg'] = $$diferenciakg_;		
					$iRegopcorte['ordprodespdt'] = $$proceddestin_;		
					$iRegopcorte['ordprodescri'] = 'Corte secundario extrusion - '.$ordprodescri_ext;
					//se le inserta el registro detallado de la operacion de produccion
					insrecordopcorte($iRegopcorte,$idcon);
				}
			}
		}
		//se actualiza el consecutico de op
		fncnumprox(145,$iRegop[ordprocodigo] + 1,$idcon);
		unset($iRegop,$iRegopcorter,$nuidtemp);
		//-------------FIN SECCION GRABA EXTRUSION--------------//
		fncclose($idcon);
	}	
	
	
	if($arrProceso['tabs_solicitud']['lmn'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA LAMINADO--------------//
		unset($iRegop,$iRegoplaminado,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion laminacion
		$produclam = 1;
		for($a = 0;$a < count($arrMateriales);$a++)
		{
			if($arrMateriales[$a]['paditecodigo'] == '23')
			{
				$obj_ancholam = 'anchlam2_'.$arrMateriales[$a]['paditecodigo'];
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti'] = 1;//orden activa
				$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['lmn'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				$objbreak = 0;
				for($b = 0;$b < count($arrMateriales);$b++)
				{
					$obj_product_lam = 'product_lam_'.($produclam);
					if($arrMateriales[$b]['paditecodigo'] == $$obj_product_lam)
					{
						$objbreak = 1;
						//record para el detalle para la gestion de la op
						$iRegoplaminado['ordprocodigo'] = $iRegop['ordprocodigo'];
						$iRegoplaminado['paditecodigo'] = $arrMateriales[$a]['paditecodigo'];
						$iRegoplaminado['ordprolamina'] = $arrMateriales[$a]['laminado'];
						$iRegoplaminado['ordprodesemp'] = $arrMateriales[$a]['plapaddesem'];
						$iRegoplaminado['ordprotiposo'] = $arrMateriales[$a]['plapadtipo'];
						$iRegoplaminado['ordprocalibr'] = $arrMateriales[$b]['plapadcaliba1'];
						$iRegoplaminado['ordprocantkg'] = $cantplanea_kgs;//$arrMateriales[$b]['plapadcantkg'];
						$iRegoplaminado['ordprocantmt'] = $arrMateriales[$b]['plapadcantmt'];
						$iRegoplaminado['ordproanclam'] = $arrMateriales[$b]['plapadanchoi'];
						$iRegoplaminado['ordproancref'] = $arrMateriales[$b]['plapadrefile'];
						$iRegoplaminado['ordproancmat'] = $ancho;
						$iRegoplaminado['ordpropistap'] = $nropistas;
						$iRegoplaminado['ordproancalt'] = $$obj_ancholam;
						$iRegoplaminado['ordprodescri'] = $ordprodescri_lmn;
						//se le inserta el registro detallado de la operacion de produccion
						$res = insrecordoplaminado($iRegoplaminado,$idcon);						
					}
					if($objbreak > 0)
						break;
				}
				$produclam++;
			}
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegoplaminado,$nuidtemp);
		//-------------FIN SECCION GRABA LAMINADO--------------//
		fncclose($idcon);
	}
	
	
	if($arrProceso['tabs_solicitud']['flx'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA FLEXOGRAFIA--------------//
		unset($iRegop,$iRegopflexografia,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion flexo
		for($a = 0;$a < count($arrMateriales);$a++)
		{
			if($arrMateriales[$a]['paditecodigo'] == $product_imp && $product_imp)
			{
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti'] = 1;//orden activa
				$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['flx'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				//record para el detalle para la gestion de la op
				$iRegopflexografia['ordprocodigo'] = $iRegop['ordprocodigo'];
				$iRegopflexografia['paditecodigo'] = $arrMateriales[$a]['paditecodigo'];
				$iRegopflexografia['ordprocalibr'] = $arrMateriales[$a]['plapadcaliba1'];
				$iRegopflexografia['ordprocantkg'] = $arrMateriales[$a]['plapadcantkg'];
				$iRegopflexografia['ordprocantmt'] = $arrMateriales[$a]['plapadcantmt'];
				$iRegopflexografia['ordproancflx'] = $arrMateriales[$a]['plapadanchoi'];
				$iRegopflexografia['ordproancmat'] = $ancho;
				$iRegopflexografia['ordpropistap'] = $nropistas;
				$iRegopflexografia['ordprotipimp'] = $tipo_impresion;
				$iRegopflexografia['ordprorodill'] = $rodillo;
				$iRegopflexografia['ordproancref'] = $arrMateriales[$a]['plapadrefile'];			
				$iRegopflexografia['ordproestruc'] = $tipo_estruc;			
				$iRegopflexografia['ordprodescri'] = $ordprodescri_flx;
				//se le inserta el registro detallado de la operacion de produccion
				$res = insrecordopflexo($iRegopflexografia,$idcon);
				$product_imp = '';
			}
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegopflexografia,$nuidtemp);
		//-------------FIN SECCION GRABA FLEXOGRAFIA--------------//
		fncclose($idcon);
	}
	
	
	if($arrProceso['tabs_solicitud']['cor'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA CORTE--------------//
		unset($iRegop,$iRegopcorte,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion corte
		for($a = 0;$a < 1;$a++)
		{
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti'] = 1;//orden activa
				$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['cor'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				//record para el detalle para la gestion de la op
				$iRegopcorte['ordprocodigo'] = $iRegop['ordprocodigo'];			
				$iRegopcorte['paditecodigo'] = $arrMateriales[$a]['paditecodigo'];
				$iRegopcorte['ordprocalibr'] = $total_calibre;
				$iRegopcorte['ordprocantkg'] = $cantplanea_kgs;
				$iRegopcorte['ordproanccrt'] = $arrMateriales[$a]['plapadanchoi'];
				$iRegopcorte['ordproancmat'] = $ancho;
				$iRegopcorte['ordpropistap'] = $nropistas;
				$iRegopcorte['ordprocantmt'] = $arrMateriales[$a]['plapadcantmt'];			
				$iRegopcorte['ordprotacore'] = $tam_core;		
				$iRegopcorte['ordprodespmm'] = 0;		
				$iRegopcorte['ordprodespkg'] = 0;		
				$iRegopcorte['ordprodespdt'] = 0;		
				$iRegopcorte['ordprodescri'] = $ordprodescri_cor;
				//se le inserta el registro detallado de la operacion de produccion
				$res = insrecordopcorte($iRegopcorte,$idcon);
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegopcorte,$nuidtemp);
		//-------------FIN SECCION GRABA CORTE--------------//
		fncclose($idcon);
	}
	
	
	if($arrProceso['tabs_solicitud']['sld'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA SELLADO--------------//
		unset($iRegop,$iRegopsellado,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion sellado
		for($a = 0;$a < 1;$a++)
		{
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti'] = 1;//orden activa
				$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['sld'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				//record para el detalle para la gestion de la op
				$iRegopsellado['ordprocodigo'] = $iRegop['ordprocodigo'];
				$iRegopsellado['paditecodigo'] = $arrMateriales[$a]['paditecodigo'];			
				$iRegopsellado['ordprocalibr'] = $total_calibre;
				$iRegopsellado['ordprocantkg'] = $cantplanea_kgs;
				$iRegopsellado['ordprocantmt'] = $arrMateriales[$a]['plapadcantmt'];
				$iRegopsellado['ordproancsld'] = $arrMateriales[$a]['plapadanchoi'];
				$iRegopsellado['ordproancmat'] = $ancho;
				$iRegopsellado['ordpropistap'] = $nropistas;
				$iRegopsellado['ordprolargom'] = $largo;
				$iRegopsellado['ordprofuelle'] = (validaint4($fuelle) > 0)? 0 : $fuelle;
				$iRegopsellado['ordpropmilla'] = $pmillar;
				$iRegopsellado['ordprodescri'] = $ordprodescri_sld;	
				//se le inserta el registro detallado de la operacion de produccion
				$res = insrecordopsellado($iRegopsellado,$idcon);
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegopsellado,$nuidtemp);
		//-------------FIN SECCION GRABA SELLADO--------------//
		fncclose($idcon);
	}
	
	
	
	if($arrProceso['tabs_solicitud']['pch'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA PAUCHADO--------------//
		unset($iRegop,$iRegoppauchado,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion laminacion
		for($a = 0;$a < 1;$a++)
		{
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti'] = 1;//orden activa
				$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['pch'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				//record para el detalle para la gestion de la op
				$iRegoppauchado['ordprocodigo'] = $iRegop['ordprocodigo'];	
				$iRegoppauchado['paditecodigo'] = $arrMateriales[$a]['paditecodigo'];		
				$iRegoppauchado['ordprocalibr'] = $total_calibre;
				$iRegoppauchado['ordprocantkg'] = $cantplanea_kgs;
				$iRegoppauchado['ordprocantmt'] = $arrMateriales[$a]['plapadcantmt'];
				$iRegoppauchado['ordproancpch'] = $arrMateriales[$a]['plapadanchoi'];
				$iRegoppauchado['ordproancmat'] = $ancho;
				$iRegoppauchado['ordpropistap'] = $nropistas;
				$iRegoppauchado['ordprolargom'] = $largo;
				$iRegoppauchado['ordprofuelle'] = (validaint4($fuelle) > 0)? 0 : $fuelle;
				$iRegoppauchado['ordpropmilla'] = $pmillar;
				$iRegoppauchado['ordprodescri'] = $ordprodescri_pch;	
				//se le inserta el registro detallado de la operacion de produccion
				$res = insrecordoppauchado($iRegoppauchado,$idcon);
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegoppauchado,$nuidtemp);
		//-------------FIN SECCION GRABA PAUCHADO--------------//
		fncclose($idcon);
	}
	
	
	if($arrProceso['tabs_solicitud']['dbl'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA DOBLADO--------------//
		unset($iRegop,$iRegopdoblado,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion laminacion
		for($a = 0;$a < 1;$a++)
		{
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti'] = 1;//orden activa
				$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['dbl'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				//record para el detalle para la gestion de la op
				$iRegopdoblado['ordprocodigo'] = $iRegop['ordprocodigo'];	
				$iRegopdoblado['paditecodigo'] = $arrMateriales[$a]['paditecodigo'];		
				$iRegopdoblado['ordprocalibr'] = $total_calibre;
				$iRegopdoblado['ordprocantkg'] = $cantplanea_kgs;
				$iRegopdoblado['ordprocantmt'] = $arrMateriales[$a]['plapadcantmt'];
				$iRegopdoblado['ordproancdbl'] = $arrMateriales[$a]['plapadanchoi'];
				$iRegopdoblado['ordproancmat'] = $ancho;
				$iRegopdoblado['ordpropistap'] = $nropistas;
				$iRegopdoblado['ordprolargom'] = $largo;
				$iRegopdoblado['ordprofuelle'] = (validaint4($fuelle) > 0)? 0 : $fuelle;
				$iRegopdoblado['ordpropmilla'] = $pmillar;
				$iRegopdoblado['ordprodescri'] = $ordprodescri_dbl;	
				//se le inserta el registro detallado de la operacion de produccion
				$res = insrecordopdoblado($iRegopdoblado,$idcon);
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegopdoblado,$nuidtemp);
		//-------------FIN SECCION GRABA DOBLADO--------------//
		fncclose($idcon);
	}
	
	if($arrProceso['tabs_solicitud']['mcr'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA MICROPERFORADO--------------//
		unset($iRegop,$iRegopmicroperforado,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion microperforado
		for($a = 0;$a < 1;$a++)
		{
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti] = 1;//orden activa
				$iRegop[procedcodigo'] = $arrProceso['tabs_solicitud']['mcr'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				//record para el detalle para la gestion de la op
				$iRegopmicroperforado['ordprocodigo'] = $iRegop['ordprocodigo'];
				$iRegopmicroperforado['paditecodigo'] = null;		
				$iRegopmicroperforado['ordprocalibr'] = $total_calibre;
				$iRegopmicroperforado['ordprocantkg'] = $cantplanea_kgs;
				$iRegopmicroperforado['ordprocantmt'] = $arrMateriales[$a]['plapadcantmt'];
				$iRegopmicroperforado['ordproancmcr'] = ($tipo_microper)? 0 : $tipo_microper;
				$iRegopmicroperforado['ordproancmat'] = $ancho;
				$iRegopmicroperforado['ordpropistap'] = $nropistas;
				$iRegopmicroperforado['ordprolargom'] = $largo;
				$iRegopmicroperforado['ordprofuelle'] = (validaint4($fuelle) > 0)? 0 : $fuelle;
				$iRegopmicroperforado['ordpropmilla'] = $pmillar;
				$iRegopmicroperforado['ordprodescri'] = $ordprodescri_mcr;	
				//se le inserta el registro detallado de la operacion de produccion
				$res = insrecordopmicroperforado($iRegopmicroperforado,$idcon);
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegopmicroperforado,$nuidtemp);
		//-------------FIN SECCION GRABA MICROPERFORADO--------------//
		fncclose($idcon);
	}
	
	
	if($arrProceso['tabs_solicitud']['tql'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA TROQUELADO--------------//
		unset($iRegop,$iRegoptroquelado,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion troquelado
		for($a = 0;$a < 1;$a++)
		{
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti'] = 1;//orden activa
				$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['tql'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				//record para el detalle para la gestion de la op
				$iRegoptroquelado['ordprocodigo'] = $iRegop['ordprocodigo'];
				$iRegoptroquelado['paditecodigo'] = null;		
				$iRegoptroquelado['ordprocalibr'] = $total_calibre;
				$iRegoptroquelado['ordprocantkg'] = $cantplanea_kgs;
				$iRegoptroquelado['ordprocantmt'] = $arrMateriales[$a]['plapadcantmt'];
				$iRegoptroquelado['ordproanctql'] = $arrMateriales[$a]['plapadanchoi'];
				$iRegoptroquelado['ordproancmat'] = $ancho;
				$iRegoptroquelado['ordpropistap'] = $nropistas;
				$iRegoptroquelado['ordprolargom'] = $largo;
				$iRegoptroquelado['ordprofuelle'] = (validaint4($fuelle) > 0)? 0 : $fuelle;
				$iRegoptroquelado['ordpropmilla'] = $pmillar;
				$iRegoptroquelado['ordprodescri'] = $ordprodescri_tql;	
				//se le inserta el registro detallado de la operacion de produccion
				$res = insrecordoptroquelado($iRegoptroquelado,$idcon);
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegoptroquelado,$nuidtemp);
		//-------------FIN SECCION GRABA TROQUELADO--------------//
		fncclose($idcon);
	}
	
	
	if($arrProceso['tabs_solicitud']['vlv'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA VALVULADO--------------//
		unset($iRegop,$iRegoptroquelado,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion valvulado
		for($a = 0;$a < 1;$a++)
		{
				do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
				$iRegop['solprocodigo'] = $solprocodigo;
				$iRegop['usuacodi'] = $usuacodi;
				$iRegop['ordprofecgen'] = date('Y-m-d');
				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
				$iRegop['ordprohorgen'] = $hora;
				$iRegop['plantacodigo'] = 1;//planta yumbo
				$iRegop['ordproacti'] = 1;//orden activa
				$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['vlv'][0];
				$iRegop['opestacodigo'] = 1;//creada esta inicial
				$iRegop['ordprodescri'] = $solprodescri;
				//se inserta el registro de orden de produccion
				$res = insrecordop($iRegop,$idcon);
				//record para el detalle para la gestion de la op
				$iRegopvalvulado['ordprocodigo'] = $iRegop['ordprocodigo'];
				$iRegopvalvulado['paditecodigo'] = null;		
				$iRegopvalvulado['ordprocalibr'] = $total_calibre;
				$iRegopvalvulado['ordprocantkg'] = $cantplanea_kgs;
				$iRegopvalvulado['ordprocantmt'] = $arrMateriales[$a]['plapadcantmt'];
				$iRegopvalvulado['ordproancvlv'] = $arrMateriales[$a]['plapadanchoi'];
				$iRegopvalvulado['ordproancmat'] = $ancho;
				$iRegopvalvulado['ordpropistap'] = $nropistas;
				$iRegopvalvulado['ordprolargom'] = $largo;
				$iRegopvalvulado['ordprofuelle'] = (validaint4($fuelle) > 0)? 0 : $fuelle;
				$iRegopvalvulado['ordpropmilla'] = $pmillar;
				$iRegopvalvulado['ordprodescri'] = $ordprodescri_vlv;	
				//se le inserta el registro detallado de la operacion de produccion
				$res = insrecordopvalvulado($iRegopvalvulado,$idcon);
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegopvalvulado,$nuidtemp);
		//-------------FIN SECCION GRABA VALVULADO--------------//
		fncclose($idcon);
	}
	
	if($arrProceso['tabs_solicitud']['crt'][0] > 0){
		$idcon = fncconn();
		//-------------SECCION GRABA CORTER--------------//
		unset($iRegop,$iRegopcorter,$nuidtemp);
		//consecutivo de op
		$nuidtemp = fncnumact(145,$idcon);
		//validacion de necesidad de produccion laminacion
		for($a = 0;$a < count($arrCorteS);$a++)
		{
			do{$nuresult = loadrecordop($nuidtemp,$idcon);if($nuresult == e_empty){$iRegop['ordprocodigo'] = $nuidtemp;}$nuidtemp ++;}while ($nuresult != e_empty);
			$iRegop['solprocodigo'] = $solprocodigo;
			$iRegop['usuacodi'] = $usuacodi;
			$iRegop['ordprofecgen'] = date('Y-m-d');
			$rwhora = getdate(time());
			$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
			$iRegop['ordprohorgen'] = $hora;
			$iRegop['plantacodigo'] = 1;//planta yumbo
			$iRegop['ordproacti'] = 1;//orden activa
			$iRegop['procedcodigo'] = $arrProceso['tabs_solicitud']['crt'][0];
			$iRegop['opestacodigo'] = 1;//creada esta inicial
			//se inserta el registro de orden de produccion
			$res = insrecordop($iRegop,$idcon);
			//record para el detalle para la gestion de la op
			$iRegopcorte['ordprocodigo'] = $iRegop['ordprocodigo'];			
			$iRegopcorte['ordprocalibr'] = $arrCorteS[$a]['itedescalib'];
			$iRegopcorte['ordprocantkg'] = $arrCorteS[$a]['ordprocantkg'];
			$iRegopcorte['ordproanccrt'] = $arrCorteS[$a]['anchocortes'];
			$iRegopcorte['ordproancmat'] = $arrCorteS[$a]['itedesancho'];
			$iRegopcorte['ordpropistap'] = 1;
			$iRegopcorte['ordprocantmt'] = $arrCorteS[$a]['ordprocantmt'];		
			$iRegopcorte['ordprotacore'] = $tam_core;		
			$iRegopcorte['ordprodespmm'] = $arrCorteS[$a]['desperdiciomm'];		
			$iRegopcorte['ordprodespkg'] = $arrCorteS[$a]['desperdiciokg'];		
			$iRegopcorte['ordprodespdt'] = $arrCorteS[$a]['desperdiciodt'];		
			$iRegopcorte['ordprodescri'] = $ordprodescri_crt;
			//se le inserta el registro detallado de la operacion de produccion
			$res = insrecordopcorte($iRegopcorte,$idcon);
		}
		fncnumprox(145,$iRegop['ordprocodigo'] + 1,$idcon);
		unset($iRegop,$iRegopcorter,$nuidtemp);
		//-------------FIN SECCION GRABA CORTER--------------//
		fncclose($idcon);
	}
	
	$idcon = fncconn();
	//se crea el registro para actualizar soliprog
	$iRegsoliprog['solprocodigo'] = $solprocodigo;
	$iRegsoliprog['estsolcodigo'] = 2;//programada 
	$iRegsoliprog['solprodescri'] = $solprodescri; 
	$iRegsoliprog['solprodocume'] = $solprodocume; 
	$iRegsoliprog['solprodosize'] = $solprodosize; 
	$iRegsoliprog['solprofecest'] = $solprofecest; 
	uprecordsoliprogestadosoliprog($iRegsoliprog,$idcon);
	fncclose($idcon);
	$flageditarvistasoliprog = 1;
	fncmsgerror(editaEx);
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablvistasoliprog.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
else
{
	fncmsgerror(35);
}

?>