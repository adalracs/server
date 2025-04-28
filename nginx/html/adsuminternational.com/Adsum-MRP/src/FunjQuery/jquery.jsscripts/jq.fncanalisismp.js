$(function(){

	$("#msgwindowform").dialog({
		autoOpen: false,
		modal: true,
		position: { my: "left top", at: "left top", of: window }
	});

	$('#proveecodigo').change(function() {
		$("#fabricodigo").val("");
		$("#lotecodigo").val("");
		$("#itedesnombre").val("");
		$("#itedescodigo").val("");
		accionReloadAnalisiMp();
		fajaxloadfabricante(this.value);
	});

	$('#fabricodigo').change(function() {
		$("#lotecodigo").val("");
		$("#itedesnombre").val("");
		$("#itedescodigo").val("");
		accionReloadAnalisiMp();
		fajaxloadlote(this.value);
	});

	$('#lotecodigo').change(function() {
		$("#itedesnombre").val("");
		$("#itedescodigo").val("");
		accionReloadAnalisiMp();
		fajaxloaditemdesa(this.value);
	});

	$('#itedescodigo').change(function() {
		$("#analiscantap").val("");
		$("#analiscantre").val("");
		eventHistorial(this.value);
		accionReloadAnalisiMp();
		accionCantidad();
	});


	$("#estanacodigo").change(function(event) {
		eventEstadoAnalisi();
	});

	$('#detanalisismp').button({ icons: { primary: "ui-icon-script" }, text: "Detallar Historial Analisis" }).click(function() {
		$("#msgwindowform").dialog("open");
		$("#msgwindowform").dialog({ buttons: [ { text: "Cerrar", click: function() { $("#msgwindowform").dialog("close");$("#msgform").html( "" )  } } ] });
		$("#msgwindowform").dialog( "option", "width", "auto" );
		$("#msgwindowform").dialog( "option", "height", "auto" );
		$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Historial Analisis Materias Primas]" );

		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.phpscripts/jq.historialanalisismp.php", 	
			data: { itedescodigo : $("#itedescodigo").val(), lotecodigo : $("#lotecodigo").val() } ,
			beforeSend: function(data){ $("#msgform").html() },        
			success: function(requestData){ 
				if( requestData != ""){
					$("#msgform").html( requestData ) 
				}

			}                              
		});

		return false;
	});

	/*$("#itedesnombre").autocomplete({
		source: function(request, response) {
        	$.ajax({
               	url: "../src/FunjQuery/jquery.phpcombobox/calidad/jq.atcitemdesa.php",
              	data: {term: request.term,lotecodigo: $('#lotecodigo').val()},
              	dataType: "json",
               	success: function(data) {
               		response( $.map( data, function( item ) {
    					return {id : item.id,label: item.label,value: item.value}
					}));
              	}
			});
       	},
		minLength: 0,
		select: function(event, ui) {
			if(ui.item){
				document.getElementById('itedescodigo').value = ui.item.id;
				accionReloadAnalisiMp();
			}else{
				document.getElementById('itedescodigo').value = "";
			}
		}
	});*/

	$("#reportot_file_upload").uploadify({
		'uploader': 'temas/upload/uploadify.swf',
		'cancelImg': 'temas/upload/cancel.png',
		'script': 'uploadify.php',
		'folder': '/doc/upload/noconforme/',
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

function fajaxloadfabricante( proveecodigo )
{
	if( proveecodigo ){

		$.ajax({
			url: "../src/FunGen/floadfabricante.php",
			type: "POST",
			dataType: "html",
			data:{ proveecodigo:proveecodigo, ajax : 1, fload : "floadfabricanteproveedor" },
			beforeSend: function(data){ }, 
			success: function(data, textStatus, xhr) {

				if( data ){
					$("#fabricodigo").html('<option value="">--Seleccione--</td>' + data);
				}else{
					$("#fabricodigo").html('<option value="">--Seleccione--</td>');
				}
			}

		});

	}

}

function fajaxloadlote( fabricodigo )
{

	if( fabricodigo ){

		$.ajax({
			url: "../src/FunGen/floadlote.php",
			type: "POST",
			dataType: "html",
			data:{ fabricodigo:fabricodigo, ajax : 1, fload : "floadlotefabricante" },
			beforeSend: function(data){ }, 
			success: function(data, textStatus, xhr) {

				if( data ){
					$("#lotecodigo").html('<option value="">--Seleccione--</td>' + data);
				}else{
					$("#lotecodigo").html('<option value="">--Seleccione--</td>');
				}
			}

		});

	}

}


function fajaxloaditemdesa( lotecodigo )
{

	if( lotecodigo ){

		$.ajax({
			url: "../src/FunGen/floaditemdesa.php",
			type: "POST",
			dataType: "html",
			data:{ lotecodigo:lotecodigo, ajax : 1, fload : "floaditemdesaanalisismp" },
			beforeSend: function(data){ }, 
			success: function(data, textStatus, xhr) {

				if( data ){
					$("#itedescodigo").html('<option value="">--Seleccione--</td>' + data);
				}else{
					$("#itedescodigo").html('<option value="">--Seleccione--</td>');
				}
			}

		});

	}

}

function accionReloadAnalisiMp()
{

	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jq.vanalisismp.php", 	
		data: { itedescodigo : $("#itedescodigo").val() },
		beforeSend: function(data){ 
			$('#filtrlistavaranalisis').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga el plan de inspecci&oacute;n.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('filtrlistavaranalisis').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){
			$('#filtrlistavaranalisis').block({ theme : true , message : 'Error'});
		 },
		complete: function(requestData, exito){ 
			$('#filtrlistavaranalisis').unblock();
		}                                      
	});

}

