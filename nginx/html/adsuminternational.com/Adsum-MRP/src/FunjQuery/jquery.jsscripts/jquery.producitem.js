$(function(){
//Campos Formulario

	scanAlarma();

	$("#tabitems").tabs({});
	
	//ObjSeleccion
	$( "#productos_aprobados_por" ).buttonset();
	$( "#colores_aprobados" ).buttonset();
	$( "#tintas_resistentes_a" ).buttonset();
	
	$.fx.speeds._default = 1000;
	$( "#msgerror" ).dialog({
		autoOpen: false,
		width: 250,
		show: "blind",
		hide: "explode"
	});
	
	//ObjDatepicker
	$("#pedvenfecent").datepicker({changeMonth: true,changeYear: true});
	$("#pedvenfecent").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#pedvenfecent").datepicker($.datepicker.regional['es']);
	
	$("#pedvenfecrec").datepicker({changeMonth: true,changeYear: true});
	$("#pedvenfecrec").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#pedvenfecrec").datepicker($.datepicker.regional['es']);
	
	$("#pedvenfecelb").datepicker({changeMonth: true,changeYear: true});
	$("#pedvenfecelb").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#pedvenfecelb").datepicker($.datepicker.regional['es']);
	
	$("#material").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atcpadreitem.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('idmaterial').value = ui.item.id;
				document.getElementById('iddensidad').value = ui.item.densidad; 
				document.getElementById('idextruido').value = ui.item.extruido; 
			}
			else
			{
				document.getElementById('idmaterial').value = "";
				document.getElementById('iddensidad').value = "";
				document.getElementById('idextruido').value = "";
			}
		}
	});
	
	//gperez para cargar vendedores
	/*$("#pedvenvendedor").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atcvendedor.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('pedvencodven').value = ui.item.id;
			}
			else
			{
				document.getElementById('pedvencodven').value = "";
			}
		}
	});*/
	
	$("#unimedi").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atcunimedida.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('unimedi').value = ui.item.id;
			}
			else
			{
				document.getElementById('unimedi').value = "";
			}
		}
	});
	
	//gperez para cargar item
	/*var tipven = document.getElementById('tipevecodigo').value;
	if(tipven==1 || tipven==2){
		$("#produccoduno").autocomplete({
			if(tipven==1){
				source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atcvendedor.php",
			}else if(tipven==2){
				source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atcvendedor.php",
			}
			source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atcvendedor.php",
			minLength: 0,
			select: function(event, ui) {
				if(ui.item)
				{
					document.getElementById('pedvencodven').value = ui.item.id;
				}
				else
				{
					document.getElementById('pedvencodven').value = "";
				}
			}
		});
	}*/
//Campos Formulario
	
	

//Acciones
	$("#tipitecodigo").change(function(){ document.form1.submit(); });
	$("#tipevecodigo").change(function(){ document.form1.submit(); });
	
	
