$(function(){
	//tab's para la bandeja general de corte

	scanAlarma();

	$("#tabs_soliprog").tabs({
		ajaxOptions: {
			error: function(xhr, status, index, anchor) {
				$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	//ObjDatepicker
	$("#solprofecest").datepicker({
		changeMonth: true,
		changeYear: true,  
		onClose: function( solprofecest ) 
		{
			//objetos a usar
			var obj_pedvenfecrec = document.getElementById('pedvenfecrec');
			var lbl_diff_solprofecest = document.getElementById('diff_solprofecest');
			//valor de los objetos
			var pedvenfecrec = (obj_pedvenfecrec)? obj_pedvenfecrec.value : '' ;
			var diff =  Math.floor(( Date.parse(solprofecest) - Date.parse(pedvenfecrec) ) / 86400000);
			//asignacion de dias
			if(lbl_diff_solprofecest)
				lbl_diff_solprofecest.innerHTML = '<b>' + diff + ' Dias.<b>';
		}
	});
	$("#solprofecest").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#solprofecest").datepicker($.datepicker.regional['es']);
	//ventana para inventario de materiales
	//ventana de dialogo items
	$("#msgwindowform").dialog({
		autoOpen: false,
		modal: true,
		position: { my: "left top", at: "left top", of: window }
	});
	//anexar materiales en extrusion
	$('#anxmaterial_ext').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//objetos a utilzar
		var obj_gstmaterial_ext = document.getElementById('gstmaterial_ext');
		//valores 
		var gstmaterial_ext = (obj_gstmaterial_ext)? obj_gstmaterial_ext.value : '' ;
		var err = '';
		
		//validaciones 
		if(gstmaterial_ext == '')
			err = err + 'Advertencia : *** Debe seleccionar material.';
		
		//evento del boton
		if(err == '')
		{
			openPlaneacion(gstmaterial_ext);
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
		if(obj_gstmaterial_ext)
			obj_gstmaterial_ext.value = '';
		return false;
	});
	//retirar materiales en extrusion
	$('#retmaterial_ext').button().click(function() {
		loadArraylistdelete('arrmatsoliextru', ':|:');
		accionReloadListMat_Soliextru();
		loadArraylistdelete('arrtarsoliextru', ':|:');
		accionReloadListTar_Soliextru();
		return false;
	});
	//anexar tarea a items de extrusion
	$('#anxtarea_ext').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//objetos a utilzar
		var obj_trtmaterial_ext = document.getElementById('trtmaterial_ext');
		//valores 
		var trtmaterial_ext = (obj_trtmaterial_ext)? obj_trtmaterial_ext.value : '' ;
		var err = '';
		//validaciones 
		if(trtmaterial_ext == '')
			err = err + 'Advertencia : *** Debe seleccionar material.';
		//evento del boton
		if(err == '')
		{
			loadArraylist(trtmaterial_ext, 'arrtarsoliextru', ':|:');
			accionReloadListTar_Soliextru();
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		//limpiar objetos
		if(obj_trtmaterial_ext)
			obj_trtmaterial_ext.value = '';
		return false;
	});
	//retirar tarea a items de extrusion
	$('#rettarea_ext').button().click(function() {
		loadArraylistdelete('arrtarsoliextru', ':|:');
		accionReloadListTar_Soliextru();
		return false;
	});
	//evento para adjuntar archivos a la solicitud
	$("#reportot_file_upload_soliprog").uploadify({
		'uploader': 'temas/upload/uploadify.swf',
		'cancelImg': 'temas/upload/cancel.png',
		'script': 'uploadify.php',
		'folder': '/doc/upload/soliprog/',
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
			alert(event);
			alert(ID);
			alert(fileObj);
			alert(response);
			alert(data);
			var file = document.getElementById('solprodocume');
			var filesize = document.getElementById('solprodosize');
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

//funcion para abrir venta modal con materiales a asignar
function openPlaneacion(data)
{
	ajaxItemsPlaneacion(data);
	$("#msgwindowform").dialog("open");
	return false;
}
//funcion para asignar los materiales al visor de planeacion
function ajaxItemsPlaneacion(data)
{
	//objetos a utilizar
	var obj_arrmatsoliextru = document.getElementById('arrmatsoliextru');
	var obj_arrrutaitem = document.getElementById('arrrutaitem');
	//valor de los objetos
	var arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value : '' ;
	var arrrutaitem = (obj_arrrutaitem)? obj_arrrutaitem.value : '' ;
	var arrplan = '';
	//parametros
	var parameters;
	parameters = (data != '')? 'paditecodigo=' + data : 'paditecodigo=';
	parameters += (arrmatsoliextru != '')? '&arrplan=' + arrplan : '&arrplan=';
	parameters += (arrrutaitem != '')? '&arrrutaitem=' + arrrutaitem : '&arrrutaitem=';
	//evento ajax
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
		}
	});
}
//funcion para recargar el visor de materiales con los selecionados en la ventana de materiales
function accionReloadListMatSoliextru()
{
	//objetos a utilizar
	var obj_arrplan = document.getElementById('arrplan');
	var obj_arrmatsoliextru = document.getElementById('arrmatsoliextru');
	//valor de los objetos
	var arrplan = (obj_arrplan)? obj_arrplan.value : '' ;
	var arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value : '' ;
	var objs_arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value.split(':|:') : '' ;
	//parametros
	var parameters = '';
	//parametros de objetos adicionales
	for(i=0;i<objs_arrmatsoliextru.length;i++)
	{
		var rows_arrmatsoliextru = objs_arrmatsoliextru[i].split(':-:');		
		var objs_consumo = 'gessolcantid_' + objs_arrmatsoliextru[i];
		var obj_consumo = document.getElementById(objs_consumo);
		var consumo = (obj_consumo)? obj_consumo.value : '' ;
		(consumo != '')? parameters += '&' + objs_consumo + '=' + consumo : parameters += '&' + objs_consumo + '=';
	}
	parameters += (arrmatsoliextru != '')? '&arrmatsoliextru=' + arrmatsoliextru : '&arrmatsoliextru=';
	//accion ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.mat_soliextru.php", 	
		data: parameters,
		beforeSend: function(data){
			$('#gestion_materiales').block({ theme : true , message : 'Cargando...'});
		 },        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('gestion_materiales').innerHTML = requestData;
		},         
		complete: function(requestData, exito){
			$('#gestion_materiales').unblock();
			accionReloadSelect_();
		}                                      
	});
}
//funcion para recargar el visor de materiales
function accionReloadListMat_Soliextru()
{
	//objetos a utilizar
	var obj_arrmatsoliextru = document.getElementById('arrmatsoliextru');
	var objs_arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value.split(":|:") : '' ;
	//valor de los objetos
	var arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value : '' ;
	//parametros
	var parameters;
	parameters = (arrmatsoliextru != '')? 'arrmatsoliextru=' + arrmatsoliextru : 'arrmatsoliextru=';
	//parametros de objetos adicionales
	for(i=0;i<objs_arrmatsoliextru.length;i++)
	{
		//objeto adicional
		var objs_gessolcantid = 'gessolcantid_' + objs_arrmatsoliextru[i];
		//objetos a utilizar
		var obj_gessolcantid = document.getElementById(objs_gessolcantid);
		//valor de los objetos
		var gessolcantid = (obj_gessolcantid)? obj_gessolcantid.value : '' ;
		//parametros adicionales
		(gessolcantid != '')? parameters += '&' + objs_gessolcantid + '=' + gessolcantid : parameters += '&' + objs_gessolcantid + '=';
	}
	//accion ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.mat_soliextru.php", 	
		data: parameters,
		beforeSend: function(data){ 
			$('#gestion_materiales').block({ theme : true , message : 'Cargando...'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('gestion_materiales').innerHTML = requestData;
		},         
		complete: function(requestData, exito){
			$('#gestion_materiales').unblock();
			accionReloadSelect_();
		}                                      
	});
}
//funcion para recargar el visor de tareas
function accionReloadListTar_Soliextru()
{
	//objetos a utilizar
	var obj_arrtarsoliextru = document.getElementById('arrtarsoliextru');
	var objs_arrtarsoliextru = (obj_arrtarsoliextru)? obj_arrtarsoliextru.value.split(":|:") : '' ;
	//valor de los objetos
	var arrtarsoliextru = (obj_arrtarsoliextru)? obj_arrtarsoliextru.value : '' ;
	//parametros
	var parameters;
	parameters = (arrtarsoliextru != '')? '&arrtarsoliextru=' + arrtarsoliextru : '&arrtarsoliextru=';
	//parametros de objetos adicionales
	for(i=0;i<objs_arrtarsoliextru.length;i++)
	{
		//objeto adicional
		var objs_anchocorte = 'anchocorte_' + objs_arrtarsoliextru[i];
		var objs_diferenciamm = 'diferenciamm_' + objs_arrtarsoliextru[i];
		var objs_diferenciakg = 'diferenciakg_' + objs_arrtarsoliextru[i];
		var objs_proceddestin = 'proceddestin_' + objs_arrtarsoliextru[i];
		//objetos a utilizar
		var obj_anchocorte = document.getElementById(objs_anchocorte);
		var obj_diferenciamm = document.getElementById(objs_diferenciamm);
		var obj_diferenciakg = document.getElementById(objs_diferenciakg);
		var obj_proceddestin = document.getElementById(objs_proceddestin);
		//valor de los objetos
		var anchocorte = (obj_anchocorte)? obj_anchocorte.value : '' ;
		var diferenciamm = (obj_diferenciamm)? obj_diferenciamm.value : '' ;
		var diferenciakg = (obj_diferenciakg)? obj_diferenciakg.value : '' ;
		var proceddestin = (obj_proceddestin)? obj_proceddestin.value : '' ;
		//parametros adicionales
		(anchocorte != '')? parameters += '&' + objs_anchocorte + '=' + anchocorte : parameters += '&' + objs_anchocorte + '=';
		(diferenciamm != '')? parameters += '&' + objs_diferenciamm + '=' + diferenciamm : parameters += '&' + objs_diferenciamm + '=';
		(diferenciakg != '')? parameters += '&' + objs_diferenciakg + '=' + diferenciakg : parameters += '&' + objs_diferenciakg + '=';
		(proceddestin != '')? parameters += '&' + objs_proceddestin + '=' + proceddestin : parameters += '&' + objs_proceddestin + '=';
	}
	//accion ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.tar_soliextru.php", 	
		data: parameters,
		beforeSend: function(data){
			 $('#gestion_tarea').block({ theme : true , message : 'Cargando...'});
		 },        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('gestion_tarea').innerHTML = requestData;
		},
		onComplete : function()
		{
			$('#gestion_tarea').unblock();
		}
	});
}
//accion para recargar el select de los materiales a realizar tareas
function accionReloadSelect_()
{
	//objetos a utilizar
	var obj_arrmatsoliextru = document.getElementById('arrmatsoliextru');
	//valor de los objetos
	var arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value : '' ;
	//parametros
	var parameters;
	parameters = 'arrmatplan=' + arrmatsoliextru + '&voption=1';
	//evento ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_selectruta.php", 	
		data: parameters,
		beforeSend: function(data){ },        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('trtmaterial_ext').innerHTML = requestData;
		}
	});
}
//funcion para el ancho de corte en la tareas de materiales
function eventAnchoc(ancho_c,indice)
{	
	//objetos a utilizar
	var obj_anchocorte = document.getElementById('anchocorte_' + indice);
	var obj_diferenciamm = document.getElementById('diferenciamm_' + indice);
	var obj_diferenciakg = document.getElementById('diferenciakg_' + indice);
	var obj_gessolcantid = document.getElementById('gessolcantid_' + indice);
	var obj_anchomaterial = document.getElementById('anchomaterial_' + indice);
	//objetos label a utilizar
	var lbl_diferenciamm = document.getElementById('lbl_diferenciamm_' + indice);
	var lbl_diferenciakg = document.getElementById('lbl_diferenciakg_' + indice);
	//validacion de error de digitacion
	if(!/^([0-9\.])*$/.test(ancho_c))
	{
		if(obj_anchocorte)
			obj_anchocorte.value = '';
		document.getElementById('msg').innerHTML = 'Advertencia: *** Debe ingresar valor numerico en campo(Ancho de corte).';
		$("#msgwindow").dialog("open");
		return false;
	}
	//valor de los objetos
	var anchocorte = ancho_c; 
	var diferenciamm = (obj_diferenciamm)? obj_diferenciamm.value : '' ;
	var diferenciakg = (obj_diferenciakg)? obj_diferenciakg.value : '' ;
	var gessolcantid = (obj_gessolcantid)? obj_gessolcantid.value : '' ; 
	var anchomaterial = (obj_anchomaterial)? obj_anchomaterial.value : '' ;
	//diferencia en milimetros (mm) = ancho material - ancho corte
	var diferenciamm = Number(anchomaterial) - Number(anchocorte);
	//diferencia en kilogramos (kgs) = (diferencia en milimetros / ancho material) * cantidad asignada
	var diferenciakg = Number(diferenciamm / Number(anchomaterial)) * Number(gessolcantid);
	if(isNaN(diferenciakg) === true)
		diferenciakg = 0;
	if(diferenciakg == -Infinity)
		diferenciakg = 0;
	//asignacion de valores
	if(obj_diferenciamm) obj_diferenciamm.value = diferenciamm;
	if(lbl_diferenciamm) lbl_diferenciamm.innerHTML = Math.round(diferenciamm * 100) / 100;
	if(obj_diferenciakg) obj_diferenciakg.value = diferenciakg;
	if(lbl_diferenciakg) lbl_diferenciakg.innerHTML = Math.round(diferenciakg * 100) / 100;
	return false;
}
//funcion adicional para evento de gestion de archivos
function loadHTMLUpload(codeot)
{
	if(document.getElementById('solprodocume').value != '')
	{
		var file = document.getElementById('solprodocume').value.split('::');
		var filesize = document.getElementById('solprodosize').value.split('::');
		var session = '';

		
		for(var i=0; i < file.length; i++)
			session += '<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload(' + i + ');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName">' + file[i] + ' (' + filesize[i] + ')</span></div>';

		document.getElementById('reportot_file_load_soliprog').innerHTML = session;
	}
	else
	{
		document.getElementById('reportot_file_load_soliprog').innerHTML = '';
	}
}

