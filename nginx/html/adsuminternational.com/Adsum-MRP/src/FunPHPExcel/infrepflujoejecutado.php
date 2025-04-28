<?php 
//	error_reporting(E_ALL);
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time', '120');
	ini_set('display_errors', 1);
	
	date_default_timezone_set('America/Bogota');

	include ('../../def/configvarphp.php');
	include '../FunPerSecNiv/fncconn.php';
	include '../FunPerSecNiv/fncsqlrun.php';
	include '../FunPerSecNiv/fncnumreg.php';
	include '../FunPerSecNiv/fncfetch.php';
	include '../FunGen/fncformat.php';

	include '../FunPerPriNiv/pktblflujoejecutado.php';
	include '../FunPerPriNiv/pktblflujejecdetalle.php';
	
	include '../FunPerPriNiv/pktblippipc.php';
	include '../FunPerPriNiv/pktblrecaudo.php';
	include '../FunPerPriNiv/pktblenergia.php';
	include '../FunPerPriNiv/pktblenergiaexccom.php';
	include '../FunPerPriNiv/pktbldatos.php';
	include '../FunPerPriNiv/pktbldatosentrada.php';
	include '../FunPerPriNiv/pktblexphurtcpl.php';
	include '../FunPerPriNiv/pktblpodaarboles.php';
	include '../FunPerPriNiv/pktblcrecsap.php';
	include '../FunPerPriNiv/pktblcreditos.php';
	
	$noAjax = 1;	
	include '../FunjQuery/jquery.tabs/phpinformes/infbaseflujoejecutado.php';
	
	include 'Classes/PHPExcel.php';
	require 'Classes/PHPExcel/Writer/Excel5.php';
	
	//Var
	$key = array('','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$arrLabels = array(	'Numero','Mes','Fecha',0,'Inflacion - IPC','Inflacion - IPC [%]','Inflacion - IPP','Inflacion - IPP [%]',0,'Ingresos [Recaudo Impuesto A.P.]','Recaudo de A.P de Emcali',
						'Recaudo de A.P de Otros Comercializadores','Comisiones de Facturacion de otros comercializadores',1,'Total Ingresos [Recaudo Impuesto A.P.]',
						0,'Otros ingresos','Creditos','Aportes de capital de riesgo (Equity)','Ingresos adicionales por EUCOL ','Ingresos por publicidad','Rendimientos financieros',
						'Reinversiones(parciales)',1,'Total ingresos por otros conceptos',0,'Ingresos Totales',0,'Anticipos','Traslados Diarios a Fiducia',0,'Egresos',1,
						'Egresos pagados a Emcali','Suministro de Energia para el SAP','Alquiler Infraestructura Emcali para el SAP','IVA Alquiler de Infraestructura',
						'Impuesto de Timbre Factura de Energia','Servicio de Facturacion','IVA del Servicio de Facturacion','Servicio de Interventoria','IVA del Servicio de Interventoria',
						'Clausula Sexta Reconocimiento Mensual','Reintegro a Emcali G.M.F.','Rendimientos EMCALI y Sanciones','Intereses Sobre Saldo Mayores Valores Trasladados',
						1,'Subtotal egresos pagados a Emcali',0,'Egresos pagados a Mega S.A.',1,'Egresos de inversion',
						'Total Inversion Inicial en Infraestructura [Vehiculos, Equipos de Oficina, Sistema Georef, Equipos de Comunic]','Inversion Modernizacion o Inversion',
						'Valor Expansion del Sistema de A.P.','Valor Cambio de Potencia de Luminarias CPL','Retiros CPL','Valor Hurtos del Sistema de A.P.','Valor Anual para Ferias de Cali y Eventos',
						'Valor anual para infraestructura alumbrado navideño',1,'Subtotal Egresos de Inversion',0,'Egresos de O y M','Publicidad','Seguros','Debito Gastos en la Fiduciaria',
						'Sistema de Calidad','Mantenimiento Fuentes Urbanas','Equipos de Oficina [Mantenimiento]','Subcontratos de Vehiculos y Personal Operativos',
						'Poda Tecnica de Arboles','Termografias','Tranferencia de tecnologia y conocimientos Clausula 8 Num. 5','Mantenimiento Vehiculos de Supervision y Operativos Propios',
						'Personal Administrativo','Personal Operativo Propio','Gastos Administrativos','Herramientas [Reposicion Herramienta Menor]','Materiales de Mantenimiento [Repuestos]',
						'Imprevistos de Operacion y Mantenimiento 4%','Contrato Inventario SAP',1,'Subtotal Egresos de O y M',0,'Egresos financieros pagados a Mega',
						'Intereses Pagados de prestamos','Abono a capital de prestamos',1,'Subtotal egresos financieros',0,'Egresos impuestos pagados a Mega',
						'Impuesto de Industria y comercio 8.8 x 1000','Impuesto a la seguridad','Impuesto de Renta',1,'Subtotal egresos impuestos ',0,'Subtotal egresos pagados a Mega',
						0,'Egresos pagados a otros','Gravamen a los Movimientos Financieros Fiduciaria [GMF]','Administracion Fiduciaria Incluido I.V.A. y Auditoria Externa',
						'Gastos G.M.F Traslado Emcali a la Fiduciaria','Pagos a revisoria fiscal',1,'Subtotal egresos pagados a otros',0,'TOTAL EGRESOS',0,
						'INGRESOS TOTALES MENOS EGRESOS TOTALES',0,'PAGO AL INVERSIONISTA(prestamo 1)','PAGO AL INVERSIONISTA(prestamo 2)',0,'SALDO EN CAJA',
				);
	$arrBold = array('0' => 1, '1' => 1, '2' => 1, '4' => 1, '5' => 1, '6' => 1, '7' => 1, '9' => 1, '14' => 1, '16' => 1, '24' => 1, '26' => 1, '28' => 1, '31' => 1, '33' => 1,
						'47' => 1, '49' => 1, '51' => 1, '61' => 1, '63' => 1, '83' => 1, '85' => 1, '89' => 1, '91' => 1, '96' => 1, '98' => 1, '100' => 1, '106' => 1, '108' => 1,
						'110' => 1, '112' => 1, '113' => 1, '115' => 1, 
				);
	$medMes = array('','ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic');
	$cplMes = array('','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
	$keycol = array();
	$recA = 2;
	$indA = 0;
	$indB = 0;
	
	//Conf: Column Head
//	foreach($arrFlujoEjecutado AS $anio => $arrMeses):
//		foreach($arrMeses AS $mes => $arrValue):
//			$keycol['cols'][] = $key[$indA].$key[$recA];
//			$keycol['date'][] = array($anio, $mes);
//			
//			if(($recA % 26) == 0) $indA++;
//			($recA < 26) ? $recA++ : $recA = 1;
//		endforeach;
//	endforeach;
	//Conf: Column Head
	
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Tahoma');
	$objPHPExcel->getDefaultStyle()->getFont()->setSize(10); 
	
	$uploaddir = '../../temp/';
	$sheet = 0;
	$styleArray = array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('argb' => 'FF92CDDC'),
			),
		),
	);

	$objPHPExcel->setActiveSheetIndex(0)->setTitle(substr('FLUJO EJECUTADO',0,30));

	//Content: Column Head
	for($a = 0; $a < count($arrLabels); $a++):
		
		if($arrLabels[$a] != 1 && $arrLabels[$a]):
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.($a + 1), $arrLabels[$a])->getStyle('A'.($a + 1))->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($a + 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($a + 1))->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle('A'.($a + 1))->getFont()->getColor()->setARGB("FF1F497D");

			(array_key_exists($a, $arrBold)) ? $objPHPExcel->getActiveSheet()->getStyle('A'.($a + 1))->getFont()->setBold(true) : $num = 1;

		elseif($arrLabels[$a] == 1):
			$objPHPExcel->getActiveSheet()->getRowDimension(($a + 1))->setRowHeight(3);
		endif;
	endfor;
	//Content: Column Head
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	
	
	$numCol = 0;
	$arrFEJTotal = array();
	$arrStyles = array();
	
	foreach($arrFlujoEjecutado AS $anio => $arrMeses):
		
		ksort ($arrMeses);
	
		foreach($arrMeses AS $mes => $arrValue):
			$Cord = $key[$indA].$key[$recA];
			$numCol++;
			
			($mes < 7) ? $index = 1 : $index = 2;
			
			if(!$arrStyles[$anio]['inimes'][$index]) $arrStyles[$anio]['inimes'][$index] = $Cord;
			$arrStyles[$anio]['finmes'][$index] = $Cord;
			
			
			$arrFEJTotal[$anio][$index]['ipc'] += $arrValue['IppIpc']['ipc'];
			$arrFEJTotal[$anio][$index]['pipc'] += ($arrValue['IppIpc']['pipc'] / 100);
			$arrFEJTotal[$anio][$index]['ipp'] += $arrValue['IppIpc']['ipp'];
			$arrFEJTotal[$anio][$index]['pipp'] += ($arrValue['IppIpc']['pipp'] / 100);
			
			$arrFEJTotal[$anio][$index]['recaudtemcali'] += $arrValue['IngRecaudo']['recaudtemcali'];
			$arrFEJTotal[$anio][$index]['recaudtotros'] += $arrValue['IngRecaudo']['recaudtotros'];
			$arrFEJTotal[$anio][$index]['recaudtcomic'] += $arrValue['IngRecaudo']['recaudtcomic'];
			$arrFEJTotal[$anio][$index]['ttIngRecaudo'] += $arrValue['IngRecaudo']['ttIngRecaudo'];
			
			$arrFEJTotal[$anio][$index]['fecreditos'] += $arrValue['OtrosIng']['fecreditos'];
			$arrFEJTotal[$anio][$index]['feapocaprie'] += $arrValue['OtrosIng']['feapocaprie'];
			$arrFEJTotal[$anio][$index]['feingadieucol'] += $arrValue['OtrosIng']['feingadieucol'];
			$arrFEJTotal[$anio][$index]['feingrpubli'] += $arrValue['OtrosIng']['feingrpubli'];
			$arrFEJTotal[$anio][$index]['ferendfinan'] += $arrValue['OtrosIng']['ferendfinan'];
			$arrFEJTotal[$anio][$index]['fereinparci'] += $arrValue['OtrosIng']['fereinparci'];
			$arrFEJTotal[$anio][$index]['TotIngOtrCon'] += $arrValue['OtrosIng']['TotIngOtrCon'];
			
			$arrFEJTotal[$anio][$index]['IngresosTotales'] += $arrValue['IngresosTotales'];
			
			$arrFEJTotal[$anio][$index]['fetradiafid'] += $arrValue['fetradiafid'];
			
			$arrFEJTotal[$anio][$index]['SumiEneSAP'] += $arrValue['EgrePagEmcali']['Energia']['SumiEneSAP'];
			$arrFEJTotal[$anio][$index]['AlqInfEmcSAP'] += $arrValue['EgrePagEmcali']['Energia']['AlqInfEmcSAP'];
			$arrFEJTotal[$anio][$index]['IVAAlqInfSAP'] += $arrValue['EgrePagEmcali']['Energia']['IVAAlqInfSAP'];
			$arrFEJTotal[$anio][$index]['ImpTimFacEne'] += $arrValue['EgrePagEmcali']['Energia']['ImpTimFacEne'];
			$arrFEJTotal[$anio][$index]['feservfacturac'] += $arrValue['EgrePagEmcali']['feservfacturac'];
			$arrFEJTotal[$anio][$index]['IvaSerFact'] += $arrValue['EgrePagEmcali']['IvaSerFact'];
			$arrFEJTotal[$anio][$index]['feservinterven'] += $arrValue['EgrePagEmcali']['feservinterven'];
			$arrFEJTotal[$anio][$index]['IvaServInven'] += $arrValue['EgrePagEmcali']['IvaServInven'];
			$arrFEJTotal[$anio][$index]['ClaSexReMen'] += $arrValue['EgrePagEmcali']['ClaSexReMen'];
			$arrFEJTotal[$anio][$index]['fereinemcaligmf'] += $arrValue['EgrePagEmcali']['fereinemcaligmf'];
			$arrFEJTotal[$anio][$index]['ferenemcalisan'] += $arrValue['EgrePagEmcali']['ferenemcalisan'];
			$arrFEJTotal[$anio][$index]['feintsobsalmayvaltra'] += $arrValue['EgrePagEmcali']['feintsobsalmayvaltra'];
			$arrFEJTotal[$anio][$index]['SubTEgrePagEm'] += $arrValue['EgrePagEmcali']['SubTEgrePagEm'];
			
			$arrFEJTotal[$anio][$index]['fetotinviniinf'] += $arrValue['EgreInversion']['fetotinviniinf'];
			$arrFEJTotal[$anio][$index]['feinvmodinver'] += $arrValue['EgreInversion']['feinvmodinver'];
			$arrFEJTotal[$anio][$index]['exhcplexpanc'] += $arrValue['EgreInversion']['ExpHurCpl']['exhcplexpanc'];
			$arrFEJTotal[$anio][$index]['exhcplcpls'] += $arrValue['EgreInversion']['ExpHurCpl']['exhcplcpls'];
			$arrFEJTotal[$anio][$index]['exhcplretcpl'] += $arrValue['EgreInversion']['ExpHurCpl']['exhcplretcpl'];
			$arrFEJTotal[$anio][$index]['exhcplhurtos'] += $arrValue['EgreInversion']['ExpHurCpl']['exhcplhurtos'];
			$arrFEJTotal[$anio][$index]['fevalanufereven'] += $arrValue['EgreInversion']['fevalanufereven'];
			$arrFEJTotal[$anio][$index]['fevalanuinfalunav'] += $arrValue['EgreInversion']['fevalanuinfalunav'];
			$arrFEJTotal[$anio][$index]['SubTotEgreInver'] += $arrValue['EgreInversion']['SubTotEgreInver'];
			
			$arrFEJTotal[$anio][$index]['fepublicidad'] += $arrValue['EgreOpeMant']['fepublicidad'];
			$arrFEJTotal[$anio][$index]['feseguros'] += $arrValue['EgreOpeMant']['feseguros'];
			$arrFEJTotal[$anio][$index]['fedebitogastosmega'] += $arrValue['EgreOpeMant']['fedebitogastosmega'];
			$arrFEJTotal[$anio][$index]['fesistcalid'] += $arrValue['EgreOpeMant']['fesistcalid'];
			$arrFEJTotal[$anio][$index]['femanfueurb'] += $arrValue['EgreOpeMant']['femanfueurb'];
			$arrFEJTotal[$anio][$index]['feequofimant'] += $arrValue['EgreOpeMant']['feequofimant'];
			$arrFEJTotal[$anio][$index]['fesubconvehperope'] += $arrValue['EgreOpeMant']['fesubconvehperope'];
			$arrFEJTotal[$anio][$index]['podarbtotal'] += $arrValue['EgreOpeMant']['PodArboles']['podarbtotal'];
			$arrFEJTotal[$anio][$index]['fetermografias'] += $arrValue['EgreOpeMant']['fetermografias'];
			$arrFEJTotal[$anio][$index]['fetransteclocon'] += $arrValue['EgreOpeMant']['fetransteclocon'];
			$arrFEJTotal[$anio][$index]['femancehsupopepro'] += $arrValue['EgreOpeMant']['femancehsupopepro'];
			$arrFEJTotal[$anio][$index]['fepersoadmin'] += $arrValue['EgreOpeMant']['fepersoadmin'];
			$arrFEJTotal[$anio][$index]['feperopepro'] += $arrValue['EgreOpeMant']['feperopepro'];
			$arrFEJTotal[$anio][$index]['fegastadmin'] += $arrValue['EgreOpeMant']['fegastadmin'];
			$arrFEJTotal[$anio][$index]['feherramrepherrmen'] += $arrValue['EgreOpeMant']['feherramrepherrmen'];
			$arrFEJTotal[$anio][$index]['fematemantrepu'] += $arrValue['EgreOpeMant']['fematemantrepu'];
			$arrFEJTotal[$anio][$index]['ImpreOperMant'] += $arrValue['EgreOpeMant']['ImpreOperMant'];
			$arrFEJTotal[$anio][$index]['fecontrinvensap'] += $arrValue['EgreOpeMant']['fecontrinvensap'];
			$arrFEJTotal[$anio][$index]['SubTotEgreOM'] += $arrValue['EgreOpeMant']['SubTotEgreOM'];
			
			$arrFEJTotal[$anio][$index]['feinterpagpres'] += $arrValue['EgreFinanPagMega']['feinterpagpres'];
			$arrFEJTotal[$anio][$index]['feabonocappres'] += $arrValue['EgreFinanPagMega']['feabonocappres'];
			$arrFEJTotal[$anio][$index]['SubTotEgreFinan'] += $arrValue['EgreFinanPagMega']['SubTotEgreFinan'];
			
			$arrFEJTotal[$anio][$index]['feimpuesindcomer'] += $arrValue['EgreImpuePagMega']['feimpuesindcomer'];
			$arrFEJTotal[$anio][$index]['feimpuesseguri'] += $arrValue['EgreImpuePagMega']['feimpuesseguri'];
			$arrFEJTotal[$anio][$index]['feimpuesrenta'] += $arrValue['EgreImpuePagMega']['feimpuesrenta'];
			$arrFEJTotal[$anio][$index]['SubTotEgreImpu'] += $arrValue['EgreImpuePagMega']['SubTotEgreImpu'];
			
			$arrFEJTotal[$anio][$index]['SubTotalEgrePagMega'] += $arrValue['SubTotalEgrePagMega'];
			
			$arrFEJTotal[$anio][$index]['feimpsobtrabanc'] += $arrValue['EgrePagOtros']['feimpsobtrabanc'];
			$arrFEJTotal[$anio][$index]['feadmfiduinclaudiext'] += $arrValue['EgrePagOtros']['feadmfiduinclaudiext'];
			$arrFEJTotal[$anio][$index]['fegmftraslemcfidacta'] += $arrValue['EgrePagOtros']['fegmftraslemcfidacta'];
			$arrFEJTotal[$anio][$index]['fepagrevisorfiscal'] += $arrValue['EgrePagOtros']['fepagrevisorfiscal'];
			$arrFEJTotal[$anio][$index]['SubTotEgrePagOtro'] += $arrValue['EgrePagOtros']['SubTotEgrePagOtro'];
			
			$arrFEJTotal[$anio][$index]['TotalEgresos'] += $arrValue['TotalEgresos'];
			$arrFEJTotal[$anio][$index]['TotalGen'] += $arrValue['TotalGen'];
			
			$arrFEJTotal[$anio][$index]['fepaginvpresta'] += $arrValue['fepaginvpresta'];
			$arrFEJTotal[$anio][$index]['fepaginvprestb'] += $arrValue['fepaginvprestb'];
			$arrFEJTotal[$anio][$index]['fesaldocaja'] = $arrValue['fesaldocaja'];

			
			$arrFEJTotal[$anio]['anual']['ipc'] += $arrValue['IppIpc']['ipc'];
			$arrFEJTotal[$anio]['anual']['pipc'] += ($arrValue['IppIpc']['pipc'] / 100 );
			$arrFEJTotal[$anio]['anual']['ipp'] += $arrValue['IppIpc']['ipp'];
			$arrFEJTotal[$anio]['anual']['pipp'] += ($arrValue['IppIpc']['pipp'] / 100 );
			
			$arrFEJTotal[$anio]['anual']['recaudtemcali'] += $arrValue['IngRecaudo']['recaudtemcali'];
			$arrFEJTotal[$anio]['anual']['recaudtotros'] += $arrValue['IngRecaudo']['recaudtotros'];
			$arrFEJTotal[$anio]['anual']['recaudtcomic'] += $arrValue['IngRecaudo']['recaudtcomic'];
			$arrFEJTotal[$anio]['anual']['ttIngRecaudo'] += $arrValue['IngRecaudo']['ttIngRecaudo'];
			
			$arrFEJTotal[$anio]['anual']['fecreditos'] += $arrValue['OtrosIng']['fecreditos'];
			$arrFEJTotal[$anio]['anual']['feapocaprie'] += $arrValue['OtrosIng']['feapocaprie'];
			$arrFEJTotal[$anio]['anual']['feingadieucol'] += $arrValue['OtrosIng']['feingadieucol'];
			$arrFEJTotal[$anio]['anual']['feingrpubli'] += $arrValue['OtrosIng']['feingrpubli'];
			$arrFEJTotal[$anio]['anual']['ferendfinan'] += $arrValue['OtrosIng']['ferendfinan'];
			$arrFEJTotal[$anio]['anual']['fereinparci'] += $arrValue['OtrosIng']['fereinparci'];
			$arrFEJTotal[$anio]['anual']['TotIngOtrCon'] += $arrValue['OtrosIng']['TotIngOtrCon'];
			
			$arrFEJTotal[$anio]['anual']['IngresosTotales'] += $arrValue['IngresosTotales'];
			
			$arrFEJTotal[$anio]['anual']['fetradiafid'] += $arrValue['fetradiafid'];
			
			$arrFEJTotal[$anio]['anual']['SumiEneSAP'] += $arrValue['EgrePagEmcali']['Energia']['SumiEneSAP'];
			$arrFEJTotal[$anio]['anual']['AlqInfEmcSAP'] += $arrValue['EgrePagEmcali']['Energia']['AlqInfEmcSAP'];
			$arrFEJTotal[$anio]['anual']['IVAAlqInfSAP'] += $arrValue['EgrePagEmcali']['Energia']['IVAAlqInfSAP'];
			$arrFEJTotal[$anio]['anual']['ImpTimFacEne'] += $arrValue['EgrePagEmcali']['Energia']['ImpTimFacEne'];
			$arrFEJTotal[$anio]['anual']['feservfacturac'] += $arrValue['EgrePagEmcali']['feservfacturac'];
			$arrFEJTotal[$anio]['anual']['IvaSerFact'] += $arrValue['EgrePagEmcali']['IvaSerFact'];
			$arrFEJTotal[$anio]['anual']['feservinterven'] += $arrValue['EgrePagEmcali']['feservinterven'];
			$arrFEJTotal[$anio]['anual']['IvaServInven'] += $arrValue['EgrePagEmcali']['IvaServInven'];
			$arrFEJTotal[$anio]['anual']['ClaSexReMen'] += $arrValue['EgrePagEmcali']['ClaSexReMen'];
			$arrFEJTotal[$anio]['anual']['fereinemcaligmf'] += $arrValue['EgrePagEmcali']['fereinemcaligmf'];
			$arrFEJTotal[$anio]['anual']['ferenemcalisan'] += $arrValue['EgrePagEmcali']['ferenemcalisan'];
			$arrFEJTotal[$anio]['anual']['feintsobsalmayvaltra'] += $arrValue['EgrePagEmcali']['feintsobsalmayvaltra'];
			$arrFEJTotal[$anio]['anual']['SubTEgrePagEm'] += $arrValue['EgrePagEmcali']['SubTEgrePagEm'];
			
			$arrFEJTotal[$anio]['anual']['fetotinviniinf'] += $arrValue['EgreInversion']['fetotinviniinf'];
			$arrFEJTotal[$anio]['anual']['feinvmodinver'] += $arrValue['EgreInversion']['feinvmodinver'];
			$arrFEJTotal[$anio]['anual']['exhcplexpanc'] += $arrValue['EgreInversion']['ExpHurCpl']['exhcplexpanc'];
			$arrFEJTotal[$anio]['anual']['exhcplcpls'] += $arrValue['EgreInversion']['ExpHurCpl']['exhcplcpls'];
			$arrFEJTotal[$anio]['anual']['exhcplretcpl'] += $arrValue['EgreInversion']['ExpHurCpl']['exhcplretcpl'];
			$arrFEJTotal[$anio]['anual']['exhcplhurtos'] += $arrValue['EgreInversion']['ExpHurCpl']['exhcplhurtos'];
			$arrFEJTotal[$anio]['anual']['fevalanufereven'] += $arrValue['EgreInversion']['fevalanufereven'];
			$arrFEJTotal[$anio]['anual']['fevalanuinfalunav'] += $arrValue['EgreInversion']['fevalanuinfalunav'];
			$arrFEJTotal[$anio]['anual']['SubTotEgreInver'] += $arrValue['EgreInversion']['SubTotEgreInver'];
			
			$arrFEJTotal[$anio]['anual']['fepublicidad'] += $arrValue['EgreOpeMant']['fepublicidad'];
			$arrFEJTotal[$anio]['anual']['feseguros'] += $arrValue['EgreOpeMant']['feseguros'];
			$arrFEJTotal[$anio]['anual']['fedebitogastosmega'] += $arrValue['EgreOpeMant']['fedebitogastosmega'];
			$arrFEJTotal[$anio]['anual']['fesistcalid'] += $arrValue['EgreOpeMant']['fesistcalid'];
			$arrFEJTotal[$anio]['anual']['femanfueurb'] += $arrValue['EgreOpeMant']['femanfueurb'];
			$arrFEJTotal[$anio]['anual']['feequofimant'] += $arrValue['EgreOpeMant']['feequofimant'];
			$arrFEJTotal[$anio]['anual']['fesubconvehperope'] += $arrValue['EgreOpeMant']['fesubconvehperope'];
			$arrFEJTotal[$anio]['anual']['podarbtotal'] += $arrValue['EgreOpeMant']['PodArboles']['podarbtotal'];
			$arrFEJTotal[$anio]['anual']['fetermografias'] += $arrValue['EgreOpeMant']['fetermografias'];
			$arrFEJTotal[$anio]['anual']['fetransteclocon'] += $arrValue['EgreOpeMant']['fetransteclocon'];
			$arrFEJTotal[$anio]['anual']['femancehsupopepro'] += $arrValue['EgreOpeMant']['femancehsupopepro'];
			$arrFEJTotal[$anio]['anual']['fepersoadmin'] += $arrValue['EgreOpeMant']['fepersoadmin'];
			$arrFEJTotal[$anio]['anual']['feperopepro'] += $arrValue['EgreOpeMant']['feperopepro'];
			$arrFEJTotal[$anio]['anual']['fegastadmin'] += $arrValue['EgreOpeMant']['fegastadmin'];
			$arrFEJTotal[$anio]['anual']['feherramrepherrmen'] += $arrValue['EgreOpeMant']['feherramrepherrmen'];
			$arrFEJTotal[$anio]['anual']['fematemantrepu'] += $arrValue['EgreOpeMant']['fematemantrepu'];
			$arrFEJTotal[$anio]['anual']['ImpreOperMant'] += $arrValue['EgreOpeMant']['ImpreOperMant'];
			$arrFEJTotal[$anio]['anual']['fecontrinvensap'] += $arrValue['EgreOpeMant']['fecontrinvensap'];
			$arrFEJTotal[$anio]['anual']['SubTotEgreOM'] += $arrValue['EgreOpeMant']['SubTotEgreOM'];
			
			$arrFEJTotal[$anio]['anual']['feinterpagpres'] += $arrValue['EgreFinanPagMega']['feinterpagpres'];
			$arrFEJTotal[$anio]['anual']['feabonocappres'] += $arrValue['EgreFinanPagMega']['feabonocappres'];
			$arrFEJTotal[$anio]['anual']['SubTotEgreFinan'] += $arrValue['EgreFinanPagMega']['SubTotEgreFinan'];
			
			$arrFEJTotal[$anio]['anual']['feimpuesindcomer'] += $arrValue['EgreImpuePagMega']['feimpuesindcomer'];
			$arrFEJTotal[$anio]['anual']['feimpuesseguri'] += $arrValue['EgreImpuePagMega']['feimpuesseguri'];
			$arrFEJTotal[$anio]['anual']['feimpuesrenta'] += $arrValue['EgreImpuePagMega']['feimpuesrenta'];
			$arrFEJTotal[$anio]['anual']['SubTotEgreImpu'] += $arrValue['EgreImpuePagMega']['SubTotEgreImpu'];
			
			$arrFEJTotal[$anio]['anual']['SubTotalEgrePagMega'] += $arrValue['SubTotalEgrePagMega'];
			
			$arrFEJTotal[$anio]['anual']['feimpsobtrabanc'] += $arrValue['EgrePagOtros']['feimpsobtrabanc'];
			$arrFEJTotal[$anio]['anual']['feadmfiduinclaudiext'] += $arrValue['EgrePagOtros']['feadmfiduinclaudiext'];
			$arrFEJTotal[$anio]['anual']['fegmftraslemcfidacta'] += $arrValue['EgrePagOtros']['fegmftraslemcfidacta'];
			$arrFEJTotal[$anio]['anual']['fepagrevisorfiscal'] += $arrValue['EgrePagOtros']['fepagrevisorfiscal'];
			$arrFEJTotal[$anio]['anual']['SubTotEgrePagOtro'] += $arrValue['EgrePagOtros']['SubTotEgrePagOtro'];
			
			$arrFEJTotal[$anio]['anual']['TotalEgresos'] += $arrValue['TotalEgresos'];
			$arrFEJTotal[$anio]['anual']['TotalGen'] += $arrValue['TotalGen'];
			
			$arrFEJTotal[$anio]['anual']['fepaginvpresta'] += $arrValue['fepaginvpresta'];
			$arrFEJTotal[$anio]['anual']['fepaginvprestb'] += $arrValue['fepaginvprestb'];
			$arrFEJTotal[$anio]['anual']['fesaldocaja'] = $arrValue['fesaldocaja'];
			
			//Imprime MES
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'1', $numCol)->getStyle($Cord.'1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'2', $cplMes[$mes])->getStyle($Cord.'2')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'3', $medMes[$mes].'-'.date("y", strtotime($anio."-01-01")))->getStyle($Cord.'3')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'5', $arrValue['IppIpc']['ipc'])->getStyle($Cord.'5')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'6', ($arrValue['IppIpc']['pipc'] / 100 ))->getStyle($Cord.'6')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'7', $arrValue['IppIpc']['ipp'])->getStyle($Cord.'7')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'8', ($arrValue['IppIpc']['pipp'] / 100 ))->getStyle($Cord.'8')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'11', $arrValue['IngRecaudo']['recaudtemcali'])->getStyle($Cord.'11')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'12', $arrValue['IngRecaudo']['recaudtotros'])->getStyle($Cord.'12')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'13', $arrValue['IngRecaudo']['recaudtcomic'])->getStyle($Cord.'13')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'15', $arrValue['IngRecaudo']['ttIngRecaudo'])->getStyle($Cord.'15')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'18', $arrValue['OtrosIng']['fecreditos'])->getStyle($Cord.'18')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'19', $arrValue['OtrosIng']['feapocaprie'])->getStyle($Cord.'19')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'20', $arrValue['OtrosIng']['feingadieucol'])->getStyle($Cord.'20')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'21', $arrValue['OtrosIng']['feingrpubli'])->getStyle($Cord.'21')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'22', $arrValue['OtrosIng']['ferendfinan'])->getStyle($Cord.'22')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'23', $arrValue['OtrosIng']['fereinparci'])->getStyle($Cord.'23')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'25', $arrValue['OtrosIng']['TotIngOtrCon'])->getStyle($Cord.'25')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'27', $arrValue['IngresosTotales'])->getStyle($Cord.'27')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'30', $arrValue['fetradiafid'])->getStyle($Cord.'30')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'35', $arrValue['EgrePagEmcali']['Energia']['SumiEneSAP'])->getStyle($Cord.'35')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'36', $arrValue['EgrePagEmcali']['Energia']['AlqInfEmcSAP'])->getStyle($Cord.'36')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'37', $arrValue['EgrePagEmcali']['Energia']['IVAAlqInfSAP'])->getStyle($Cord.'37')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'38', $arrValue['EgrePagEmcali']['Energia']['ImpTimFacEne'])->getStyle($Cord.'38')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'39', $arrValue['EgrePagEmcali']['feservfacturac'])->getStyle($Cord.'39')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'40', $arrValue['EgrePagEmcali']['IvaSerFact'])->getStyle($Cord.'40')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'41', $arrValue['EgrePagEmcali']['feservinterven'])->getStyle($Cord.'41')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'42', $arrValue['EgrePagEmcali']['IvaServInven'])->getStyle($Cord.'42')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'43', $arrValue['EgrePagEmcali']['ClaSexReMen'])->getStyle($Cord.'43')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'44', $arrValue['EgrePagEmcali']['fereinemcaligmf'])->getStyle($Cord.'44')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'45', $arrValue['EgrePagEmcali']['ferenemcalisan'])->getStyle($Cord.'45')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'46', $arrValue['EgrePagEmcali']['feintsobsalmayvaltra'])->getStyle($Cord.'46')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'48', $arrValue['EgrePagEmcali']['SubTEgrePagEm'])->getStyle($Cord.'48')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'53', $arrValue['EgreInversion']['fetotinviniinf'])->getStyle($Cord.'53')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'54', $arrValue['EgreInversion']['feinvmodinver'])->getStyle($Cord.'54')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'55', $arrValue['EgreInversion']['ExpHurCpl']['exhcplexpanc'])->getStyle($Cord.'55')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'56', $arrValue['EgreInversion']['ExpHurCpl']['exhcplcpls'])->getStyle($Cord.'56')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'57', $arrValue['EgreInversion']['ExpHurCpl']['exhcplretcpl'])->getStyle($Cord.'57')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'58', $arrValue['EgreInversion']['ExpHurCpl']['exhcplhurtos'])->getStyle($Cord.'58')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'59', $arrValue['EgreInversion']['fevalanufereven'])->getStyle($Cord.'59')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'60', $arrValue['EgreInversion']['fevalanuinfalunav'])->getStyle($Cord.'60')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'62', $arrValue['EgreInversion']['SubTotEgreInver'])->getStyle($Cord.'62')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'65', $arrValue['EgreOpeMant']['fepublicidad'])->getStyle($Cord.'65')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'66', $arrValue['EgreOpeMant']['feseguros'])->getStyle($Cord.'66')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'67', $arrValue['EgreOpeMant']['fedebitogastosmega'])->getStyle($Cord.'67')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'68', $arrValue['EgreOpeMant']['fesistcalid'])->getStyle($Cord.'68')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'69', $arrValue['EgreOpeMant']['femanfueurb'])->getStyle($Cord.'69')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'70', $arrValue['EgreOpeMant']['feequofimant'])->getStyle($Cord.'70')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'71', $arrValue['EgreOpeMant']['fesubconvehperope'])->getStyle($Cord.'71')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'72', $arrValue['EgreOpeMant']['PodArboles']['podarbtotal'])->getStyle($Cord.'72')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'73', $arrValue['EgreOpeMant']['fetermografias'])->getStyle($Cord.'73')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'74', $arrValue['EgreOpeMant']['fetransteclocon'])->getStyle($Cord.'74')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'75', $arrValue['EgreOpeMant']['femancehsupopepro'])->getStyle($Cord.'75')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'76', $arrValue['EgreOpeMant']['fepersoadmin'])->getStyle($Cord.'76')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'77', $arrValue['EgreOpeMant']['feperopepro'])->getStyle($Cord.'77')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'78', $arrValue['EgreOpeMant']['fegastadmin'])->getStyle($Cord.'78')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'79', $arrValue['EgreOpeMant']['feherramrepherrmen'])->getStyle($Cord.'79')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'80', $arrValue['EgreOpeMant']['fematemantrepu'])->getStyle($Cord.'80')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'81', $arrValue['EgreOpeMant']['ImpreOperMant'])->getStyle($Cord.'81')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'82', $arrValue['EgreOpeMant']['fecontrinvensap'])->getStyle($Cord.'82')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'84', $arrValue['EgreOpeMant']['SubTotEgreOM'])->getStyle($Cord.'84')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'87', $arrValue['EgreFinanPagMega']['feinterpagpres'])->getStyle($Cord.'87')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'88', $arrValue['EgreFinanPagMega']['feabonocappres'])->getStyle($Cord.'88')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'90', $arrValue['EgreFinanPagMega']['SubTotEgreFinan'])->getStyle($Cord.'90')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'93', $arrValue['EgreImpuePagMega']['feimpuesindcomer'])->getStyle($Cord.'93')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'94', $arrValue['EgreImpuePagMega']['feimpuesseguri'])->getStyle($Cord.'94')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'95', $arrValue['EgreImpuePagMega']['feimpuesrenta'])->getStyle($Cord.'95')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'97', $arrValue['EgreImpuePagMega']['SubTotEgreImpu'])->getStyle($Cord.'97')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'99', $arrValue['SubTotalEgrePagMega'])->getStyle($Cord.'99')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'102', $arrValue['EgrePagOtros']['feimpsobtrabanc'])->getStyle($Cord.'102')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'103', $arrValue['EgrePagOtros']['feadmfiduinclaudiext'])->getStyle($Cord.'103')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'104', $arrValue['EgrePagOtros']['fegmftraslemcfidacta'])->getStyle($Cord.'104')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'105', $arrValue['EgrePagOtros']['fepagrevisorfiscal'])->getStyle($Cord.'105')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'107', $arrValue['EgrePagOtros']['SubTotEgrePagOtro'])->getStyle($Cord.'107')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'109', $arrValue['TotalEgresos'])->getStyle($Cord.'109')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'111', $arrValue['TotalGen'])->getStyle($Cord.'111')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'113', $arrValue['fepaginvpresta'])->getStyle($Cord.'113')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'114', $arrValue['fepaginvprestb'])->getStyle($Cord.'114')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'116', $arrValue['fesaldocaja'])->getStyle($Cord.'116')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->getColumnDimension($Cord)->setAutoSize(true);
			//Imprime MES
			
			if(($recA % 26) == 0) $indA++;
			($recA < 26) ? $recA++ : $recA = 1;
			
			//Imprime SEMESTRE
			if($mes == 6 || $mes == 12):
				$Cord = $key[$indA].$key[$recA];
			
				$arrStyles[$anio]['espCol'][] = $Cord;
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'1', '')->getStyle($Cord.'1')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'2', 'SEMESTRE No.'.$index)->getStyle($Cord.'2')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'3', '')->getStyle($Cord.'3')->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'5', ($arrFEJTotal[$anio][$index]['ipc'] / 6))->getStyle($Cord.'5')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'6', ($arrFEJTotal[$anio][$index]['pipc']))->getStyle($Cord.'6')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'7', ($arrFEJTotal[$anio][$index]['ipp'] / 6))->getStyle($Cord.'7')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'8', ($arrFEJTotal[$anio][$index]['pipp']))->getStyle($Cord.'8')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'11', $arrFEJTotal[$anio][$index]['recaudtemcali'])->getStyle($Cord.'11')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'12', $arrFEJTotal[$anio][$index]['recaudtotros'])->getStyle($Cord.'12')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'13', $arrFEJTotal[$anio][$index]['recaudtcomic'])->getStyle($Cord.'13')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'15', $arrFEJTotal[$anio][$index]['ttIngRecaudo'])->getStyle($Cord.'15')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'18', $arrFEJTotal[$anio][$index]['fecreditos'])->getStyle($Cord.'18')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'19', $arrFEJTotal[$anio][$index]['feapocaprie'])->getStyle($Cord.'19')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'20', $arrFEJTotal[$anio][$index]['feingadieucol'])->getStyle($Cord.'20')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'21', $arrFEJTotal[$anio][$index]['feingrpubli'])->getStyle($Cord.'21')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'22', $arrFEJTotal[$anio][$index]['ferendfinan'])->getStyle($Cord.'22')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'23', $arrFEJTotal[$anio][$index]['fereinparci'])->getStyle($Cord.'23')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'25', $arrFEJTotal[$anio][$index]['TotIngOtrCon'])->getStyle($Cord.'25')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'27', $arrFEJTotal[$anio][$index]['IngresosTotales'])->getStyle($Cord.'27')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'30', $arrFEJTotal[$anio][$index]['fetradiafid'])->getStyle($Cord.'30')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'35', $arrFEJTotal[$anio][$index]['SumiEneSAP'])->getStyle($Cord.'35')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'36', $arrFEJTotal[$anio][$index]['AlqInfEmcSAP'])->getStyle($Cord.'36')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'37', $arrFEJTotal[$anio][$index]['IVAAlqInfSAP'])->getStyle($Cord.'37')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'38', $arrFEJTotal[$anio][$index]['ImpTimFacEne'])->getStyle($Cord.'38')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'39', $arrFEJTotal[$anio][$index]['feservfacturac'])->getStyle($Cord.'39')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'40', $arrFEJTotal[$anio][$index]['IvaSerFact'])->getStyle($Cord.'40')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'41', $arrFEJTotal[$anio][$index]['feservinterven'])->getStyle($Cord.'41')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'42', $arrFEJTotal[$anio][$index]['IvaServInven'])->getStyle($Cord.'42')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'43', $arrFEJTotal[$anio][$index]['ClaSexReMen'])->getStyle($Cord.'43')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'44', $arrFEJTotal[$anio][$index]['fereinemcaligmf'])->getStyle($Cord.'44')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'45', $arrFEJTotal[$anio][$index]['ferenemcalisan'])->getStyle($Cord.'45')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'46', $arrFEJTotal[$anio][$index]['feintsobsalmayvaltra'])->getStyle($Cord.'46')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'48', $arrFEJTotal[$anio][$index]['SubTEgrePagEm'])->getStyle($Cord.'48')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'53', $arrFEJTotal[$anio][$index]['fetotinviniinf'])->getStyle($Cord.'53')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'54', $arrFEJTotal[$anio][$index]['feinvmodinver'])->getStyle($Cord.'54')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'55', $arrFEJTotal[$anio][$index]['exhcplexpanc'])->getStyle($Cord.'55')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'56', $arrFEJTotal[$anio][$index]['exhcplcpls'])->getStyle($Cord.'56')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'57', $arrFEJTotal[$anio][$index]['exhcplretcpl'])->getStyle($Cord.'57')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'58', $arrFEJTotal[$anio][$index]['exhcplhurtos'])->getStyle($Cord.'58')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'59', $arrFEJTotal[$anio][$index]['fevalanufereven'])->getStyle($Cord.'59')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'60', $arrFEJTotal[$anio][$index]['fevalanuinfalunav'])->getStyle($Cord.'60')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'62', $arrFEJTotal[$anio][$index]['SubTotEgreInver'])->getStyle($Cord.'62')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'65', $arrFEJTotal[$anio][$index]['fepublicidad'])->getStyle($Cord.'65')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'66', $arrFEJTotal[$anio][$index]['feseguros'])->getStyle($Cord.'66')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'67', $arrFEJTotal[$anio][$index]['fedebitogastosmega'])->getStyle($Cord.'67')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'68', $arrFEJTotal[$anio][$index]['fesistcalid'])->getStyle($Cord.'68')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'69', $arrFEJTotal[$anio][$index]['femanfueurb'])->getStyle($Cord.'69')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'70', $arrFEJTotal[$anio][$index]['feequofimant'])->getStyle($Cord.'70')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'71', $arrFEJTotal[$anio][$index]['fesubconvehperope'])->getStyle($Cord.'71')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'72', $arrFEJTotal[$anio][$index]['podarbtotal'])->getStyle($Cord.'72')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'73', $arrFEJTotal[$anio][$index]['fetermografias'])->getStyle($Cord.'73')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'74', $arrFEJTotal[$anio][$index]['fetransteclocon'])->getStyle($Cord.'74')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'75', $arrFEJTotal[$anio][$index]['femancehsupopepro'])->getStyle($Cord.'75')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'76', $arrFEJTotal[$anio][$index]['fepersoadmin'])->getStyle($Cord.'76')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'77', $arrFEJTotal[$anio][$index]['feperopepro'])->getStyle($Cord.'77')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'78', $arrFEJTotal[$anio][$index]['fegastadmin'])->getStyle($Cord.'78')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'79', $arrFEJTotal[$anio][$index]['feherramrepherrmen'])->getStyle($Cord.'79')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'80', $arrFEJTotal[$anio][$index]['fematemantrepu'])->getStyle($Cord.'80')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'81', $arrFEJTotal[$anio][$index]['ImpreOperMant'])->getStyle($Cord.'81')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'82', $arrFEJTotal[$anio][$index]['fecontrinvensap'])->getStyle($Cord.'82')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'84', $arrFEJTotal[$anio][$index]['SubTotEgreOM'])->getStyle($Cord.'84')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'87', $arrFEJTotal[$anio][$index]['feinterpagpres'])->getStyle($Cord.'87')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'88', $arrFEJTotal[$anio][$index]['feabonocappres'])->getStyle($Cord.'88')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'90', $arrFEJTotal[$anio][$index]['SubTotEgreFinan'])->getStyle($Cord.'90')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'93', $arrFEJTotal[$anio][$index]['feimpuesindcomer'])->getStyle($Cord.'93')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'94', $arrFEJTotal[$anio][$index]['feimpuesseguri'])->getStyle($Cord.'94')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'95', $arrFEJTotal[$anio][$index]['feimpuesrenta'])->getStyle($Cord.'95')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'97', $arrFEJTotal[$anio][$index]['SubTotEgreImpu'])->getStyle($Cord.'97')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'99', $arrFEJTotal[$anio][$index]['SubTotalEgrePagMega'])->getStyle($Cord.'99')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'102', $arrFEJTotal[$anio][$index]['feimpsobtrabanc'])->getStyle($Cord.'102')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'103', $arrFEJTotal[$anio][$index]['feadmfiduinclaudiext'])->getStyle($Cord.'103')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'104', $arrFEJTotal[$anio][$index]['fegmftraslemcfidacta'])->getStyle($Cord.'104')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'105', $arrFEJTotal[$anio][$index]['fepagrevisorfiscal'])->getStyle($Cord.'105')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'107', $arrFEJTotal[$anio][$index]['SubTotEgrePagOtro'])->getStyle($Cord.'107')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'109', $arrFEJTotal[$anio][$index]['TotalEgresos'])->getStyle($Cord.'109')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'111', $arrFEJTotal[$anio][$index]['TotalGen'])->getStyle($Cord.'111')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'113', $arrFEJTotal[$anio][$index]['fepaginvpresta'])->getStyle($Cord.'113')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'114', $arrFEJTotal[$anio][$index]['fepaginvprestb'])->getStyle($Cord.'114')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue($Cord.'116', $arrFEJTotal[$anio][$index]['fesaldocaja'])->getStyle($Cord.'116')->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->getColumnDimension($Cord)->setAutoSize(true);
				
				if(($recA % 26) == 0) $indA++;
				($recA < 26) ? $recA++ : $recA = 1;
			endif;
		endforeach; 
		
		//Imprime ANIO
		if($mes == 12):
			$Cord = $key[$indA].$key[$recA];
		
			$arrStyles[$anio]['espColto'][] = $Cord;
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'1', '')->getStyle($Cord.'1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'2', $anio)->getStyle($Cord.'2')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'3', '')->getStyle($Cord.'3')->applyFromArray($styleArray);

			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'5', ($arrFEJTotal[$anio]['anual']['ipc'] / count($arrMeses)))->getStyle($Cord.'5')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'6', $arrFEJTotal[$anio]['anual']['pipc'])->getStyle($Cord.'6')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'7', ($arrFEJTotal[$anio]['anual']['ipp']/ count($arrMeses)))->getStyle($Cord.'7')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'8', $arrFEJTotal[$anio]['anual']['pipp'])->getStyle($Cord.'8')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'11', $arrFEJTotal[$anio]['anual']['recaudtemcali'])->getStyle($Cord.'11')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'12', $arrFEJTotal[$anio]['anual']['recaudtotros'])->getStyle($Cord.'12')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'13', $arrFEJTotal[$anio]['anual']['recaudtcomic'])->getStyle($Cord.'13')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'15', $arrFEJTotal[$anio]['anual']['ttIngRecaudo'])->getStyle($Cord.'15')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'18', $arrFEJTotal[$anio]['anual']['fecreditos'])->getStyle($Cord.'18')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'19', $arrFEJTotal[$anio]['anual']['feapocaprie'])->getStyle($Cord.'19')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'20', $arrFEJTotal[$anio]['anual']['feingadieucol'])->getStyle($Cord.'20')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'21', $arrFEJTotal[$anio]['anual']['feingrpubli'])->getStyle($Cord.'21')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'22', $arrFEJTotal[$anio]['anual']['ferendfinan'])->getStyle($Cord.'22')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'23', $arrFEJTotal[$anio]['anual']['fereinparci'])->getStyle($Cord.'23')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'25', $arrFEJTotal[$anio]['anual']['TotIngOtrCon'])->getStyle($Cord.'25')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'27', $arrFEJTotal[$anio]['anual']['IngresosTotales'])->getStyle($Cord.'27')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'30', $arrFEJTotal[$anio]['anual']['fetradiafid'])->getStyle($Cord.'30')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'35', $arrFEJTotal[$anio]['anual']['SumiEneSAP'])->getStyle($Cord.'35')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'36', $arrFEJTotal[$anio]['anual']['AlqInfEmcSAP'])->getStyle($Cord.'36')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'37', $arrFEJTotal[$anio]['anual']['IVAAlqInfSAP'])->getStyle($Cord.'37')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'38', $arrFEJTotal[$anio]['anual']['ImpTimFacEne'])->getStyle($Cord.'38')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'39', $arrFEJTotal[$anio]['anual']['feservfacturac'])->getStyle($Cord.'39')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'40', $arrFEJTotal[$anio]['anual']['IvaSerFact'])->getStyle($Cord.'40')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'41', $arrFEJTotal[$anio]['anual']['feservinterven'])->getStyle($Cord.'41')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'42', $arrFEJTotal[$anio]['anual']['IvaServInven'])->getStyle($Cord.'42')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'43', $arrFEJTotal[$anio]['anual']['ClaSexReMen'])->getStyle($Cord.'43')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'44', $arrFEJTotal[$anio]['anual']['fereinemcaligmf'])->getStyle($Cord.'44')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'45', $arrFEJTotal[$anio]['anual']['ferenemcalisan'])->getStyle($Cord.'45')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'46', $arrFEJTotal[$anio]['anual']['feintsobsalmayvaltra'])->getStyle($Cord.'46')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'48', $arrFEJTotal[$anio]['anual']['SubTEgrePagEm'])->getStyle($Cord.'48')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'53', $arrFEJTotal[$anio]['anual']['fetotinviniinf'])->getStyle($Cord.'53')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'54', $arrFEJTotal[$anio]['anual']['feinvmodinver'])->getStyle($Cord.'54')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'55', $arrFEJTotal[$anio]['anual']['exhcplexpanc'])->getStyle($Cord.'55')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'56', $arrFEJTotal[$anio]['anual']['exhcplcpls'])->getStyle($Cord.'56')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'57', $arrFEJTotal[$anio]['anual']['exhcplretcpl'])->getStyle($Cord.'57')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'58', $arrFEJTotal[$anio]['anual']['exhcplhurtos'])->getStyle($Cord.'58')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'59', $arrFEJTotal[$anio]['anual']['fevalanufereven'])->getStyle($Cord.'59')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'60', $arrFEJTotal[$anio]['anual']['fevalanuinfalunav'])->getStyle($Cord.'60')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'62', $arrFEJTotal[$anio]['anual']['SubTotEgreInver'])->getStyle($Cord.'62')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'65', $arrFEJTotal[$anio]['anual']['fepublicidad'])->getStyle($Cord.'65')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'66', $arrFEJTotal[$anio]['anual']['feseguros'])->getStyle($Cord.'66')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'67', $arrFEJTotal[$anio]['anual']['fedebitogastosmega'])->getStyle($Cord.'67')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'68', $arrFEJTotal[$anio]['anual']['fesistcalid'])->getStyle($Cord.'68')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'69', $arrFEJTotal[$anio]['anual']['femanfueurb'])->getStyle($Cord.'69')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'70', $arrFEJTotal[$anio]['anual']['feequofimant'])->getStyle($Cord.'70')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'71', $arrFEJTotal[$anio]['anual']['fesubconvehperope'])->getStyle($Cord.'71')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'72', $arrFEJTotal[$anio]['anual']['podarbtotal'])->getStyle($Cord.'72')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'73', $arrFEJTotal[$anio]['anual']['fetermografias'])->getStyle($Cord.'73')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'74', $arrFEJTotal[$anio]['anual']['fetransteclocon'])->getStyle($Cord.'74')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'75', $arrFEJTotal[$anio]['anual']['femancehsupopepro'])->getStyle($Cord.'75')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'76', $arrFEJTotal[$anio]['anual']['fepersoadmin'])->getStyle($Cord.'76')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'77', $arrFEJTotal[$anio]['anual']['feperopepro'])->getStyle($Cord.'77')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'78', $arrFEJTotal[$anio]['anual']['fegastadmin'])->getStyle($Cord.'78')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'79', $arrFEJTotal[$anio]['anual']['feherramrepherrmen'])->getStyle($Cord.'79')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'80', $arrFEJTotal[$anio]['anual']['fematemantrepu'])->getStyle($Cord.'80')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'81', $arrFEJTotal[$anio]['anual']['ImpreOperMant'])->getStyle($Cord.'81')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'82', $arrFEJTotal[$anio]['anual']['fecontrinvensap'])->getStyle($Cord.'82')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'84', $arrFEJTotal[$anio]['anual']['SubTotEgreOM'])->getStyle($Cord.'84')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'87', $arrFEJTotal[$anio]['anual']['feinterpagpres'])->getStyle($Cord.'87')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'88', $arrFEJTotal[$anio]['anual']['feabonocappres'])->getStyle($Cord.'88')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'90', $arrFEJTotal[$anio]['anual']['SubTotEgreFinan'])->getStyle($Cord.'90')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'93', $arrFEJTotal[$anio]['anual']['feimpuesindcomer'])->getStyle($Cord.'93')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'94', $arrFEJTotal[$anio]['anual']['feimpuesseguri'])->getStyle($Cord.'94')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'95', $arrFEJTotal[$anio]['anual']['feimpuesrenta'])->getStyle($Cord.'95')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'97', $arrFEJTotal[$anio]['anual']['SubTotEgreImpu'])->getStyle($Cord.'97')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'99', $arrFEJTotal[$anio]['anual']['SubTotalEgrePagMega'])->getStyle($Cord.'99')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'102', $arrFEJTotal[$anio]['anual']['feimpsobtrabanc'])->getStyle($Cord.'102')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'103', $arrFEJTotal[$anio]['anual']['feadmfiduinclaudiext'])->getStyle($Cord.'103')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'104', $arrFEJTotal[$anio]['anual']['fegmftraslemcfidacta'])->getStyle($Cord.'104')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'105', $arrFEJTotal[$anio]['anual']['fepagrevisorfiscal'])->getStyle($Cord.'105')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'107', $arrFEJTotal[$anio]['anual']['SubTotEgrePagOtro'])->getStyle($Cord.'107')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'109', $arrFEJTotal[$anio]['anual']['TotalEgresos'])->getStyle($Cord.'109')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'111', $arrFEJTotal[$anio]['anual']['TotalGen'])->getStyle($Cord.'111')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'113', $arrFEJTotal[$anio]['anual']['fepaginvpresta'])->getStyle($Cord.'113')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'114', $arrFEJTotal[$anio]['anual']['fepaginvprestb'])->getStyle($Cord.'114')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue($Cord.'116', $arrFEJTotal[$anio]['anual']['fesaldocaja'])->getStyle($Cord.'116')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->getColumnDimension($Cord)->setAutoSize(true);
			
			if(($recA % 26) == 0) $indA++;
			($recA < 26) ? $recA++ : $recA = 1;
		endif;
	endforeach;
	
	/**
	 * 
	 * @param $objPHPExcel
	 * @param $ColIni
	 * @param $ColFin
	 * @param $Color
	 * @param $BoldAll
	 * @return unknown_type
	 */
	function styleCells(&$objPHPExcel, $ColIni, $ColFin, $Color, $BoldAll = false)
	{
		if(!$ColIni || !$ColFin) return;
	
	
		$objPHPExcel->getActiveSheet()->getStyle($ColIni.'1:'.$ColFin.'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'1:'.$ColFin.'3' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'5:'.$ColFin.'8' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'11:'.$ColFin.'13' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'15:'.$ColFin.'15' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'18:'.$ColFin.'23' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'25:'.$ColFin.'25' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'27:'.$ColFin.'27' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'30:'.$ColFin.'30' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'35:'.$ColFin.'46' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'48:'.$ColFin.'48' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'53:'.$ColFin.'60' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'62:'.$ColFin.'62' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'65:'.$ColFin.'82' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'84:'.$ColFin.'84' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'87:'.$ColFin.'88' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'90:'.$ColFin.'90' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'93:'.$ColFin.'95' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'97:'.$ColFin.'97' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'99:'.$ColFin.'99' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'102:'.$ColFin.'105' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'107:'.$ColFin.'107' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'109:'.$ColFin.'109' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'111:'.$ColFin.'111' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'113:'.$ColFin.'114' )->getFill()->getStartColor()->setARGB($Color);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'116:'.$ColFin.'116' )->getFill()->getStartColor()->setARGB($Color);

		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'1:'.$ColFin.'3' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'5:'.$ColFin.'8' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'11:'.$ColFin.'13' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'15:'.$ColFin.'15' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'18:'.$ColFin.'23' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'25:'.$ColFin.'25' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'27:'.$ColFin.'27' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'30:'.$ColFin.'30' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'35:'.$ColFin.'46' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'48:'.$ColFin.'48' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'53:'.$ColFin.'60' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'62:'.$ColFin.'62' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'65:'.$ColFin.'82' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'84:'.$ColFin.'84' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'87:'.$ColFin.'88' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'90:'.$ColFin.'90' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'93:'.$ColFin.'95' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'97:'.$ColFin.'97' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'99:'.$ColFin.'99' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'102:'.$ColFin.'105' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'107:'.$ColFin.'107' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'109:'.$ColFin.'109' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'111:'.$ColFin.'111' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'113:'.$ColFin.'114' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'116:'.$ColFin.'116' )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				
		if($BoldAll == true):
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'1:'.$ColIni.'116' )->getFont()->setBold(true);
		else:
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'15:'.$ColFin.'15' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'25:'.$ColFin.'25' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'27:'.$ColFin.'27' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'48:'.$ColFin.'48' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'62:'.$ColFin.'62' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'84:'.$ColFin.'84' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'90:'.$ColFin.'90' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'97:'.$ColFin.'97' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'99:'.$ColFin.'99' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'107:'.$ColFin.'107' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'109:'.$ColFin.'109' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'111:'.$ColFin.'111' )->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'116:'.$ColFin.'116' )->getFont()->setBold(true);
		endif;
				
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'5:'.$ColFin.'5' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'6:'.$ColFin.'6' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'7:'.$ColFin.'7' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'8:'.$ColFin.'8' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
				
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'11:'.$ColFin.'13' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'15:'.$ColFin.'15' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'18:'.$ColFin.'23' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'25:'.$ColFin.'25' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'27:'.$ColFin.'27' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'30:'.$ColFin.'30' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'35:'.$ColFin.'46' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'48:'.$ColFin.'48' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'53:'.$ColFin.'60' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'62:'.$ColFin.'62' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'65:'.$ColFin.'82' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'84:'.$ColFin.'84' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'87:'.$ColFin.'88' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'90:'.$ColFin.'90' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'93:'.$ColFin.'95' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'97:'.$ColFin.'97' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'99:'.$ColFin.'99' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'102:'.$ColFin.'105' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'107:'.$ColFin.'107' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'109:'.$ColFin.'109' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'111:'.$ColFin.'111' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'113:'.$ColFin.'114' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle( $ColIni.'116:'.$ColFin.'116' )->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	}
	

	foreach($arrStyles AS $arrRang):
		//MESES
		for($a = 1; $a <= 2; $a++)
			styleCells($objPHPExcel, $arrRang['inimes'][$a], $arrRang['finmes'][$a], 'FFDAEEF3');

		for($a = 0; $a < count($arrRang['espCol']); $a++)
			styleCells($objPHPExcel, $arrRang['espCol'][$a], $arrRang['espCol'][$a], 'FFC5D9F1');
			
		for($a = 0; $a < count($arrRang['espColto']); $a++)
			styleCells($objPHPExcel, $arrRang['espColto'][$a], $arrRang['espColto'][$a], 'FFC5D9F1', true);
	endforeach;
	
	$objPHPExcel->getActiveSheet()->setShowGridlines(false);
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);
	



	
	
	
//	for($a = 0; $a < count($keycol['cols']); $a++)
//		$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].'1', $arr_mes[date('n', strtotime($ar_date[$a])) - 1].'-'.date('Y', strtotime($ar_date[$a])))->getStyle($keycol[$a+1].'1')->applyFromArray($styleArray);
//	
//	
//	foreach($arrFlujoEjecutado AS $anio => $arrMeses):
//		foreach($arrMeses AS $mes => $arrValue):
//			echo $anio.'-'.$mes.' '.$key[$indA].$key[$recA].'<br>';
//			$keycol[] = $key[$indA].$key[$recA];
//			
//			if(($recA % 26) == 0) $indA++;
//			($recA < 26) ? $recA++ : $recA = 1;
//			
//			
//			
//					
//			
//			
//			
//		endforeach;
//	endforeach;
//	
//	
//	
//	for($a = 0; $a < count($ar_date); $a++)
//		if(date('Y', strtotime($ar_date[$a])) >= 2000) $objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].'1', $arr_mes[date('n', strtotime($ar_date[$a])) - 1].'-'.date('Y', strtotime($ar_date[$a])))->getStyle($keycol[$a+1].'1')->applyFromArray($styleArray);
//		
//		
//		
//		
//	foreach($arrFlujoEjecutado AS $anio => $arrMeses):
//		foreach($arrMeses AS $mes => $arrValue):
//			echo $anio.'-'.$mes.' '.$key[$indA].$key[$recA].'<br>';
//			$keycol[] = $key[$indA].$key[$recA];
//			
//			if(($recA % 26) == 0) $indA++;
//			($recA < 26) ? $recA++ : $recA = 1;
//			
//			
//			
//					
//			
//			
//			
//		endforeach;
//	endforeach;
//	
//	die();
		
	/*	
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$keycol[count($ar_date)].'1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$keycol[count($ar_date)].'1')->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$keycol[count($ar_date)].'1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$keycol[count($ar_date)].'1')->getFont()->setBold(true);
	
	
	//Content: Column Head		
	//Var
	$row = 2;
		
	//Content: Counts :: Session A
	foreach($a_session as $value):
		switch ($value):
			case 'pgoblc': $label = 'Pago Obligaciones'; break;
			case 'rtinvst': $label = 'Retorno Inversionista'; break;
			case 'valrtinvst_1':
			case 'valrtinvst_2':
			case 'valrtinvst_3':
			case 'Cont2355_a': $label = ''; break;
			case 'valrtinvst': $label = 'Validacion Retorno Inversionista'; break;
			default: $label = $value; break;
		endswitch;	

		$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, $label)->getStyle($keycol[0].$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
		
		
		for($a = 0; $a < count($ar_date); $a++):
			if(date('Y', strtotime($ar_date[$a])) >= 2000):
				($ar_count[$value][$a]) ? $datValue = round($ar_count[$value][$a]) : $datValue = 0;
				$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
			endif;
		endfor;
		
		$row++;
	endforeach;
	//Content: Counts :: Session A
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
		
	//Ingresos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Ingresos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
							
	for($a = 0; $a < count($ar_date); $a++):
		$rest = 0;
										
		if($ar_date[$a] < date('Y-m-d', strtotime('2001-01-01'))):
			$ingresos[$a] = $ar_count[2105][$a] + $ar_count[3140][$a] + $ar_count[4125][$a] + $ar_count[4205][$a];
		elseif($ar_date[$a] < date('Y-m-d', strtotime('2002-12-01'))):
			$ingresos[$a] = $ar_count[2105][$a] + $ar_count[3140][$a] + $ar_count[4125][$a] + $ar_count[4205][$a] - ($ar_count[2105][$a-1] + $ar_count[3140][$a-1]);
		else:
			if($ar_count[2105][$a] > $ar_count[2105][$a-1])
				$rest = $ar_count[2105][$a] - $ar_count[2105][$a-1];
			
			$ingresos[$a] = $ar_count[4125][$a] + $ar_count[4205][$a] + ($ar_count[3140][$a] - $ar_count[3140][$a-1]) + $rest;
		endif;
								
//		if($ar_date[$a] == date('Y-m-d', strtotime('2008-06-01')))
//			$ingresos[$a] -= (1757305240.91177); //Ajuste Retorno inversionista;
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($ingresos[$a]) ? $datValue = round($ingresos[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Ingresos	
	$row++;
	
	//Egresos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Egresos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$rest = 0;
										
		$part1 = $ar_count[1255][$a] + $ar_count[1505][$a] + $ar_count[171005][$a] +
				($ar_count[5105][$a] + $ar_count[5115][$a] + $ar_count[5120][$a] + $ar_count[5135][$a] + 
				$ar_count[5145][$a] + $ar_count[5160][$a] + $ar_count[5195][$a] + $ar_count[5205][$a] + 
				$ar_count[5215][$a] + $ar_count[5230][$a] + $ar_count[5235][$a] + $ar_count[5245][$a] +
				$ar_count[5250][$a] + $ar_count[5265][$a] + $ar_count[5295][$a] + $ar_count[5305][$a] +
				$ar_count[5315][$a] + $ar_count[6135][$a]) - $ar_count[5160][$a] - $ar_count[5265][$a];

		if($ar_date[$a] == date('Y-m-d', strtotime('2000-12-01')))
			$egresos[$a] = $part1 - $ar_count[235505][$a];
		elseif($ar_date[$a] >= date('Y-m-d', strtotime('2001-06-01')))
		{
			$part1 = $part1 - $ar_count[1505][$a-1] - $ar_count[171005][$a-1] + $ar_count['pgoblc'][$a] - 
					$ar_count[1255][$a-1] - $ar_count[235505][$a] + $ar_count[235505][$a-1];
											
//		if($ar_date[$a] > date('Y-m-d', strtotime('2005-12-01')))
//			$part1 = $part1 + $ar_count['rtinvst'][$a];
											
			$egresos[$a] = $part1;
		}
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($egresos[$a]) ? $datValue = round($egresos[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Egresos	
	$row++;
	
	//Disponible
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Disponible')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$disponible[$a] = $ingresos[$a] - $egresos[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($disponible[$a]) ? $datValue = round($disponible[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Disponible	
	$row++;

	//Caja
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Caja')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$valtot -= $caja[$a - 1];
		$valtoth += $caja[$a - 1];
	
		if($ar_date[$a] < date('Y-m-d', strtotime('2002-01-01'))):
		
			$caja[$a] =  $ar_count[1120][$a] + $valtot;
		else:
			$caja[$a] = $ar_count[1120][$a] - $valtoth;
		endif;

//		$caja[$a] = $ar_count[1120][$a] - $decr;
//		$decr += $ar_count[1120][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($caja[$a]) ? $datValue = round($caja[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Caja	
	$row++;

	//Diferencia
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Diferencia')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$diferencia[$a] = $disponible[$a] - $caja[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($diferencia[$a]) ? $datValue = round($diferencia[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Diferencia	
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
	
	//Caja Final
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Caja Final')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$cajafinal[$a] = $cajafinal[$a-1] + $disponible[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($cajafinal[$a]) ? $datValue = round($cajafinal[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	
	//Caja Final	
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
	
	
	//Content: Counts :: Session B
	foreach($b_session as $value):
		$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, $value)->getStyle($keycol[0].$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
		for($a = 0; $a < count($ar_date); $a++):
			if(date('Y', strtotime($ar_date[$a])) >= 2000):
				($ar_countt[$value][$a]) ? $datValue = round($ar_countt[$value][$a]) : $datValue = 0;
				$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
			endif;
		endfor;
		
		$row++;
	endforeach;
	//Content: Counts :: Session B
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$row++;
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'FLUJO DE CAJA');
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	
	$exrow = $row;
	
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row.':'.$keycol[count($ar_date)].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FF4F81BD');

	$row++;
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
	
	
	
	//Utilidad Operativa
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Utilidad Operativa')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$geneinter[$a] =  $ar_count[4125][$a] - $ar_countt[51][$a] - $ar_countt[52][$a] - $ar_count[6135][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($geneinter[$a]) ? $datValue = round($geneinter[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Utilidad Operativa	
	$row++;

	//Mas : Depreciacion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Depreciacion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$geneinter[$a] += $ar_count[5160][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($ar_count[5160][$a]) ? $datValue = round($ar_count[5160][$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Depreciacion
	$row++;

	//Mas : Amortizacion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Amortizacion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$geneinter[$a] += $ar_count[5265][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($ar_count[5265][$a]) ? $datValue = round($ar_count[5265][$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Amortizacion
	$row++;

	//Mas : Provisiones
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Provisiones')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Provisiones
	$row++;

	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Generacion Interna
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Generacion Interna')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$geneinter[$a] += $ar_count[5265][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($geneinter[$a]) ? $datValue = round($geneinter[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Generacion Interna
	$row++;

	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Capital de Trabajo
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Capital de Trabajo')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Capital de Trabajo
	$row++;

	//Mas : Cartera Nacional
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Cartera Nacional')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Cartera Nacional
	$row++;

	//Mas : Inventarios Operacionales
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Inventarios Operacionales')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Inventarios Operacionales
	$row++;
	
	//Menos : Proveedores
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Menos : Proveedores')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$menprovee[$a] += 0 - ($ar_count[235505][$a] - $ar_count[235505][$a - 1]);
		$print = $ar_count[235505][$a] - $ar_count[235505][$a - 1];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($print) ? $datValue = round($print) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Menos : Proveedores
	$row++;

	//Mas : Impuestos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Impuestos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Impuestos
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Total Capital de Trabajo
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Total Capital de Trabajo')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($menprovee[$a]) ? $datValue = round($menprovee[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Total Capital de Trabajo
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Otras Fuentes - Otros Usos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Otras Fuentes - Otros Usos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Otras Fuentes - Otros Usos
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
		
	//Disponible Para Inversion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Disponible Para Inversion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$disparinv[$a] =  $geneinter[$a] - $menprovee[$a];
		
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($disparinv[$a]) ? $datValue = round($disparinv[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Disponible Para Inversion
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Inversion Activos Fijos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Inversion Activos Fijos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if($ar_date[$a] < date('Y-m-d', strtotime('2001-06-30')))
			$invactfijo[$a] += $ar_count[1505][$a] - $invactfijo[$a-1];
		else
			$invactfijo[$a] += $ar_count[1505][$a] - $ar_count[1505][$a-1];
		
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($invactfijo[$a]) ? $datValue = round($invactfijo[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Inversion Activos Fijos
	$row++;
		
	//Inversiones Permanentes
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Inversiones Permanentes')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($ar_count[1255][$a]) ? $datValue = round($ar_count[1255][$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Inversiones Permanentes
	$row++;
								
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
			
	//Flujo de Caja Libre
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Flujo de Caja Libre')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$flujcajalibr[$a] = $disparinv[$a] - $invactfijo[$a] - $ar_count[1255][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($flujcajalibr[$a]) ? $datValue = round($flujcajalibr[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Flujo de Caja Libre
	$row++;				
									
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Menos : Pago de Intereses
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Menos : Pago de Intereses')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($ar_count[5305][$a]) ? $datValue = round($ar_count[5305][$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Menos : Pago de Intereses
	$row++;

	//Mas : Incremento Obligaciones
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Incremento Obligaciones')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if($ar_date[$a] < date('Y-m-d', strtotime('2001-06-30')))
			$masincrobli[$a] += $ar_count[2105][$a] - $masincrobli[$a-1];
		else
			$masincrobli[$a] += $ar_count[2105][$a] - $ar_count[2105][$a-1];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($masincrobli[$a]) ? $datValue = round($masincrobli[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Incremento Obligaciones
	$row++;

	//Mas : Ing (Egr) no Operacionales
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Ing (Egr) no Operacionales')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$masingegroper[$a] += $ar_countt[42][$a] -  $ar_count[5315][$a];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($masingegroper[$a]) ? $datValue = round($masingegroper[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Incremento Obligaciones
	$row++;
	
	//Mas : Otros
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Otros')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Otros
	$row++;
									
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells

	//Total Flujo Financiero
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Total Flujo Financiero')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$totaflujfina[$a] = $masincrobli[$a] - $ar_count[5305][$a] + $masingegroper[$a];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($totaflujfina[$a]) ? $datValue = round($totaflujfina[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Total Flujo Financiero
	$row++;
									
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Variacion Otras Cuentas Patrimonio
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Variacion Otras Cuentas Patrimonio')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($varotrcuepat[$a]) ? $datValue = round($varotrcuepat[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Variacion Otras Cuentas Patrimonio
	$row++;
										
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
		
	//Flujo de Caja para Utilizacion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Flujo de Caja para Utilizacion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$flujcajautil[$a] = $flujcajalibr[$a] + $totaflujfina[$a] + $varotrcuepat[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($flujcajautil[$a]) ? $datValue = round($flujcajautil[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Flujo de Caja para Utilizacion
	$row++;
											
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
		
	//Reparto de Dividendos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Reparto de Dividendos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Reparto de Dividendos
	$row++;
			
	//Capitalizacion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Capitalizacion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y-m', strtotime($ar_date[$a])) == '2009-12') 
			$capitaliza[$a] =  -5768009885;
		elseif(date('Y-m', strtotime($ar_date[$a])) < '2009-12')
			$capitaliza[$a] += $ar_count[3140][$a] -  $ar_count[3140][$a-1];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($capitaliza[$a]) ? $datValue = round($capitaliza[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Capitalizacion
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$row++;
	//Space: Meger Cells
	
	//Reparto de Dividendos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, '')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
						
	for($a = 0; $a < count($ar_date); $a++)
		if(date('Y', strtotime($ar_date[$a])) >= 2000) $objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $arr_mes[date('n', strtotime($ar_date[$a])) - 1].'-'.date('Y', strtotime($ar_date[$a])))->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.$keycol[count($ar_date)].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.$keycol[count($ar_date)].$row)->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.$keycol[count($ar_date)].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.$keycol[count($ar_date)].$row)->getFont()->setBold(true);
	
	//Reparto de Dividendos
	$row++;
	
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
				
	//Flujo Neto
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Flujo Neto')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$flujoneto[$a] = $flujcajautil[$a] + $capitaliza[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($flujoneto[$a]) ? $datValue = round($flujoneto[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Flujo Neto
	$row++;
		
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
				
	//Caja Inicial
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Caja Inicial')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if($ar_date[$a] < date('Y-m-d', strtotime('2001-06-30')))
			$cajaini[$a] += $flujoneto[$a-1];
		else
			$cajaini[$a] += $flujoneto[$a-1] + $cajaini[$a-1];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($cajaini[$a]) ? $datValue = round($cajaini[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Caja Inicial
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
				
	//Caja Final
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Caja Final')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FF4F81BD');
						
	for($a = 0; $a < count($ar_date); $a++):
		$total = $flujoneto[$a] + $cajaini[$a];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($total) ? $datValue = round($total) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FF4F81BD');
		endif;
	endfor;
	//Caja Final
	$exrow_to = $row;
	
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$row++;
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$row++;
	//Space: Meger Cells
				
	//Disponible Balance
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Disponible Balance')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($cajafinal[$a]) ? $datValue = round($cajafinal[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Disponible Balance
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
					
	//Diferencia
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Diferencia')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$difbalance = ($flujoneto[$a] + $cajaini[$a]) - $cajafinal[$a];
		
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($difbalance) ? $datValue = round($difbalance) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Diferencia
	$row++;
					
	//Diferencia 2
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Diferencia 2')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$difbalance = $cajafinal[$a] - $ar_count[1120][$a];
		
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($difbalance) ? $datValue = round($difbalance) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Diferencia 2
	$row++;
	
	
	foreach($keycol AS $filed)
		$objPHPExcel->getActiveSheet()->getColumnDimension($filed)->setAutoSize(true);
		
	$objPHPExcel->getActiveSheet()->setShowGridlines(false);
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);
	$objPHPExcel->getActiveSheet()->getStyle()->applyFromArray($styleArray);
	
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A2:'.$keycol[0].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->getStyle('A2:'.$keycol[0].$row)->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$exrow)->getFont()->getColor()->setARGB("FFFFFFFF");
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$exrow_to.':'.$keycol[count($ar_date)].$exrow_to)->getFont()->getColor()->setARGB("FFFFFFFF");
	$objPHPExcel->getActiveSheet()->getStyle('A2:'.$keycol[0].$row)->getFont()->setBold(true);
	
	
	
	
//	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->getColor()->setARGB("FF1F497D");
//	$objPHPExcel->getActiveSheet()->getStyle('A2:I'.($nrOttipo + 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//	
//	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
//	$objPHPExcel->getActiveSheet()->getStyle('A2:I'.($nrOttipo + 1))->getFill()->getStartColor()->setARGB('FFDAEEF3');
//	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	
	

*/
	$objPHPExcel->getProperties()->setCreator("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setLastModifiedBy("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setTitle("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setSubject("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setDescription("Este documento fue generado desde el software Adsum");
	$objPHPExcel->getProperties()->setKeywords("office php adsum kallpa");
	$objPHPExcel->getProperties()->setCategory("Export result file");
	$objWriterSinzona = new PHPExcel_Writer_Excel5($objPHPExcel);
	$objWriterSinzona->save($uploaddir.'ADM_FlujoEjecutado.xls');
	
	echo 'ADM_FlujoEjecutado.xls';