// BOTON PARA VENTANA MODAL
	
	$('#button').button({ icons: { primary: "ui-icon-search" }, text: false }).click(function() {
		$("#button").bind("focus", function(){$(this).blur();});
		openModal();
		$.ajax({	   
			dataType: "json",
			type: "POST",   
			timeout: 15000,
			url: "../src/FunjQuery/jquery.phpscripts/jq.ajx.detpro.php",
			data: 'pedido=' + document.getElementById('produccoduno').value+'&tipevecodigo='+ document.getElementById('tipevecodigo').value,
			success: function(json_data){
				closeModal();
				setPedido(json_data);
			},error: function(){
				closeModal();
				document.getElementById('msg').innerHTML = 'No PV no existe...';
				$("#msgwindow").dialog("open");
			},
			complete: function(requestData, exito){ }                                      
		});
		return false;
	});

 $(window).resize(function(){
         // dimensiones de la ventana del explorer 
         var wscr = $(window).width();
         var hscr = $(window).height();

         // estableciendo dimensiones de fondo
         $('#bgtransparent').css("width", wscr);
         $('#bgtransparent').css("height", hscr);
         
         // estableciendo tamaño de la ventana modal
         $('#bgmodal').css("width", '130px');
         $('#bgmodal').css("height", '155px');
         
         // obtiendo tamaño de la ventana modal
         var wcnt = $('#bgmodal').width();
         var hcnt = $('#bgmodal').height();
         
         // obtener posicion central
         var mleft = ( wscr - wcnt ) / 2;
         var mtop = ( hscr - hcnt ) / 2;
         
         // estableciendo ventana modal en el centro
         $('#bgmodal').css("left", mleft+'px');
         $('#bgmodal').css("top", mtop+'px');
 });


	
	
	/**
	 * Boton Ingresar color
	 */
	$('#ingresarcolor').button().click(function() {
		var arrlistacolores = document.getElementById('list_colors');
		var color = document.getElementById('l_color');

		if(color.value)
		{
			if(arrlistacolores.value)
			{
				var arrColors = arrlistacolores.value.split(",");
				var enc = false;

				/*for(var a = 0; a < (arrColors.length); a++)
				{
					if(arrColors[a] == color.value)
					{
						document.getElementById('msg').innerHTML = 'Error: El color ya se encuentra registrado';
						$("#msgwindow").dialog("open");
						enc = true;
						break;
					}
				}*/
			}
			
			if(enc != true)
				(arrlistacolores.value) ? arrlistacolores.value = arrlistacolores.value + ',' +  color.value : arrlistacolores.value = color.value; 

			accionReloadListColors();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Error: Debe digitar el color';
			$("#msgwindow").dialog("open");
		}
		
		document.getElementById('l_color').value = '';
		
		return false;
	});

	/**
	 * Boton Quitar color
	 */
	$('#quitarcolor').button().click(function() {
		accionReloadListColors();
		return false;
	});
	
	
	//****************************************
	//****************************************
	//****************************************
	
	/**
	 * Boton Ingresar estructura
	 */
	$('#ingresarestructura').button().click(function() {
		
		var calibre = document.getElementById('calibre');
		var idmaterial = document.getElementById('idmaterial');
		var iddensidad = document.getElementById('iddensidad');
		var idextruido = document.getElementById('idextruido');
		var arrtabla1 = document.getElementById('arrtabla1');
		var index = document.getElementById('indexarrtabla1');
		
		var calib = (calibre)? calibre.value : '' ;
		calib = (/^([0-9])*[.]?[0-9]*$/.test(calib))? calib : '' ;
		
		var arrTabla = (arrtabla1.value) ? arrtabla1.value.split(":|:") : 0;
		var tipestr = validaEstructura(document.getElementById('tipo_estruc').value, arrTabla.length);
		
		if(tipestr == 'err')
		{
			document.getElementById('msg').innerHTML = 'Error: Debe especificar el Tipo de Estructura';
			$("#msgwindow").dialog("open");
			return false;
		}

		if(tipestr < 1)
		{
		
			if(calibre.value != '' && idmaterial.value)
			{
				if(calib == '')
				{
					document.getElementById('msg').innerHTML = 'Error: Debe ser Numerico el Calibre';
					$("#msgwindow").dialog("open");
					return false;
				}
				
				
				
				document.getElementById('ext').value = '1';
				var enc = false;
				var newRow = Number(index.value) + 1 + ':-:' + idmaterial.value + ':-:' + iddensidad.value + ':-:' + calibre.value + ':-:' + idextruido.value;
				
				(idextruido.value == 'f') ? document.getElementById('ext').value = '0' : document.getElementById('ext').value = '1';
				
				
				for(var a = 0; a < (arrTabla.length); a++)
				{
					/*if(arrTabla[a] == newRow)
					{
						document.getElementById('msg').innerHTML = 'Error: El color ya se encuentra registrado';
						$("#msgwindow").dialog("open");
						enc = true;
						break;
					}*/
					
					var arrColumn = arrTabla[a].split(':-:');
					
					if(document.getElementById('ext').value == '0' && arrColumn[4] == 't')
						document.getElementById('ext').value = '1';
				}
					
				if(enc != true)
				{
					loadArraylist(newRow, 'arrtabla1', ':|:');
//					(arrtabla1.value) ? arrtabla1.value = arrtabla1.value + ':|:' +  newRow : arrtabla1.value = newRow;
					index.value = Number(index.value) + 1;
				}
				
				eventDisabledTab();
				accionReloadListEstructura();
				accionReloadListMatExtruido();
			}
			else
			{
				document.getElementById('msg').innerHTML = 'Error: Debe suministrar el material y el calibre';
				$("#msgwindow").dialog("open");
				return false;
			}
		
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Error: Solo es permitido ingresar (' + tipestr + ') items';
			$("#msgwindow").dialog("open");
			return false;
		}
			
		document.getElementById('iddensidad').value = '';
		document.getElementById('idmaterial').value = '';
		document.getElementById('material').value = '';
		document.getElementById('calibre').value = '';
		
		return false;
	});
	
	/**
	 * Boton Quitar estructura
	 */
	$('#quitarestructura').button().click(function() {
		loadArraylistdelete('arrtabla1', ':|:');
		accionReloadListEstructura();
		
		var arrtabla1 = document.getElementById('arrtabla1');
		var arrTabla = (arrtabla1.value) ? arrtabla1.value.split(":|:") : '';
		
		
		document.getElementById('ext').value = '0';
		
		for(var a = 0; a < (arrTabla.length); a++)
		{
			var arrColumn = arrTabla[a].split(':-:');
			
			if(document.getElementById('ext').value == '0' && arrColumn[4] == 't')
				document.getElementById('ext').value = '1';
		}
		
		accionReloadListMatExtruido();
		eventDisabledTab();
		return false;
	});
	
	
	
	
	
	/**
	 * accionReloadListColors
	 * AJAX - Load or Reload list
	 * @return
	 */
	function accionReloadListColors()
	{
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.visors/jquery.listacolores.php", 	
			data: 'list_colors=' + document.getElementById('list_colors').value,
			beforeSend: function(data){ },        
			success: function(requestData){
				if(requestData != '')
					document.getElementById('filtrlistacolores').innerHTML = requestData;
				
				var arrColors = document.getElementById('list_colors').value.split(",");
				var nro;
				(arrColors == '')? nro = 0 : nro = arrColors.length;
				document.getElementById('nrocolors').innerHTML = nro;
				document.getElementById('ncolor').value = nro;
			},         
			error: function(requestData, strError, strTipoError){ },
			complete: function(requestData, exito){ }                                      
		});
	}

	/**
	 * accionReloadListEstructura
	 * AJAX - Load or Reload list
	 * @return
	 */
	function accionReloadListEstructura()
	{
		var addparamet = '';
		var arrObjs = document.getElementById('arrtabla1').value.split(':|:');
		var arr;
		
		for(var i = 0;i < (arrObjs.length);i++)
		{
			var arr = arrObjs[i].split(':-:');
			//objeto adicional a utilizar
			var objs_color = 'color_' + arr[0] + '_' + arr[1];
			//objeto adiconal
			var obj_color = document.getElementById(objs_color);
			//valor del objeto adicional
			var color = (obj_color)? obj_color.value : '' ;
			
			addparamet = (color != '')? addparamet + '&' + objs_color + '=' + color : addparamet + '&' + objs_color + '=';
		}
		
		
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.visors/jquery.tabla1.php", 	
			data: 'arrtabla1=' + document.getElementById('arrtabla1').value + addparamet + '&tipo_estruc=' + document.getElementById('tipo_estruc').value + '&indexarrtabla1=' + document.getElementById('indexarrtabla1').value,
			beforeSend: function(data){ },        
			success: function(requestData){
				if(requestData != '')
				{
					document.getElementById('filtrlistaestructura').innerHTML = requestData;
					eventPesomillar();
				}
			},         
			error: function(requestData, strError, strTipoError){ },
			complete: function(requestData, exito)
			{ 
				if(document.getElementById('tipo_estruc').value == 'compuesto')
					eventMaterialprint();
			}                                      
		});
		
		
	}
	
	/**
	 * accionReloadListMatextruido
	 * AJAX - Load or Reload list
	 * @return
	 */
	function accionReloadListMatExtruido()
	{	
		var addparamet = '';
		var arrObjs = document.getElementById('arrtabla1').value.split(':|:');
		var arr;
		
		for(var i = 0;i < (arrObjs.length);i++)
		{
			if(document.getElementById('apli_mate_' + (i + 1)))
				addparamet = addparamet + '&apli_mate_' + (i + 1) + '=' + document.getElementById('apli_mate_' + (i + 1)).value;
			
			if(document.getElementById('color_' + (i + 1)))
				addparamet = addparamet + '&color_' + (i + 1) + '=' + document.getElementById('color_' + (i + 1)).value;
			
			if(document.getElementById('tratamiento_' + (i + 1)))
			{
				if(document.getElementsByName('tratamiento_' + (i + 1))[0].checked == true)
					addparamet = addparamet + '&tratamiento_' + (i + 1) + '=' + document.getElementsByName('tratamiento_' + (i + 1))[0].value;
				
				if(document.getElementsByName('tratamiento_' + (i + 1))[1].checked == true)
					addparamet = addparamet + '&tratamiento_' + (i + 1) + '=' + document.getElementsByName('tratamiento_' + (i + 1))[1].value;
			}
			
			if(document.getElementById('plano_tratado_' + (i + 1)))
			{
				if(document.getElementsByName('plano_tratado_' + (i + 1))[0].checked == true)
					addparamet = addparamet + '&plano_tratado_' + (i + 1) + '=' + document.getElementsByName('plano_tratado_' + (i + 1))[0].value;
				
				if(document.getElementsByName('plano_tratado_' + (i + 1))[1].checked == true)
					addparamet = addparamet + '&plano_tratado_' + (i + 1) + '=' + document.getElementsByName('plano_tratado_' + (i + 1))[1].value;
			}
			
			if(document.getElementById('trata_min_' + (i + 1)))
				addparamet = addparamet + '&trata_min_' + (i + 1) + '=' + document.getElementById('trata_min_' + (i + 1)).value;
			
			if(document.getElementById('trata_max_' + (i + 1)))
				addparamet = addparamet + '&trata_max_' + (i + 1) + '=' + document.getElementById('trata_max_' + (i + 1)).value;
			
			if(document.getElementById('ncaras_trata_' + (i + 1)))
			{
				if(document.getElementsByName('ncaras_trata_' + (i + 1))[0].checked == true)
					addparamet = addparamet + '&ncaras_trata_' + (i + 1) + '=' + document.getElementsByName('ncaras_trata_' + (i + 1))[0].value;
				
				if(document.getElementsByName('ncaras_trata_' + (i + 1))[1].checked == true)
					addparamet = addparamet + '&ncaras_trata_' + (i + 1) + '=' + document.getElementsByName('ncaras_trata_' + (i + 1))[1].value;
			}
			
			if(document.getElementById('mat_sellable_' + (i + 1)))
			{
				if(document.getElementsByName('mat_sellable_' + (i + 1))[0].checked == true)
					addparamet = addparamet + '&mat_sellable_' + (i + 1) + '=' + document.getElementsByName('mat_sellable_' + (i + 1))[0].value;
				
				if(document.getElementsByName('mat_sellable_' + (i + 1))[1].checked == true)
					addparamet = addparamet + '&mat_sellable_' + (i + 1) + '=' + document.getElementsByName('mat_sellable_' + (i + 1))[1].value;
			}
			
			if(document.getElementById('ncaras_sellable_' + (i + 1)))
			{
				if(document.getElementsByName('ncaras_sellable_' + (i + 1))[0].checked == true)
					addparamet = addparamet + '&ncaras_sellable_' + (i + 1) + '=' + document.getElementsByName('ncaras_sellable_' + (i + 1))[0].value;
				
				if(document.getElementsByName('ncaras_sellable_' + (i + 1))[1].checked == true)
					addparamet = addparamet + '&ncaras_sellable_' + (i + 1) + '=' + document.getElementsByName('ncaras_sellable_' + (i + 1))[1].value;
			}
			
			if(document.getElementById('cofmax_nt_' + (i + 1)))
				addparamet = addparamet + '&cofmax_nt_' + (i + 1) + '=' + document.getElementById('cofmax_nt_' + (i + 1)).value;
			
			if(document.getElementById('cofmax_tt_' + (i + 1)))
				addparamet = addparamet + '&cofmax_tt_' + (i + 1) + '=' + document.getElementById('cofmax_tt_' + (i + 1)).value;
			
			if(document.getElementById('haze_' + (i + 1)))
				addparamet = addparamet + '&haze_' + (i + 1) + '=' + document.getElementById('haze_' + (i + 1)).value;
			
			if(document.getElementById('tole_haze_ms_' + (i + 1)))
				addparamet = addparamet + '&tole_haze_ms_' + (i + 1) + '=' + document.getElementById('tole_haze_ms_' + (i + 1)).value;
			
			if(document.getElementById('tole_haze_mn_' + (i + 1)))
				addparamet = addparamet + '&tole_haze_mn_' + (i + 1) + '=' + document.getElementById('tole_haze_mn_' + (i + 1)).value;
			
			if(document.getElementById('note_extruido_' + (i + 1)))
				addparamet = addparamet + '&note_extruido_' + (i + 1) + '=' + document.getElementById('note_extruido_' + (i + 1)).value;
		}
		
		if(document.getElementById('tipo_impresion'))
			addparamet = addparamet + '&tipo_impresion' + '=' + document.getElementById('tipo_impresion').value;
		
		if(document.getElementById('tipitecodigo'))
			addparamet = addparamet + '&tipitecodigo' + '=' + document.getElementById('tipitecodigo').value;
		
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_matextruido.php", 	
			data: 'arrtabla1=' + document.getElementById('arrtabla1').value + addparamet,
			beforeSend: function(data){ },        
			success: function(requestData){
				if(requestData != '')
				{
					document.getElementById('filtrlistamatextruido').innerHTML = requestData;
				}
			},         
			error: function(requestData, strError, strTipoError){ },
			complete: function(requestData, exito)
			{}                                      
		});
		
		
	}
	
	if(document.getElementById('tipevecodigo').value == 2 && (document.getElementById('sourceaction').value == 'nuevo' || document.getElementById('sourceaction').value == 'editar'))
	{
		eventNotamedidas();
		eventNotacalibre_estructura();
		eventNotadisenio_textos_colores();
		eventNotaaccesorios_seccion();
		eventNotaesp_emb();
		eventNotaesp_ext();
		eventNotalaminacion_seccion();
		eventNotadesarrollo_seccion();
	}
	
	if(document.getElementById('sourceaction').value == 'editar')
	{
		$("#pedvennumero").bind("focus", function(){$(this).blur();});
		$("#ordcomnumero").bind("focus", function(){$(this).blur();});
		$("#tipevecodigo").bind("focus", function(){$(this).blur();});
		$("#tipitecodigo").bind("focus", function(){$(this).blur();});
	}
	
	
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
 * Funcion evento tipoimpresion, cuando cambie el objeto select su valor muestra/oculta la session item_sessiond
 * @param value
 * @return
 * 
 * CASO tipo FLOW PACK
 */
