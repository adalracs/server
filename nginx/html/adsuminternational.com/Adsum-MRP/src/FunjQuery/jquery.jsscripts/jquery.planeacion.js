$(function(){
//Campos Formulario

	scanAlarma();

	$("#tabitems").tabs({});
	
	$('.tiptip').qtip({
	      content: {
	         text: false // Use each elements title attribute
	      },
	      style: 'cream' // Give it some style
	   });
	
	/**
	 * Boton Ingresar ruta item estandar
	 */
	$('#ingresaritem_est').button().click(function() {
		var arrruta = document.getElementById('rutaitem_est');
		var item = document.getElementById('r_item_est');

		if(item.value)
		{
			if(arrruta.value)
			{
				var arr = arrruta.value.split(",");
				var enc = false;
			}
			
			if(enc != true)
				(arrruta.value) ? arrruta.value = arrruta.value + ',' +  item.value : arrruta.value = item.value; 

			accionReloadListRutaitem_est();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Error: Debe digitar el ruta de item estandar...';
			$("#msgwindow").dialog("open");
		}
		
		document.getElementById('r_item_est').value = '';
		
		return false;
	});

	/**
	 * Boton Quitar ruta item estandar
	 */
	$('#quitaritem_est').button().click(function() {
		loadArraylistdelete('rutaitem_est', ',');
		accionReloadListRutaitem_est();
		return false;
	});
	
	/**
	 * Boton Ingresar ruta item pv
	 */
	$('#ingresaritem_pv').button().click(function() {
		//objetos a utilizar
		var obj_arrmatplan = document.getElementById('arrmatplan');
		var objs_arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value.split(",") : '' ;
		var obj_material = document.getElementById('material_ruta');
		var obj_ruta = document.getElementById('ruta');
		var obj_material_rep = document.getElementById('material_rep');
		//valor de los objetos
		var material = (obj_material)? obj_material.value : '' ;
		var ruta = (obj_ruta)? obj_ruta.value : '' ;
		var material_rep = (obj_material_rep)? obj_material_rep.value : '' ;
		
		var err = '' ;
		//validacion de error
		if(ruta == '')
			err = err + 'Advertencia : *** Debe seleccionar ruta.' + '<br>';
		
		if(material_rep == 'corte_r')
		{
			if(material == '')
				err = err + 'Advertencia : *** Debe seleccionar material.' + '<br>';
		}
		//validacion adicional de consumo
		//objeto adicional
		var objs_consumo = 'consumo_' + material;
		//objetos a utilizar
		var obj_consumo = document.getElementById(objs_consumo);
		//valor de los objetos
		var consumo = (obj_consumo)? obj_consumo.value : '' ;
		
		if(obj_consumo && consumo == '')
			err = err + 'Advertencia : *** Debe ingresar consumo en pesta&ntilde;a explosion de materiales.' + '<br>';
		
		//accion 
		if(err == '')
		{
			var newRow = ruta + ':-:' + material;
			if(material_rep == 'corte_r')
			{
				ajax_corte_r(material,newRow);
				$("#msgwindowform").dialog("open");
				$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() { EventCorteSecundario();} } ] });
				$("#msgwindowform").dialog( "option", "width", "auto" );
				$("#msgwindowform").dialog( "option", "height", "auto" );
				$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Corte Secundario]" );
				$("#msgwindowform").dialog("open");
			}
			else
			{
				loadArraylist(newRow,'arrrutaitem',':|:');
				accionReloadListRutaitem();
			}
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		//limpir objetos
		obj_material.value = '';
		obj_ruta.value = '';
		eventCorte_r('');
		return false;
	});

	/**
	 * Boton Quitar ruta item pv
	 */
	$('#quitaritem_pv').button().click(function() {
		loadArraylistdelete('arrrutaitem', ':|:');
		accionReloadListRutaitem();
		return false;
	});
	
	
	/**
	 * Boton Adicionar Materia prima pv
	 */
	$('#anxmaterial').button().click(function() {
		//objetos a utilzar
		var obj_idmaterial = document.getElementById('idmaterial');
		//valores 
		var idmaterial = (obj_idmaterial)? obj_idmaterial.value : '' ;
		var err = '';
		
		//validaciones 
		if(idmaterial == '')
			err = err + 'Advertencia : *** Debe seleccionar material.';
		
		//evento del boton
		if(err == '')
		{
			openPlaneacion(idmaterial);
			$("#msgwindowform").dialog("open");
			$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() { EventPlaneacionGMT();} } ] });
			$("#msgwindowform").dialog( "option", "width", "auto" );
			$("#msgwindowform").dialog( "option", "height", "auto" );
			$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Gestion Materia Prima]" );
			$("#msgwindowform").dialog("open");
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		//limpiar objetos
		obj_idmaterial.value = '' ;
		return false;
	});
	
	/**
	 * Boton Quitar Materia prima pv
	 */
	$('#retmaterial').button().click(function() {
		loadArraylistdelete1('arrrutaitem', ':|:', ':-:' ,'arrmatplan');//solo para este evento
		loadArraylistdelete('arrmatplan', ':|:');
		accionReloadListMat_Planeacion();
		accionReloadListRutaitem();
		return false;
	});
	
	//ventana de dialogo items
	$("#msgwindowform").dialog({
		autoOpen: false,
		modal: true,
		position: { my: "left top", at: "left top", of: window }
	});
	
});

