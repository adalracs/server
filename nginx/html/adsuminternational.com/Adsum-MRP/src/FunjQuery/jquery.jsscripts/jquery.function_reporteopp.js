$(function(){
	//$( document ).tooltip();
	$("a[title]").qtip({
       //content: '<?php echo str_replace("\r",'', str_replace("\n",'<br>', $value)) ?>',
       show: 'mouseover',
       hide: 'mouseout',
       style: {  border: { width: 5, radius: 5 }, padding: 2, textAlign: 'left', tip: true, name: 'blue' }
       //position: { corner: { target: 'leftMiddle', tooltip: 'rightMiddle' } }
    });
	//pestanas formulario
	$("#tabs_opp").tabs({});
	//Boton Ingresar Insumo/item
	$('#ingresaritem').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
		ajaxItems( url = "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_reporteoppmaterial.php");
		$("#msgwindowform").dialog("open");
		$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() { reLoadListItems( url = "../src/FunjQuery/jquery.visors/jquery.mtreporteopp.php", arrkey = "arrmatrep", listkey = "listadoreportematerial");$(this).dialog("close");  } } ] });
		$("#msgwindowform").dialog( "option", "width", "auto" );
		$("#msgwindowform").dialog( "option", "height", "auto" );
		$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Materiales]" );
		return false;
	});
	
	//Boton quitar Insumo/item
	$('#quitaritem').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		loadArraylistdelete('arrmatrep', ':|:');
		reLoadListItems( url = "../src/FunjQuery/jquery.visors/jquery.mtreporteopp.php", arrkey = "arrmatrep", listkey = "listadoreportematerial");
		return false;
	});
	
	//Boton Ingresar Reporte pn
	$('#ingresardpn').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
		ajaxDesperdicio();
		$("#msgwindowform").dialog("open");
		$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() { reLoadListDesperdicio();$(this).dialog("close");  } } ] });
		$("#msgwindowform").dialog( "option", "width", "auto" );
		$("#msgwindowform").dialog( "option", "height", "auto" );
		$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Desperdicio]" );
		return false;
	});
	
	//Boton quitar Reporte pn
	$('#quitardpn').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		loadArraylistdelete('arrdesperdiciopn', ',');
		reLoadListDesperdicio();
		return false;
	});
	
	
	//Boton Ingresar Reporte Tiempo pn
	$('#ingresartpn').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
		ajaxTiempo();
		$("#msgwindowform").dialog("open");
		$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() { reLoadListTiempopn();$(this).dialog("close");  } } ] });
		$("#msgwindowform").dialog( "option", "width", "auto" );
		$("#msgwindowform").dialog( "option", "height", "auto" );
		$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Tiempos]" );
		return false;
	});
	
	//Boton quitar Reporte Tiempo pn
	$('#quitartpn').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		loadArraylistdelete('arrtiempopn', ',');
		reLoadListTiempopn();
		return false;
	});
	
	//Boton quitar Insumo/item
	$('#formulbutton').button({ icons: { primary: "ui-icon-script" }, text: false }).click(function() {
		openFormulacion($('#formulcodigo').val());
		return false;
	});

	//Boton Ingresar Saldo
	$('#ingresarsaldo').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
		ajaxItems( url = "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_reporteoppsaldo.php");
		$("#msgwindowform").dialog("open");
		$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() { reLoadListItems( url = "../src/FunjQuery/jquery.visors/jquery.mtreporteoppsaldo.php", arrkey = "arrmatsaldo", listkey = "listadoreportesaldo");$(this).dialog("close");  } } ] });
		$("#msgwindowform").dialog( "option", "width", "auto" );
		$("#msgwindowform").dialog( "option", "height", "auto" );
		$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Materiales]" );
		return false;
	});
	
	//Boton quitar Saldo
	$('#quitarsaldo').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		loadArraylistdelete('arrmatsaldo', ':|:');
		reLoadListItems( url = "../src/FunjQuery/jquery.visors/jquery.mtreporteoppsaldo.php", arrkey = "arrmatsaldo", listkey = "listadoreportesaldo");
		return false;
	});
	
	//ventana de dialogo items
	$("#msgwindowform").dialog({
		autoOpen: false,
		modal: true,
		position: { my: "left top", at: "left top", of: window }
	});
});