function eventTipoimpresion(value)
{
	switch (value)
	{
		case 'sin_impresion':
				document.getElementById('item_sessiond').style.display = 'none';
				if(document.getElementById('tipitecodigo').value == 4 || document.getElementById('tipitecodigo').value == 2)
				{
					document.getElementById('ncaras_imp_lb').style.display = 'none';
					document.getElementById('ncaras_imp_obj').style.display = 'none';
				}
				
				if(document.getElementById('tipitecodigo').value == 6){
					document.getElementById('largo_lb').style.display = 'none';
					document.getElementById('largo_obj').style.display = 'none';
					document.getElementById('tolelargo_lb').style.display = 'none';
					document.getElementById('tolelargo_obj').style.display = 'none';
					document.getElementById('anchofotoc_lb').style.display = 'none';
					document.getElementById('anchofotoc_obj').style.display = 'none';
					document.getElementById('largo_fotoc_lb').style.display = 'none';
					document.getElementById('largo_fotoc_obj').style.display = 'none';
					document.getElementById('dfotoc_lb').style.display = 'none';
					document.getElementById('dfotoc_obj').style.display = 'none';
					document.getElementById('colorfotoc_lb').style.display = 'none';
					document.getElementById('colorfotoc_obj').style.display = 'none';
					document.getElementById('tipoemb_lb').style.display = 'none';
					document.getElementById('tipoemb_obj').style.display = 'none';
					document.getElementById('conresp_lb').style.display = 'none';
					document.getElementById('conresp_obj').style.display = 'none';
					document.getElementById('cod_barras_lb').style.display = 'none';
					document.getElementById('cod_barras_obj').style.display = 'none';
				}
				
				if(document.getElementById('tipitecodigo').value == 5){
					document.getElementById('session_materialimprimir').style.display = 'none';
				}
					document.getElementById('cod_barras_lb').style.display = 'none';
					document.getElementById('cod_barras_obj').style.display = 'none';
			break;
		case 'interna':
		case 'externa':
			document.getElementById('item_sessiond').style.display = 'block';
			if(document.getElementById('tipevecodigo').value == '4')
				document.getElementById('item_sessiond1').style.display = 'none';
			
			if(document.getElementById('tipitecodigo').value == 4 || document.getElementById('tipitecodigo').value == 2)
			{
				document.getElementById('ncaras_imp_lb').style.display = 'block';
				document.getElementById('ncaras_imp_obj').style.display = 'block';
			}
			
			if(document.getElementById('tipitecodigo').value == 6){
				document.getElementById('largo_lb').style.display = 'block';
				document.getElementById('largo_obj').style.display = 'block';
				document.getElementById('tolelargo_lb').style.display = 'block';
				document.getElementById('tolelargo_obj').style.display = 'block';
				document.getElementById('anchofotoc_lb').style.display = 'block';
				document.getElementById('anchofotoc_obj').style.display = 'block';
				document.getElementById('largo_fotoc_lb').style.display = 'block';
				document.getElementById('largo_fotoc_obj').style.display = 'block';
				document.getElementById('dfotoc_lb').style.display = 'block';
				document.getElementById('dfotoc_obj').style.display = 'block';
				document.getElementById('colorfotoc_lb').style.display = 'block';
				document.getElementById('colorfotoc_obj').style.display = 'block';
				document.getElementById('tipoemb_lb').style.display = 'block';
				document.getElementById('tipoemb_obj').style.display = 'block';
				document.getElementById('conresp_lb').style.display = 'block';
				document.getElementById('conresp_obj').style.display = 'block';
				document.getElementById('cod_barras_lb').style.display = 'block';
				document.getElementById('cod_barras_obj').style.display = 'block';
			}
			if(document.getElementById('tipitecodigo').value == 5){
				document.getElementById('session_materialimprimir').style.display = (document.getElementById('tipo_impresion').value == 'sin_impresion')?'none':'block';
			}
				document.getElementById('cod_barras_lb').style.display = 'block';
				document.getElementById('cod_barras_obj').style.display = 'block';
		break;
		default:
			document.getElementById('item_sessiond').style.display = 'block';
			document.getElementById('item_sessiond1').style.display = 'block';
			break;
	}	
}


/**
 * @param value
 * @return
 */
function eventEstructura(value)
{
	document.getElementById('lmn').value = (value == 'monocapa') ? '0' : '1';

	var arrtabla1 = document.getElementById('arrtabla1');
	var arrTabla = (arrtabla1.value) ? arrtabla1.value.split(":|:") : '';
	document.getElementById('ext').value = '0';
	
	for(var a = 0; a < (arrTabla.length); a++)
	{
		var arrColumn = arrTabla[a].split(':-:');
		if(document.getElementById('ext').value == '0' && arrColumn[3] == 't')
			document.getElementById('ext').value = '1';
	}
	
	eventDisabledTab();
	
	if(document.getElementById('session_materialimprimir') != null){
		if(value == 'compuesto'){
			(document.getElementById('tipo_impresion').value != 'sin_impresion')? document.getElementById('session_materialimprimir').style.display = 'block' : document.getElementById('session_materialimprimir').style.display = 'none' ;
		}
		else
		{
			document.getElementById('session_materialimprimir').style.display = 'none';
		}
	}
	
	if(document.getElementById('session_numcarasimprimir') != null)
		if(value == 'sencillo'){
			(document.getElementById('tipo_impresion').value != 'sin_impresion')? document.getElementById('session_numcarasimprimir').style.display = 'block': document.getElementById('session_numcarasimprimir').style.display = 'none';
		}
		else
		{
			document.getElementById('session_numcarasimprimir').style.display = 'none';
		}
			
}

/**
 * 
 * @param id
 * @param nrRow
 * @return
 */
function validaEstructura(id, nrRow)
{
	switch (id)
	{
		case 'monocapa':
		case 'sencillo':
			if(nrRow >= 1){ return 1; }else{ return 0; }
			break;
		case 'bilaminado':
		case 'compuesto':
			if(nrRow >= 2){ return 2; }else{ return 0; }
			break;
		case 'trilaminado':
			if(nrRow >= 3){ return 3; }else{ return 0; }
			break;
		case 'tetralaminado':
			if(nrRow >= 4){ return 4; }else{ return 0; }
			break;
		case 'multilaminado':
			return 0;
			break;
		default:
			return 'err';
			break;
	}	
}

/**
 * @param value
 * @return
 */
function eventMaterialEstibado(value)
{
	(value == 1) ? document.getElementById('session_estibado').style.display = 'block' : document.getElementById('session_estibado').style.display = 'none';
}

/**
 * @param value
 * @return
 */
function eventAplicacion(value)
{
	if(value == 'reempaque')
	{
		document.getElementById('product_empa').value = 'N/A';
		$("#product_empa").bind("focus", function(){$(this).blur();});
	}
	else
	{	
		var obj_product_empa = document.getElementById('product_empa');
		var produc_emp = (obj_product_empa.value)? obj_product_empa.value : '' ;
		
		if(produc_emp == 'N/A')
			document.getElementById('product_empa').value = '';
		
		$("#product_empa").unbind("focus");
	}
}

/**
 * @param value
 * @return
 */
function eventTroquel(value)
{
	(value == 1) ? document.getElementById('session_tipotroquel').style.display = 'block' : document.getElementById('session_tipotroquel').style.display = 'none';
}

/**
 * @param value
 * @return
 */
function eventBandera(value)
{
	(value == 1) ? document.getElementById('session_bandera').style.display = 'block' : document.getElementById('session_bandera').style.display = 'none';
}

/**
 * @param value
 * @return
 */
function eventMaterialprint()
{
		var data = document.getElementById('arrtabla1').value.split(":|:");
	
		for(var i = 0;i < data.length;i++)
		{
			document.getElementById('mate_imp').options[i+1]= null;
		}
		
		for(var a = 0; a < data.length; a++)
		{
			var datas = data[a].split(":-:");
			var opcion=document.createElement("option"); 
			opcion.value=datas[0];
			opcion.text= document.getElementById('objnombre_'+datas[0]).value;
			document.getElementById('mate_imp').options[a+1]= opcion;
		}
}


