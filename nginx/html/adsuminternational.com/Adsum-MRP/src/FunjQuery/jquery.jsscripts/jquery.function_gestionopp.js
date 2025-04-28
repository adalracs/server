$(function(){
	//$( document ).tooltip();
	$("a[title]").qtip({
       //content: '<?php echo str_replace("\r",'', str_replace("\n",'<br>', $value)) ?>',
       show: 'mouseover',
       hide: 'mouseout',
       style: {  border: { width: 5, radius: 5 }, padding: 2, textAlign: 'left', tip: true, name: 'blue' }
       //position: { corner: { target: 'leftMiddle', tooltip: 'rightMiddle' } }
    });

	//evento para tipo de solicitud 
	$("#tipsolcodigo").change(function(){ cargarArrEquipo( this.value ); } );
	//evento boton gestionar ordenes de produccion
	$('#gestionar').button({ icons: { primary: "ui-icon-gear" } }).click(function() {		
		if( $( "#selstar" ).val() >= 1 ){
			document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
		}
		return false;
	});
	//evento boton reporte ordenes de produccion
	$('#reporte').button({ icons: { primary: "ui-icon-gear" }}).click(function(){
		if(document.form1.selstar.value == 1)
		{
			document.form1.action = 'ingrnuevreporte' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
		}
			
		return false;
	});

	//pestanas formulario
	$("#tabs_opp").tabs({});
	//Boton Ingresar Insumo/item
	$('#ingresaritem').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
		ajaxItems();
		$("#msgwindowform").dialog("open");
		$("#msgwindowform").dialog({ 
			buttons: [{ 
				 	text: "Adicionar", 
				 	click: function() { 
				 		reLoadListItems();
						$(this).dialog("close"); 
				 	} 
				 }] 
		});
		$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Gestion Materia Prima]" );
		return false;
	});
	
	//Boton quitar Insumo/item
	$('#quitaritem').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		loadArraylistdelete('arritem', ':|:');
		reLoadListItems();
		return false;
	});
	
	//Boton quitar Insumo/item
	$('#formulbutton').button({ icons: { primary: "ui-icon-script" }, text: false }).click(function() {
		openFormulacion($('#formulcodigo').val());
		return false;
	});
	
	//ventana de dialogo items
	$("#msgwindowform").dialog({
		autoOpen: false,
		width: 1000,
		//height: auto,
		modal: true,
		/*buttons: {
			"Adicionar": function() { 
				reLoadListItems();
				$(this).dialog("close"); 
			}
		},*/
		position: { my: "left top", at: "left top", of: window }
	});	
	
	//Boton Ingresar Rollo/bobina
	$('#ingresarbobina').button({ icons: { primary: "ui-icon-circle-plus" }, text: "Ingresar rollo" }).click(function() {
		//variables a usar
		var idmaterial = $( "#idmaterial" ).val();
		var arrbobina = $( "#arrbobina" ).val();
		var objsarrbobina = ( $( "#arrbobina" ).val() )? $( "#arrbobina" ).val().split(":|:") : "" ;
		var err = "";
		var arr = "";
		//validaciones 
		if(idmaterial == "")
			err = err + "Advertencia : *** Debe seleccionar material.";

		if( vEventSaldo( idmaterial ) > 0 )
			err = err + "Advertencia : *** Saldo se encuentra asignado.";
		
		//evento del boton
		if(err == ''){
			var nobobina = (arrbobina == '')? 1 : (objsarrbobina.length) + 1 ;
			arr = (arr)? arr + idmaterial + ":-:" + nobobina : idmaterial + ":-:" + nobobina ;
			loadArraylist(arr, 'arrbobina', ':|:');
			accionReloadListBobinas();
		}else{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}

		//$( "#idmaterial" ).val("");
		return false;
	});
	
	//Boton quitar Rollo/bobina
	$('#quitarbobina').button({ icons: { primary: "ui-icon-circle-minus" }, text: "Retirar rollo" }).click(function() {
		loadArraylistdelete('arrbobina', ':|:');
		accionReloadListBobinas();
		return false;
	});

	//Boton Ingresar Insumo/item
	$('#ingresarmat').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {

		var objPaditecodigo = document.getElementById("paditecodigo");
		var paditecodigo = (objPaditecodigo)? objPaditecodigo.value : "" ; 
		var err = "";

		if(paditecodigo == ""){

			err = err + "Advertencia : *** Debe seleccionar material.";
		}

		if(err == ""){

			ajaxItemsPlaneacion();
			$("#msgwindowform").dialog("open");			
			$("#msgwindowform").dialog({ 
				buttons: [ { 
					text: "Adicionar", 
					click: function() { 
						reloadMaterial();
						$(this).dialog("close"); 
					} 
				} ] 
			});
			$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Gestion Materia Prima]" );

		}else{

			//document.getElementById('msg').innerHTML = err;
			$("#msg").html(err);
			$("#msgwindow").dialog("open");
		}

		if(objPaditecodigo) objPaditecodigo.value = "";
		return false;
	});
	
	//Boton quitar Insumo/item
	$('#quitarmat').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		loadArraylistdelete('arrplaneacionopp', ',');
		reloadMaterial();
		return false;
	});
				
});
//evento para cargar equipos x programa
function cargarArrEquipo(id)
{
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		data : { id : id },
		url: "../src/FunjQuery/jquery.accionextras/jq.cargarEqu.programa.php",
		beforeSend: function(){ 
			$('#detallaprograma').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga el programa...</img>'});
		},
		success: function(datajson){
			reloadPrograma(id, datajson);
		}
	});
}
//evento de recargar programas de produccion
function reloadPrograma(id, json)
{
	if( id > 0 ){

		json['tipsolcodigo'] = $("#tipsolcodigo").val();
		json['sourcetable'] = $("#sourcetable").val();
		
		var key = 'key_' + id;
		var url = "detalla" + json.arrconf[key] + ".php";
		
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			data : json ,
			url: url,
			beforeSend: function(data){ 
			},
			success: function(requestData){
				document.getElementById('detallaprograma').innerHTML = requestData;
			},
			complete: function(){ 

				$('#detallaprograma').unblock();
				reloadTabs(id, json);
				reloadAnimatedcollapse(json);
				reloadQtip();
			}
			
		});

	}else{

		var msj = '';
		msj += '<div class="ui-widget">';
 		msj += '<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">'; 
  		msj += '<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>';
  		msj += '<b>No se encontraron OPP {Ordenes de produccion programadas} asociadas a algun equipo.</b></p>';
 		msj += '</div>';
		msj += '</div>';

		document.getElementById('detallaprograma').innerHTML = msj;

	}
	
}
//evento animted callpase de las ordenes 
function Event_animatedcollapse(indice, id_animated)
{

	for(i = 0;i < indice;i++)
	{
		
		animatedcollapse.addDiv(id_animated + '_' +  i, 'fade=1,height=auto');
	}
	//inicia el evento
	animatedcollapse.init();
}
//evento para recargar los tab's por equipo {ajax}
function reloadTabs(id, json)
{
	var key = 'key_' + id;

	$(function(){
		$( "#" + json.arrconf[key] ).tabs({
			ajaxOptions: {
				error: function(xhr, status, index, anchor) {
				$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
				}
			}
		});
	});
}
//envento para recargar los animated collapse de las ordenes {ajax}
function reloadAnimatedcollapse(json)
{
	var objsEquipoUnidad = (json.arrequipo)? json.arrequipo.split(',') : '';

	for( var i = 0; i < objsEquipoUnidad.length; i++)
	{
		var objEquipoUnidad = objsEquipoUnidad[i] + "_und";
		var EquipoUnidad = $( "#" + objEquipoUnidad ).val();
		Event_animatedcollapse(EquipoUnidad, "filtrOpp_" + objsEquipoUnidad[i])
	}
}
//evento para recargar los tooltip
function reloadQtip(){

	$(function(){

		$("a[title]").qtip({
       	//content: '<?php echo str_replace("\r",'', str_replace("\n",'<br>', $value)) ?>',
       	show: 'mouseover',
       	hide: 'mouseout',
       	style: {  border: { width: 5, radius: 5 }, padding: 2, textAlign: 'left', tip: true, name: 'dark' }
       	//position: { corner: { target: 'leftMiddle', tooltip: 'rightMiddle' } }
    	});
    });
}
//evento de los radiobutton para obtener el id de la orden de produccion seleccionada
function setOrdoppcodigo(ordoppcodigo)
{
	$('#ordoppcodigo').val( ordoppcodigo + "|n" );
	$('#selstar').val(1);	
}
//ventana de gestion de lineas y materiales
function ajaxItems()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.formitems.php",
		data: "tipsolcodigo=" + $( "#tipsolcodigo" ).val() + "&ordoppcodigo=" + $( "#ordoppcodigo" ).val() + "&arritem=" + $("#arritem").val(),
		beforeSend: function(data){
			document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
			$("#itedescodigo").keyup(function(){ajaxItemsFilter();});
			$("#itedesancho").change(function(){ajaxItemsFilter();});
			$("#itedescalib").change(function(){ajaxItemsFilter();});
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}
//ventana de gestion de planeacion
function ajaxItemsPlaneacion()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.formgestionplaneacionopp.php",
		data: { arrplaneacionopp: $("#arrplaneacionopp").val(),paditecodigo : $("#paditecodigo").val()},
		//data: "tipsolcodigo=" + $( "#tipsolcodigo" ).val() + "&ordoppcodigo=" + $( "#ordoppcodigo" ).val() + "&arritem=" + $("#arritem").val(),
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
//filtro para listado de items
function ajaxItemsFilter()
{
	//objetos a utilizar
	var obj_itedescodigo = document.getElementById('itedescodigo');
	var obj_itedesancho = document.getElementById('itedesancho');
	var obj_itedescalib = document.getElementById('itedescalib');
	var obj_itedesnombre = document.getElementById('itedesnombre');
	var obj_tipsolcodigo = document.getElementById('tipsolcodigo');
	var obj_ordoppcodigo = document.getElementById('ordoppcodigo');
	var obj_arritem = document.getElementById('arritem');
	//valor de los objeto
	var itedescodigo = (obj_itedescodigo)? obj_itedescodigo.value : '' ; 
	var itedesancho = (obj_itedesancho)? obj_itedesancho.value : '' ; 
	var itedescalib = (obj_itedescalib)? obj_itedescalib.value : '' ; 
	var itedesnombre = (obj_itedesnombre)? obj_itedesnombre.value : '' ; 
	var tipsolcodigo = (obj_tipsolcodigo)? obj_tipsolcodigo.value : '' ; 
	var ordoppcodigo = (obj_ordoppcodigo)? obj_ordoppcodigo.value : '' ; 
	var arritem = (obj_arritem)? obj_arritem.value : '' ; 
	//parametros de envio
	var parameters = '';
	(itedescodigo != '')? parameters = parameters + '&itedescodigo=' + itedescodigo : parameters = parameters + '&itedescodigo=';
	(itedesancho != '')? parameters = parameters + '&itedesancho=' + itedesancho : parameters = parameters + '&itedesancho=';
	(itedescalib != '')? parameters = parameters + '&itedescalib=' + itedescalib : parameters = parameters + '&itedescalib=';
	(itedesnombre != '')? parameters = parameters + '&itedesnombre=' + itedesnombre : parameters = parameters + '&itedesnombre=';
	(tipsolcodigo != '')? parameters = parameters + '&tipsolcodigo=' + tipsolcodigo : parameters = parameters + '&tipsolcodigo=';
	(ordoppcodigo != '')? parameters = parameters + '&ordoppcodigo=' + ordoppcodigo : parameters = parameters + '&ordoppcodigo=';
	(arritem != '')? parameters = parameters + '&arritem=' + arritem : parameters = parameters + '&arritem=';
	//accion ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.listaitems.php",
		data: parameters,
		beforeSend: function(data){
			$('#filteritemlist').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las items.</img>'});
		},        
		success: function(requestData){
			document.getElementById('filteritemlist').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ 
			$('#filteritemlist').unblock();
		}                                      
	});
}
//selecciona y  envia variables adiconales en el filtro
function reLoadListItems(){
	var obj_ordoppcodigo = document.getElementById('ordoppcodigo');
	var arrObjItems = document.getElementById('arritem').value.split(':|:'); //el comodin ':|:' es separador de filas
	var ordoppcodigo = (obj_ordoppcodigo)? obj_ordoppcodigo.value : '' ;

	var objparams = 'arritem=' + document.getElementById('arritem').value;
	for( i = 0; i < arrObjItems.length; i++ )
	{
		var objs_consumo = 'consumo_' + arrObjItems[i];
		var objs_itedescodigoid = 'itedescodigoid_' + arrObjItems[i];
		var obj_consumo = document.getElementById(objs_consumo);
		var obj_itedescodigoid = document.getElementById(objs_itedescodigoid);
		var consumo = (obj_consumo)? obj_consumo.value : '';
		var itedescodigoid = (obj_itedescodigoid)? obj_itedescodigoid.value : '';
		//parametros adicionales
		objparams = objparams + '&' + objs_consumo + '=' + consumo; 
		objparams = objparams + '&' + objs_itedescodigoid + '=' + itedescodigoid; 
	}

	objparams = objparams + '&ordoppcodigo=' + ordoppcodigo;
	ajaxListaGestion(objparams);
}