//------------------------REPORTE DE BOBINAS --------------------------
//ventana de reporte de bobinas 
function ajaxItems( url)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		//url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_reporteoppmaterial.php",
		url: url, 
		data: "ordoppcodigo=" + document.getElementById("ordoppcodigo").value +
			  "&produccodigo=" + document.getElementById("produccodigo").value +
			  "&solprocodigo=" + document.getElementById("solprocodigo").value +
			  "&procedcodigo=" + document.getElementById("procedcodigo").value +
			  "&produccoduno=" + document.getElementById("produccoduno").value +
			  "&producnombre=" + document.getElementById("producnombre").value +
			  "&arrmatrep=" + document.getElementById("arrmatrep").value + 
			  "&arrmatsaldo=" + document.getElementById("arrmatsaldo").value,
		beforeSend: function(data){
			document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 
		},
		complete: function(requestData, exito){ 
		}                                      
	});
	
}
//selecciona y  envia variables adiconales en el filtro
function reLoadListItems( url, arrkey, listkey ){
	var arrObjItems = document.getElementById(arrkey).value.split(":|:"); //el comodin "," es separador de filas
	var objparams = "" + arrkey + "=" + document.getElementById(arrkey).value +
					"&ordoppcodigo=" + document.getElementById("ordoppcodigo").value +
					"&produccodigo=" + document.getElementById("produccodigo").value +
					"&solprocodigo=" + document.getElementById("solprocodigo").value +
					"&procedcodigo=" + document.getElementById("procedcodigo").value +
					"&produccoduno=" + document.getElementById("produccoduno").value +
					"&producnombre=" + document.getElementById("producnombre").value;

	for(var a = 0; a < arrObjItems.length; a++){
		
		var objsReporteSaldo = "reportesaldo_" + arrObjItems[a];
		var objReporteSaldo = document.getElementById(objsReporteSaldo);
		var reporteSaldo = (objReporteSaldo)? objReporteSaldo.value : "";


		objparams += (reporteSaldo)? "&" + objsReporteSaldo + "=" + reporteSaldo : "&" + objsReporteSaldo + "=";
	}

	ajaxListaReporte(objparams, url, listkey);
}
//evento ajax para recargar items asignados
function ajaxListaReporte(objparams, url, listkey)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		//url: "../src/FunjQuery/jquery.visors/jquery.mtreporteopp.php",
		url : url,
		data: objparams,
		beforeSend: function(data){
			//document.getElementById(listkey).innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
			$("#" + listkey).block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>'});
		},         
		success: function(requestData){
			document.getElementById(listkey).innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 
			$("#" + listkey).block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){
			$("#" + listkey).unblock();
		}                                      
	});
	
}





//------------------------REPORTE DE DESPERDICIO --------------------------
//ventana de reporte de desperdicio
function ajaxDesperdicio()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.listdesperdiciopn.php",
		data: "tipsolcodigo=" + document.getElementById('tipsolcodigo').value + '&arrdesperdiciopn=' + document.getElementById('arrdesperdiciopn').value,
		beforeSend: function(data){
			document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}
//selecciona y  envia variables adiconales en el filtro
function reLoadListDesperdicio(){
	var arrObjItems = document.getElementById('arrdesperdiciopn').value.split(','); //el comodin ':|:' es separador de filas
	var objparams = 'arrdesperdiciopn=' + document.getElementById('arrdesperdiciopn').value;
	for( i = 0; i < arrObjItems.length; i++ )
	{
		//variables de objetos adicionales
		var objs_repkilos = 'repkilos_' + arrObjItems[i];
		var objs_repmetros = 'repmetros_' + arrObjItems[i];
		//objetos adicionales
		var obj_repkilos = document.getElementById(objs_repkilos);
		var obj_repmetros = document.getElementById(objs_repmetros);
		//valor de los objetos
		var repkilos = (obj_repkilos)? obj_repkilos.value : '' ;
		var repmetros = (obj_repmetros)? obj_repmetros.value : '' ;
		//parametros adicionales
		objparams = objparams + '&' + objs_repkilos + '=' + repkilos;
		objparams = objparams + '&' + objs_repmetros + '=' + repmetros;
	}
	ajaxListaDesperdicio(objparams);
}
//evento ajax para recargar items asignados
function ajaxListaDesperdicio(objparams)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.desperdiciopn.php",
		data: objparams,
		beforeSend: function(data){
			//document.getElementById('listadodesperdicio').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
			$("#listadodesperdicio").block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>'});
		},         
		success: function(requestData){

			document.getElementById('listadodesperdicio').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 

			$("#listadodesperdicio").block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){

			$("#listadodesperdicio").unblock();
		}                                      
	});
	
}





//------------------------REPORTE DE TIEMPOS --------------------------
//ventana de reporte de desperdicio
function ajaxTiempo()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.listtiempopn.php",
		data: { arrtiempopn: $("#arrtiempopn").val(), tipsolcodigo : $("#tipsolcodigo").val() } ,
		//data: "arrtiempopn=" + document.getElementById('arrtiempopn').value,
		beforeSend: function(data){
			document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}