/**
 * @param value
 * @return
 */
function eventTipoapertura(value)
{
	if(document.getElementById('session_tipoapertura') != null)
		(value == '') ? document.getElementById('session_tipoapertura').style.display = 'block' : document.getElementById('session_tipoapertura').style.display = 'none';
}

/**
 * @param value
 * @return
 */
function eventTipovalvula(value)
{
	if(value == '')
	{
		document.getElementById('session_tipovalvula').style.display = 'block';
		eventTipoapertura(document.getElementById('tipo_valve').value);
	}
	else
	{
		document.getElementById('session_tipovalvula').style.display = 'none';
		eventTipoapertura('');
	}
}


/**
 * @return
 */
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
	
	if(document.getElementById('tipitecodigo').value != 6)
		document.getElementById('pesomillar').innerHTML = Math.round(suma * 100) / 100;
}

/**
 * @return
 */
function eventPesomillarCapuchon()
{
	//objetos a usar
	var estructura_n = (document.getElementById('arrtabla1') != null) ? document.getElementById('arrtabla1').value.split(":|:").length : 1;
	var largo = (document.getElementById('largo') != null) ? document.getElementById('largo').value : 0;  
	var bmayor = (document.getElementById('bmayor') != null) ? document.getElementById('bmayor').value : 0; 
	var bmenor = (document.getElementById('bmenor') != null) ? document.getElementById('bmenor').value : 0;
	var pestania = (document.getElementById('pestania') != null) ? document.getElementById('pestania').value : 0;
	var totalgramaje = document.getElementById('totalgramaje').value;
	var totalcalibre = document.getElementById('totalcalibre').value;
	var milipul = 0;var calibre = 0;var pesom = 0;
	
	if(largo == "") largo = 0;
	if(bmayor == "") bmayor = 0;
	if(bmenor == "") bmenor = 0;
	if(pestania == "") pestania = 0;
	
	area = (((parseFloat(bmayor) / 1000) + (parseFloat(bmenor) / 1000)) / 2) * (((parseFloat(largo) / 1000 ) * 2) + ((parseFloat(pestania) / 1000 ) * 2));
	suma = area * (totalgramaje / estructura_n);
	
	
	var redondiado = Math.round(suma * 100)/100;
	document.getElementById('pesomillar').innerHTML = redondiado;
}

/**
 * @param value
 * @return
 */
function accionColorPelicula(value)
{
	if(document.getElementById('color'))
	{
		document.getElementById('color').value = value;
	}
}


/**
 * @param value
 * @return
 */
function eventOcultaPallet(value)
{
	if(value != '')
	{
		document.getElementById('peso_pallet').value = '0.0';
	}
	else
	{
		document.getElementById('peso_pallet').value = '0.0';
	}
}

/**
 * @param value
 * @return
 */
function eventOcultaAltPallet(value)
{
	if(value != '')
	{
		document.getElementById('alt_pallet').value = '0.0';
	}
	else
	{
		document.getElementById('alt_pallet').value = '0.0';
	}
}


/**
 * @param value
 * @return
 */
function eventMetrosrollo(value)
{
	if(value > 0)
	{
		document.getElementById('peso_rollolb').style.display = 'none';
		document.getElementById('peso_rolloobj').style.display = 'none';
		document.getElementById('prollo').value = '';
		document.getElementById('tole_pesolb').style.display = 'none';
		document.getElementById('tole_pesoobj').style.display = 'none';
		document.getElementById('tole_prollo_ms').value = '';
		document.getElementById('tole_prollo_mn').value = '';
		document.getElementById('diam_rollolb').style.display = 'none';
		document.getElementById('diam_rolloobj').style.display = 'none';
		document.getElementById('drollo').value = '';
		document.getElementById('tole_diametrolb').style.display = 'none';
		document.getElementById('tole_diametroobj').style.display = 'none';
		document.getElementById('tole_drollo_ms').value = '';
		document.getElementById('tole_drollo_mn').value = '';
	}
	else
	{
		document.getElementById('peso_rollolb').style.display = 'block';
		document.getElementById('peso_rolloobj').style.display = 'block';
		document.getElementById('tole_pesolb').style.display = 'block';
		document.getElementById('tole_pesoobj').style.display = 'block';
		document.getElementById('diam_rollolb').style.display = 'block';
		document.getElementById('diam_rolloobj').style.display = 'block';
		document.getElementById('tole_diametrolb').style.display = 'block';
		document.getElementById('tole_diametroobj').style.display = 'block';
	}
}

/**
 * @param value
 * @return
 */
function eventPesorollo(value)
{
	if(value > 0)
	{
		document.getElementById('metros_rollolb').style.display = 'none';
		document.getElementById('metros_rolloobj').style.display = 'none';
		document.getElementById('mrollo').value = '';
		document.getElementById('diam_rollolb').style.display = 'none';
		document.getElementById('diam_rolloobj').style.display = 'none';
		document.getElementById('drollo').value = '';
		document.getElementById('tole_diametrolb').style.display = 'none';
		document.getElementById('tole_diametroobj').style.display = 'none';
		document.getElementById('tole_drollo_ms').value = '';
		document.getElementById('tole_drollo_mn').value = '';
	}
	else
	{
		document.getElementById('metros_rollolb').style.display = 'block';
		document.getElementById('metros_rolloobj').style.display = 'block';
		document.getElementById('diam_rollolb').style.display = 'block';
		document.getElementById('diam_rolloobj').style.display = 'block';
		document.getElementById('tole_diametrolb').style.display = 'block';
		document.getElementById('tole_diametroobj').style.display = 'block';
		document.getElementById('prollo').value = '';
		document.getElementById('tole_prollo_ms').value = '';
		document.getElementById('tole_prollo_mn').value = '';
	}
}

/**
 * @param value
 * @return
 */
function eventDiamrollo(value)
{
	if(value > 0)
	{
		document.getElementById('peso_rollolb').style.display = 'none';
		document.getElementById('peso_rolloobj').style.display = 'none';
		document.getElementById('prollo').value = '';
		document.getElementById('tole_pesolb').style.display = 'none';
		document.getElementById('tole_pesoobj').style.display = 'none';
		document.getElementById('tole_prollo_ms').value = '';
		document.getElementById('tole_prollo_mn').value = '';
		document.getElementById('metros_rollolb').style.display = 'none';
		document.getElementById('metros_rolloobj').style.display = 'none';
		document.getElementById('mrollo').value = '';
	}
	else
	{
		document.getElementById('metros_rollolb').style.display = 'block';
		document.getElementById('metros_rolloobj').style.display = 'block';
		document.getElementById('peso_rollolb').style.display = 'block';
		document.getElementById('peso_rolloobj').style.display = 'block';
		document.getElementById('tole_pesolb').style.display = 'block';
		document.getElementById('tole_pesoobj').style.display = 'block';
		document.getElementById('prollo').value = '';
		document.getElementById('tole_drollo_ms').value = '';
		document.getElementById('tole_drollo_mn').value = '';
	}
}


/**
 * @param value
 * @return
 */
function eventOcultaTratamiento(value,index)
{
	var tipoimpresion = document.getElementById('tipo_impresion');
	var impresion = (tipoimpresion.value)? tipoimpresion.value : 0 ;
	
	if(impresion != 'sin_impresion')
	{
		document.getElementsByName('tratamiento_' + index)[1].click();
		return false;
	}
		
	
	if(value == 'no')
	{
		document.getElementById('trata_min_lb_' + index).style.display = 'none';
		document.getElementById('trata_min_obj_' + index).style.display = 'none';
		document.getElementById('trata_max_lb_' + index).style.display = 'none';
		document.getElementById('trata_max_obj_' + index).style.display = 'none';
		if(document.getElementById('tipitecodigo').value == 6)
		{
			document.getElementById('lado_trata_lb_' + index).style.display = 'none';
			document.getElementById('lado_trata_obj_' + index).style.display = 'none';
		}
	}
	if(value == 'si')
	{
		document.getElementById('trata_min_lb_' + index).style.display = 'block';
		document.getElementById('trata_min_obj_' + index).style.display = 'block';
		document.getElementById('trata_max_lb_' + index).style.display = 'block';
		document.getElementById('trata_max_obj_' + index).style.display = 'block';
		if(document.getElementById('tipitecodigo').value == 6)
		{
			document.getElementById('lado_trata_lb_' + index).style.display = 'block';
			document.getElementById('lado_trata_obj_' + index).style.display = 'block';
		}
	}
}

/**
 * @param value
 * @return
 */