function eventEstadoAnalisi()
{

	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jq.tipoestadoanalisismp.php", 	
		data: { estanacodigo : $("#estanacodigo").val() },
		beforeSend: function(data){ },        
		success: function(requestData){

			if(requestData != ""){

				switch ( requestData.tipestcodigo ) {
    				case "1":
    					$("#analiscantap").val("");
    					$("#analiscantre").val("");

    					$("#lblanaliscantap").css("display", "none");
    					$("#objanaliscantap").css("display", "none");

    					$("#lblanaliscantre").css("display", "none");
    					$("#objanaliscantre").css("display", "none");
       					break;
    				default:
    					$("#analiscantap").val("");
    					$("#analiscantre").val("");

    					$("#lblanaliscantap").css("display", "block");
    					$("#objanaliscantap").css("display", "block");

    					$("#lblanaliscantre").css("display", "block");
    					$("#objanaliscantre").css("display", "block");
    					accionCantidad();
       			}

			}

		},         
		error: function(requestData, strError, strTipoError){},
		complete: function(requestData, exito){ }                                      
	});

}

function valResultado( vresultado, varanacodigo, vespecificacion){

	var objsVaranatipespee = "varanatipespe" + varanacodigo;
	var objsVaranatolems = "varanatolems" + varanacodigo;
	var objsVaranatolemn = "varanatolemn" + varanacodigo;
	var objsarVaranadetesp = "varanadetesp" + varanacodigo;

	var varanatipespe = parseInt ( $( "#" + objsVaranatipespee ).val() );
	var varanatolems = parseFloat ( $( "#" + objsVaranatolems ).val() );
	var varanatolemn = parseFloat ( $( "#" + objsVaranatolemn ).val() );
	var varanadetesp = parseFloat ( $( "#" + objsarVaranadetesp ).val() );

	var varanatolemsx = vespecificacion + (vespecificacion * (varanatolems) / 100);
	var varanatolemnx = vespecificacion - (vespecificacion * (varanatolemn) / 100);

	var bandera = 0;

	if(varanatipespe == 1){//rango

		if(vresultado > varanatolems || vresultado < varanatolemn){
			bandera = 1;
		}

	}else if(varanatipespe == 2){//mayor igual

		if( vresultado < varanadetesp){
			bandera = 1;
		}

	}else if(varanatipespe == 3){//menor igual

		if( vresultado > varanadetesp){
			bandera = 1;
		}

	}else if(varanatipespe == 4){//binaria 1/0

		if( vresultado != 1){
			bandera = 1;
		}

	}else if(varanatipespe == 5){//tolerancia

		if(vresultado > varanatolemsx || vresultado < varanatolemnx){
			bandera = 1;
		}

	}

	if(bandera > 0){

		var objsValor = "txtvalor" + varanacodigo;
		$( "#" + objsValor ).addClass( "ui-state-highlight ui-corner-all" );

	}else{

		var objsValor = "txtvalor" + varanacodigo;
		$( "#" + objsValor ).removeClass( "ui-state-highlight ui-corner-all" );

	}


}

function eventHistorial( vitedescodigo ){

	if( parseInt(vitedescodigo) > 0 ){

		$("#lblhistorial").css("display", "block");
    	$("#objhistorial").css("display", "block");

	}else{

		$("#lblhistorial").css("display", "none");
    	$("#objhistorial").css("display", "none");

	}


}

function accionCantidad(){

	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jq.cantidadlote.php", 	
		data: { lotecodigo : $("#lotecodigo").val(), itedescodigo : $("#itedescodigo").val() },
		beforeSend: function(data){ },        
		success: function(requestData){

			if(requestData != ""){

				var analiscantap = $("#analiscantap").val();

				if( analiscantap <= 0){

					$("#analiscantap").val( requestData.analiscantap );
				}

			}

		},         
		error: function(requestData, strError, strTipoError){},
		complete: function(requestData, exito){ }                                      
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
	
	accionDeleteFileNormal('../doc/upload/noconforme/' + file[index]);

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