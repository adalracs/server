$(function(){
	///tabs item

	scanAlarma();

	$("#tabitems").tabs({});
	//ObjSeleccion
	$( "#productos_aprobados_por" ).buttonset();
	$( "#colores_aprobados" ).buttonset();
	$( "#tintas_resistentes_a" ).buttonset();
	//mensaje de error
	$( "#msgerror" ).dialog({
		autoOpen: false,
		width: 250,
		show: "blind",
		hide: "explode"
	});
	$("#formulnumero").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/dispensing/jquery.atcformula.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('formulcodigo').value = ui.item.id;
			}
			else
			{
				document.getElementById('formulnumero').value = "";
				document.getElementById('formulcodigo').value = ""; 
			}
		}
	});
	//autocompletar de material para estructura
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
	//autocompletar de material para cajas
	$("#caja_item").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/fichatecnica/jquery.atc_cajas.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('cod_caja').value = ui.item.id;
			}
			else
			{
				document.getElementById('cod_caja').value = '';
			}
		}
	});
	//autocompletar de material para estibas
	$("#estiba_item").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/fichatecnica/jquery.atc_estibas.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('cod_estiba').value = ui.item.id;
			}
			else
			{
				document.getElementById('cod_estiba').value = '';
			}
		}
	});
	//autocompletar de material para estibas
	$("#valve_item").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/fichatecnica/jquery.atc_valve.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('cod_valve').value = ui.item.id;
			}
			else
			{
				document.getElementById('cod_valve').value = '';
			}
		}
	});
	//autocompletar de material para forma de empaque Carton - Extremos
	$("#empa_item_suspendido").autocomplete({
		source: function (request, response){
			$.ajax({
					url: "../src/FunjQuery/jquery.phpcombobox/fichatecnica/jquery.atc_item_linea.php",
					dataType: "json" ,
					data: {
						term : request.term,
						form_empa : document.getElementById('form_empa').value
					},
					success: function (data)
					{
						response(data);
					}
			});
		},
		minLengt: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('cod_empa_suspendido').value = ui.item.id;
			}
			else
			{
				document.getElementById('cod_empa_suspendido').value = '';
			}
		}
	});
	//autocompletar de material para forma de empaque
	$("#empa_item_carton_extremos").autocomplete({
		source: function (request, response){
		$.ajax({
			url: "../src/FunjQuery/jquery.phpcombobox/fichatecnica/jquery.atc_item_linea.php",
			dataType: "json" ,
			data: {
			term : request.term,
			form_empa : document.getElementById('form_empa').value
		},
		success: function (data)
		{
			response(data);
		}
		});
	},
	minLengt: 0,
	select: function(event, ui) {
		if(ui.item)
		{
			document.getElementById('cod_empa_carton_extremos').value = ui.item.id;
		}
		else
		{
			document.getElementById('cod_empa_carton_extremos').value = '';
		}
	}
	});

	if( $("#tipembnombre") ){
		//autocompletar para tipos de embobinados
		$( "#tipembnombre" ).autocomplete({
	        minLength: 0,
	        source: "../src/FunjQuery/jquery.phpcombobox/fichatecnica/jquery.atc_embobinados.php",
	        focus: function( event, ui ) {
	            $( "#tipembnombre" ).val( ui.item.label );
	            return false;
	        },
	        select: function( event, ui ) {
	        	if(ui.item)
	    		{
	    			document.getElementById('tipembcodigo').value = ui.item.id;
	    			document.getElementById('tipembnombre').value = ui.item.value;
	    			document.getElementById('embobinado_icon').value = ui.item.icon;
	    			$( "#embobinado-icon" ).attr( "src", "../img/pics_embobinados//" + ui.item.icon );
	    		}
	    		else
	    		{
	    			document.getElementById('tipembcodigo').value = '';
	    			document.getElementById('tipembnombre').value = ui.item.value;
	    			document.getElementById('embobinado_icon').value = "transparent_1x1.png";
	    			$( "#embobinado-icon" ).attr( "src", "../img/pics_embobinados/transparent_1x1.png" );
	    		}
	            return false;
	        }
	    });
/*
	    .data( "autocomplete" )._renderItem = function( ul, item ) {
	        return $( "<li>" )
	            .data( "item.autocomplete", item )
	            .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
	            .appendTo( ul );
	    };*/
	}
	
	$('#ingresarcolor').button().click(function() {
		//objetos a utilizar
		var obj_arrdispensing = document.getElementById('arrdispensing');
		var obj_formulcodigo = document.getElementById('formulcodigo');
		var obj_formulnumero = document.getElementById('formulnumero');
		var obj_index = document.getElementById('indexarrdispensing');
		
		//valor de los objetos
		var arrdispensing = (obj_arrdispensing.value)? obj_arrdispensing.value.split(':|:'): '' ;
		var formulcodigo = (obj_formulcodigo.value)? obj_formulcodigo.value : '' ;
		var formulnumero = (obj_formulnumero.value)? obj_formulnumero.value : '' ;
		var index = (obj_index.value)? obj_index.value : '';
		
		//validacion de error
		var err = '';
		
		if(formulcodigo == '' || formulnumero == '')
			err = err + 'Advertencia : *** Debe seleccionar color.' + '<br>';

		if(index == '')
			err = err + 'Advertencia : *** Error inesperado.' + '<br>';
		
		//evento de boton
		if(err == '')
		{
			//concatenar registros formando un array separados por comodin ':-:'
			var newRow = ( Number(index) + 1 ) + ':-:' + formulcodigo;
			//concatena los array separados por comodin :|:
			loadArraylist(newRow, 'arrdispensing', ':|:');
			//almacena indice actual de registros 
			obj_index.value = Number(index) + 1;
			//evento de recargar los datos en el visor
			accionReloadListDispensing();
		}else{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		
		//limpiar objetos
		obj_formulcodigo.value = '';
		obj_formulnumero.value = '';
		
		return false;
	});
	
	$('#quitarcolor').button().click(function() {
		//elimina registro seleccionado para eliminar
		loadArraylistdelete('arrdispensing', ':|:');
		//evento de recargar los datos en el visor
		accionReloadListDispensing();
		return false;
	});
	//boton ingresar materiales a la estructura
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
					var arrColumn = arrTabla[a].split(':-:');
					
					if(document.getElementById('ext').value == '0' && arrColumn[4] == 't')
						document.getElementById('ext').value = '1';
				}
					
				if(enc != true)
				{
					loadArraylist(newRow, 'arrtabla1', ':|:');
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
	//boton quitar estructura
	$('#quitarestructura').button().click(function() {
		loadArraylistdelete('arrtabla1', ':|:');
		accionReloadListEstructura();
		//validar los tabs
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
	//funcio que recarga el visor de colores
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
	//funcion que recarga el visor de la estructura
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

//funcion de tipo de impresio dependiendo de cada tipo de producto
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
	//funcion dependiendo de la estructura valida los tabs y la cantidad de materiales a asignar
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
//valida la estructura
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

//evento material estibado
function eventMaterialEstibado(value)
{
	(value == 1) ? document.getElementById('session_estibado').style.display = 'block' : document.getElementById('session_estibado').style.display = 'none';
}
//evento aplicacion
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
//evento troquel
function eventTroquel(value)
{
	(value == 1) ? document.getElementById('session_tipotroquel').style.display = 'block' : document.getElementById('session_tipotroquel').style.display = 'none';
}
//evento bandera
function eventBandera(value)
{
	(value == 1) ? document.getElementById('session_bandera').style.display = 'block' : document.getElementById('session_bandera').style.display = 'none';
}
//evento material a imprimir
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
//evento tipo de apertura
function eventTipoapertura(value)
{
	if(document.getElementById('session_tipoapertura') != null)
		(value == '') ? document.getElementById('session_tipoapertura').style.display = 'block' : document.getElementById('session_tipoapertura').style.display = 'none';
}
//evento tipo valvula
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
//evento peso millar
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
//evento peso millar capuchon
function eventPesomillarCapuchon()
{
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
	suma = area * totalgramaje;
	
	
	var redondiado = Math.round(suma * 100)/100;
	document.getElementById('pesomillar').innerHTML = redondiado;
}
//evento color de la pelicula extruida
function accionColorPelicula(value)
{
	if(document.getElementById('color'))
	{
		document.getElementById('color').value = value;
	}
}
//evento ocultar pallet
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
//evento ocultar altura de pallet
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
//evento metros por rollo
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
//evento peso del rollo
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
//evento diametro del rollo
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
//evento para ocultar tratamiento
function eventOcultaTratamiento(value,index)
{
	var tipoimpresion = document.getElementById('tipo_impresion');
	var impresion = (tipoimpresion.value)? tipoimpresion.value : 0 ;
	
	if(value == 'na')
	{
		document.getElementById('trata_min_lb_' + index).style.display = 'none';
		document.getElementById('trata_min_obj_' + index).style.display = 'none';
		document.getElementById('trata_max_lb_' + index).style.display = 'none';
		document.getElementById('trata_max_obj_' + index).style.display = 'none';
		document.getElementById('ncaras_trata_lb_' + index).style.display = 'none';
		document.getElementById('ncaras_trata_obj_' + index).style.display = 'none';
	}
	if(value == 'interno' || value == 'externo')
	{
		document.getElementById('trata_min_lb_' + index).style.display = 'block';
		document.getElementById('trata_min_obj_' + index).style.display = 'block';
		document.getElementById('trata_max_lb_' + index).style.display = 'block';
		document.getElementById('trata_max_obj_' + index).style.display = 'block';
		document.getElementById('ncaras_trata_lb_' + index).style.display = 'block';
		document.getElementById('ncaras_trata_obj_' + index).style.display = 'block';
	}
}
//evento para ocultar valvula de las bolsas
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
//evento para material sellable
function eventOcultaMaterialsellable(value,index)
{
	var producto = document.getElementById('tipitecodigo');
	/*
	if(producto.value != 6)
		return false;
	*/
		
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
//evento tipo de cierre
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
//evento tipo de apertura
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
//evento numero maximo de empalmes
function eventMaxempalmes(value)
{
	if(Number(value) <= 0)
	{
		document.getElementById('ancho_empal').value = 'NA';
		document.getElementById('cempal_cara').value = 'NA';
		document.getElementById('cempal_dorso').value = 'NA';
	}
	else
	{
		document.getElementById('ancho_empal').value = '';
		document.getElementById('cempal_cara').value = '';
		document.getElementById('cempal_dorso').value = '';
	}
}
//evento oculta distacion de perforado
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
//evento ocultar macroperforaciones
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
//evento ocultar microperforaciones
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
//evento ocultar tolerancias
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
//evento forma de empaque
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
	$("#pro_core_diam_caja").val('');
	$("#pro_core_diam_bolsa_plastica").val('');
	$("#pro_core_diam_carton_extremos").val('');
	$("#pro_core_diam_cubierto_extremos").val('');
	$("#cod_empa_suspendido").val('');
	$("#cod_empa_carton_extremos").val('');
	$("#empa_item_suspendido").val('');
	$("#empa_item_carton_extremos").val('');
	$("#cod_caja").val('');
	$("#caja_item").val('');
}
//evento para deshablitar tabs
function eventDisabledTab()
{
	var tribTabs = new Array();
	
	if(document.getElementById('lmn').value == '0')
		(document.getElementById('tipitecodigo').value == '6') ? tribTabs[0] = 4 : tribTabs[0] = 4;
	
	if(document.getElementById('ext').value == '0')
		(document.getElementById('tipitecodigo').value == '6') ? tribTabs[1] = 3 : tribTabs[1] = 3;
	
	$( "#tabitems" ).tabs( "option", "disabled", tribTabs );
	document.getElementById('arrTabs').value = tribTabs;
}
//evento para ocultar impresion
function eventPapelpouch_imp(papelpouch)
{
	//objetos a utilizar
	var obj_papel_pouch_imp = document.getElementsByName('papel_pouch_imppor');
	var label_papel_pouch_imp = document.getElementById('lb_papel_pouch_imppor');
	var lbobj_papel_pouch_imp = document.getElementById('obj_papel_pouch_imppor');
	var display = 'none';
	if(papelpouch == 'si')
		display = 'block'
	else 
		if(obj_papel_pouch_imp)
		{
			obj_papel_pouch_imp[0].checked = false;
			obj_papel_pouch_imp[1].checked = false;
		}
	
	if(label_papel_pouch_imp)
		label_papel_pouch_imp.style.display = display;
	
	if(lbobj_papel_pouch_imp)
		lbobj_papel_pouch_imp.style.display = display;
	
}
//lamina papel pouch por
function eventPapelpouch_lam(papelpouch)
{
	//objetos a utilizar
	var obj_papel_pouch_lam = document.getElementsByName('papel_pouch_lampor');
	var label_papel_pouch_lam = document.getElementById('lb_papel_pouch_lampor');
	var lbobj_papel_pouch_lam= document.getElementById('obj_papel_pouch_lampor');
	var display = 'none';
	if(papelpouch == 'si')
		display = 'block'
			else 
				if(obj_papel_pouch_lam)
				{
					obj_papel_pouch_lam[0].checked = false;
					obj_papel_pouch_lam[1].checked = false;
				}
	
	if(label_papel_pouch_lam)
		label_papel_pouch_lam.style.display = display;
	
	if(lbobj_papel_pouch_lam)
		lbobj_papel_pouch_lam.style.display = display;
	
}
//evento foil impreso por
function eventFoil_imp(foil)
{
	//objetos a utilizar
	var obj_foil_imp = document.getElementsByName('foil_imppor');
	var label_foil_imp = document.getElementById('lb_foil_imppor');
	var lbobj_foil_imp = document.getElementById('obj_foil_imppor');
	var display = 'none';
	
	if(foil == 'si')
		display = 'block'
	else 
		if(obj_foil_imp)
		{
			obj_foil_imp[0].checked = false;
			obj_foil_imp[1].checked = false;
		}
	
	if(label_foil_imp)
		label_foil_imp.style.display = display;
	
	if(lbobj_foil_imp)
		lbobj_foil_imp.style.display = display;
	
}
//evento foil laminado por
function eventFoil_lam(foil)
{
	//objetos a utilizar
	var obj_foil_lam = document.getElementsByName('foil_lampor');
	var label_foil_lam = document.getElementById('lb_foil_lampor');
	var lbobj_foil_lam = document.getElementById('obj_foil_lampor');
	var display = 'none';
	
	if(foil == 'si')
		display = 'block'
			else 
				if(obj_foil_lam)
				{
					obj_foil_lam[0].checked = false;
					obj_foil_lam[1].checked = false;
				}
	
	if(label_foil_lam)
		label_foil_lam.style.display = display;
	
	if(lbobj_foil_lam)
		lbobj_foil_lam.style.display = display;
	
}
//evento para calcular rodillo
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
//evento para continuo
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
//evento para codigo de item caja
function eventCaja(valor)
{
	//objetos a utilizar
	var obj_cod_caja = document.getElementById('cod_caja');
	var obj_caja_item = document.getElementById('caja_item');
	var obj_cod_caja_lb = document.getElementById('cod_caja_lb');
	var obj_cod_caja_obj = document.getElementById('cod_caja_obj');
	//validacion de evento
	if(valor == 'caja')
	{
		//accion del evento
		obj_cod_caja_lb.style.display = 'block';
		obj_cod_caja_obj.style.display = 'block';
	}
	else
	{
		//accion del evento
		obj_cod_caja_lb.style.display = 'none';
		obj_cod_caja_obj.style.display = 'none';
		if(obj_cod_caja)
			obj_cod_caja.value = '';
		if(obj_caja_item)
			obj_caja_item.value = '';
	}
}
//evento doblado 
function eventDoblado(valor)
{
	//objetos a utilizar
	var obj_note_doblado = document.getElementById('note_doblado');
	var obj_note_doblado_lb = document.getElementById('note_doblado_lb');
	var obj_note_doblado_obj = document.getElementById('note_doblado_obj');
	//validacion de evento
	if(valor == 'si')
	{
		//accion del evento
		obj_note_doblado_lb.style.display = 'block';
		obj_note_doblado_obj.style.display = 'block';
	}
	else
	{
		//accion del evento
		obj_note_doblado_lb.style.display = 'none';
		obj_note_doblado_obj.style.display = 'none';
		if(obj_note_doblado)
			obj_note_doblado.value = '';
	}
	
}
//evento micro  
function eventMicro(valor)
{
	//objetos a utilizar
	//tipo microperforaciones
	var obj_mcr_tipo_perforacion = document.getElementById('mcr_tipo_perforacion');
	var obj_mcr_tipo_perforacion_lb = document.getElementById('mcr_tipo_perforacion_lb');
	var obj_mcr_tipo_perforacion_obj = document.getElementById('mcr_tipo_perforacion_obj');
	//numero de caras microperforadas
	var obj_mrc_cant_cara_microper = document.getElementById('mrc_cant_cara_microper');
	var obj_mrc_cant_cara_microper_lb = document.getElementById('mrc_cant_cara_microper_lb');
	var obj_mrc_cant_cara_microper_obj = document.getElementById('mrc_cant_cara_microper_obj');
	//notas de microperdoracion
	var obj_note_micro = document.getElementById('note_micro');
	var obj_note_micro_lb = document.getElementById('note_micro_lb');
	var obj_note_micro_obj = document.getElementById('note_micro_obj');
	//validacion de evento
	if(valor == 'si')
	{
		//accion del evento
		obj_mcr_tipo_perforacion_lb.style.display = 'block';
		obj_mrc_cant_cara_microper_lb.style.display = 'block';
		obj_note_micro_lb.style.display = 'block';
		obj_mcr_tipo_perforacion_obj.style.display = 'block';
		obj_mrc_cant_cara_microper_obj.style.display = 'block';
		obj_note_micro_obj.style.display = 'block';
	}
	else
	{
		//accion del evento
		obj_mcr_tipo_perforacion_lb.style.display = 'none';
		obj_mrc_cant_cara_microper_lb.style.display = 'none';
		obj_note_micro_lb.style.display = 'none';
		obj_mcr_tipo_perforacion_obj.style.display = 'none';
		obj_mrc_cant_cara_microper_obj.style.display = 'none';
		obj_note_micro_obj.style.display = 'none';
		if(obj_mcr_tipo_perforacion)
			obj_mcr_tipo_perforacion.value = '';
		if(obj_mrc_cant_cara_microper)
			obj_mrc_cant_cara_microper.value = '';
		if(obj_note_micro)
			obj_note_micro.value = '';
	}
	
}
//evento protector de core 
function eventProtector_core(valor,forma_empa)
{
	//validacion para formas de empaque
	if(forma_empa != 'caja' && forma_empa != 'bolsa_plastica' && forma_empa != 'carton_extremos' && forma_empa != 'cubierto_extremos')
		return false;
	//variables para objetos a utilizar
	var objs_pro_core_diam = 'pro_core_diam_' + forma_empa;
	var objs_pro_core_diam_lb = forma_empa + '_pro_core_diam_lb';
	var objs_pro_core_diam_obj = forma_empa + '_pro_core_diam_obj';
	//objetos a utilizar
	var obj_pro_core_diam = document.getElementById(objs_pro_core_diam);
	var obj_pro_core_diam_lb = document.getElementById(objs_pro_core_diam_lb);
	var obj_pro_core_diam_obj = document.getElementById(objs_pro_core_diam_obj);
	//validacion de evento
	if(valor == 'si')
	{
		//accion del evento
		if(obj_pro_core_diam_lb)
			obj_pro_core_diam_lb.style.display = 'block';
		if(obj_pro_core_diam_obj)
			obj_pro_core_diam_obj.style.display = 'block';
	}
	else
	{
		//accion del evento
		if(obj_pro_core_diam_lb)
			obj_pro_core_diam_lb.style.display = 'none';
		if(obj_pro_core_diam_obj)
			obj_pro_core_diam_obj.style.display = 'none';
		if(obj_pro_core_diam)
			obj_pro_core_diam.value = '';
	}
	
}
//abre ventana con mensaje de campos con error
function helpcampnomb()
{
	$("#msgerror").dialog("open");
}
//autocomplete de formulacion
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
//abre el detalle de la formulacion
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

function accionReloadListDispensing()
{	
	//objetos a utilizar 
	var obj_arrdispensing = document.getElementById('arrdispensing');
	var obj_indexarrdispensing = document.getElementById('indexarrdispensing');
	
	//valor de los objetos
	var arrdispensing = (obj_arrdispensing.value)? obj_arrdispensing.value : '' ;
	var indexarrdispensing = (obj_indexarrdispensing.value)? obj_indexarrdispensing.value : '' ;
	var arrObjs = (obj_arrdispensing.value)? obj_arrdispensing.value.split(':|:') : '' ;
	
	//parametros de envio 
	var parameters;
	parameters = (arrdispensing != '')? 'arrdispensing=' + arrdispensing : 'arrdispensing=';
	parameters += (indexarrdispensing != '')? '&indexarrdispensing=' + indexarrdispensing : '&indexarrdispensing=';
	
	for(var i=0;i<arrObjs.length;i++)
	{
		var arr = arrObjs[i].split(':-:');
		//variables objetos adicionales
		var objs_anilox = 'anilox_' + arr[1];
		var objs_grupo = 'grupo_' + arr[1];
		// objetos adicionales
		var obj_anilox = document.getElementById(objs_anilox);
		var obj_grupo = document.getElementById(objs_grupo);
		//valor de los objetos adicionales
		var anilox = (obj_anilox)? obj_anilox.value : '' ;
		var grupo = (obj_grupo)? obj_grupo.value : '' ;
		//adicionar parametros adicional
		parameters += (anilox != '')? '&' + objs_anilox + '=' + anilox : '&' + objs_anilox + '=';
		parameters += (grupo != '')? '&' + objs_grupo + '=' + grupo : '&' + objs_grupo + '=';
	}
	//evento ajax 
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.dispensing.php", 	
		data: parameters,
		beforeSend: function(data){ 
			$('#filtrlistacolores').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan los colores.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
			{
				document.getElementById('filtrlistacolores').innerHTML = requestData;
			}
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ 
			$('#filtrlistacolores').unblock();
		}                                      
	});
}

function validaEntero(objeto,value)
{	
	//validacion
	if(!/^([0-9])*$/.test(value))
	{
		objeto.value = '';
		document.getElementById('msg').innerHTML = 'Advertencia : *** Ingresar valores enteros.';
		$("#msgwindow").dialog("open");
	}
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

