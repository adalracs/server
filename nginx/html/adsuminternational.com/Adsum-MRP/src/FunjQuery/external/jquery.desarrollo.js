$(function(){
//Campos Formulario
	$("#tabitems").tabs({});
	
	//ObjSeleccion
	$( "#tintas_especiales_para" ).buttonset();
	$( "#otros_productos" ).buttonset();
		
		$('#ingr_apli_tinta').button().click(function() {
		var calibre = document.getElementById('apli_tinta_mt2');
		var arrtabla2 = document.getElementById('arrtabla2');
		var arr = document.getElementById('arrtabla2').value.split(':|:');
		
		if(Number(calibre.value) > 0)
		{
			var newRow = ((arr.length) + 1);
			newRow = newRow + ':-:' + '25:-:1:-:' + calibre.value + ':-:f';
			
			var enc = validaTinta();
			if(enc != true)
			{
				(arrtabla2.value) ? arrtabla2.value = arrtabla2.value + ':|:' +  newRow : arrtabla2.value = newRow; 
			}
			else
			{
				reemplazaTinta(newRow);
			}
			accionReloadListEstructura();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Error: Debe de ingresar cantidad de tinta a ingresar...';
			$("#msgwindow").dialog("open");
		}
		
		calibre.value = '';
		return false;
	});
	
	$('#ingr_apli_adhe').button().click(function() {
		var desempenio = document.getElementById('desempenio');
		var tipo = document.getElementById('tipo');
		var calibre = document.getElementById('apli_adhe_mt2');
		var estructura = document.getElementById('tipo_estruc');
		var arrtabla2 = document.getElementById('arrtabla2');
		var arr = document.getElementById('arrtabla2').value.split(':|:');
		var err = '';
		
		if(desempenio.value == '')
			err = err + 'Advertencia: Debe ingresar desempe&ntilde;o <br>';
		
		if(tipo.value == '')
			err = err + 'Advertencia: Debe ingresar tipo <br>';
		
		if(Number(calibre.value) <= 0)
			err = err + 'Advertencia: Debe de ingresar cantidad de adhesivo... <br>';
		
		if(err == '')
		{
			var newRow = ((arr.length) + 1);
			newRow = newRow + ':-:' + '23:-:1:-:' + calibre.value + ':-:f,' + desempenio.value + ',' + tipo.value;
			var enc = validaAdhesivo();
			
			if(enc > 0)
			{
				(arrtabla2.value) ? arrtabla2.value = arrtabla2.value + ':|:' +  newRow : arrtabla2.value = newRow; 
			}
			else
			{
				document.getElementById('msg').innerHTML = 'Advertencia: Estructura ' + estructura.value + ' excedi&oacute; adhesivos';
				$("#msgwindow").dialog("open");
			}
			accionReloadListEstructura();
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		
		desempenio.value = '';
		tipo.value = '';
		calibre.value = '';
		return false;
	});
	
	$('#quitar_apli_adhe').button().click(function() {
		accionReloadListEstructura();
		return false;
	});
	
	$("#itedesnombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/desarrollo/jquery.atcmaterialdesa.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('itedescodigo').value = ui.item.id;
				document.getElementById('itedesslip').value = ui.item.slip;
				document.getElementById('itedesantibl').value = ui.item.antiblock;
				document.getElementById('itedescosto').value = ui.item.costo;
			}
			else
			{
				document.getElementById('itedescodigo').value = "";
				document.getElementById('itedesnombre').value = "";
				document.getElementById('itedescodigo').value = "";
				document.getElementById('itedesslip').value = "";
				document.getElementById('itedesantibl').value = "";
				document.getElementById('itedescosto').value = "";
			}
		}
	});
	
	
	$("#formulnumero").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/desarrollo/jquery.atcformulacion.php",
		minLength: 0,
		select: function(event, ui) {
		if(ui.item)
		{
			document.getElementById('formulcodigo').value = ui.item.id;
		}
		else
		{
			document.getElementById('formulcodigo').value = "";
			document.getElementById('formulnumero').value = "";
		}
	}
	});
	
	/**
	 * Boton Ingresar Insumo/item
	 */
	$('#ingresaritem').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
		
		var a = document.getElementById('formulcapaa');
		var b = document.getElementById('formulcapab');
		var c = document.getElementById('formulcapac');
		var capa = document.getElementById('capa');
		var item = document.getElementById('itedescodigo');
		var itempor = document.getElementById('itempor');
		var itemnombre = document.getElementById('itedesnombre');
		var itemslip = document.getElementById('itedesslip');
		var itemantibl = document.getElementById('itedesantibl');
		var itemcosto = document.getElementById('itedescosto');
		var arrformulacion = document.getElementById('arrformulacion');
		var arr = document.getElementById('arrformulacion').value.split(':|:');
		var err = '';
		
		if(Number(a.value) <= 0 || isNaN(Number(a.value)))
			err = err + 'Advertencia: Debe ingresar % de capa A...<br>';
		
		if(Number(b.value) <= 0 || isNaN(Number(b.value)))
			err = err + 'Advertencia: Debe ingresar % de capa B...<br>';
		
		if(Number(c.value) <= 0 || isNaN(Number(c.value)))
			err = err + 'Advertencia: Debe ingresar % de capa C...<br>';
		
		if(capa.value == '')
			err = err + 'Advertencia: Debe seleccionar capa...<br>';
		
		if(item.value == '' || itemnombre.value == '' || itemslip.value == '' || itemantibl.value == '' || itemcosto == '')
			err = err + 'Advertencia: Debe ingresar item...<br>';
		
		if(Number(itempor.value) <= 0 || isNaN(Number(itempor.value)))
			err = err + 'Advertencia: Debe ingresar % de item...<br>';
		
		if(err == '')
		{
			
			if(validaMaterial(capa,Number(itempor.value)) == true)
			{
				if(encuentraMaterial(item.value,capa.value) == false)
				{
					var newRow = item.value + ':-:' +  capa.value + ':-:' + itempor.value + ':-:' + itemslip.value + ':-:' + itemantibl.value + ':-:' + itemcosto.value;
					(arrformulacion.value) ? arrformulacion.value = arrformulacion.value + ':|:' +  newRow : arrformulacion.value = newRow; 
					organizarFormulacion();
					validaPorcentaje();
					accionReloadListFormulacion();
				}
				else
				{
					document.getElementById('msg').innerHTML = 'Advertencia: material ya se encuentra ingresado en capa ' + capa.value + '...<br>';
					$("#msgwindow").dialog("open");
				}
					
			}
			else
			{
				document.getElementById('msg').innerHTML = 'Advertencia: superado los porcentajes de materiales en capa ' + capa.value + '...<br>';
				$("#msgwindow").dialog("open");
			}
				
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		
		capa.value = '';
		item.value = '';
		itempor.value = '';
		itemnombre.value = '';
		itemslip.value = '';
		itemantibl.value = '';
			
		return false;
	});
	
	$('#quitaritem').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		organizarFormulacion();
		validaPorcentaje();
		accionReloadListFormulacion();
		return false;
	});

	$('#ingresarformul').button({ icons: { primary: "ui-icon-circle-plus" }}).click(function() {
		var arrformulacion2 = document.getElementById('arrformulacion2');
		var formulacion = document.getElementById('formulcodigo');
		var err = '';
		
		if(formulacion.value == '')
			err = err + 'Advertencia: Debe ingresar formulacion...<br>';
		
		if(err == '')
		{
			arrformulacion2.value = formulacion.value;
			accionReloadListFormulacion2();
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		
		return false;
	});
	
	
	$('#verOmologacion').button({ icons: { primary: "ui-icon-clipboard" }}).click(function() {
		var obj_formulpadre = document.getElementById('formulpadre');
		var formulpadre = (obj_formulpadre.value)? obj_formulpadre.value : 'empty' ;
		
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.phpscripts/jquery.omologaciones.php", 	
			data: 'formulpadre=' + formulpadre,
			beforeSend: function(data){ },        
			success: function(requestData){
				if(requestData != '')
				{
					document.getElementById('msg-formu').innerHTML = requestData;
				}
			},         
			error: function(requestData, strError, strTipoError){ },
			complete: function(requestData, exito){ }                                      
		});
		
		$( "#msgwindow-formu" ).dialog( "option", "resizable", false );
		$( "msgwindow-formu" ).dialog( "option", "height", "auto" );
		$("#msgwindow-formu").dialog("open");
		
		return false;
	});
	
	
});