function eventOcultaValvula(value)
{
	if(value == 'no')
	{
		document.getElementById('ctapa_valvelb').style.display = 'none';
		document.getElementById('ctapa_valveobj').style.display = 'none';
		document.getElementById('medi_valvelb').style.display = 'none';
		document.getElementById('medi_valveobj').style.display = 'none';
		document.getElementById('ubic_valvelb').style.display = 'none';
		document.getElementById('ubic_valveobj').style.display = 'none';
		document.getElementById('tipo_valvelb').style.display = 'none';
		document.getElementById('tipo_valveobj').style.display = 'none';
		if(document.getElementById('tipitecodigo').value == 3)
		{
			document.getElementById('tipo_cierre_lb').style.display = 'block';
			document.getElementById('tipo_cierre_obj').style.display = 'block';
			document.getElementById('dist_cierre_lb').style.display = 'block';
			document.getElementById('dist_cierre_obj').style.display = 'block';
			document.getElementById('tllvalve_obj').style.display = 'none';
		}
		if(document.getElementById('tipitecodigo').value == 4)
		{
			document.getElementById('ziper_lb').style.display = 'block';
			document.getElementById('ziper_obj').style.display = 'block';
			document.getElementById('dist_ziper_lb').style.display = 'block';
			document.getElementById('dist_ziper_obj').style.display = 'block';
			document.getElementById('tllvalve_obj').style.display = 'none';
		}
	}
	if(value == 'si')
	{
		document.getElementById('ctapa_valvelb').style.display = 'block';
		document.getElementById('ctapa_valveobj').style.display = 'block';
		document.getElementById('medi_valvelb').style.display = 'block';
		document.getElementById('medi_valveobj').style.display = 'block';
		document.getElementById('ubic_valvelb').style.display = 'block';
		document.getElementById('ubic_valveobj').style.display = 'block';
		document.getElementById('tipo_valvelb').style.display = 'block';
		document.getElementById('tipo_valveobj').style.display = 'block';
		if(document.getElementById('tipitecodigo').value == 3)
		{
			document.getElementById('tipo_cierre_lb').style.display = 'none';
			document.getElementById('tipo_cierre_obj').style.display = 'none';
			document.getElementById('dist_cierre_lb').style.display = 'none';
			document.getElementById('dist_cierre_obj').style.display = 'none';
			document.getElementById('tllvalve_obj').style.display = 'block';
		}
		
		if(document.getElementById('tipitecodigo').value == 4)
		{
			document.getElementById('ziper_lb').style.display = 'none';
			document.getElementById('ziper_obj').style.display = 'none';
			document.getElementById('dist_ziper_lb').style.display = 'none';
			document.getElementById('dist_ziper_obj').style.display = 'none';
			document.getElementById('tllvalve_obj').style.display = 'block';
		}
		
		
	}
}

/**
 * @param value
 * @return
 */
