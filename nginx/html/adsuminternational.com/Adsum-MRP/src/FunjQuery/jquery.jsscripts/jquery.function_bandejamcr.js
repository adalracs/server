$(function(){
	//tab's para la bandeja general de microperforado
	$("#bandejaotgeneral").tabs({
		ajaxOptions: {
			error: function(xhr, status, index, anchor) {
				$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	//tab's para el programa de microperforado
	$("#programamicroperforado").tabs({
		ajaxOptions: {
		error: function(xhr, status, index, anchor) {
		$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	/*
	//boton para evento de simular opp de microperforado
	$('#simularopp_mcr').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
	});
	*/
	//boton con evento para geneer opp de microperforado
	$('#generaropp_mcr').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#generaropp_mcr" ).button( "option", "disabled", true );
		$( "#backward_mcr" ).button( "option", "disabled", true );
		//objetos a utilizar
		var obj_arrop = document.getElementById('arrop');
		//valor de los objetos
		var arrop = (obj_arrop)? obj_arrop.value : '' ;
		//validacion de error
		var err = '' ;
		if(arrop == '')
			err = err + 'Advertencia : *** Debe seleccionar una o varias op.' ;		
		
		if(err == '')
		{
			//acccion del boton
			document.form1.action='ingrnuevopp_mcr.php';
			document.form1.submit();
		}
		else
		{
			$( "#generaropp_mcr" ).button( "option", "disabled", false );
			$( "#backward_mcr" ).button( "option", "disabled", false );
			//mensaje de error
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		return false;
	});
	//boton de atras para retornar a la bandeja de microperforado
	$('#backward_mcr').button({ icons: { primary: "ui-icon-seek-prev" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#generaropp_mcr" ).button( "option", "disabled", true );
		$( "#backward_mcr" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablbandejamicroperforado.php';
		document.form1.submit();
		return false;
	});
	//boton para ingresar a editar el programa de microperforado		
	$('#editarprograma_mcr').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editarprograma_mcr" ).button( "option", "disabled", true );
		//acccion del boton	
		document.form1.action='_editarprogramamicroperforado.php';
		document.form1.submit();
		return false;
	});
	//evento para accion de graba la orden de produccion
	$('#aceptaropp_mcr').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#aceptaropp_mcr" ).button( "option", "disabled", true );
		$( "#cancelaropp_mcr" ).button( "option", "disabled", true );
		//acccion del boton
		//document.getElementsByName('accionnuevoopp_')[0].value = 1;
		document.getElementsByName('accion' + document.form1.sourceaction.value + 'opp')[0].value = 1;
		document.form1.submit();	
		return false;
	});
	//evento para accion de cancelar la orden de produccion	
	$('#cancelaropp_mcr').button({ icons: { primary: "ui-icon-circle-close" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#aceptaropp_mcr" ).button( "option", "disabled", true );
		$( "#cancelaropp_mcr" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablbandejamicroperforado.php';
		document.form1.submit();	
		return false;
	});
	//evento para mensaje de dialogo
	$("#msgwindow").dialog({
		autoOpen: false,
		width: 350,
		modal: true,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close"); 
			}
		}
	});
	//evento para mensaje de dialogo
	$("#msgwindowup").dialog({
		autoOpen: false,
		width: 350,
		modal: true,
		buttons: {
			"Actualizar": function() { 
				uprecordopp();
//				$(this).dialog("close"); 
			},
			"Cerrar": function() { 
				$(this).dialog("close"); 
			}
		}
	});
	//evento para editar el programa de microperforado
    $('#editaprograma_mcr').button({ icons: { primary: "ui-icon-pencil" } }).click(function() {
        //objetos a utilizar
        var obj_arrequipo = document.getElementById('arrequipo');			        
        //valor de los objetos
    	var arrequipo = (obj_arrequipo)? obj_arrequipo.value : '' ;
    	var _arrequipo = (arrequipo)? arrequipo.split(',') : '' ;
    	//accion del boton
    		var arrupdate = '';
    	for(i = 0;i< _arrequipo.length;i++)
    	{
	      	arrupdate = (arrupdate == '')? arrupdate = _arrequipo[i] + ',' +  $("#sortable_" + _arrequipo[i]).sortable("toArray") : arrupdate = arrupdate + ':|:' +  _arrequipo[i] + ',' +  $("#sortable_" + _arrequipo[i]).sortable("toArray");						
	    }  
    	update_programa(arrupdate);
		return false;
	});
	//evento para cancelar la edicion de programa
	$('#cancelarprograma_mcr').button({ icons: { primary: "ui-icon-seek-prev" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editaprograma_mcr" ).button( "option", "disabled", true );
		$( "#cancelarprograma_mcr" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablprogramamicroperforado.php';
		document.form1.submit();
		return false;
	});
	
	//boton para evento de simular opp de extrusion
	$('#editaropp_mcr').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editaropp_mcr" ).button( "option", "disabled", true );
		//objetos a utilizar
		var obj_arropp = document.getElementById('arropp');
		//valor de los objetos
		var arropp = (obj_arropp)? obj_arropp.value : '' ; 
		//validacion de error
		var err = '' ;
		if(arropp == '')
			err = err + 'Advertencia : *** Debe seleccionar una orden de produccion.' ;
		
		if(err == '')
		{
			//acccion del boton
			document.form1.action='editaropp_mcr.php';
			document.form1.submit();
		}
		else
		{
			$( "#editaropp_mcr" ).button( "option", "disabled", false );
			//mensaje de error
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		return false;
	});
});

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
//evento que crear los animatedcollapse en la bandeja de microperforado
function Event_animatedcollapse(indice, id_animated)
{
	//accion
	for(i = 0;i < indice;i++)
	{
		
		animatedcollapse.addDiv(id_animated + '_' +  i, 'fade=1,height=auto');
	}
	//inicia el evento
	animatedcollapse.init();
}
//evento para actualizar el programa de microperforado
function update_programa(arr_programa)
{
	//objetos a usar
	var obj_arroppview = document.getElementById('arroppview');
	//valor de los objetos
	var arroppview = (obj_arroppview)? obj_arroppview.value : '' ;
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_editarprogramamcr.php",
		data: 'arr_programa=' + arr_programa + '&arroppview=' + arroppview ,
		beforeSend: function(data){ 
			$( "#editaprograma_mcr" ).button( "option", "disabled", true );
			$( "#cancelarprograma_mcr" ).button( "option", "disabled", true );
		},
		success: function(json){
			if(json == 'error')
			{
				document.getElementById('msg').innerHTML = 'Advertencia: Programa no actualizado.';
				$("#msgwindow").dialog("open");
			}
			else
			{
				document.getElementById('msg').innerHTML = 'Programa Actualizado.';
				$("#msgwindow").dialog("open");
			}
			$( "#editaprograma_mcr" ).button( "option", "disabled", false );
			$( "#cancelarprograma_mcr" ).button( "option", "disabled", false );
		}
	});
}
//evento que asigna el array de op
function setArrop(valor)
{
	document.getElementById('arrop').value = valor;
}
//evento para recargar velocidades por maquina
function reladlistVelocidadpn()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.velocidadpn.php", 	
		data: 'arrvelocidadpn=&equipocodigo=' + document.getElementById('equipocodigo').value + '&tipsolcodigo=5',
		beforeSend: function(data){ 
			//document.getElementById('listavelocidadpn').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las velocidades pn.</img>';
			$('#listavelocidadpn').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las velocidades de produccion.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listavelocidadpn').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ 
			$('#listavelocidadpn').unblock();
		}                                      
	});
}
//evento para recargar ajustes y/o cambios por maquina
function reladlistAjsutepn()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.ajustepn.php", 	
		data: 'arrajustepn=&equipocodigo=' + document.getElementById('equipocodigo').value + '&tipsolcodigo=5',
		beforeSend: function(data){ 
			//document.getElementById('listaajustepn').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las velocidades pn.</img>';
			$('#listaajustepn').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las velocidades de produccion.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listaajustepn').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ 
			$('#listaajustepn').unblock();
		}                                      
	});
}
//evento que asigna el array de opp
function setArropp(valor)
{
	document.getElementById('arropp').value = valor;
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