/**
 * @param value
 * @return
 */
function eventOcultaTratamiento(value)
{
	if(value == 'no')
	{
		document.getElementById('plano_tratadot').style.display = 'none';
		document.getElementById('plano_trataobj').style.display = 'none';
		document.getElementById('nrocara_tratat').style.display = 'none';
		document.getElementById('nrocara_trataobj').style.display = 'none';
		document.getElementById('trata_min_lb').style.display = 'none';
		document.getElementById('trata_min_obj').style.display = 'none';
		document.getElementById('trata_max_lb').style.display = 'none';
		document.getElementById('trata_max_obj').style.display = 'none';
		document.getElementById('lado_trata_lb').style.display = 'none';
		document.getElementById('lado_trata_obj').style.display = 'none';
	}
	if(value == 'si')
	{
		document.getElementById('plano_tratadot').style.display = 'block';
		document.getElementById('plano_trataobj').style.display = 'block';
		document.getElementById('nrocara_tratat').style.display = 'block';
		document.getElementById('nrocara_trataobj').style.display = 'block';
		document.getElementById('trata_min_lb').style.display = 'block';
		document.getElementById('trata_min_obj').style.display = 'block';
		document.getElementById('trata_max_lb').style.display = 'block';
		document.getElementById('trata_max_obj').style.display = 'block';
		document.getElementById('lado_trata_lb').style.display = 'block';
		document.getElementById('lado_trata_obj').style.display = 'block';
	}
}