function scanAlarma(){	

	$.ajax({	   
			dataType: "json",
			type: "POST",        
			url: "../src/FunjQuery/jquery.accionextras/jq.scanalarma.php", 	
			data: { 
				produccoduno: $("#produccoduno").val(), 
				modulocodigo : $("#modulocodigo").val(),
				ordcomcodcli : $("#ordcomcodcli").val(),
				windetallar : $("#windetallar").val()
			},
			beforeSend: function(data){ },        
			success: function(json_data){

				if(json_data.html){

					$("form").after( '<div id="msgwindow-alarma" title="Adsum Kallpa"><span id="msg-alarma"></span></div>' );

					$("#msgwindow-alarma").dialog({
						autoOpen: false,
						width: 550,
						modal: true,
						close: function(event, ui){

							if(json_data.redirect > 0){
								location = 'main.php';
							}
						},
						buttons: {
							"Ok": function() {							
								$(this).dialog("close"); 
							}
						}
					});

					$("#msgwindow-alarma").dialog("open");

					$("#msg-alarma").html( json_data.html );
				}

			},         
			error: function(requestData, strError, strTipoError){ },
			complete: function(requestData, exito){}                                      
		});
	
} 

/**
 * AJAX - Load or Reload list
 * @return
 */
function accionReloadListRutaitem_est()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.rutaitem_est.php", 	
		data: 'rutaitem_est=' + document.getElementById('rutaitem_est').value,
		beforeSend: function(data){ 
			//document.getElementById('filtrrutaitem_est').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las rutas.</img>';
			$('#filtrrutaitem_est').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las rutas.</img>'});
		},     
		success: function(requestData){
			if(requestData != '')
				document.getElementById('filtrrutaitem_est').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 
			$('#filtrrutaitem_est').block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){ 
			$('#filtrrutaitem_est').unblock();
		}                                      
	});
}

/**
 * accionReloadAjax_planeacion
 * AJAX - Load or Reload list
 * @return
 */
