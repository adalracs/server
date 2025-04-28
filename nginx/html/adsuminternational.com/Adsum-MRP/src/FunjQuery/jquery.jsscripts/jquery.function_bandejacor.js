$(function(){
	$("a[title]").qtip({
       //content: '<?php echo str_replace("\r",'', str_replace("\n",'<br>', $value)) ?>',
       show: 'mouseover',
       hide: 'mouseout',
       style: {  border: { width: 5, radius: 5 }, padding: 2, textAlign: 'left', tip: true, name: 'green' }
       //position: { corner: { target: 'leftMiddle', tooltip: 'rightMiddle' } }
    });
	//tab's para la bandeja general de corte
	$("#bandejaotgeneral").tabs({
		ajaxOptions: {
			error: function(xhr, status, index, anchor) {
				$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	//tab's para el programa de corte
	$("#programacorte").tabs({
		ajaxOptions: {
		error: function(xhr, status, index, anchor) {
		$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	/*
	//boton para evento de simular opp de corte
	$('#simularopp_cor').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
	});
	*/
	//boton con evento para geneer opp de corte
	$('#generaropp_cor').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#generaropp_cor" ).button( "option", "disabled", true );
		$( "#backward_cor" ).button( "option", "disabled", true );
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
			document.form1.action='ingrnuevopp_cor.php';
			document.form1.submit();
		}
		else
		{
			//mensaje de error
			$( "#generaropp_cor" ).button( "option", "disabled", false );
			$( "#backward_cor" ).button( "option", "disabled", false );
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		return false;
	});
	//boton de atras para retornar a la bandeja de corte
	$('#backward_cor').button({ icons: { primary: "ui-icon-seek-prev" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#generaropp_cor" ).button( "option", "disabled", true );
		$( "#backward_cor" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablbandejacorte.php';
		document.form1.submit();
		return false;
	});
	//boton para ingresar a editar el programa de corte		
	$('#editarprograma_cor').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editarprograma_cor" ).button( "option", "disabled", true );
		//acccion del boton	
		document.form1.action='_editarprogramacorte.php';
		document.form1.submit();
		return false;
	});
	//evento para accion de graba la orden de produccion
	$('#aceptaropp_cor').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#aceptaropp_cor" ).button( "option", "disabled", true );
		$( "#cancelaropp_cor" ).button( "option", "disabled", true );
		//acccion del boton
//		document.getElementsByName('accionnuevoopp_')[0].value = 1;
		document.getElementsByName('accion' + document.form1.sourceaction.value + 'opp')[0].value = 1;
		document.form1.submit();	
		return false;
	});
	//evento para accion de cancelar la orden de produccion	
	$('#cancelaropp_cor').button({ icons: { primary: "ui-icon-circle-close" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#aceptaropp_cor" ).button( "option", "disabled", true );
		$( "#cancelaropp_cor" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablbandejacorte.php';
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
	//evento para editar el programa de corte
    $('#editaprograma_cor').button({ icons: { primary: "ui-icon-pencil" } }).click(function() {
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
	$('#cancelarprograma_cor').button({ icons: { primary: "ui-icon-seek-prev" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editaprograma_cor" ).button( "option", "disabled", true );
		$( "#cancelarprograma_cor" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablprogramacorte.php';
		document.form1.submit();
		return false;
	});
	//boton para evento de simular opp de extrusion
	$('#editaropp_cor').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editaropp_cor" ).button( "option", "disabled", true );
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
			document.form1.action='editaropp_cor.php';
			document.form1.submit();
		}
		else
		{
			$( "#editaropp_cor" ).button( "option", "disabled", false );
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
//evento que crear los animatedcollapse en la bandeja de corte
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
//evento para actualizar el programa de corte
function update_programa(arr_programa)
{
	//objetos a usar
	var obj_arroppview = document.getElementById('arroppview');
	//valor de los objetos
	var arroppview = (obj_arroppview)? obj_arroppview.value : '' ;
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_editarprogramacor.php",
		data: 'arr_programa=' + arr_programa + '&arroppview=' + arroppview ,
		beforeSend: function(data){ 
			$( "#editaprograma_lmn" ).button( "option", "disabled", true );
			$( "#cancelarprograma_lmn" ).button( "option", "disabled", true );
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
			$( "#editaprograma_cor" ).button( "option", "disabled", false );
			$( "#cancelarprograma_cor" ).button( "option", "disabled", false );
		}
	});
}
//evento que asigna el array de op
function setArrop(valor)
{
	document.getElementById('arrop').value = valor;
}
//evento para recargar la bandaje de acuerdo a los filtros seleccionados
function ajax_filtro()
{
	//objetos a utilizar
	var obj_plantacodigo = document.getElementById('plantacodigo');
	var obj_ordproancmat = document.getElementById('ordproancmat');
	var obj_arrop = document.getElementById('arrop');
	//valor de los objetos
	var plantacodigo = (obj_plantacodigo)? obj_plantacodigo.value : '' ; 
	var ordproancmat = (obj_ordproancmat)? obj_ordproancmat.value : '' ; 
	var arrop = (obj_arrop)? obj_arrop.value : '' ; 
	//parametros de envio
	var parameters = '' ;
	parameters = (plantacodigo != '')? parameters + 'plantacodigo=' + plantacodigo : parameters + 'plantacodigo=' ;
	parameters = (ordproancmat != '')? parameters + '&ordproancmat=' + ordproancmat : parameters + '&ordproancmat=' ;	
	parameters = (arrop != '')? parameters + '&arrop=' + arrop : parameters + '&arrop=' ;
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "detallabandejacorte.php",
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('detallebandejacorte').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la bandeja.</img>';
			$('#detallebandejacorte').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga la bandeja.</img>'});
			document.getElementById('total_und_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('total_kgs_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('total_mts_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
		},
		success: function(requestData){
			document.getElementById('detallebandejacorte').innerHTML = requestData;
		},
		complete : function(requestData)
		{			
			$('#detallebandejacorte').unblock();
			//objetos a usar
			var obj_total_und = document.getElementById('total_und');
			var obj_total_kgs = document.getElementById('total_kgs');
			var obj_total_mts = document.getElementById('total_mts');
			//valor de los objetos
			var total_und = (obj_total_und)? obj_total_und.value : '' ;
			var total_kgs = (obj_total_kgs)? obj_total_kgs.value : '' ;
			var total_mts = (obj_total_mts)? obj_total_mts.value : '' ;
			//label a usar
			var lbl_total_und = document.getElementById('total_und_lbl');
			var lbl_total_kgs = document.getElementById('total_kgs_lbl');
			var lbl_total_mts = document.getElementById('total_mts_lbl');
			//se asigna el valor a label
			if(lbl_total_und) lbl_total_und.innerHTML = number_format(total_und, 2, ',', '.');
			if(lbl_total_kgs) lbl_total_kgs.innerHTML = number_format(total_kgs, 2, ',', '.');
			if(lbl_total_mts) lbl_total_mts.innerHTML = number_format(total_mts, 2, ',', '.');
			//se actualiza el evento animatedcollapse
			Event_animatedcollapse(total_und , 'filtrOp');
		}
	});
}


//evento para recargar las ordenes de acuerdo a los filtros seleccionados
function ajax_filtroopp()
{
	//objetos a utilizar
	var obj_plantacodigo = document.getElementById('plantacodigo_opp');
	var obj_ordproancmat = document.getElementById('ordproancmat_opp');
	var obj_arrop = document.getElementById('arrop');
	//valor de los objetos
	var plantacodigo = (obj_plantacodigo)? obj_plantacodigo.value : '' ; 
	var ordproancmat = (obj_ordproancmat)? obj_ordproancmat.value : '' ; 
	var arrop = (obj_arrop)? obj_arrop.value : '' ; 
	//parametros de envio
	var parameters = '' ;
	parameters = (plantacodigo != '')? parameters + 'plantacodigo=' + plantacodigo : parameters + 'plantacodigo=' ;
	parameters = (ordproancmat != '')? parameters + '&ordproancmat=' + ordproancmat : parameters + '&ordproancmat=' ;	
	parameters = (arrop != '')? parameters + '&arrop=' + arrop : parameters + '&arrop=' ;
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "detallaordencorte.php",
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('detalleordencorte').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga las ordenes de produccion.</img>';
			$('#detalleordencorte').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga las ordenes de produccion.</img>'});
			document.getElementById('totalopp_und_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('totalopp_kgs_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('totalopp_mts_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
		},
		success: function(requestData){
			document.getElementById('detalleordencorte').innerHTML = requestData;
		},
		complete : function(requestData)
		{			
			$('#detalleordencorte').unblock();
			//objetos a usar
			var obj_totalopp_und = document.getElementById('totalopp_und');
			var obj_totalopp_kgs = document.getElementById('totalopp_kgs');
			var obj_totalopp_mts = document.getElementById('totalopp_mts');
			//valor de los objetos
			var totalopp_und = (obj_totalopp_und)? obj_totalopp_und.value : '' ;
			var totalopp_kgs = (obj_totalopp_kgs)? obj_totalopp_kgs.value : '' ;
			var totalopp_mts = (obj_totalopp_mts)? obj_totalopp_mts.value : '' ;
			//label a usar
			var lbl_totalopp_und_lbl = document.getElementById('totalopp_und_lbl');
			var lbl_totalopp_kgs_lbl = document.getElementById('totalopp_kgs_lbl');
			var lbl_totalopp_mts_lbl = document.getElementById('totalopp_mts_lbl');
			//se asigna el valor a label
			if(lbl_totalopp_und_lbl) lbl_totalopp_und_lbl.innerHTML = number_format(totalopp_und, 2, ',', '.');
			if(lbl_totalopp_kgs_lbl) lbl_totalopp_kgs_lbl.innerHTML = number_format(totalopp_kgs, 2, ',', '.');
			if(lbl_totalopp_mts_lbl) lbl_totalopp_mts_lbl.innerHTML = number_format(totalopp_mts, 2, ',', '.');
			//se actualiza el evento animatedcollapse
			Event_animatedcollapse(totalopp_und , 'filtrOpp');
		}
	});
}


//evento para recargar velocidades por maquina
function reladlistVelocidadpn()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.velocidadpn.php", 	
		data: 'arrvelocidadpn=&equipocodigo=' + document.getElementById('equipocodigo').value + '&tipsolcodigo=4',
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
		data: 'arrajustepn=&equipocodigo=' + document.getElementById('equipocodigo').value + '&tipsolcodigo=4',
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
			data: 'ordoppcodigo=' + idordenproduccion + '&equipocodigo=' + idequipo + '&tipsolcodigo=4' ,
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