function reloadMaterial(){
	
	var objArrplaneacionopp = document.getElementById("arrplaneacionopp");

	var arrplaneacionopp = (objArrplaneacionopp)? objArrplaneacionopp.value : "" ;
	var objsArrplaneacionopp = (arrplaneacionopp)? arrplaneacionopp.split(",") : "" ;
	var parameters = "";

	parameters += "&arrplaneacionopp=" + arrplaneacionopp;

	for( i = 0; i < objsArrplaneacionopp.length; i++){

		var objsConsumo = "consumo_" + objsArrplaneacionopp[i];
		var objConsumo = document.getElementById(objsConsumo);
		var consumo = (objConsumo)? objConsumo.value : "" ;
		parameters += "&" + objsConsumo + "=" + consumo;
	}

	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.gestionplaneacionopp.php",
		data: parameters,
		beforeSend: function(data){
			$('#listadoplaneacionopp').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las items.</img>'});
		},        
		success: function(requestData){
			if(requestData != ''){
				//document.getElementById('listadoplaneacionopp').innerHTML = requestData;
				$("#listadoplaneacionopp").html(requestData);
			}
		},         
		error: function(requestData, strError, strTipoError){ 
			$('#listadoplaneacionopp').block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){
			$('#listadoplaneacionopp').unblock();
		}                                      
	});

}
//evento ajax para recargar items asignados
function ajaxListaGestion(objparams)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.gestionopp.php",
		data: objparams,
		beforeSend: function(data){
			$('#listadoitems').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las items.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listadoitems').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){
			$('#listadoitems').unblock();
		}                                      
	});
	
}
//evento ajax recargar bobinas
function accionReloadListBobinas()
{
	//objetos a utilizar
	var arrObjBobina = document.getElementById('arrbobina').value.split(':|:'); //el comodin ':|:' es separador de filas
	var obj_arrbobina = document.getElementById('arrbobina');
	//valor de los objeto
	var arrbobina = (obj_arrbobina)? obj_arrbobina.value : '' ; 
	//parametros de envio
	var parameters = '';
	var nrll = 0;
	(arrbobina != '')? parameters = parameters + '&arrbobina=' + arrbobina : parameters = parameters + '&arrbobina=';
	//variables a usar
	for( i = 0; i < arrObjBobina.length; i++ )
	{
		var rowsObjBobina = arrObjBobina[i].split(":-:");
		if(rowsObjBobina[1] != "t"){
			nrll++;
		}
		//variables de objetos adicionales
		var objs_consumokg = 'consumokg_' + arrObjBobina[i];
		var objs_lote = 'nolote_' + arrObjBobina[i];
		//objetos adicionales
		var obj_consumokg = document.getElementById(objs_consumokg);
		var obj_lote = document.getElementById(objs_lote);
		//valor de los objetos
		var consumokg = (obj_consumokg)? obj_consumokg.value : '' ;
		var lote = (obj_lote)? obj_lote.value : '' ;
		//parametros adicionales
		parameters = parameters + '&' + objs_consumokg + '=' + consumokg; 
		parameters = parameters + '&' + objs_lote + '=' + lote; 
	}
	parameters = parameters + '&nrll=' + nrll; 
	//evento ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.reporteopp.php", 	
		data: parameters,
		beforeSend: function(data){ 
			$('#listadobobinas').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las items.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listadobobinas').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ 
			$('#listadobobinas').unblock();
		}                                      
	});
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