/**
 * @param value
 * @return
 */
function eventOcultaMaterialsellable(value,index)
{
	var producto = document.getElementById('tipitecodigo');
	
//	if(producto.value != 6)
//		return false;
		
	if(value == 'no')
	{
		document.getElementById('ncara_sellable_lb_' + index).style.display = 'none';
		document.getElementById('ncara_sellable_obj_' + index).style.display = 'none';
	}
	if(value == 'si')
	{
		document.getElementById('ncara_sellable_lb_' + index).style.display = 'block';
		document.getElementById('ncara_sellable_obj_' + index).style.display = 'block';
	}
}

/**
 * @param value
 * @return
 */
function eventFormulacion()
{
	var a = document.getElementById('formulcapaa');
	var b = document.getElementById('formulcapab');
	var c = document.getElementById('formulcapac');
	
	if((Number(a.value) + Number(b.value) + Number(c.value)) > 100)
	{
		document.getElementById('msg').innerHTML = 'Advertencia: superado los porcentajes de las capas...';
		$("#msgwindow").dialog("open");
		a.value = '';
		b.value = '';
		c.value = '';
	}
}

function accionReloadListEstructura()
{
	var addparamet = '';
	var arrObjs = document.getElementById('arrtabla2').value.split(':|:');
	var arr;
	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.tabla2.php", 	
		data: 'arrtabla2=' + document.getElementById('arrtabla2').value + addparamet + '&tipo_estruc=' + document.getElementById('tipo_estruc').value,
		beforeSend: function(data){ },        
		success: function(requestData){
			if(requestData != '')
			{
				document.getElementById('filtrlistaestructura').innerHTML = requestData;
				document.getElementById('filtrlistaestructura2').innerHTML = requestData;
				eventPesomillar();
			}
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
	
}


function validaTinta()
{
	var arrObjs = document.getElementById('arrtabla2').value.split(':|:');
	var arr;
	var enc = false;
	
	for(var i=0;i < arrObjs.length;i++)
	{
		var arr = arrObjs[i].split(':-:');
		if(arr[1] == 25)
			enc = true;
	}
	
	return enc;
}

function validaAdhesivo()
{
	var estructura = document.getElementById('tipo_estruc');
	var arrObjs = document.getElementById('arrtabla2').value.split(':|:');
	var arrtabla2 = document.getElementById('arrtabla2');
	var adh = 0;

	if(estructura.value == 'monocapa')
		var adhesivo = 0;
	
	if(estructura.value == 'bilaminado')
		var adhesivo = 1;
	
	if(estructura.value == 'trilaminado')
		var adhesivo = 2;
	
	if(estructura.value == 'tetralaminado')
		var adhesivo = 3;
	
	if(estructura.value == 'multilaminado')
		var adhesivo = 4;
	
	if(!estructura.value)
		var adhesivo = 0;
	
	for(var i=0;i < arrObjs.length;i++)
	{
		var arr = arrObjs[i].split(':-:');
		if(arr[1] == '23')
			adh = adh + 1;
	}
	
	return (adhesivo - adh);
}

function reemplazaTinta(arrnew)
{
	var arrObjs = document.getElementById('arrtabla2').value.split(':|:');
	var arrtabla2 = document.getElementById('arrtabla2');
	var arrtabla;
	for(var i=0;i < arrObjs.length;i++)
	{
		var arr = arrObjs[i].split(':-:');
		if(arr[1] == 25)
			arrtabla = (arrtabla)? arrtabla + ':|:' + arrnew : arrnew;
		else
			arrtabla = (arrtabla)? arrtabla + ':|:' + arrObjs[i] : arrObjs[i];
	}
	
	arrtabla2.value = arrtabla;
}

function eventPesomillar()
{
	var ancho = (document.getElementById('ancho') != null) ? document.getElementById('ancho').value : 0; 
	var largo = (document.getElementById('largo') != null) ? document.getElementById('largo').value : 0; 
	var fuelle = (document.getElementById('fuelle') != null) ? document.getElementById('fuelle').value : 0; 
	var solapa = (document.getElementById('solopa') != null) ? document.getElementById('solopa').value : 0;
	var totalgramaje = document.getElementById('totalgramaje').value;
	
	
	if(ancho == "") ancho = 0;
	if(largo == "") largo = 0;
	if(fuelle == "") fuelle = 0;
	if(solapa == "") solapa = 0;
	
	suma = [(parseFloat(solapa) / 1000) + (parseFloat(largo) / 1000 * 2) + (parseFloat(solapa) / 1000 * 2) + (parseFloat(fuelle) / 1000 * 2)] * [(parseFloat(ancho) / 1000) * parseFloat(totalgramaje)];
	
	document.getElementById('pesomillar').innerHTML = Math.round(suma * 100) / 100;
}

function accionReloadListFormulacion()
{	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.formulacion.php", 	
		data: 'arrformulacion=' + document.getElementById('arrformulacion').value ,
		beforeSend: function(data){ },        
		success: function(requestData){
			if(requestData != '')
			{
				document.getElementById('filtrlistaformulacion').innerHTML = requestData;
			}
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
}

function accionReloadListFormulacion2()
{	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.formulacion2.php", 	
		data: 'arrformulacion2=' + document.getElementById('arrformulacion2').value ,
		beforeSend: function(data){ },        
		success: function(requestData){
			if(requestData != '')
			{
				document.getElementById('filtrlistaformulacion2').innerHTML = requestData;
			}
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
}

function organizarFormulacion ()
{
	var arrObjs = document.getElementById('arrformulacion').value.split(':|:');
	var arrformulacion = document.getElementById('arrformulacion');
	var arrtabla;
	var arrtablaA;
	var arrtablaB;
	var arrtablaC;
	
	for(var i=0;i < arrObjs.length;i++)
	{
		var arr = arrObjs[i].split(':-:');
		var arrnew = arr[0] + ':-:' + arr[1] + ':-:' + arr[2] + ':-:' + arr[3] + ':-:' + arr[4] + ':-:' + arr[5];
		
		if(arr[1] == 'A')
			arrtablaA = (arrtablaA)? arrtablaA + ':|:' + arrnew : arrnew;
		else if (arr[1] == 'B')
			arrtablaB = (arrtablaB)? arrtablaB + ':|:' + arrnew : arrnew;
		else
			arrtablaC = (arrtablaC)? arrtablaC + ':|:' + arrnew : arrnew;
	}
	
	if(arrtablaA)
		arrtabla = arrtablaA;
	
	if(arrtablaB)
		arrtabla = (arrtabla)? arrtabla + ':|:' + arrtablaB : arrtablaB;
	
	if(arrtablaC)
		arrtabla = (arrtabla)? arrtabla + ':|:' + arrtablaC : arrtablaC;
	
	arrformulacion.value = arrtabla;
}

function validaPorcentaje ()
{
	var arrObjs = document.getElementById('arrformulacion').value.split(':|:');
	var a_lb = document.getElementById('capaa');
	var slip_a_lb = document.getElementById('slip_capaa');
	var antibl_a_lb = document.getElementById('antiblock_capaa');
	var b_lb = document.getElementById('capab');
	var slip_b_lb = document.getElementById('slip_capab');
	var antibl_b_lb = document.getElementById('antiblock_capab');
	var c_lb = document.getElementById('capac');
	var slip_c_lb = document.getElementById('slip_capac');
	var antibl_c_lb = document.getElementById('antiblock_capac');
	var obj_slip = document.getElementById('slip');
	var obj_antiblock = document.getElementById('antiblock');
	var obj_costo = document.getElementById('costo');
	var obj_capaa = document.getElementById('formulcapaa');
	var obj_capab = document.getElementById('formulcapab');
	var obj_capac = document.getElementById('formulcapac');
	var capaa = 0;
	var slip_capaa = 0;
	var antibl_capaa = 0;
	var capab = 0;
	var slip_capab = 0;
	var antibl_capab = 0;
	var capac = 0;
	var slip_capac = 0;
	var antibl_capac = 0;
	var slip = 0;
	var antiblock = 0;
	var costo = 0;
	
	for(var i=0;i < arrObjs.length;i++)
	{
		var arr = arrObjs[i].split(':-:');
		
		switch (arr[1])
		{
			case 'A':
				capaa = capaa + Number(arr[2]);
				slip_capaa = slip_capaa + ( ( Number(arr[3]) ) * ( Number(arr[2]) / 100 ) );
				antibl_capaa = antibl_capaa + ( ( Number(arr[4]) ) * ( Number(arr[2]) / 100 ) );
				costo = costo + ( ( ( Number(obj_capaa.value) / 100 ) * ( Number(arr[2]) / 100 ) )  *   Number(arr[5]));
				break;
			case 'B':
				capab = capab + Number(arr[2]);
				slip_capab = slip_capab + ( ( Number(arr[3]) ) * ( Number(arr[2]) / 100 ) );
				antibl_capab = antibl_capab + ( ( Number(arr[4]) ) * ( Number(arr[2]) / 100 ) );
				costo = costo + ( ( ( Number(obj_capab.value) / 100 ) * ( Number(arr[2]) / 100 ) )  *   Number(arr[5]));
				break;
			case 'C':
				capac = capac + Number(arr[2]);
				slip_capac = slip_capac + ( ( Number(arr[3]) ) * ( Number(arr[2]) / 100 ) );
				antibl_capac = antibl_capac + ( ( Number(arr[4]) ) * ( Number(arr[2]) / 100 ) );
				costo = costo + ( ( ( Number(obj_capac.value) / 100 ) * ( Number(arr[2]) / 100 ) )  *   Number(arr[5]));
				break;
		}
		
	}
	
	a_lb.innerHTML = capaa;
	slip_a_lb.innerHTML = slip_capaa;
	antibl_a_lb.innerHTML = antibl_capaa;
	b_lb.innerHTML = capab;
	slip_b_lb.innerHTML = slip_capab;
	antibl_b_lb.innerHTML = antibl_capab;
	c_lb.innerHTML = capac;
	slip_c_lb.innerHTML = slip_capac;
	antibl_c_lb.innerHTML = antibl_capac;
	
	slip = ( slip_capaa * ( Number( obj_capaa.value ) / 100 ) ) + ( slip_capab * ( Number( obj_capab.value ) / 100 ) ) + ( slip_capac * ( Number( obj_capac.value ) / 100 ) );
	antiblock = ( antibl_capaa * ( Number( obj_capaa.value ) / 100 ) ) + ( antibl_capab * ( Number( obj_capab.value ) / 100 ) ) + ( antibl_capac * ( Number( obj_capac.value ) / 100 ) );
	
	obj_slip.innerHTML = Math.round(slip * 100) / 100;
	obj_antiblock.innerHTML = Math.round(antiblock * 100) / 100;
	obj_costo.innerHTML = Math.round(costo * 100) / 100;
}

function validaMaterial(c,valor)
{
	var capa = Number(document.getElementById('capa' + c.value.toLowerCase()).innerHTML);
	
	if((capa + valor) > 100)
	{
		return false;
	}
	else
	{
		return true;
	}
	
}

function encuentraMaterial (item,capa)
{
	var arrObjs = document.getElementById('arrformulacion').value.split(':|:');
	var enc = false;
	
	for(var i=0;i < arrObjs.length;i++)
	{
		var arr = arrObjs[i].split(':-:');
		var arrnew = arr[0] + ':-:' + arr[1] + ':-:' + arr[2];
		
		if(arr[1] == capa && arr[0] == item)
			enc =  true;
			
	}
	
	return enc;
}

function validaProduc_lam (valor,indice)
{
	//objetos a utilizar
	var obj_valid_produc_imp = document.getElementById('valid_produc_imp');
	
	//valor de objetos
	var valid_produc_imp = (obj_valid_produc_imp.value)? obj_valid_produc_imp.value : '' ;
	var enc = false;
	
	for(var i=0;i < valid_produc_imp;i++)
	{
		//objetos a utilizar
		var obj_productlam = document.getElementById('product_lam_' + (i +1));
		//valor de objetos
		var productlam = (obj_productlam.value)? obj_productlam.value : '' ;
		if((i + 1) != indice && productlam == valor)
			enc = true;
	}
	
	if(enc == true)
	{
		document.getElementById('product_lam_' + indice).value = '';
		document.getElementById('msg').innerHTML = 'Advertencia : *** Material seleccionado ya esta en uso.';
		$("#msgwindow").dialog("open");
	}
}

function autoformulacion(index)
{
	$("#formulnumero_" + index).autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/desarrollo/jquery.atcformulacion.php",
		minLength: 0,
		select: function(event, ui) {
		if(ui.item)
		{
			document.getElementById('formulcodigo_' + index).value = ui.item.id;
		}
		else
		{
			document.getElementById('formulcodigo_' + index).value = "";
			document.getElementById('formulnumero_' + index).value = "";
		}
	}
	});
	
}

function openFormulacion(index)
{
	
	var objformulcodigo = document.getElementById('formulcodigo_' + index);
	var formulcodigo = (objformulcodigo.value)? objformulcodigo.value : 0 ;
	var err = '';
	
	if(formulcodigo <= 0)
		err = err + 'Advertencia : Debe seleccionar formulacion.';
	
	if(err == '')
	{
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.visors/jquery.formulacion2.php", 	
			data: 'arrformulacion2=' + formulcodigo,
			beforeSend: function(data){ },        
			success: function(requestData){
				if(requestData != '')
				{
					document.getElementById('msg').innerHTML = requestData;
				}
			},         
			error: function(requestData, strError, strTipoError){ },
			complete: function(requestData, exito)
			{}                                      
		});
		//getter
		var height = $( "#msgwindow" ).dialog( "option", "height" );
		var width = $( "#msgwindow" ).dialog( "option", "width" );
		//setter
		$( "#msgwindow" ).dialog( "option", "height", 300 );
		$( "#msgwindow" ).dialog( "option", "width", 828 );
		$( "#msgwindow" ).dialog( "option", "resizable", false );
		$("#msgwindow").dialog("open");
	}
	else
	{
		document.getElementById('msg').innerHTML = err;
		$("#msgwindow").dialog("open");
	}
}