function accionReloadAjax_planeacion()
{
	eventTotalgramaje();
	//objetos a utilizar
	var obj_arrtabla2 = document.getElementById('arrtabla2');
	var obj_tipitecodigo = document.getElementById('tipitecodigo');
	var obj_totalgramaje = document.getElementById('totalgramaje');
	var obj_unimedi = document.getElementById('unimedi');
	var obj_cant_planea = document.getElementById('cant_planea');
	var obj_solapa = document.getElementById('solapa');
	var obj_traslape = document.getElementById('traslape');
	var obj_largo = document.getElementById('largo');
	var obj_fuelle = document.getElementById('fuelle');
	var obj_ancho = document.getElementById('ancho');
	var obj_bmayor = document.getElementById('bmayor');
	var obj_bmenor = document.getElementById('bmenor');
	var obj_pestania = document.getElementById('pestania');
	var obj_nropistas = document.getElementById('nropistas');
	var obj_product_imp = document.getElementById('product_imp');
	var obj_formulcodigo = document.getElementById('formulcodigo');
	var obj_valid_produc_imp = document.getElementById('valid_produc_imp');
	var objs_arrtabla2 = (obj_arrtabla2)? obj_arrtabla2.value.split(":|:") : '' ;
	
	//valor de los objetos
	var arrtabla2 = (obj_arrtabla2.value)? obj_arrtabla2.value : '' ;
	var tipitecodigo = (obj_tipitecodigo.value)? obj_tipitecodigo.value : '' ;
	var totalgramaje = (obj_totalgramaje.value)? obj_totalgramaje.value : '' ;
	var unimedi = (obj_unimedi.value)? obj_unimedi.value : '' ;
	var cantplanea = (obj_cant_planea.value)? obj_cant_planea.value : '' ;
	var solapa = (obj_solapa.value)? obj_solapa.value : '' ;
	var traslape = (obj_traslape.value)? obj_traslape.value : '' ;
	var largo = (obj_largo.value)? obj_largo.value : '' ;
	var fuelle = (obj_fuelle.value)? obj_fuelle.value : '' ;
	var ancho = (obj_ancho.value)? obj_ancho.value : '' ;
	var bmayor = (obj_bmayor.value)? obj_bmayor.value : '' ;
	var bmenor = (obj_bmenor.value)? obj_bmenor.value : '' ;
	var pestania = (obj_pestania.value)? obj_pestania.value : '' ;
	var nropistas = (obj_nropistas.value)? obj_nropistas.value : '' ;
	var product_imp = (obj_product_imp.value)? obj_product_imp.value : '' ;
	var formulcodigo = (obj_formulcodigo.value)? obj_formulcodigo.value : '' ;
	var valid_produc_imp = (obj_valid_produc_imp.value)? obj_valid_produc_imp.value : '' ;
			
	//parametros de envio 
	var parameters;
	parameters = (arrtabla2 != '')? 'arrtabla2=' + arrtabla2 : 'arrtabla2=';
	parameters += (tipitecodigo != '')? '&tipitecodigo=' + tipitecodigo : '&tipitecodigo=';
	parameters += (totalgramaje != '')? '&totalgramaje=' + totalgramaje : '&totalgramaje=';
	parameters += (unimedi != '')? '&unimedi=' + unimedi : '&unimedi=';
	parameters += (cantplanea != '')? '&cantplanea=' + cantplanea : '&cantplanea=';
	parameters += (solapa != '')? '&solapa=' + solapa : '&solapa=';
	parameters += (traslape != '')? '&traslape=' + traslape : '&traslape=';
	parameters += (largo != '')? '&largo=' + largo : '&largo=';
	parameters += (fuelle != '')? '&fuelle=' + fuelle : '&fuelle=';
	parameters += (ancho != '')? '&ancho=' + ancho : '&ancho=';
	parameters += (bmayor != '')? '&bmayor=' + bmayor : '&bmayor=';
	parameters += (bmenor != '')? '&bmenor=' + bmenor : '&bmenor=';
	parameters += (pestania != '')? '&pestania=' + pestania : '&pestania=';
	parameters += (/^([0-9])*$/.test(nropistas))? '&nropistas=' + nropistas : '&nropistas=';
	parameters += (product_imp)? '&product_imp=' + product_imp : '&product_imp=';
	parameters += (formulcodigo != '')? '&formulcodigo=' + formulcodigo : '&formulcodigo=';
	parameters += (valid_produc_imp != '')? '&valid_produc_imp=' + valid_produc_imp : '&valid_produc_imp=';
	
	//parametros adicionales
	
	for(i = 0 ; i < valid_produc_imp ; i ++)
	{
		//variables de objetos adicionales
		var objs_produclam = 'product_lam_' + (i + 1);
		//objetos segun variables adicionales
		var obj_produclam = document.getElementById(objs_produclam);
		//valor del objetos
		var produclam = (obj_produclam)? obj_produclam.value : '' ;
		//parametros adicinal
		parameters += (produclam != '')? '&' + objs_produclam + '=' + produclam : '&' + objs_produclam + '=';
		
	}
	
	for(i = 0;i < objs_arrtabla2.length ; i ++)
	{
		var row_arrtabla = objs_arrtabla2[i].split(":-:");
		//variables de objetos adicionales
		var objs_calib_a1 = 'calib_a1_' + row_arrtabla[0] + '_' + row_arrtabla[1];
		var objs_refile_mm = 'refile_mm_' + row_arrtabla[0] + '_' + row_arrtabla[1];
		//objetos segun variables adicionales
		var obj_calib_a1 = document.getElementById(objs_calib_a1);
		var obj_refile_mm = document.getElementById(objs_refile_mm);
		//valor del objetos
		var calib_a1_ = (obj_calib_a1)? obj_calib_a1.value : '' ;
		var refile_mm_ = (obj_refile_mm)? obj_refile_mm.value : '' ;
		//validacion de numero entero
		var calib_a1 = (/^([0-9\,.])*$/.test(calib_a1_))? calib_a1_ : '' ; 
		var refile_mm = (/^([0-9\,.])*$/.test(refile_mm_))? refile_mm_ : '' ; 
		//parametros adicinal
		parameters += (calib_a1 != '')? '&' + objs_calib_a1 + '=' + calib_a1 : '&' + objs_calib_a1 + '=';
		parameters += (refile_mm != '')? '&' + objs_refile_mm + '=' + refile_mm : '&' + objs_refile_mm + '=';
	}
	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_planeacion.php", 	
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('filtrlistaplaneacion').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la explosion de materiales.</img>';
			$('#filtrlistaplaneacion').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga la explosion de materiales.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('filtrlistaplaneacion').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){
			$('#filtrlistaplaneacion').block({ theme : true , message : 'Error'});
		 },
		complete: function(requestData, exito){ 
			$('#filtrlistaplaneacion').unblock();
		}                                      
	});
}


/**
 * cargaCriterio
 * AJAX 
 * @return
 */