function deleteFileUpload(index)
{
	var file = document.getElementById('solprodocume').value.split('::');
	var filesize = document.getElementById('solprodosize').value.split('::');
	
	accionDeleteFileNormal('../doc/upload/soliprog/' + file[index]);

	document.getElementById('solprodocume').value = '';
	document.getElementById('solprodosize').value = '';
	
	for(var i=0; i < file.length; i++)
	{
		if(i != index)
		{
			if(document.getElementById('solprodocume').value != '')
			{
				document.getElementById('solprodocume').value = document.getElementById('solprodocume').value + '::' + file[i];
				document.getElementById('solprodosize').value = document.getElementById('solprodosize').value + '::' + filesize[i];
			}
			else
			{
				document.getElementById('solprodocume').value = file[i];
				document.getElementById('solprodosize').value = filesize[i];
			}
		}
	}

	loadHTMLUpload();
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
			console.log(objs_procedimiento);
			err = 'Advertencia : *** Debe Seleccionar proceso.';
			document.getElementById(objs_procedimiento).className = 'ui-state-highlight';
		}
	}
	
	if(err == '')
	{
		var obj_arrplan = document.getElementById('arrplan');
		var arrplan = (obj_arrplan)? obj_arrplan.value : '' ;
		var objs_arrplan = (arrplan)? arrplan.split(',') : '' ;
		var arrmatsoliextru = '';
		
		for( i=0; i < objs_arrplan.length; i++)
		{
			//objeto adicional
			var objs_procedimiento = 'procedimiento_' + objs_arrplan[i];
			//objetos 
			var obj_procedimiento = document.getElementById(objs_procedimiento);
			//valor de los objetos
			var procedimiento = (obj_procedimiento)? obj_procedimiento.value : '' ;
			if(procedimiento)
				arrmatsoliextru = (arrmatsoliextru)? arrmatsoliextru + ':|:' + objs_arrplan[i] + ':-:' + procedimiento : objs_arrplan[i] + ':-:' + procedimiento ;
		}
		
		loadArraylist(arrmatsoliextru,'arrmatsoliextru',':|:');
		accionReloadListMatSoliextru();
		document.getElementById('msgform').innerHTML = '' ;
		$("#msgwindowform").dialog("close");
	}
	else
	{
		document.getElementById('mensaje').innerHTML = err;
		document.getElementById('mensaje').className = 'ui-state-highlight';
	}
}
//calculo de metros
function kilostometros(indiceobjeto, var_densidad, var_calibre, var_ancho)
{
	/*
	var calib_a1_ = (obj_calib_a1)? obj_calib_a1.value : '' ;
	var refile_mm_ = (obj_refile_mm)? obj_refile_mm.value : '' ;
	var calib_a1 = (/^([0-9\,.])*$/.test(calib_a1_))? calib_a1_ : '' ; 
	var refile_mm = (/^([0-9\,.])*$/.test(refile_mm_))? refile_mm_ : '' ;
	*/ 
	//labels a usar
	var lbl_metros = document.getElementById('lbcantmetros_' + indiceobjeto);
	//objetos a usar
	var obj_kilos = document.getElementById('cantkilos_' + indiceobjeto);
	var obj_metros = document.getElementById('cantmetros_' + indiceobjeto);
	//valor de los objetos
	var var_kilos = (obj_kilos)? obj_kilos.value : '' ;
	var var_metros = 0;
	//validacion variables
	var kilos = (/^([0-9\,.])*$/.test(var_kilos))? var_kilos : 0 ; 
	var densidad = (/^([0-9\,.])*$/.test(var_densidad))? var_densidad : 0 ; 
	var calibre = (/^([0-9\,.])*$/.test(var_calibre))? var_calibre : 0 ; 
	var ancho = (/^([0-9\,.])*$/.test(var_ancho))? var_ancho : 0 ; 
	//formulacion
	metros = ( kilos / (ancho * (calibre * densidad) ) ) * 1000000; 
	//asignacion de valores
	if(obj_metros)
		obj_metros.value = metros;
	if(lbl_metros)
		lbl_metros.innerHTML = number_format(metros, 2, ',', '.');
}
function number_format( number, decimals, dec_point, thousands_sep ) {
    // http://kevin.vanzonneveld.net
    // + original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfix by: Michael White (http://crestidg.com)
    // + bugfix by: Benjamin Lupton
    // + bugfix by: Allan Jensen (http://www.winternet.no)
    // + revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // * example 1: number_format(1234.5678, 2, '.', '');
    // * returns 1: 1234.57
     
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
     
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}