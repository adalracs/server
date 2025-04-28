$(function(){
	
	$("#tipsolcodigo").change(function(){ cargarArrEquipo( this.value ); } );

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

	$('#cierre').button({ icons: { primary: "ui-icon-gear" } }).click(function() {		
		if( $( "#selstar" ).val() >= 1 )
			{
			//document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
			document.form1.action = 'ingrnuevcierreopp.php';
			document.form1.submit();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
		}
		return false;
	});


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

function openUpdateOpp(idordenproduccion,idequipo)
{
	var err = '';
	
	if(idordenproduccion <= 0 || !idequipo)
		err = err + 'Advertencia : Error inesperado.';
	
	if(err == '')
	{
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.phpscripts/jq.updateopp.php", 	
			data: 'ordoppcodigo=' + idordenproduccion + '&equipocodigo=' + idequipo + '&tipsolcodigo=5' ,
			beforeSend: function(data){
				document.getElementById('msg1').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la informacion.</img>';		
			},          
			success: function(requestData){
				if(requestData != '')
				{
					document.getElementById('msg1').innerHTML = requestData;
				}
			},         
			error: function(requestData, strError, strTipoError){ },
			complete: function(requestData, exito)
			{}                                      
		});
		//getter
		var height = $( "#msgwindowup" ).dialog( "option", "height" );
		var width = $( "#msgwindowup" ).dialog( "option", "width" );
		//setter
		$( "#msgwindowup" ).dialog( "option", "height", 480 );
		$( "#msgwindowup" ).dialog( "option", "width", 830 );
		$( "#msgwindowup" ).dialog( "option", "resizable", false );
		$( "#msgwindowup" ).dialog( "open");
	}
	else
	{
		document.getElementById('msg1').innerHTML = err;
		$("#msgwindowup").dialog("open");
	}
}
//actualizar orden de produccion {tiempos de ajuste}
function uprecordopp ()
{
	//id de los objetos a usar
	var id_arrvelocidadpn = 'arrvelocidadpn';
	var id_arrajustepn = 'arrajustepn';
	var id_ordoppcodigo = 'ordoppcodigo';
	//objetos a usar
	var obj_arrvelocidadpn = document.getElementById(id_arrvelocidadpn);
	var obj_arrajustepn = document.getElementById(id_arrajustepn);
	var obj_ordoppcodigo = document.getElementById(id_ordoppcodigo);
	//valor de los objetos
	var arrvelocidadpn = (obj_arrvelocidadpn)? obj_arrvelocidadpn.value : '' ;
	var arrajustepn = (obj_arrajustepn)? obj_arrajustepn.value : '' ;
	var ordoppcodigo = (obj_ordoppcodigo)? obj_ordoppcodigo.value : '' ;
	var err = '';
	//validacion de error
	if(arrvelocidadpn == '')
		err = (err != '')? err + ' - Debe Seleccionar Velocidad.' : '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Advertencia:</strong> *** Debe Seleccionar Velocidad' ;
	
	if(arrajustepn == '')
		err = (err != '')? err + ' - Debe Seleccionar Ajustes/Cambios.' : '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Advertencia:</strong> *** Debe Seleccionar Ajustes/Cambios.';
	
	if(ordoppcodigo == '')
		err = (err != '')? err + ' - Ocurrio un error inesperado.' : '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Advertencia:</strong> *** Ocurrio un error inesperado.';
	
	if(err == '')
	{
		$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.phpscripts/jq.uprecordopp.php", 	
			data: 'ordoppcodigo=' + ordoppcodigo + '&arrvelocidadpn=' + arrvelocidadpn + '&arrajustepn=' + arrajustepn,
			beforeSend: function(data){
				$("#msgwindow").dialog("open");
				document.getElementById('msg').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras actualiza la informacion.</img>';		
			},          
			success: function(requestData){
				if(requestData != '')
				{
					document.getElementById('msg').innerHTML = requestData;
					$("#msgwindowup").dialog("close");
				}
			},         
			error: function(requestData, strError, strTipoError){ },
			complete: function(requestData, exito)
			{}                                      
		});
	}
	else
	{
		document.getElementById('mnsj').innerHTML = err;
		document.getElementById('wmnsj').style.display = 'block';
	}
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
       	style: {  border: { width: 5, radius: 5 }, padding: 2, textAlign: 'left', tip: true, name: 'cream' }
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