function cargaCriterio(codigo)
{
	
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_cargacriterio.php", 	
		data: 'critercodigo=' + codigo,
		beforeSend: function(data){ 
			$('#filtrlistaplaneacion').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga la explosion de materiales.</img>'});
		},        
		success: function(jSonData){
			if(jSonData != '')
				reloadCriterio(jSonData);
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
}


/**
 * adicionaCriterio
 * AJAX 
 * @return
 */

function reloadCriterio(Json)
{
	var porcen = (Json)? Json.criterporcen / 100 : '';
	//objetos a utilizar
	var valor = document.getElementById('cantsol');
	var cant = document.getElementById('cant_planea');
	var obj_criterio_val = document.getElementById('criterio_val');
	
	if(!porcen)
	{
		cant.value = parseInt(valor.value);
	}
	else
	{
		cant.value = parseInt(valor.value) + (valor.value * porcen);
		if(obj_criterio_val)
			obj_criterio_val.value = Json.criterporcen;
	}
	
	accionReloadAjax_planeacion();
	
}


/**
 * validaCantplaneada();
 * AJAX 
 * @return
 */

function validaCantplaneada(valor)
{
	//objetos a utilizar 
	var obj_cantsol = document.getElementById('cantsol');
	var obj_cant_planea = document.getElementById('cant_planea');
	var obj_criterio = document.getElementById('criterio');
	//valor de los objetos
	var cantsol = (obj_cantsol.value)? obj_cantsol.value : '' ;
	var cant_planea = (obj_cant_planea.value)? obj_cant_planea.value : '' ;
	var criterio = (obj_criterio.value)? obj_criterio.value : '' ;
	var err = '';
	//condicion de validacion
	if(!/^([0-9])*$/.test(valor))
		err = err + 'Advertencia : *** Debe digitar valores enteros.';
	
	//evento tras validacion
	if(err !='')
	{
		obj_cant_planea.value = cantsol;
		cargaCriterio(criterio);
		document.getElementById('msg').innerHTML = err;
		$("#msgwindow").dialog("open");
		return false;
	}
	
	accionReloadAjax_planeacion();
}


/**
 * evento para calcular rodillo de acuerdo a las pistas
 * y el tipo de producto
 * @return
 */

function eventRodillo(valor)
{
	//objetos a utilizar
	var obj_nrorepet = document.getElementById('nrorepet');
	var obj_rodillo = document.getElementById('rodillo');
	var obj_tipitecodigo = document.getElementById('tipitecodigo');
	//valor de los objetos
	var tipitecodigo = (/^([0-9])*$/.test(obj_tipitecodigo.value))? obj_tipitecodigo.value : 0 ;
	
	//validacion de error de digitacion
	if(!/^([0-9])*$/.test(valor))
	{
		obj_nrorepet.value = 0;
		document.getElementById('msg').innerHTML = 'Advertencia: *** Debe ingresar valor numerico en campo(Nro Repeticiones).';
		$("#msgwindow").dialog("open");
		return false;
	}
	
	//validacion de productos (lamina, bolsa flow pack)
	if(tipitecodigo > 0 && (tipitecodigo == 1 || tipitecodigo == 6))
	{
		//objetos a utilizar
		var obj_largo = document.getElementById('largo');
		//valor de los objetos
		var largo = (/^([0-9])*$/.test(obj_largo.value))? obj_largo.value : 0 ;
		//operacion a realizar
		obj_rodillo.value = largo * valor;
		return false;
	}
	
	//validacion de productos (bolsa doy pack, bolsa lateral, bolsa pouch lateral)
	if(tipitecodigo > 0 && (tipitecodigo == 2 || tipitecodigo == 3 || tipitecodigo == 4))
	{
		//objetos a utilizar
		var obj_ancho = document.getElementById('ancho');
		//valor de los objetos
		var ancho = (/^([0-9])*$/.test(obj_ancho.value))? obj_ancho.value : 0 ;
		//operacion a realizar
		obj_rodillo.value = ancho * valor;
		return false;
	}
	
	//validacion de productos (capuchon)
	if(tipitecodigo > 0 && (tipitecodigo == 5))
	{
		//objetos a utilizar
		var obj_bmayor = document.getElementById('bmayor');
		var obj_bmenor = document.getElementById('bmenor');
		//valor de los objetos
		var bmayor = (/^([0-9])*$/.test(obj_bmayor.value))? obj_bmayor.value : 0 ;
		var bmenor = (/^([0-9])*$/.test(obj_bmenor.value))? obj_bmenor.value : 0 ;
		//operacion a realizar
		obj_rodillo.value = (Number(bmayor) + Number(bmenor)) * valor;
		return false;
	}
	
}


/**
 * openPlaneacion
 * AJAX 
 * @return
 */

function openPlaneacion(data)
{
	ajaxItemsPlaneacion(data);
	$("#msgwindowform").dialog("open");
	return false;
}

function eventContinuo(valor)
{
	//objetos a utilizar
	var obj_rodillo = document.getElementById('rodillo');
	var obj_nrorepet = document.getElementById('nrorepet');
	var obj_nrorepet_lb = document.getElementById('nrorepet_lb');
	var obj_nrorepet_obj = document.getElementById('nrorepet_obj');
	//validacion de evento
	if(valor == 'si')
	{
		//accion del evento
		obj_nrorepet_lb.style.display = 'none';
		obj_nrorepet_obj.style.display = 'none';
	}
	
	if(valor == 'no')
	{
		//accion del evento
		obj_nrorepet_lb.style.display = 'block';
		obj_nrorepet_obj.style.display = 'block';
		obj_rodillo.value = '';
		eventRodillo(obj_nrorepet.value);
	}

}


function ajaxItemsPlaneacion(data)
{
	//objetos a utilizar
	var obj_arrmatplan = document.getElementById('arrmatplan');
	var obj_arrrutaitem = document.getElementById('arrrutaitem');
	//valor de los objetos
	var arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value : '' ;
	var arrrutaitem = (obj_arrrutaitem)? obj_arrrutaitem.value : '' ;
	var objs_arrmatplan = (arrmatplan)? arrmatplan.split(':|:') : '' ;
	var arrplan = '';
	var parameters = '';
	//parametros
	parameters = (data != '')? '&paditecodigo=' + data : '&paditecodigo=';
	parameters += (arrmatplan != '')? '&arrplan=' + arrplan : '&arrplan=';
	parameters += (arrrutaitem != '')? '&arrrutaitem=' + arrrutaitem : '&arrrutaitem=';

	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.planeacion.php",
		data: parameters,
		beforeSend: function(data){
			document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>';
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}

/**
 * AJAX - Load or Reload list
 * @return
 */
function accionReloadListMatplaneacion()
{
	//objetos a utilizar
	var obj_arrplan = document.getElementById('arrplan');
	var obj_arrmatplan = document.getElementById('arrmatplan');
	//valor de los objetos
	var arrplan = (obj_arrplan)? obj_arrplan.value : '' ;
	var arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value : '' ;
	var objs_arrmatplan = (arrmatplan)? arrmatplan.split(':|:') : '' ;
	//parametros
	var parameters = '';
	//parametros de objetos adicionales
	for(i=0;i<objs_arrmatplan.length;i++)
	{
		var rows_arrmatplan = objs_arrmatplan[i].split(':-:');		
		var objs_consumo = 'consumo_' + objs_arrmatplan[i];
		var obj_consumo = document.getElementById(objs_consumo);
		var consumo = (obj_consumo)? obj_consumo.value : '' ;
		(consumo != '')? parameters += '&' + objs_consumo + '=' + consumo : parameters += '&' + objs_consumo + '=';
	}
	
	parameters += (arrmatplan != '')? '&arrmatplan=' + arrmatplan : '&arrmatplan=';
	//evento ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.mat_planeacion.php", 	
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('listamateriales').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>';
			$('#listamateriales').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listamateriales').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 
			$('#listamateriales').block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){ 
			$('#listamateriales').unblock();
		}   
	});
	//parametro adicional
	parameters += (arrmatplan != '')? '&arrmatplan=' + arrmatplan : '&arrmatplan=' ;
	parameters += '&voption=1';
	//accion ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_selectruta.php", 	
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('material_ruta').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>';
			$('#material_ruta').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('material_ruta').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){
			$('#material_ruta').block({ theme : true , message : 'Error'});
		 },
		complete: function(requestData, exito){ 
			$('#material_ruta').unblock();
		}                                      
	});
}

