$(function(){
	// Otros ingresos
	$('#fecreditos_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fecreditos';
		document.getElementById('comment').value = document.getElementById('fecreditos_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fecreditos_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feapocaprie_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feapocaprie';
		document.getElementById('comment').value = document.getElementById('feapocaprie_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feapocaprie_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feingadieucol_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feingadieucol';
		document.getElementById('comment').value = document.getElementById('feingadieucol_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feingadieucol_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feingrpubli_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feingrpubli';
		document.getElementById('comment').value = document.getElementById('feingrpubli_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feingrpubli_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#ferendfinan_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'ferendfinan';
		document.getElementById('comment').value = document.getElementById('ferendfinan_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('ferendfinan_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fereinparci_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fereinparci';
		document.getElementById('comment').value = document.getElementById('fereinparci_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fereinparci_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Otros ingresos
	// Anticipos
	$('#fetradiafid_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fetradiafid';
		document.getElementById('comment').value = document.getElementById('fetradiafid_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fetradiafid_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Anticipos
	// Egresos Pagados a i
	$('#feservfacturac_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feservfacturac';
		document.getElementById('comment').value = document.getElementById('feservfacturac_comment').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feservfacturac_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feservinterven_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feservinterven';
		document.getElementById('comment').value = document.getElementById('feservinterven_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feservinterven_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	$('#feservinterven_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feservinterven';
		document.getElementById('comment').value = document.getElementById('feservinterven_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feservinterven_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});

	$('#fereinligmf_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fereinligmf';
		document.getElementById('comment').value = document.getElementById('fereinligmf_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fereinligmf_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});

	$('#fereinligmf2_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fereinligmf2';
		document.getElementById('comment').value = document.getElementById('fereinligmf2_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fereinligmf2_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#ferenlisan_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'ferenlisan';
		document.getElementById('comment').value = document.getElementById('ferenlisan_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('ferenlisan_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});

	$('#feintsobsalmayvaltra_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feintsobsalmayvaltra';
		document.getElementById('comment').value = document.getElementById('feintsobsalmayvaltra_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feintsobsalmayvaltra_').value, '');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Egresos Pagados a li
	// Egresos de Inversión
	$('#fetotinviniinf_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fetotinviniinf';
		document.getElementById('comment').value = document.getElementById('fetotinviniinf_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fetotinviniinf_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});

	$('#feinvmodinver_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feinvmodinver';
		document.getElementById('comment').value = document.getElementById('feinvmodinver_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feinvmodinver_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fevalanufereven_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fevalanufereven';
		document.getElementById('comment').value = document.getElementById('fevalanufereven_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fevalanufereven_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});

	$('#fevalanuinfalunav_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fevalanuinfalunav';
		document.getElementById('comment').value = document.getElementById('fevalanuinfalunav_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fevalanuinfalunav_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Egresos de Inversión
	// Egresos de O y M
   $('#fepublicidad_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
	    document.getElementById('comment_field').value = 'fepublicidad';
		document.getElementById('comment').value = document.getElementById('fepublicidad_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fepublicidad_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});

	$('#feseguros_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feseguros';
		document.getElementById('comment').value = document.getElementById('feseguros_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feseguros_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fesistcalid_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fesistcalid';
		document.getElementById('comment').value = document.getElementById('fesistcalid_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fesistcalid_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});

	$('#femanfueurb_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'femanfueurb';
		document.getElementById('comment').value = document.getElementById('femanfueurb_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('femanfueurb_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feequofimant_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feequofimant';
		document.getElementById('comment').value = document.getElementById('feequofimant_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feequofimant_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fesubconvehperope_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fesubconvehperope';
		document.getElementById('comment').value = document.getElementById('fesubconvehperope_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fesubconvehperope_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fetermografias_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fetermografias';
		document.getElementById('comment').value = document.getElementById('fetermografias_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fetermografias_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#femancehsupopepro_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'femancehsupopepro';
		document.getElementById('comment').value = document.getElementById('femancehsupopepro_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('femancehsupopepro_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fepersoadmin_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fepersoadmin';
		document.getElementById('comment').value = document.getElementById('fepersoadmin_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fepersoadmin_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feperopepro_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feperopepro';
		document.getElementById('comment').value = document.getElementById('feperopepro_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feperopepro_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fegastadmin_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fegastadmin';
		document.getElementById('comment').value = document.getElementById('fegastadmin_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fegastadmin_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feherramrepherrmen_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feherramrepherrmen';
		document.getElementById('comment').value = document.getElementById('feherramrepherrmen_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feherramrepherrmen_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fematemantrepu_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fematemantrepu';
		document.getElementById('comment').value = document.getElementById('fematemantrepu_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fematemantrepu_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fecontrinvensap_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fecontrinvensap';
		document.getElementById('comment').value = document.getElementById('fecontrinvensap_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fecontrinvensap_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Egresos de O y M
	// Egresos Financieros Pagados a Mega
	$('#feinterpagpres_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feinterpagpres';
		document.getElementById('comment').value = document.getElementById('feinterpagpres_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feinterpagpres_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feabonocappres_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feabonocappres';
		document.getElementById('comment').value = document.getElementById('feabonocappres_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feabonocappres_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Egresos Financieros Pagados a Mega	
	// Egresos Impuestos Pagados a Mega
	$('#feimpuesindcomer_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feimpuesindcomer';
		document.getElementById('comment').value = document.getElementById('feimpuesindcomer_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feimpuesindcomer_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feimpuesseguri_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feimpuesseguri';
		document.getElementById('comment').value = document.getElementById('feimpuesseguri_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feimpuesseguri_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feimpuesrenta_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feimpuesrenta';
		document.getElementById('comment').value = document.getElementById('feimpuesrenta_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feimpuesrenta_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Egresos Impuestos Pagados a Mega	
	// Egresos Pagados a Otros
	$('#feimpsobtrabanc_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feimpsobtrabanc';
		document.getElementById('comment').value = document.getElementById('feimpsobtrabanc_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feimpsobtrabanc_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#feadmfiduinclaudiext_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'feadmfiduinclaudiext';
		document.getElementById('comment').value = document.getElementById('feadmfiduinclaudiext_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('feadmfiduinclaudiext_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Egresos Pagados a Otros
	// Egresos Pagados a Otros
	$('#fepaginvprestb_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fepaginvprestb';
		document.getElementById('comment').value = document.getElementById('fepaginvprestb_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fepaginvprestb_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	
	$('#fepaginvpresta_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fepaginvpresta';
		document.getElementById('comment').value = document.getElementById('fepaginvpresta_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fepaginvpresta_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});

	$('#fesaldocaja_comment').button({ icons: { primary: "ui-icon-locked" }, text: false }).click(function() {
		document.getElementById('comment_field').value = 'fesaldocaja';
		document.getElementById('comment').value = document.getElementById('fesaldocaja_com').value;
		document.getElementById('valor').value = formatNumber(document.getElementById('fesaldocaja_').value,'');
		$('#msgwindowlocked').dialog('open');
		
		return false;
	});
	// Egresos Pagados a Otros
});


/**
 * Function formatNumber
 */
function formatNumber(num, prefix)
{
	prefix = prefix || '';
	num += '';

	var splitStr = num.split('.');
	var splitLeft = splitStr[0];
	var splitRight = splitStr.length > 1 ? ',' + splitStr[1] : '';
	var regx = /(\d+)(\d{3})/;

	while (regx.test(splitLeft)) {
		splitLeft = splitLeft.replace(regx, '$1' + '.' + '$2');
	}

	return prefix + splitLeft + splitRight;
}

/**
 * Function reformatNumber
 */
function reformatNumber(num) 
{
	if(num == '')
		return '0';
	num = num.replace(/([^0-9\,\-])/g,'');
	return num.replace(/([^0-9\.\-])/g,'.');
}

/**
 * Class Decimal
 */
var suma = 0;
Number.prototype.decimal = function(n) {
	pot = Math.pow(10, parseInt(n));
	return parseInt(this * pot) / pot;
}

/**
 * Function dateComapreTo
 * @param yy1
 * @param mm1
 * @param dd1
 * @param yy2
 * @param mm2
 * @param dd2
 * @return
 */
function dateComapreTo(yy1, mm1, dd1, yy2, mm2, dd2) 
{
	var f1 =  new Date(yy1, mm1, dd1);
	var f2 =  new Date(yy2, mm2, dd2);
	return f1.getTime() - f2.getTime();
}

function comparaFecha(fecha, fecha1)
{
	fec = fecha.split("-");
	fec1 = fecha1.split("-");
	
	if(parseInt(fec[0]) > parseInt(fec1[0]))
		return 1;
	else if(parseInt(fec[0]) < parseInt(fec1[0]))
		return -1;
	else
	{
		if(parseInt(fec[1]) > parseInt(fec1[1]))
			return 1;
		else if(parseInt(fec[1]) < parseInt(fec1[1]))
			return -1;
		else
		{
			if(parseInt(fec[2]) > parseInt(fec1[2]))
				return 1;
			else if(parseInt(fec[2]) < parseInt(fec1[2]))
				return -1;
			else
				return 0;
		}
	} 
}


function opermatch(nocalc1, nocalc2)
{
	// Total ingresos por otros conceptos
	var fecreditos = document.getElementById('fecreditos_').value;
	var feapocaprie = document.getElementById('feapocaprie_').value;
	var feingadieucol = document.getElementById('feingadieucol_').value;
	var feingrpubli = document.getElementById('feingrpubli_').value;
	var ferendfinan = document.getElementById('ferendfinan_').value;
	var fereinparci = document.getElementById('fereinparci_').value;
	//Fecha
	var fluejemes = document.getElementById('fluejemes').value;
	var fluejeano = document.getElementById('fluejeano').value;
	
	suma = parseFloat(fecreditos) + parseFloat(feapocaprie) + parseFloat(feingadieucol) + parseFloat(feingrpubli) + parseFloat(ferendfinan) + parseFloat(fereinparci);
	document.getElementById('TotIngOtrCon').innerHTML = formatNumber(Math.round(suma),''); // Total 
	// Total ingresos por otros conceptos
	
	// Ingresos Totales
	var tt_ingrecaudo = document.getElementById('tt_ingrecaudo').value; // Total Ingresos [Recaudo Impuesto A.P.]
	
	var t_ingreso = suma + parseFloat(tt_ingrecaudo);
	document.getElementById('TotalIngresos').innerHTML = formatNumber(Math.round(t_ingreso),'');
	// Ingresos Totales
	
	var por_intereven = document.getElementById('por_intereven').value;	// Porcentaje Facturacion
	var por_factuara= document.getElementById('por_factuara').value;	// Porcentaje interventoria
	var por_iva = document.getElementById('por_iva').value;				// Dato de Entrada IVA
	
	// Servicio de Interventoría
	var date_sel =  fluejeano + '-' + fluejemes + '-1'; 
	
	if(nocalc1 == '')
	{
		if(comparaFecha(date_sel, '2007-6-30') > 0  && comparaFecha(date_sel, '2007-10-31') <= 0)
			var servinven = (tt_ingrecaudo * 0.02);
		else
		{
			var servinven = 0;
			
			if(comparaFecha(date_sel, '2007-10-31') > 0)
				servinven = (t_ingreso * parseFloat(por_intereven)) / 100;
		}
		
		//var servinven = (t_ingreso * parseFloat(por_intereven)) / 100;
		document.getElementById('feservinterven_').value = servinven;
		document.getElementById('feservinterven').value = formatNumber(Math.round(servinven),'');
		// Servicio de Interventoría
		// IVA del Servicio de Interventoría
	}
	else
		var servinven = document.getElementById('feservinterven_').value;
	
	
	var recaudli = document.getElementById('recaudli').value;	// Porcentaje Facturacion
	// Servicio de Interventoría
	if(nocalc2 == '')
	{
		if(comparaFecha(date_sel, '2006-3-30') < 0  && comparaFecha(date_sel, '2007-09-30') >= 0 && comparaFecha(date_sel, '2007-10-31') <= 0)
		{
			var servfactura = (recaudli * 0.02);
		}
		else
		{
			var servfactura = 0;
			
			if(comparaFecha(date_sel, '2007-10-31') > 0)
				servfactura = (recaudli * parseFloat(por_factuara)) / 100;
		}
			
		//var servinven = (recaudli * parseFloat(por_intereven)) / 100;
		document.getElementById('feservfacturac_').value = servfactura;
		document.getElementById('feservfacturac').value = formatNumber(Math.round(servfactura),'');
		// Servicio de Facturacion
		// IVA del Servicio de Facturacion
	}
	else
		var servfactura = document.getElementById('feservfacturac_').value;
		
	
	if(comparaFecha(date_sel, '2001-6-30') > 0)
	{
		var ivaservinven = (servinven * parseFloat(por_iva)) / 100;
		document.getElementById('IVAServInven').innerHTML = formatNumber(Math.round(ivaservinven),'');
		
		var ivaservfact = (servfactura * parseFloat(por_iva)) / 100;
		document.getElementById('IVASerFact').innerHTML = formatNumber(Math.round(ivaservfact),'');
	}
	else
		var ivaservinven = 0;
	// IVA del Servicio de Interventoría
	
	// Reintegro a li G.M.F.
	var fetradiafid = document.getElementById('fetradiafid_').value;
	var fereinligmf = document.getElementById('fereinligmf_').value;
	var fereinligmf2 = document.getElementById('fereinligmf2_').value;

	if(comparaFecha(date_sel, '2007-12-30') > 0)
	{
		suma = (fetradiafid * 4) / 1000;
		document.getElementById('fereinligmf_').value = suma;
		document.getElementById('fereinligmf').value = formatNumber(Math.round(suma),'');
	}
	else
	{
		if(fereinligmf == '')
			suma = 0;
		else
			suma = parseFloat(fereinligmf);
	}
	// Reintegro a i G.M.F.
	
	// Subtotal egresos pagados a i
	var SubTEgrePagEm = document.getElementById('SubTEgrePagEm').value;
	var ferenlisan = document.getElementById('ferenlisan_').value;
	var feintsobsalmayvaltra = document.getElementById('feintsobsalmayvaltra_').value;
	
	
	suma = suma + parseFloat(SubTEgrePagEm) + parseFloat(servfactura) + parseFloat(ivaservfact) + parseFloat(servinven) + parseFloat(ivaservinven) + parseFloat(ferenlisan) + parseFloat(feintsobsalmayvaltra) + parseFloat(fereinligmf2);
	document.getElementById('SubTotalEgresosli').innerHTML = formatNumber(Math.round(suma),'');
	document.getElementById('subtotalegrespagli').value = suma;
	// Subtotal egresos pagados a i
	
	// Subtotal Egresos de Inversión
	var subtotegre = document.getElementById('subtotegre').value;
	var fetotinviniinf = document.getElementById('fetotinviniinf_').value;
	var feinvmodinver = document.getElementById('feinvmodinver_').value;
	var fevalanuinfalunav = document.getElementById('fevalanuinfalunav_').value;
	var fevalanufereven = document.getElementById('fevalanufereven_').value;
	//-----

	if(fetotinviniinf == '')
		fetotinviniinf = 0;
	
	var subtotalegresoinv = (parseFloat(subtotegre) + parseFloat(fetotinviniinf) + parseFloat(feinvmodinver) + parseFloat(fevalanuinfalunav) + parseFloat(fevalanufereven));

	document.getElementById('SubTotalEgresosInversion').innerHTML = formatNumber(Math.round(subtotalegresoinv),'');
	document.getElementById('subtotalegresoinv').value = subtotalegresoinv;
	// Subtotal Egresos de Inversión}
	
	
	
	// Imprevistos de Operacion y mantenimiento 4%
	// Subtotal egresos de O y M
	var fepublicidad = document.getElementById('fepublicidad_').value;
	var feseguros = document.getElementById('feseguros_').value;
	var fesistcalid = document.getElementById('fesistcalid_').value;
	var femanfueurb = document.getElementById('femanfueurb_').value;
	
	var feequofimant = document.getElementById('feequofimant_').value;
	var fesubconvehperope = document.getElementById('fesubconvehperope_').value;
	var podarbtotal = document.getElementById('podarbtotal').value; // Poda 1
	var minpodarbtotal = document.getElementById('minpodarbtotal').value; // min Poda 1
	var fetermografias = document.getElementById('fetermografias_').value;
	var femancehsupopepro = document.getElementById('femancehsupopepro_').value;
	var fepersoadmin = document.getElementById('fepersoadmin_').value;
	var feperopepro = document.getElementById('feperopepro_').value;
	var fegastadmin = document.getElementById('fegastadmin_').value;
	var feherramrepherrmen = document.getElementById('feherramrepherrmen_').value;
	var fematemantrepu = document.getElementById('fematemantrepu_').value;
	
	var fecontrinvensap = document.getElementById('fecontrinvensap_').value;
	
	
	if(podarbtotal == '')
		podarbtotal = 0;
	
	if(fepublicidad == '')
		fepublicidad = 0;
	
	var SubTotal_1 = parseFloat(feequofimant) + parseFloat(fesubconvehperope) + parseFloat(podarbtotal) + parseFloat(fetermografias) + parseFloat(femancehsupopepro) + parseFloat(fepersoadmin) + parseFloat(feperopepro) + parseFloat(fegastadmin) + parseFloat(feherramrepherrmen) + parseFloat(fematemantrepu);
	var ImpreOperMant = ((parseFloat(SubTotal_1) - parseFloat(minpodarbtotal)) * 4) / 100;
	
	document.getElementById('ImpreOperMant').innerHTML = formatNumber(Math.round(ImpreOperMant),'');

	if(fesistcalid == '')
		fesistcalid = '0';
	
	var SubTotEgreOM = parseFloat(SubTotal_1) + parseFloat(ImpreOperMant) + parseFloat(fecontrinvensap) + parseFloat(femanfueurb) + parseFloat(fepublicidad) + parseFloat(feseguros) + parseFloat(fesistcalid);	
	document.getElementById('SubTotEgreOM').innerHTML = formatNumber(Math.round(SubTotEgreOM),'');
	document.getElementById('subtotalegresosom').value = SubTotEgreOM;
	//-------------------------------
	
	
	
	//-----------------------------
	
	//-----
	var feinterpagpres = document.getElementById('feinterpagpres_').value;
	var feabonocappres = document.getElementById('feabonocappres_').value;

	var SubTotEgreFinan = parseFloat(feinterpagpres) + parseFloat(feabonocappres);
	
	document.getElementById('SubTotEgreFinan').innerHTML = formatNumber(Math.round(SubTotEgreFinan),'');
	document.getElementById('subtotegrefinan').value = SubTotEgreFinan;
	//-----
	//-----
	var feimpuesindcomer = document.getElementById('feimpuesindcomer_').value;
	var feimpuesseguri = document.getElementById('feimpuesseguri_').value;
	var feimpuesrenta = document.getElementById('feimpuesrenta_').value;

	var SubTotEgreImpu = parseFloat(feimpuesindcomer) + parseFloat(feimpuesseguri) + parseFloat(feimpuesrenta);
	document.getElementById('SubTotEgreImpu').innerHTML = formatNumber(Math.round(SubTotEgreImpu),'');
	document.getElementById('subtotegreimpu').value = SubTotEgreImpu;
	//-----
	//-----
	var feimpsobtrabanc = document.getElementById('feimpsobtrabanc_').value;
	var feadmfiduinclaudiext = document.getElementById('feadmfiduinclaudiext_').value;

	var SubTotEgrePagOtro = parseFloat(feimpsobtrabanc) + parseFloat(feadmfiduinclaudiext);
	document.getElementById('SubTotEgrePagOtro').innerHTML = formatNumber(Math.round(SubTotEgrePagOtro),'');
	document.getElementById('subtotegrepagotro').value = SubTotEgrePagOtro;
	//-----
	
	
	
	
	
	// Subtotal egresos pagados a Mega
	suma = parseFloat(subtotalegresoinv) + parseFloat(SubTotEgreOM) + parseFloat(SubTotEgreImpu) + parseFloat(SubTotEgreFinan);
	document.getElementById('SubTotalEgrePagMega').innerHTML = formatNumber(Math.round(suma),'');
	// Subtotal egresos pagados a Mega
	
	// Total Egresos
	var subtotalegrespagli = document.getElementById('subtotalegrespagli').value;

	suma = suma + parseFloat(subtotalegrespagli) + parseFloat(SubTotEgrePagOtro);
	document.getElementById('TotalEgresos').innerHTML = formatNumber(Math.round(suma),'');
	// Total Egresos
	
	// INGRESOS TOTALES MENOS EGRESOS TOTALES
	suma = parseFloat(t_ingreso) - suma; 
	document.getElementById('TotalIngresosEgresos').innerHTML = formatNumber(Math.round(suma),'');
	// INGRESOS TOTALES MENOS EGRESOS TOTALES
	
	// SALDO EN CAJA
	var fepaginvpresta = document.getElementById('fepaginvpresta_').value;
	var fepaginvprestb = document.getElementById('fepaginvprestb_').value;
	var fesaldocaja = document.getElementById('fesaldocaja_').value;
	
	if(fesaldocaja == '')
		fesaldocaja = 0;
	
	suma = (parseFloat(fesaldocaja) + suma) - (parseFloat(fepaginvprestb) + parseFloat(fepaginvpresta));

	document.getElementById('SaldoCaja').innerHTML = formatNumber(Math.round(suma),'');
	document.getElementById('fesaldocaja').value = formatNumber(Math.round(suma),'');
	document.getElementById('fesaldocajan_').value = suma;
}