function eventOcultaMaterialsellable(value,index)
{
	var producto = document.getElementById('tipitecodigo');

	if(producto.value != 6)
		return false;
		
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
function eventTipocierre(value)
{
	if(value == 'NA')
	{
		document.getElementById('dist_cierre').value = 'N/A';
	}
	else
	{
		document.getElementById('dist_cierre').value = '';
	}
}

function eventTipoaper(value)
{
	if(value == 'NA')
	{
		document.getElementById('dist_aper').value = 'N/A';
	}
	else
	{
		document.getElementById('dist_aper').value = '';
	}
}

function eventMaxempalmes(value)
{
	if(Number(value) <= 0)
	{
		document.getElementById('ancho_empal').value = 'NA';
		document.getElementById('cempal_cara').value = 'NA';
		document.getElementById('cempal_dorso').value = 'NA';
	}
	/*
	 * wilson ospina cambio 
	 * 
	else
	{
		document.getElementById('ancho_empal').value = '';
		document.getElementById('cempal_cara').value = '';
		document.getElementById('cempal_dorso').value = '';
	}
	*/
}

function eventOcultaDistancia(value , key)
{
	if(value == 'si')
	{
		document.getElementById('dist_' + key + '_lb').style.display = 'block';
		document.getElementById('dist_'+ key +'_obj').style.display = 'block';
	}
	else
	{
		document.getElementById('dist_' + key + '_lb').style.display = 'none';
		document.getElementById('dist_'+ key +'_obj').style.display = 'none';
	}
}


/**
 * @param value
 * @return
 */
function eventOcultaMacroperforaciones(value)
{
	if(value != '1')
	{
		document.getElementById('n_macroperflbl').style.display = 'none';
		document.getElementById('n_macroperfobj').style.display = 'none';
	}
	else
	{
		document.getElementById('n_macroperflbl').style.display = 'block';
		document.getElementById('n_macroperfobj').style.display = 'block';
	}
}

/**
 * @param value
 * @return
 */
function eventOcultaMicroperforaciones(value)
{
	if(value != '1')
	{
		document.getElementById('n_caras_microperflbl').style.display = 'none';
		document.getElementById('n_caras_microperfobj').style.display = 'none';
		document.getElementById('tipo_microperlbl').style.display = 'none';
		document.getElementById('tipo_microperobj').style.display = 'none';
		document.getElementById('dist_microper_lb').style.display = 'none';
		document.getElementById('dist_microper_obj').style.display = 'none';
	}
	else
	{
		document.getElementById('n_caras_microperflbl').style.display = 'block';
		document.getElementById('n_caras_microperfobj').style.display = 'block';
		document.getElementById('tipo_microperlbl').style.display = 'block';
		document.getElementById('tipo_microperobj').style.display = 'block';
		document.getElementById('dist_microper_lb').style.display = 'block';
		document.getElementById('dist_microper_obj').style.display = 'block';
	}
}

/**
 * @param id
 * @return
 */
function eventDisabledTolerancia(id)
{
	var valbool = (document.getElementById(id).value == '0') ? true : false;
	var valdisa = (document.getElementById(id).value == '0') ? 'none' : 'block';
	
	switch (id)
	{
		case 'cantidad_solicitada':
			document.getElementById('tole_cant_ms').disabled = valbool;
			document.getElementById('tole_cant_mn').disabled = valbool;
		break;
		
		case 'ancho':
			document.getElementById('tole_ancho_ms').disabled = valbool;
			document.getElementById('tole_ancho_mn').disabled = valbool;
		break;
			
		case 'largo':
			document.getElementById('tole_largo_ms').disabled = valbool;
			document.getElementById('tole_largo_mn').disabled = valbool;
		break;
			
		case 'fuelle':
			document.getElementById('tole_fuelle_lb').style.display = valdisa;
			document.getElementById('tole_fuelle_obj').style.display = valdisa;
		break;
			
		case 'traslape':
			document.getElementById('tipo_traslape_lb').style.display = valdisa;
			document.getElementById('tipo_traslape_obj').style.display = valdisa;
			document.getElementById('tole_traslape_lb').style.display = valdisa;
			document.getElementById('tole_traslape_obj').style.display = valdisa;
		break;
		
		case 'pestania':
			document.getElementById('tole_pestania_ms').disabled = valbool;
			document.getElementById('tole_pestania_mn').disabled = valbool;
		break;
		
		case 'base_mayor':
			document.getElementById('tole_base_mayor_ms').disabled = valbool;
			document.getElementById('tole_base_mayor_mn').disabled = valbool;
		break;
		
		case 'base_menor':
			document.getElementById('tole_base_menor_ms').disabled = valbool;
			document.getElementById('tole_base_menor_mn').disabled = valbool;
		break;
	}
}

/**
 * @param value
 * @return
 */
function eventFormaempaque(value)
{	
	document.getElementById('seccion_formempa_suspendido').style.display = 'none';
	document.getElementById('seccion_formempa_caja').style.display = 'none';
	document.getElementById('seccion_formempa_bolsa_plastica').style.display = 'none';
	document.getElementById('seccion_formempa_carton_extremos').style.display = 'none';
	document.getElementById('seccion_formempa_cubierto_extremos').style.display = 'none';
	
	switch (value)
	{
		case 'suspendido':
			document.getElementById('seccion_formempa_suspendido').style.display = 'block';
		break;
		
		case 'caja':
			document.getElementById('seccion_formempa_caja').style.display = 'block';
		break;
			
		case 'bolsa_plastica':
			document.getElementById('seccion_formempa_bolsa_plastica').style.display = 'block';		
		break;
			
		case 'carton_extremos':
			document.getElementById('seccion_formempa_carton_extremos').style.display = 'block';
		break;
		
		case 'cubierto_extremos':
			document.getElementById('seccion_formempa_cubierto_extremos').style.display = 'block';
		break;
	}
	
	$("#niv_estiba").val('');
	$("#peso_estiba").val('');
		 
	$('#seccion_formempa_suspendido #bolsa_plastic').removeAttr('checked');
	$('#seccion_formempa_caja #bolsa_plastic').removeAttr('checked');
	$('#seccion_formempa_bolsa_plastica #bolsa_plastic').removeAttr('checked');
	$('#seccion_formempa_carton_extremos #bolsa_plastic').removeAttr('checked');
	$('#seccion_formempa_cubierto_extremos #bolsa_plastic').removeAttr('checked');
	
	$('#seccion_formempa_caja #pro_core').removeAttr('checked');
	$('#seccion_formempa_bolsa_plastica #pro_core').removeAttr('checked');
	$('#seccion_formempa_carton_extremos #pro_core').removeAttr('checked');
	$('#seccion_formempa_cubierto_extremos #pro_core').removeAttr('checked');
	
	$('#seccion_formempa_caja #peso_max').val('');
	$('#seccion_formempa_bolsa_plastica #peso_max').val('');
	
	$('#seccion_formempa_carton_extremos #no_rollos').val('');
	$('#seccion_formempa_cubierto_extremos #no_rollos').val('');
	
	
}


/**
 * @return
 */
function eventDisabledTab()
{
	var tribTabs = new Array();
//	var arrTabla = document.getElementById('arrtabla1');
//	var arrObjs = (arrTabla.value)? arrTabla.value.split(":|:") : 0 ;
	
	/*
	for(i=0;i<arrObjs.length;i++)
	{
		var arrColumn = arrObjs[i].split(':-:');
		
		alert(arrColumn);
		
		if(document.getElementById('ext').value == '0' && arrColumn[4] == 't')
			document.getElementById('ext').value = '1';
	}
	*/
	
	if(document.getElementById('lmn').value == '0')
		(document.getElementById('tipitecodigo').value == '6') ? tribTabs[0] = 4 : tribTabs[0] = 4;
	
	if(document.getElementById('ext').value == '0')
		(document.getElementById('tipitecodigo').value == '6') ? tribTabs[1] = 3 : tribTabs[1] = 3;
	
	$( "#tabitems" ).tabs( "option", "disabled", tribTabs );
	document.getElementById('arrTabs').value = tribTabs;
}

function eventNotamedidas()
{
	var bole = $('#medidas').attr('checked');
	var fade = (bole)? 1 : 0.5 ;
	
	
	$("#medidas_seccion").fadeTo("slow",fade);
	if(!bole)
	{
		$("#medidas_seccion :input").bind("focus", function(){$(this).blur();});
		$("#medidas_seccion input:radio").bind("click", function(){return false;});
		$("#medidas_seccion input:checkbox").bind("click", function(){return false;});
	}
	
	if(bole)
	{
		$("#medidas_seccion :input").unbind("focus");
		$("#medidas_seccion input:radio").unbind("click");
		$("#medidas_seccion input:checkbox").unbind("click");
	}
}

function eventNotacalibre_estructura()
{
	var bole = $('#calibre_estructura').attr('checked');
	var view = (bole)? 'enable' : 'disable';
	var fade = (bole)? 1 : 0.5 ;
   
    if(!bole)
    {
    	$("#estructura_seccion :input").bind("focus", function(){$(this).blur();});
    	$("#cantidad_seccion :input").bind("focus", function(){$(this).blur();});
    	$("#estructura_seccion input:radio").bind("click", function(){return false;});
		$("#estructura_seccion input:checkbox").bind("click", function(){return false;});
    }
    else
    {
    	$("#estructura_seccion :input").unbind("focus"); 
        $("#cantidad_seccion :input").unbind("focus"); 
        $("#estructura_seccion input:radio").unbind("click"); 
		$("#estructura_seccion input:checkbox").unbind("click"); 
    }
    
	$("#cantidad_seccion").fadeTo("slow",fade); 
    $("#estructura_seccion").fadeTo("slow",fade);
    $( "#ingresarestructura").button(view);
    $( "#quitarestructura").button(view);
    
}



function eventNotadisenio_textos_colores()
{
	var bole = $('#disenio_textos_colores').attr('checked');
	var view = (bole)? 'enable' : 'disable' ;
	var fade = (bole)? 1 : 0.5 ;
	
	  	$("#item_sessionc").fadeTo("slow",fade);
	    $("#item_sessiond").fadeTo("slow",fade);
	    $("#item_sessione").fadeTo("slow",fade);
	    
		$( "#ingresarcolor" ) .button(view);
	    $( "#quitarcolor" ) .button(view);
//		$( "#productos_aprobados_por" ).buttonset(view);
//	    $( "#colores_aprobados" ).buttonset(view);
//	   	$( "#tintas_resistentes_a" ).buttonset(view);
	    
	   	if(!bole)
	   	{
	   		$("#item_sessiond :input").bind("focus", function(){$(this).blur();});
	   		$("#item_sessione :input").bind("focus", function(){$(this).blur();});
	   		$("#item_sessionc :input").bind("focus", function(){$(this).blur();});
	   		$("#item_sessiond input:radio").bind("click", function(){return false;});
	   		$("#item_sessiond input:checkbox").bind("click", function(){return false;});
	   	}
	   	else
	   	{
	   		$("#item_sessiond :input").unbind("focus"); 
	   		$("#item_sessione :input").unbind("focus"); 
	   		$("#item_sessionc :input").unbind("focus");
	   		$("#item_sessiond input:radio").unbind("click");
	   		$("#item_sessiond input:checkbox").unbind("click");
	   	}
}

function eventNotaaccesorios_seccion()
{
	var bole = $('#accesorios').attr('checked');
	var fade = (bole)? 1 : 0.5 ;
	
	  	$("#accesorios_seccion").fadeTo("slow",fade);
	  	
	  	if(!bole)
	  	{
	  		$("#accesorios_seccion :input").bind("focus", function(){$(this).blur();});
	  		$("#accesorios_seccion input:radio").bind("click", function(){return false;});
	   		$("#accesorios_seccion input:checkbox").bind("click", function(){return false;});
	  	}
	  	
	  	if(bole)
	  	{
	  		$("#accesorios_seccion :input").unbind("focus"); 
	  		$("#accesorios_seccion input:radio").unbind("click"); 
	   		$("#accesorios_seccion input:checkbox").unbind("click"); 
	  	}
}

function eventNotaesp_emb()
{
	var bole = $('#esp_emb').attr('checked');
	var fade = (bole)? 1 : 0.5 ;
	
	$("#esp_emb_seccion").fadeTo("slow",fade);
	
	if(!bole)
	{
		$("#esp_emb_seccion :input").bind("focus", function(){$(this).blur();});
		$("#esp_emb_seccion input:radio").bind("click", function(){return false;});
   		$("#esp_emb_seccion input:checkbox").bind("click", function(){return false;});
	}
	
	if(bole)
	{
		$("#esp_emb_seccion :input").unbind("focus"); 
		$("#esp_emb_seccion input:radio").unbind("click"); 
   		$("#esp_emb_seccion input:checkbox").unbind("click"); 
	}
}

function eventNotaesp_ext()
{
	var bole = $('#esp_ext').attr('checked');
	var fade = (bole)? 1 : 0.5 ;
	
	$("#esp_ext_seccion").fadeTo("slow",fade);
	
	if(!bole)
	{
		$("#esp_ext_seccion :input").bind("focus", function(){$(this).blur();});
		$("#esp_ext_seccion input:radio").bind("click", function(){return false;});
   		$("#esp_ext_seccion input:checkbox").bind("click", function(){return false;});
	}
	
	if(bole)
	{
		$("#esp_ext_seccion :input").unbind("focus"); 
		$("#esp_ext_seccion input:radio").unbind("click"); 
   		$("#esp_ext_seccion input:checkbox").unbind("click"); 
	}
}

function eventNotalaminacion_seccion()
{
	var bole = $('#laminacion').attr('checked');
	var fade = (bole)? 1 : 0.5 ;
	
	$("#laminacion_seccion").fadeTo("slow",fade);
	
	if(!bole)
	{
		$("#laminacion_seccion :input").bind("focus", function(){$(this).blur();});
		$("#laminacion_seccion input:radio").bind("click", function(){return false;});
   		$("#laminacion_seccion input:checkbox").bind("click", function(){return false;});
	}
	
	if(bole)
	{
		$("#laminacion_seccion :input").unbind("focus"); 
		$("#laminacion_seccion input:radio").unbind("click");
   		$("#laminacion_seccion input:checkbox").unbind("click");
	}
}

function eventNotadesarrollo_seccion()
{
	var bole = $('#desarrollo').attr('checked');
	var fade = (bole)? 1 : 0.5 ;
	
	$("#desarrollo_seccion").fadeTo("slow",fade);
	
	if(bole)
	{
		$("#desarrollo_seccion :input").bind("focus", function(){$(this).blur();});
		$("#desarrollo_seccion input:radio").bind("click", function(){return false;});
   		$("#desarrollo_seccion input:checkbox").bind("click", function(){return false;});
	}
	
	if(!bole)
	{
		$("#desarrollo_seccion :input").unbind("focus");
		$("#desarrollo_seccion input:radio").unbind("click");
   		$("#desarrollo_seccion input:checkbox").unbind("click");
	}
}

function eventNotaempaque_seccion()
{
	var bole = $('#empaque').attr('checked');
	var fade = (bole)? 1 : 0.5 ;
	
	$("#empaque_seccion").fadeTo("slow",fade);
	
	if(!bole)
	{
		$("#empaque_seccion :input").bind("focus", function(){$(this).blur();});
		$("#desarrollo_seccion input:radio").bind("click", function(){return false;});
   		$("#desarrollo_seccion input:checkbox").bind("click", function(){return false;});
	}
	
	if(bole)
	{
		$("#empaque_seccion :input").unbind("focus");
		$("#desarrollo_seccion input:radio").unbind("click");
   		$("#desarrollo_seccion input:checkbox").unbind("click");
	}
}



/*
 *@param 
 *idproducto : codigo del producto para cargar campos personalizados
 *@return
 */

function getTippro(idproducto)
{
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "cargaTipprocodigo.php", 	
		data: 'idproducto=' + idproducto,       
		success: function(JSONDATA){if(JSONDATA != '')getProducto(JSONDATA['tipprocodigo'],JSONDATA['produccodigo']);}                                    
	});
}