/**
 * AJAX - Load or Reload list
 * @return
 */
function accionReloadListMat_Planeacion()
{
	//objetos a utilizar
	var obj_arrmatplan = document.getElementById('arrmatplan');
	var objs_arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value.split(':|:') : '' ;
	//valor de los objetos
	var arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value : '' ;
	//parametros
	var parameters;
	parameters = (arrmatplan != '')? 'arrmatplan=' + arrmatplan : 'arrmatplan=';
	
	//parametros de objetos adicionales
	for(i=0;i<objs_arrmatplan.length;i++)
	{
		//objeto adicional
		var objs_consumo = 'consumo_' + objs_arrmatplan[i];
		//objetos a utilizar
		var obj_consumo = document.getElementById(objs_consumo);
		//valor de los objetos
		var consumo = (obj_consumo)? obj_consumo.value : '' ;
		//parametros adicionales
		(consumo != '')? parameters += '&' + objs_consumo + '=' + consumo : parameters += '&' + objs_consumo + '=';
	}

	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.mat_planeacion.php", 	
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('listamateriales').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se cargan los materiales.</img>';
			$('#listamateriales').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras se cargan los materiales.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listamateriales').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 
			$('#listamateriales').block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){
			$('#listamateriales').unblock();
		 }                                      
	});
}