function vEventSaldo( idmaterial ){

	var arrbobina = $( "#arrbobina" ).val();
	var objsarrbobina = ( $( "#arrbobina" ).val() )? $( "#arrbobina" ).val().split(":|:") : "" ;

	for( var i = 0; i < objsarrbobina.length; i++){
		var rowsarrbobina = objsarrbobina[i].split(":-:");
		var rows = rowsarrbobina[0] + ":-:" + rowsarrbobina[1] + ":-:" + rowsarrbobina[2];

		if( idmaterial  == rows ){
			return 1;
			break;
		}

	}

	return 0;

}

function vRadioButton( id, id1, evento){


	if(evento > 0){

		var objArrgestionoppreporte = ( $("#arrgestionoppreporte").val() )? $("#arrgestionoppreporte").val() : "" ;
		var objsArrgestionoppreporte = (objArrgestionoppreporte)? objArrgestionoppreporte.split(":|:") : "";
		var banderaValidacion = 0;

		for( var a = 0; a < objsArrgestionoppreporte.length; a++){

			if(objsArrgestionoppreporte[a] == id1){
				banderaValidacion = 1;
			}

		}

		setSelectionRow(id, document.getElementById("arrgestionoppreporterch").value, ':|:', "arrgestionoppreporterch");

		if(banderaValidacion > 0){

			setSelectionRow(id1, document.getElementById("arrgestionoppreporte").value, ':|:', "arrgestionoppreporte");
			banderaValidacion = 0;
		}


	}else{

		var objArrgestionoppreporterch = ( $("#arrgestionoppreporterch").val() )? $("#arrgestionoppreporterch").val() : "" ;
		var objsArrgestionoppreporterch = (objArrgestionoppreporterch)? objArrgestionoppreporterch.split(":|:") : "";
		var banderaValidacion = 0;

		for( var a = 0; a < objsArrgestionoppreporterch.length; a++){

			if(objsArrgestionoppreporterch[a] == id1){
				banderaValidacion = 1;
			}
			
		}

		setSelectionRow(id, document.getElementById("arrgestionoppreporte").value, ':|:', "arrgestionoppreporte");

		if(banderaValidacion > 0){

			setSelectionRow(id1, document.getElementById("arrgestionoppreporterch").value, ':|:', "arrgestionoppreporterch");
			banderaValidacion = 0;
		}

	}

}
