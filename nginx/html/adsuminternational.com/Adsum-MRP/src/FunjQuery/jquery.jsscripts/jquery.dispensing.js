$(function(){
//Campos Formulario

	scanAlarma();
	
	$("#tabitems").tabs({});
	
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
	
	$("#itedesnombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/dispensing/jquery.atcvistaitemdispe.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('itedescodigo').value = ui.item.id;
			}
			else
			{
				document.getElementById('itedescodigo').value = "";
				document.getElementById('itedesnombre').value = ""; 
			}
		}
	});
	
	$('#ingresaritem').button().click(function() {
		//objetos a utilizar
		var obj_arritemdispe = document.getElementById('arritemdispe');
		var obj_itemdispen = document.getElementById('itedescodigo');
		var obj_certirpeso = document.getElementById('certirpeso');
		var obj_kilos = document.getElementById('kilos');
		var obj_lote = document.getElementById('lote');
		
		//valor de los objetos
		var arritemdispe = (obj_arritemdispe.value)? obj_arritemdispe.value : '' ;
		var itemdispen = (obj_itemdispen.value)? obj_itemdispen.value : '' ;
		var certirpeso = (obj_certirpeso.value)? obj_certirpeso.value : '' ;
		var kilos = (obj_kilos.value)? obj_kilos.value : '' ;
		var lote = (obj_lote.value)? obj_lote.value : '' ;
		
		//validacion de los objetos
		var err = '';
		
		if(itemdispen == '')
			err = err + 'Advertencia : *** Debe ingresar material.' + '<br>';
		
		if(lote == '')
			err = err + 'Advertencia : *** Debe digitar lote.' + '<br>';
		
		if(certirpeso == '')
			err = err + 'Advertencia : *** Debe digitar peso.' + '<br>';
		
		if(kilos == '')
			err = err + 'Advertencia : *** Debe digitar kilos.' + '<br>';
		
		//accion del boton 
		if(err == '')
		{
			//registro de valores separados por el comodin :-:
			var newRow = itemdispen + ':-:' + kilos + ':-:' + lote;
			//validacion de item
			var enc = validaItem(itemdispen);
			if(enc != true)
			{
				//adiciona registro de valores en el objeto
				loadArraylist(newRow, 'arritemdispe', ':|:'); 
				//recarga el visor con los nuevo campos adicionados
				accionReloadListItemdispe();
			}
			else
			{
				document.getElementById('msg').innerHTML = 'Advertencia : *** Material ya se encuentra ingresado.';
				$("#msgwindow").dialog("open");
			}
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		
		
		//limpiar objetos
		obj_itemdispen.value = '';
		obj_kilos.value = '';
		obj_lote.value = '';
		
		//objeto del nombre
		var obj_itemdispen_nombre = document.getElementById('itedesnombre');
		obj_itemdispen_nombre.value = '';
	
		return false;
	});
	
	$('#quitaritem').button().click(function() {
		loadArraylistdelete('arritemdispe', ':|:');
		accionReloadListItemdispe();
		return false;
	});

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

function validaItem(item)
{
	var arrObjs = document.getElementById('arritemdispe').value.split(':|:');
	var arr;
	var enc = false;
	
	for(var i=0;i < arrObjs.length;i++)
	{
		var arr = arrObjs[i].split(':-:');
		if(arr[0] == item)
			enc = true;
	}
	
	return enc;
}

function validaPeso(value)
{
	//objeto a utilizar
	var obj_certirpeso = document.getElementById('certirpeso');
	
	//validacion
	if(!/^\d+\.?\d*$/.test(value))
	{
		obj_certirpeso.value = '';
		document.getElementById('msg').innerHTML = 'Advertencia : *** Ingresar valores enteros.';
		$("#msgwindow").dialog("open");
	}
}

function accionReloadListItemdispe()
{	
	//objetos a utilizar 
	var obj_arritemdispe = document.getElementById('arritemdispe');
	var obj_certirpeso = document.getElementById('certirpeso');
	
	//valor de los objetos
	var arritemdispe = (obj_arritemdispe.value)? obj_arritemdispe.value : '' ;
	var certirpeso = (obj_certirpeso.value)? obj_certirpeso.value : '' ;
	
	//parametros de envio 
	var parameters;
	parameters = (arritemdispe != '')? 'arritemdispe=' + arritemdispe : 'arritemdispe=';
	parameters += (certirpeso != '')? '&certirpeso=' + certirpeso : '&certirpeso=';
	
	//evento ajax 
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.vistaitemdispe.php", 	
		data: parameters,
		beforeSend: function(data){ 
			$('#filtrlistavistaitemdispe').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan los colores.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
			{
				document.getElementById('filtrlistavistaitemdispe').innerHTML = requestData;
			}
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){
			$('#filtrlistavistaitemdispe').unblock();
		}                                      
	});
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
