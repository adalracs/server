$(function(){
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
function setOrdoppcodigo(ordoppcodigo)
{
	$('#ordoppcodigo').val( ordoppcodigo + "|n" );
	$('#selstar').val(1);	
}

function valResultado( vresultado, varanacodigo){

	var objsVaranatipespee = "varanatipespe" + varanacodigo;
	var objsVaranatolems = "varanatolems" + varanacodigo;
	var objsVaranatolemn = "varanatolemn" + varanacodigo;
	var objsarVaranadetesp = "varanadetesp" + varanacodigo;

	var varanatipespe = parseInt ( $( "#" + objsVaranatipespee ).val() );
	var varanatolems = parseFloat ( $( "#" + objsVaranatolems ).val() );
	var varanatolemn = parseFloat ( $( "#" + objsVaranatolemn ).val() );
	var varanadetesp = parseFloat ( $( "#" + objsarVaranadetesp ).val() );

	var bandera = 0;

	if(varanatipespe == 1){//tolerancia o rango

		//ingresar codigo para validar con porcentaje

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

	}

	if(bandera > 0){

		var objsValor = "txtvalor" + varanacodigo;
		$( "#" + objsValor ).addClass( "ui-state-highlight ui-corner-all" );

	}else{

		var objsValor = "txtvalor" + varanacodigo;
		$( "#" + objsValor ).removeClass( "ui-state-highlight ui-corner-all" );

	}


}











//aqui