function ajax_corte_r(material,newRow)
{
	//parametros
	var parameters;
	parameters = (material != '')? 'material=' + material : 'material=';
	parameters += (newRow != '')? '&newRow=' + newRow : '&newRow=';
	
	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_corte_r.php",
		data: parameters,
		beforeSend: function(data){
			document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se carga el formulario.</img>';			
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}

function accionReloadListRutaitem()
{
	//objetos a utilizar
	var obj_arrrutaitem = document.getElementById('arrrutaitem');
	//valor de los objetos
	var arrrutaitem = (obj_arrrutaitem)? obj_arrrutaitem.value : '' ;
	var arrObjs = (obj_arrrutaitem)? obj_arrrutaitem.value.split(':|:') : '' ;
	//parametros de envio
	var parameters = "";
	parameters = (arrrutaitem != "")? "arrrutaitem=" + arrrutaitem : "arrrutaitem=";
	//parametros de objetos adicionales
	for(var i = 0;i < (arrObjs.length);i++)
	{
		var arr = arrObjs[i].split(":-:");
		//objetos adicional
		var objs_ancho = "ancho_" + arr[0];
		var objs_destino = "destino_" + arr[0];
		//valor a utilizar
		var obj_ancho = document.getElementById(objs_ancho);
		var obj_destino = document.getElementById(objs_destino);
		//valor de los objetos
		var ancho = (obj_ancho)? obj_ancho.value : "" ;
		var destino = (obj_destino)? obj_destino.value : "" ;
		//parametros adicionales
		parameters += (ancho != "")? "&" + objs_ancho + "=" + ancho : "&" + objs_ancho + "=";
		parameters += (destino != "")? "&" + objs_destino + "=" + destino : "&" + objs_destino + "=";
	}
	
	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.rutaitem.php", 	
		data: parameters ,
		beforeSend: function(data){ 
			//document.getElementById('filtrrutaitem').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se cargan las rutas.</img>';
			$('#filtrrutaitem').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras se cargan las rutas.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
			{
				document.getElementById('filtrrutaitem').innerHTML = requestData;
			}
		},         
		error: function(requestData, strError, strTipoError){ 
			$('#filtrrutaitem').block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){ 
			$('#filtrrutaitem').unblock();
		}                                      
	});
	
	
}

