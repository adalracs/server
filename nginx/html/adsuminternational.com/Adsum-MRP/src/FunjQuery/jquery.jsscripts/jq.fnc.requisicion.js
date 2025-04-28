$(function(){

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

	$("#ordenproduccion").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jq.atc.ordenproduccion.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('idopp').value = ui.item.id;
			}
			else
			{
				document.getElementById('idopp').value = "";
			}
		}
	});

	$('#ingresaropp').button().click(function() {
		ajaxOrdenProduccion();
		$("#msgwindowform").dialog("open");
		$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() {reLoadListOrdenProduccion();$(this).dialog("close");} } ] });
		$("#msgwindowform").dialog( "option", "width", "auto" );
		$("#msgwindowform").dialog( "option", "height", "auto" );
		//$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Ordenes Produccion]" );
		return false;
	});

	$('#quitaropp').button().click(function() {
		loadArraylistdelete('arrrequisicionopp', ',');
		reLoadListOrdenProduccion();
		return false;
	});
	
	//ventana de dialogo ordenes de produccion
	$("#msgwindowform").dialog({
		autoOpen: false,
		modal: true,
		position: { my: "left top", at: "left top", of: window }
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
//evento de los radiobutton para obtener el id de la orden de produccion seleccionada
function setArrrequisicionopp(ordoppcodigo)
{
	setSelectionRow(ordoppcodigo, $( "#arrrequisicionopp" ).val(), ',', 'arrrequisicionopp');
	$('#selstar').val(1);	
}

function ajaxFilterOrdenRequisicion()
{
	//objetos a utilizar
	var obj_arrrequisicionopp = document.getElementById('arrrequisicionopp');
	var obj_tipsolcodigo = document.getElementById('tipsolcodigo');
	var obj_opestacodigo = document.getElementById('opestacodigo');
	var obj_solprocodigo = document.getElementById('solprocodigo');
	//valor de los objetos
	var arrrequisicionopp = (obj_arrrequisicionopp)? obj_arrrequisicionopp.value : '' ;
	var tipsolcodigo = (obj_tipsolcodigo)? obj_tipsolcodigo.value : '' ; 
	var opestacodigo = (obj_opestacodigo)? obj_opestacodigo.value : '' ; 
	var solprocodigo = (obj_solprocodigo)? obj_solprocodigo.value : '' ; 

	//parametros de envio
	var parameters = '';
	(arrrequisicionopp != '')? parameters = parameters + '&arrrequisicionopp=' + arrrequisicionopp : parameters = parameters + '&arrrequisicionopp=';
	(tipsolcodigo != '')? parameters = parameters + '&tipsolcodigo=' + tipsolcodigo : parameters = parameters + '&tipsolcodigo=';
	(opestacodigo != '')? parameters = parameters + '&opestacodigo=' + opestacodigo : parameters = parameters + '&opestacodigo=';
	(solprocodigo != '')? parameters = parameters + '&solprocodigo=' + solprocodigo : parameters = parameters + '&solprocodigo=';
	//accion ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jq.vlistordenrequisicion.php",
		data: parameters,
		beforeSend: function(data){
			//document.getElementById('filterordenrequisicion').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
			$('#filterordenrequisicion').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>'});
		},         
		success: function(requestData){
			document.getElementById('filterordenrequisicion').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ 
			$('#filterordenrequisicion').unblock();
		}                                      
	});
	
}
//carga formulacion de ordenes de produccion 
function ajaxOrdenProduccion()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jq.formordenrequisicion.php",
		data: "arrrequisicionopp=" + $( "#arrrequisicionopp" ).val() ,
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
function reLoadListOrdenProduccion(){
	var arrObjItems = document.getElementById('arrrequisicionopp').value.split(','); //el comodin ',' es separador de filas
	var objparams = "arrrequisicionopp=" + document.getElementById('arrrequisicionopp').value;
	ajaxListaOrdenProduccion(objparams);
}
//evento ajax para recargar ordenes de produccion asignadas a la RI => requisicion interna
function ajaxListaOrdenProduccion(objparams)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jq.vrequisicionopp.php",
		data: objparams,
		beforeSend: function(data){
			//document.getElementById('listaordenproduccion').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
			$('#listaordenproduccion').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>'});
		},         
		success: function(requestData){
			document.getElementById('listaordenproduccion').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){
			$('#listaordenproduccion').unblock();
		}                                      
	});
}