function getProducto (tipoproducto,idproducto)
{
	var producto;
	switch (tipoproducto)
	{
	case '1':
		producto = 'bolsaflowpack';
	break;
	case '2':
		producto = 'bolsalateral';
	break;
	case '3':
		producto = 'bolsapouchdoypack';
	break;
	case '4':
		producto = 'bolsapouchlateral';
	break;
	case '5':
		producto = 'capuchon';
	break;
	case '6':
		producto = 'lamina';
	break;
	}
	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.tabs/items/jquery." + producto + ".php", 	
		data: 'idproducto=' + idproducto,
		beforeSend: function(data){ },        
		success: function(requestData){
			if(requestData != '')
			{
				document.getElementById(producto).innerHTML = requestData;
			}
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
}

function openModal(){
	// fondo transparente
    // creamos un div nuevo, con dos atributos
    var bgdiv = $('<div>').attr({
                            className: 'bgtransparent',
                            id: 'bgtransparent'
                            });
    
    // agregamos nuevo div a la pagina
    $('body').append(bgdiv);
    
    // obtenemos ancho y alto de la ventana del explorer
    var wscr = $(window).width();
    var hscr = $(window).height();
    
    //establecemos las dimensiones del fondo
    $('#bgtransparent').css("width", wscr);
    $('#bgtransparent').css("height", hscr);
    
    
    // ventana modal
    // creamos otro div para la ventana modal y dos atributos
    var moddiv = $('<div>').attr({
                            className: 'bgmodal',
                            id: 'bgmodal'
                            });     
    
    // agregamos div a la pagina
    $('body').append(moddiv);

    // agregamos contenido HTML a la ventana modal
    $('#bgmodal').append('<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consultando...</b></p>&nbsp;&nbsp;&nbsp;<img align="center" src="../img/cargando.gif"></img>');
    
    // redimensionamos para que se ajuste al centro y mas
    $(window).resize();
}

function closeModal(){
	// removemos divs creados
	$('#bgmodal').remove();
	$('#bgtransparent').remove();
}

/*
function setPedido(pedido)
{
	if(pedido.cobolerror == 'error-free')
	{	
		
//		if(validarItem(pedido.cobolitem) === false)
		
		document.getElementById('pedvencodven').value = $.trim(pedido.cobolvencod);
		document.getElementById('lb_pedvencodven').innerHTML = $.trim(pedido.cobolvencod);
		
		document.getElementById('pedvenvendedor').value = $.trim(pedido.cobolvendedor);
		document.getElementById('lb_pedvenvendedor').innerHTML = $.trim(pedido.cobolvendedor);
		
		document.getElementById('pedvenfecent').value = toFecha($.trim(pedido.cobolfechaent));
		document.getElementById('produccoduno').value = $.trim(pedido.cobolitem);
		document.getElementById('lb_produccoduno').innerHTML = $.trim(pedido.cobolitem);
		document.getElementById('pedvendiapac').value = $.trim(pedido.coboldiaspact);
		document.getElementById('clientcodigo').value = $.trim(pedido.cobolnit);
		document.getElementById('clientnombre').value = $.trim(pedido.cobolrazon);
		document.getElementById('lb_clientnombre').innerHTML = $.trim(pedido.cobolrazon);
		document.getElementById('producnombre').value = $.trim(pedido.cobolnompro);
		document.getElementById('lb_producnombre').innerHTML = $.trim(pedido.cobolnompro);
		document.getElementById('pedvenobserv').value = $.trim(pedido.cobolnota);
		document.getElementById('ordcomnumero').value = $.trim(pedido.cobolordencompra);
		document.getElementById('pedvenfecelb').value = toFecha($.trim(pedido.cobolfechaped));
		if(document.getElementById('tipevecodigo').value != 3 && document.getElementById('tipevecodigo').value != 2)
		{
			document.getElementById('cant').value = Math.round($.trim(pedido.cobolcantid) * 10) / 10;
			document.getElementById('cant_lb').innerHTML = Math.round($.trim(pedido.cobolcantid) * 10) / 10;
			document.getElementById('unimedi').value = $.trim(pedido.cobolunimed);
			document.getElementById('unimedi_lb').innerHTML = $.trim(pedido.cobolunimed);
		}else
		{
			document.getElementById('cant_rep').value = Math.round($.trim(pedido.cobolcantid) * 10) / 10;
			document.getElementById('unimedi_rep').value = $.trim(pedido.cobolunimed);
			var arrtabla = document.getElementById('arrtabla1');
			if(arrtabla)arrtabla.value = '';
			document.getElementById('flagrepeticion').value = 1;
			document.form1.submit();
			eventDisabledTab();
		}
	}
	else
	{
		document.getElementById('msg').innerHTML = 'Advertencia: Pedido de venta no encontrado.<br> Error: ' + pedido.cobolerror;
		$("#msgwindow").dialog("open");
		document.getElementById('pedvenfecent').value = '';
		document.getElementById('produccoduno').value = '';
		document.getElementById('lb_produccoduno').innerHTML = '[NINGUNO]';
		document.getElementById('pedvendiapac').value = '';
		document.getElementById('clientcodigo').value = '';
		document.getElementById('clientnombre').value = '';
		document.getElementById('lb_clientnombre').innerHTML = '[NINGUNO]';
		document.getElementById('producnombre').value = '';
		document.getElementById('lb_producnombre').innerHTML = '[NINGUNO]';
		document.getElementById('pedvenobserv').value = '';
		document.getElementById('ordcomnumero').value = '';
		document.getElementById('pedvenfecrec').value = '';
		document.getElementById('cant').value = '';
		document.getElementById('cant_lb').innerHTML = '[NINGUNO]';
		document.getElementById('unimedi').value = '';
		document.getElementById('unimedi_lb').innerHTML = '[NINGUNO]';
	}
}
*/

function setPedido(pedido)
{
	document.getElementById('pedvencodven').value = $.trim(pedido.pedvencodven);
	//document.getElementById('lb_pedvencodven').innerHTML = $.trim(pedido.cobolvencod);
	document.getElementById('pedvenvendedor').value = $.trim(pedido.pedvenvendedor);
	//document.getElementById('lb_pedvenvendedor').innerHTML = $.trim(pedido.cobolvendedor);
	document.getElementById('pedvenfecent').value = toFecha($.trim(pedido.pedvenfecrec));
	document.getElementById('pedvennumero').value = $.trim(pedido.pedvennumero);
	document.getElementById('produccoduno').value = $.trim(pedido.produccoduno);
	//document.getElementById('lb_produccoduno').innerHTML = $.trim(pedido.cobolitem);
	document.getElementById('pedvendiapac').value = $.trim(pedido.coboldiaspact);
	document.getElementById('clientcodigo').value = $.trim(pedido.cobolnit);
	document.getElementById('clientnombre').value = $.trim(pedido.cobolrazon);
	//document.getElementById('lb_clientnombre').innerHTML = $.trim(pedido.cobolrazon);
	document.getElementById('producnombre').value = $.trim(pedido.producnombre);
	//document.getElementById('lb_producnombre').innerHTML = $.trim(pedido.cobolnompro);
	document.getElementById('pedvenobserv').value = $.trim(pedido.cobolnota);
	document.getElementById('ordcomnumero').value = $.trim(pedido.cobolordencompra);
	document.getElementById('pedvenfecelb').value = toFecha($.trim(pedido.cobolfechaped));
	if(document.getElementById('tipevecodigo').value != 3 && document.getElementById('tipevecodigo').value != 2)
	{
		document.getElementById('cant').value = Math.round($.trim(pedido.cobolcantid) * 10) / 10;
		document.getElementById('cant_lb').innerHTML = Math.round($.trim(pedido.cobolcantid) * 10) / 10;
		document.getElementById('unimedi').value = $.trim(pedido.cobolunimed);
		document.getElementById('unimedi_lb').innerHTML = $.trim(pedido.cobolunimed);
		document.getElementById('flagnuevoitemintegracion').value = 1;
		document.form1.submit();
	}
	else
	{
		document.getElementById('cant_rep').value = Math.round($.trim(pedido.cobolcantid) * 10) / 10;
		document.getElementById('unimedi_rep').value = $.trim(pedido.cobolunimed);
		var arrtabla = document.getElementById('arrtabla1');
		if(arrtabla)arrtabla.value = '';
		document.getElementById('flagrepeticion').value = 1;
		document.form1.submit();
		eventDisabledTab();
	}
}

function helpcampnomb()
{
	$("#msgerror").dialog("open");
}

function toFecha(fecha)
{
	var anio=String(fecha).substring(0,4); //año
	var mes= String(fecha).substring(4,6); //mes
	var dia= String(fecha).substring(6,8); //dia

	return (anio + '-' + mes + '-' + dia);
}

function validarPedido(pedido)
{
	//objetos a utilizar
	
	/*var obj_tipevecodigo = document.getElementById('tipevecodigo');
	//valor de los objetos
	var tipevecodigo = (obj_tipevecodigo)? obj_tipevecodigo.value : '' ;
	if(pedido.cobolerror == 'error-free')
	{	*/
		//si pedido nuevo validar si existe si no poner pedido setPedido()
		if(tipevecodigo == 1 || tipevecodigo == '')
		{
			validarItem(pedido,$.trim(pedido.cobolitem));
		}
		else
		{
			setPedido(pedido);
		}
	//}
	/*else
	{
		document.getElementById('msg').innerHTML = 'Advertencia: Pedido de venta no encontrado.<br> Error: ' + pedido.cobolerror + '.<br> <font color="red"> Mensaje:' + pedido.cobolmensaje + '</font>';
		$("#msgwindow").dialog("open");
		limpiarFomulario();
	}*/
}

function limpiarFomulario()
{
	document.getElementById('pedvenfecent').value = '';
	document.getElementById('produccoduno').value = '';
	//document.getElementById('lb_produccoduno').innerHTML = '[NINGUNO]';
	document.getElementById('pedvendiapac').value = '';
	document.getElementById('clientcodigo').value = '';
	document.getElementById('clientnombre').value = '';
	//document.getElementById('lb_clientnombre').innerHTML = '[NINGUNO]';
	document.getElementById('producnombre').value = '';
	//document.getElementById('lb_producnombre').innerHTML = '[NINGUNO]';
	document.getElementById('pedvenobserv').value = '';
	document.getElementById('ordcomnumero').value = '';
	document.getElementById('pedvenfecrec').value = '';
	//document.getElementById('cant').value = '';
	//document.getElementById('cant_lb').innerHTML = '[NINGUNO]';
	//document.getElementById('unimedi').value = '';
	//document.getElementById('unimedi_lb').innerHTML = '[NINGUNO]';
}

//funcion para validar si el pedido se encuentra en el sistema uno 
function validarItem(json_pedido,produccoduno)
{	
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_validaproducto.php", 	
		data: 'produccoduno=' + produccoduno,
		success: function(json_data){
			if(json_data.accion > 0)
			{
				if(json_data.bandera <= 0)
				{
					setPedido(json_pedido);
				}
				else
				{
					document.getElementById('msg').innerHTML = 'Advertencia: Item ' + produccoduno + ' se encuentra registrado.<br> Ingresar pv {repeticion - modificacion}';
					$("#msgwindow").dialog("open");
					limpiarFomulario();
				}
			}
			else
			{
				document.getElementById('msg').innerHTML = 'Advertencia: Error inesperado.<br> Error: unexpected_error';
				$("#msgwindow").dialog("open");
				limpiarFomulario();
			}
		}
	});
}