function eventAnchoc(obj_anchoc,material)
{	
	var anchoc = (obj_anchoc)? obj_anchoc.value : '' ;
	//validacion de error de digitacion
	if(!/^([0-9])*$/.test(anchoc))
	{
		obj_anchoc.value = '';
		document.getElementById('msg').innerHTML = 'Advertencia: *** Debe ingresar valor numerico en campo(Ancho de corte).';
		$("#msgwindow").dialog("open");
		return false;
	}
	
	//creacion de objetos a utilizar
	var objs_ancho = 'ancho_';
	var objs_consumo = 'consumo_' + material;
	var objs_diferencia_mm = 'diferencia_mm_';
	var lbs_diferencia_mm = 'lb_diferencia_mm_';
	var objs_diferencia_kg = 'diferencia_kg_';
	var lbs_diferencia_kg = 'lb_diferencia_kg_';
	//objetos a utilizar
	var obj_ancho = document.getElementById(objs_ancho);
	var obj_consumo = document.getElementById(objs_consumo);
	var obj_diferencia_mm = document.getElementById(objs_diferencia_mm);
	var lb_diferencia_mm = document.getElementById(lbs_diferencia_mm);
	var obj_diferencia_kg = document.getElementById(objs_diferencia_kg);
	var lb_diferencia_kg = document.getElementById(lbs_diferencia_kg);
	//valor de los objetos
	var ancho = (obj_ancho)? obj_ancho.value : '' ;
	var consumo = (obj_consumo)? obj_consumo.value : '' ;
	//resultados de formulas
	
	//diferencia en milimetros (mm) = ancho material - ancho corte
	var dif_mm = Number(ancho) - Number(anchoc);
	//diferencia en kilogramos (kgs) = (diferencia en milimetros / ancho material) * cantidad asignada
	var dif_kg = (dif_mm / Number(ancho)) * Number(consumo);
	
	//asignacion de valores
	if(obj_diferencia_mm) obj_diferencia_mm.value = dif_mm;
	if(lb_diferencia_mm) lb_diferencia_mm.innerHTML = dif_mm;
	if(obj_diferencia_kg) obj_diferencia_kg.value = dif_kg;
	if(lb_diferencia_kg) lb_diferencia_kg.innerHTML = Math.round(dif_kg * 100) / 100;
	return false;
}
//evento corte de reproceso
function eventCorte_r(valor)
{
	var obj_material_lb = document.getElementById('material_lb');
	var obj_material_obj = document.getElementById('material_obj');
	var obj_material_rep = document.getElementById('material_rep');
	//parametros de envio
	var parameters;
	parameters = (valor != '')? 'procedcodigo=' + valor : 'procedcodigo=';
	//jquery.ajax_validacorte_r.php
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_validacorte_r.php", 	
		data: parameters ,
		beforeSend: function(data){ },        
		success: function(json_data){
			if(json_data.bandera > 0)
			{
				obj_material_lb.style.display = 'block';
				obj_material_obj.style.display = 'block';
				if(obj_material_rep)
					obj_material_rep.value = 'corte_r';
			}
			else
			{
				obj_material_lb.style.display = 'none';
				obj_material_obj.style.display = 'none';
				if(obj_material_rep)
					obj_material_rep.value = '';
			}
		}                              
	});
	
}
//evento total gramaje estructura
function eventTotalgramaje()
{
	//objetos a utilizar
	var obj_arrtabla2 = document.getElementById('arrtabla2');
	var obj_totalgramaje = document.getElementById('totalgramaje');
	//valor de los obejtos y variables a utilizar
	var objs_arrtabla2 = (obj_arrtabla2)? obj_arrtabla2.value.split(":|:") : '' ;
	var arrtabla2 = (obj_arrtabla2)? obj_arrtabla2.value : '' ;
	var totalgramaje = 0;
	//accion del evento
	for(i = 0;i < objs_arrtabla2.length ; i ++)
	{
		var row_arrtabla = objs_arrtabla2[i].split(":-:");
		//variables de objetos adicionales
		var objs_calib_a1 = 'calib_a1_' + row_arrtabla[0] + '_' + row_arrtabla[1];
		//objetos segun variables adicionales
		var obj_calib_a1 = document.getElementById(objs_calib_a1);
		//valor del objetos
		var calib_a1_ = (obj_calib_a1)? obj_calib_a1.value : '' ;
		//validacion de numero entero
		var calib_a1 = (/^([0-9\,.])*$/.test(calib_a1_))? calib_a1_ : '' ;
		//variables
		var calibre = (calib_a1 == '')? row_arrtabla[3] : calib_a1 ;
		var densidad = row_arrtabla[2];
		totalgramaje = totalgramaje + (calibre * densidad);
	}
	//asignacion de la varible
	(obj_totalgramaje) ? obj_totalgramaje.value = totalgramaje : '' ;
}
//evento para planeacion gestion de materiales
function EventPlaneacionGMT()
{
	//objetos a usar
	var obj_arrplan = document.getElementById('arrplan');
	//valor de los objetos
	var arrplan = (obj_arrplan)? obj_arrplan.value : '' ;
	var objs_arrplan = (arrplan)? arrplan.split(',') : '' ;
	var err = '';
	for( i = 0; i < objs_arrplan.length; i++)
	{
		var objs_procedimiento = 'procedimiento_' + objs_arrplan[i];
		var obj_procedimiento = document.getElementById(objs_procedimiento);
		var procedimiento = (obj_procedimiento)? obj_procedimiento.value : '' ;
		if(procedimiento == '')
		{
			err = 'Advertencia : *** Debe Seleccionar proceso.';
			document.getElementById(objs_procedimiento).className = 'ui-state-highlight';
		}
	}
	
	if(err == '')
	{
		var obj_arrplan = document.getElementById('arrplan');
		var arrplan = (obj_arrplan)? obj_arrplan.value : '' ;
		var objs_arrplan = (arrplan)? arrplan.split(',') : '' ;
		var arrmatplan = '';
		
		for( i=0; i < objs_arrplan.length; i++){
			//objeto adicional
			var objs_procedimiento = "procedimiento_" + objs_arrplan[i];			
			//objetos 
			var obj_procedimiento = document.getElementById(objs_procedimiento);
			var obj_paditecodigo = document.getElementById("paditecodigo");
			//valor de los objetos
			var procedimiento = (obj_procedimiento)? obj_procedimiento.value : " " ;
			var paditecodigo = (obj_paditecodigo)? obj_paditecodigo.value : "";

			if(procedimiento && paditecodigo){
				arrmatplan = (arrmatplan)? arrmatplan + ":|:" + objs_arrplan[i] + ":-:" + procedimiento + ":-:" + paditecodigo : objs_arrplan[i] + ":-:" + procedimiento + ":-:" + paditecodigo;
			}

		}
		
		loadArraylist(arrmatplan,'arrmatplan',':|:');
		accionReloadListMatplaneacion();
		document.getElementById('msgform').innerHTML = '' ;
		$("#msgwindowform").dialog("close");
	}
	else
	{
		document.getElementById('mensaje').innerHTML = err;
		document.getElementById('mensaje').className = 'ui-state-highlight';
	}
}
//evento para corte secundario
function EventCorteSecundario()
{
	//objetos a utilizar
	var obj_newRow = document.getElementById('newRow');
	
	var obj_ancho = document.getElementById('ancho_');
	var obj_anchoc = document.getElementById('anchoc_');
	var obj_destino = document.getElementById('destino_');
	var obj_diferencia_mm = document.getElementById('diferencia_mm_');
	var obj_diferencia_kg = document.getElementById('diferencia_kg_');
	var obj_mensaje = document.getElementById('mensaje');
	//clases de inicio
	(obj_ancho)? obj_ancho.className = 'ui-widget input ui-corner-all' : '' ;
	(obj_anchoc)? obj_anchoc.className = 'ui-widget input ui-corner-all' : '' ;
	(obj_destino)? obj_destino.className = 'ui-widget input ui-corner-all' : '' ;
	//valor de los objetos
	var newRow = (obj_newRow)? obj_newRow.value : '' ;
	var ancho = (obj_ancho)? obj_ancho.value : '' ;
	var anchoc = (obj_anchoc)? obj_anchoc.value : '' ;
	var destino = (obj_destino)? obj_destino.value : '' ;
	var diferencia_mm = (obj_diferencia_mm)? obj_diferencia_mm.value : '' ;
	var diferencia_kg = (obj_diferencia_kg)? obj_diferencia_kg.value : '' ;
	//validacion de error
	var err = '';

	if(ancho == '' || ancho <= 0)
	{
		err = err + 'Advertencia : *** Ancho (mm) negativa o nula.' + '<br>';
		obj_ancho.className = 'ui-state-error ui-corner-all';
	}
	
	
	if(anchoc == '' || anchoc <= 0)
	{
		err = err + 'Advertencia : *** Debe ingresar ancho de corte.' + '<br>';
		obj_anchoc.className = 'ui-state-error ui-corner-all';
	}

	if(diferencia_mm == '' || diferencia_mm <= 0)
	{
		err = err + 'Advertencia : *** Diferencia (mm) negativa o nula.' + '<br>';
		obj_diferencia_mm.className = 'ui-state-error ui-corner-all';
	}

	if(diferencia_kg == '' || diferencia_kg <= 0)
	{
		err = err + 'Advertencia : *** Diferencia (kg) negativa o nula.' + '<br>';
		obj_diferencia_kg.className = 'ui-state-error ui-corner-all';
	}
	
	if(destino == '')
	{
		err = err + 'Advertencia : *** Debe seleccioner destino.' + '<br>';
		obj_destino.className = 'ui-state-error ui-corner-all';
	}
	
	if(newRow == '')
	{
		err = err + 'Advertencia : *** Error inesperado.' + '<br>';
	}
	
	if(err == '')
	{
		newRow += ':-:' + anchoc + ',' +  destino + ',' + diferencia_mm + ',' + diferencia_kg;  
		loadArraylist(newRow,'arrrutaitem',':|:');
		accionReloadListRutaitem();
		document.getElementById('msgform').innerHTML = '' ;
		$("#msgwindowform").dialog("close");
	}
	else
	{
		document.getElementById('mensaje').innerHTML = err;
		document.getElementById('mensaje').className = 'ui-state-highlight';
	}
}
//loadArraylistdelete especial para material reproceso
function loadArraylistdelete1(objArrindex, strArrSep, strArrSep1 ,objArrindex1)
{
	if(document.getElementById(objArrindex)){

		var strList = document.getElementById(objArrindex).value;
		var strList1 = document.getElementById(objArrindex1).value;
		var strListtmp = document.getElementById(objArrindex1 + 'tmp').value;

		var arrList = strList.split(strArrSep);
		var arrList1 = strList1.split(strArrSep);
		var arrListtmp = strListtmp.split(strArrSep);

		var strnList = "";
		var booEnc = false;
		
		if(arrList != "" && arrListtmp != ""){

			for(var i=0; i < (arrList.length); i++){

				var rowList = arrList[i].split(strArrSep1);
				var crowlist = (rowList[1] && rowList[2])? rowList[1] + strArrSep1 + rowList[2] : "" ;

				for(var j=0; j < (arrListtmp.length); j++){

					var rowList1 = arrListtmp[j].split(strArrSep1);
					var tmprowlist = (rowList1[0] && rowList1[1])? rowList1[0] + strArrSep1 + rowList1[1] : "" ;

					if (crowlist == tmprowlist){ 
						booEnc = true;
						break;
					}

				}
				
				if(booEnc == false){

					strnList = strnList + ((strnList != "") ? strArrSep : "") + arrList[i];
				}
					
				booEnc = false;
			}
			
			document.getElementById(objArrindex).value = strnList;
			document.getElementById(objArrindex + 'tmp').value = '';
		}

	}

}