//selecciona y  envia variables adiconales en el filtro
function reLoadListTiempopn(){
	var arrObjItems = document.getElementById("arrtiempopn").value.split(","); //el comodin ':|:' es separador de filas
	var objparams = "arrtiempopn=" + document.getElementById("arrtiempopn").value;
	objparams += "&tipsolcodigo=" + document.getElementById("tipsolcodigo").value;

	for( i = 0; i < arrObjItems.length; i++ )
	{
		//variables de objetos adicionales
		var objs_rephoraini = 'rephoraini_' + arrObjItems[i];
		var objs_rephorafin = 'rephorafin_' + arrObjItems[i];
		//objetos adicionales
		var obj_rephoraini = document.getElementById(objs_rephoraini);
		var obj_rephorafin = document.getElementById(objs_rephorafin);
		//valor de los objetos
		var rephoraini = (obj_rephoraini)? obj_rephoraini.value : '' ;
		var rephorafin = (obj_rephorafin)? obj_rephorafin.value : '' ;
		//parametros adicionales
		objparams = objparams + '&' + objs_rephoraini + '=' + rephoraini;
		objparams = objparams + '&' + objs_rephorafin + '=' + rephorafin; 
	}
	ajaxListaTiempopn(objparams);
}
//evento ajax para recargar items asignados
function ajaxListaTiempopn(objparams)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.tiempopn.php",
		data: objparams,
		beforeSend: function(data){
			//document.getElementById('listadotiempopn').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
			$("#listadotiempopn").block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>'});
		},         
		success: function(requestData){

			document.getElementById('listadotiempopn').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 

			$("#listadotiempopn").block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){

			$("#listadotiempopn").unblock();
			reLoadTimeprickerTiempopn();
		}                                      
	});
	
}
//selecciona y  envia variables adiconales en el filtro
function reLoadTimeprickerTiempopn(){
	var arrObjItems = document.getElementById('arrtiempopn').value.split(','); //el comodin ':|:' es separador de filas
	var objparams = 'arrtiempopn=' + document.getElementById('arrtiempopn').value;
	for( i = 0; i < arrObjItems.length; i++ )
	{
		//variables de objetos adicionales
		var objs_rephoraini = "rephoraini_" + arrObjItems[i];
		var objs_rephorafin = "rephorafin_" + arrObjItems[i];
		//objetos adicionales
		$('#' + objs_rephoraini).timepicker({});
		$('#' + objs_rephorafin).timepicker({});
	}
}
//abrir formulacion
function openFormulacion(idformulacion)
{
	var err = '';
	
	if(idformulacion <= 0)
		err = err + 'Advertencia : No Contiene formulacion asignada.';
	
	if(err == '')
	{
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.visors/jquery.formulacion2.php", 	
			data: 'arrformulacion2=' + idformulacion,
			beforeSend: function(data){
				document.getElementById('msg').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la formulacion.</img>';		
			},          
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

function openReporteOpp(idreporteopp)
{
	var err = '';
	
	if(idreporteopp <= 0)
		err = err + 'Advertencia : Error inesperado.';
	
	if(err == '')
	{
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.phpscripts/jq.loadreportepn.php", 	
			data: 'repoppcodigo=' + idreporteopp,
			beforeSend: function(data){
				document.getElementById('msg').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la informacion.</img>';		
			},          
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
//eventreportepnval
function eventreportepnval(valor)
{
	//objetos a utilizar
	var obj_sesion_reporteopp = document.getElementById("sesion_reporteopp");	

	var obj_reoppncantkg = document.getElementById("reoppncantkg");
	var obj_reoppncantmt = document.getElementById("reoppncantmt");
	var obj_reoppncantun = document.getElementById("reoppncantun");
	//validacion de evento
	if(valor == 'si'){
		//accion del evento
		obj_sesion_reporteopp.style.display = 'block';
		$("#reoppndescri").val("Reporte [OK]");
	}else{
		//accion del evento
		obj_sesion_reporteopp.style.display = 'none';
		$("#reoppncantkg").val("");
		$("#reoppncantmt").val("");
		$("#reoppncantun").val("");
		$("#reoppndescri").val("");
		$("#arrmatreptmp").val("");
		$("#arrmatrep").val("");
		reLoadListItems( url = "../src/FunjQuery/jquery.visors/jquery.mtreporteopp.php", arrkey = "arrmatrep", listkey = "listadoreportematerial");
	}
	
}