function loadHTMLUpload(codeot)
{
	if(document.getElementById('uploadocumen').value != '')
	{
		var file = document.getElementById('uploadocumen').value.split('::');
		var filesize = document.getElementById('uploadocumensize').value.split('::');
		var session = '';

		
		for(var i=0; i < file.length; i++)
			session += '<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload(' + i + ');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName">' + file[i] + ' (' + filesize[i] + ')</span></div>';

		document.getElementById('reportot_file_load').innerHTML = session;
	}
	else
	{
		document.getElementById('reportot_file_load').innerHTML = '';
	}
}

function deleteFileUpload(index)
{
	var file = document.getElementById('uploadocumen').value.split('::');
	var filesize = document.getElementById('uploadocumensize').value.split('::');
	
	accionDeleteFileNormal('../doc/upload/documentos/' + file[index]);

	document.getElementById('uploadocumen').value = '';
	document.getElementById('uploadocumensize').value = '';
	
	for(var i=0; i < file.length; i++)
	{
		if(i != index)
		{
			if(document.getElementById('uploadocumen').value != '')
			{
				document.getElementById('uploadocumen').value = document.getElementById('uploadocumen').value + '::' + file[i];
				document.getElementById('uploadocumensize').value = document.getElementById('uploadocumensize').value + '::' + filesize[i];
			}
			else
			{
				document.getElementById('uploadocumen').value = file[i];
				document.getElementById('uploadocumensize').value = filesize[i];
			}
		}
	}

	loadHTMLUpload();
}




function validarEnteroFloat(cadena){
	//intento convertir a entero. 
    //si era un entero no le afecta, si no lo era lo intenta convertir 
	var cad = cadena.value;
	cad = parseInt(cad);

 	//Compruebo si es un valor numérico 
 	if (isNaN(cad)) { 
       	 //entonces (no es numero) compruebo si es float 
     	return false;	
 	}else{
 		cad = cadena.value;
 		cad = parseFloat(cad);
 		//Compruebo si es un valor numérico 
     	if (isNaN(cad)) { 
           	 //entonces (no es float) devuelvo el valor cadena vacia 
     		return false;
     	}else{
     		//entonces (si es float)
     		cad.replace(",",".");
     		alert(cad);
     		cadena.value = cad;
     		return true;
     	}
     	
 		return true;
 	}
 	
}





$(document).ready(function() {
	/**
	 * Carga de Archivos (Ordenes de Compra)
	 */
	$("#adoc_file_upload").uploadify({
		'uploader': 'temas/upload/uploadify.swf',
		'cancelImg': 'temas/upload/cancel.png',
		'script': 'uploadify.php',
		'folder': '/doc/upload/oc/',
		'buttonImg': 'temas/upload/button_onload.png',
		'multi' : false,
		'auto' : true,
		'fileExt' : '*.doc;*.docx;*.pdf;*.jpeg;*.bmp;*.jpg;*.gif;*.png;*.msg;*.xls;*.xlsx;',
		'fileDesc' : 'All Files (.doc, .docx, .pdf, .jpeg, .bmp, .jpg, .gif, .png, .msg, .xls, .xlsx)',
		'queueID' : 'adoc_custom-queue',
		'removeCompleted': true,
		'onComplete' : function(event, ID, fileObj, response, data) {
			//======= Print Up file in html and save in hidden input ====					
			var l = Math.round(fileObj.size/1024*100)*0.01;
			var m = " Kb";

			if(l>1000)
			{
				l = Math.round(l*0.001*100)*0.01;
				m = " Mb";
			}
			//======= Print Up file in html ====						
		}
	});

	/**
	 * Carga de Archivos (Documentos Adjuntos)
	 */
	$("#addocumento_file_upload").uploadify({
		'uploader': 'temas/upload/uploadify.swf',
		'cancelImg': 'temas/upload/cancel.png',
		'script': 'uploadify.php',
		'folder': '/doc/upload/documentos/',
		'buttonImg': 'temas/upload/button_onload.png',
		'multi' : false,
		'auto' : true,
		'fileExt' : '*.doc;*.docx;*.pdf;*.jpeg;*.bmp;*.jpg;*.gif;*.png;*.msg;*.xls;*.xlsx;',
		'fileDesc' : 'All Files (.doc, .docx, .pdf, .jpeg, .bmp, .jpg, .gif, .png, .msg, .xls, .xlsx)',
		'queueID' : 'addocumento_custom-queue',
		'removeCompleted': true,
		'onComplete' : function(event, ID, fileObj, response, data) {
			//======= Print Up file in html and save in hidden input ====					
			var l = Math.round(fileObj.size/1024*100)*0.01;
			var m = " Kb";
			
			if(l>1000)
			{
				l = Math.round(l*0.001*100)*0.01;
				m = " Mb";
			}
			//======= Print Up file in html ====						
		}
	});
	
	
	$("#reportot_file_upload").uploadify({
		'uploader': 'temas/upload/uploadify.swf',
		'cancelImg': 'temas/upload/cancel.png',
		'script': 'uploadify.php',
		'folder': '/doc/upload/documentos/',
		'buttonImg': 'temas/upload/button_onload.png',
		'multi' : false,
		'auto' : true,
		'fileExt' : '*.doc;*.docx;*.pdf;*.jpeg;*.bmp;*.jpg;*.gif;*.png;*.txt;*.msg;*.xls;*.xlsx;',
		'fileDesc' : 'All Files (.doc, .docx, .pdf, .jpeg, .bmp, .jpg, .gif, .png, .txt, .msg, .xls, .xlsx)',
		'queueID' : 'reportot_custom-queue',
		'queueSizeLimit' : 3,
		'simUploadLimit' : 3,
		'removeCompleted': true,
		'onComplete' : function(event, ID, fileObj, response, data) {			
			var file = document.getElementById('uploadocumen');
			var filesize = document.getElementById('uploadocumensize');
			var l = Math.round(fileObj.size/1024*100)*0.01;
			var m = " Kb";

			if(l > 1000)
			{
				l = Math.round(l*0.001*100)*0.01;
				m = " Mb";
			}

			if(file.value != '')
			{
				file.value = file.value + '::' + fileObj.name;
				filesize.value = filesize.value + '::' + l + m;
			}
			else
			{
				file.value = fileObj.name;
				filesize.value = l + m;
			}

			loadHTMLUpload();
		}
	});

	
});
