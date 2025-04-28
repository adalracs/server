$(function(){

	$("a[title]").qtip({
       //content: '<?php echo str_replace("\r",'', str_replace("\n",'<br>', $value)) ?>',
       show: 'mouseover',
       hide: 'mouseout',
       style: {  border: { width: 5, radius: 5 }, padding: 2, textAlign: 'left', tip: true, name: 'green' }
       //position: { corner: { target: 'leftMiddle', tooltip: 'rightMiddle' } }
    });
	//tab's para la bandeja general de corteextrusion
	$("#bandejaotgeneral").tabs({
		ajaxOptions: {
			error: function(xhr, status, index, anchor) {
				$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	//tab's para el programa de corteextrusion
	$("#programacorteextrusion").tabs({
		ajaxOptions: {
		error: function(xhr, status, index, anchor) {
		$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	//boton para evento de simular opp de corteextrusion
	$('#simularopp_cxt').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#simularopp_cxt" ).button( "option", "disabled", true );
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
			document.form1.action='simularopp_cxt.php';
			document.form1.submit();
		}
		else
		{
			$( "#simularopp_cxt" ).button( "option", "disabled", false );
			//mensaje de error
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		return false;
	});
	//evento para editar el programa de corteextrusion
	$('#editarprograma_cxt').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editarprograma_cxt" ).button( "option", "disabled", true );
		//acccion del boton		
		document.form1.action='_editarprogramacorteextrusion.php';
		document.form1.submit();
		return false;
	});
	//boton con evento para geneer opp de corteextrusion
	$('#generaropp_cxt').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#generaropp_cxt" ).button( "option", "disabled", true );
		$( "#backward_cxt" ).button( "option", "disabled", true );
		//objetos a utilizar
		var obj_ordoppanchot = document.getElementById('ordoppanchot');
		var obj_ordopprefile = document.getElementById('ordopprefile');
		var obj_ordoppcantkg = document.getElementById('ordoppcantkg');
		var obj_arrop = document.getElementById('arrop');
		var objs_arrop = (obj_arrop)? obj_arrop.value.split(',') : '' ;
		//valor de los objetos
		var ordoppanchot_ = (obj_ordoppanchot)? obj_ordoppanchot.value : '' ; 
		var ordoppanchot = (/^([0-9\,.])*$/.test(ordoppanchot_))? ordoppanchot_ : 0;
		var ordopprefile_ = (obj_ordopprefile)? obj_ordopprefile.value : '' ;
		var ordopprefile = (/^([0-9\,.])*$/.test(ordopprefile_))? ordopprefile_ : 0; 
		var ordoppcantkg_ = (obj_ordoppcantkg)? obj_ordoppcantkg.value : '' ;
		var ordoppcantkg = (/^([0-9\,.])*$/.test(ordoppcantkg_))? ordoppcantkg_ : 0;
		//validacion de error
		var err = '';
		if(ordoppanchot <= 0 || ordopprefile <0 || ordoppcantkg <= 0)
		{
			err = 'error';
		}
		//accion de la funcion
		for(i = 0;i < objs_arrop.length;i++)
		{
			//variables a utilizar
			var objs_pista = 'pista_' + objs_arrop[i];		
			var objs_ancho = 'ancho_' + objs_arrop[i];
			var objs_anchot = 'anchot_' + objs_arrop[i];
			var objs_cantid = 'cantid_' + objs_arrop[i];
			var objs_porcen = 'porcen_' + objs_arrop[i];
			//objetos a utilizar	 
			var obj_pista = document.getElementById(objs_pista);
			var obj_ancho = document.getElementById(objs_ancho);
			var obj_anchot = document.getElementById(objs_anchot);
			var obj_cantid = document.getElementById(objs_cantid);
			var obj_porcen = document.getElementById(objs_porcen);
			//valor de los objetos
			var pista_ = (obj_pista)? obj_pista.value : '' ;
			var pista = (/^([0-9\,.])*$/.test(pista_))? pista_ : 0;
			var ancho_ = (obj_ancho)? obj_ancho.value : '' ;
			var ancho = (/^([0-9\,.])*$/.test(ancho_))? ancho_ : 0;
			var anchot_ = (obj_anchot)? obj_anchot.value : '' ;
			var anchot = (/^([0-9\,.])*$/.test(anchot_))? anchot_ : 0;
			var cantid_ = (obj_cantid)? obj_cantid.value : '' ;
			var cantid = (/^([0-9\,.])*$/.test(cantid_))? cantid_ : 0;
			var porcen_ = (obj_porcen)? obj_porcen.value : '' ;
			var porcen = (/^([0-9\,.])*$/.test(porcen_))? porcen_ : 0;

			if(pista <= 0 || ancho <= 0 || anchot <= 0 || cantid <= 0 || porcen <=0)
			{
				err = 'error';
				break;
			}
		}
		
		if(err == '')
		{
			//acccion del boton
			document.form1.action='ingrnuevopp_cxt.php';
			document.form1.submit();	
		}
		else
		{
			$( "#generaropp_cxt" ).button( "option", "disabled", false );
			$( "#backward_cxt" ).button( "option", "disabled", false );
			//mensaje de error
			document.getElementById('msg').innerHTML = '***Advertencia : Ocurrio algun error al simular opp.';
			$("#msgwindow").dialog("open");
		}
		return false;
	});
	//boton de atras para retornar a la bandeja de corteextrusion
	$('#backward_cxt').button({ icons: { primary: "ui-icon-seek-prev" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#generaropp_cxt" ).button( "option", "disabled", true );
		$( "#backward_cxt" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablbandejacorteextrusion.php';
		document.form1.submit();
		return false;
	});
	//evento para graba la orden de produccion opp
	$('#aceptaropp_cxt').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#aceptaropp_cxt" ).button( "option", "disabled", true );
		$( "#cancelaropp_cxt" ).button( "option", "disabled", true );
		//acccion del boton
		document.getElementsByName('accion' + document.form1.sourceaction.value + 'opp')[0].value = 1;
		document.form1.submit();	
		return false;
	});
	//evento para cancelar la orden de produccion opp
	$('#cancelaropp_cxt').button({ icons: { primary: "ui-icon-circle-close" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#aceptaropp_cxt" ).button( "option", "disabled", true );
		$( "#cancelaropp_cxt" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablbandejacorteextrusion.php';
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
	//evento para editar el programa de corteextrusion
	$('#editaprograma_cxt').button({ icons: { primary: "ui-icon-pencil" } }).click(function() {
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
	//evento para cancelar la edicion de programa de corteextrusion
	$('#cancelarprograma_cxt').button({ icons: { primary: "ui-icon-seek-prev" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editaprograma_cxt" ).button( "option", "disabled", true );
		$( "#cancelarprograma_cxt" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablprogramacorteextrusion.php';
		document.form1.submit();
		return false;
	});
	//boton para evento de simular opp de corteextrusion
	$('#editaropp_cxt').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editaropp_cxt" ).button( "option", "disabled", true );
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
			document.form1.action='editaropp_cxt.php';
			document.form1.submit();
		}
		else
		{
			$( "#editaropp_cxt" ).button( "option", "disabled", false );
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
//evento para calcular la formulacion del ancho a cxtruir
function eventAnchoBobina()
{
	//objetos a utilizar
	var obj_ordoppanchot = document.getElementById('ordoppanchot');
	var obj_ordopprefile = document.getElementById('ordopprefile');
	var obj_ordoppcantkg = document.getElementById('ordoppcantkg');
	var obj_ordoppanchou = document.getElementById('ordoppanchou');
	var obj_arrop = document.getElementById('arrop');
	var objs_arrop = (obj_arrop)? obj_arrop.value.split(',') : '' ;
	//valor de los objetos
	var ordopprefile = (obj_ordopprefile)? obj_ordopprefile.value : '' ;
	var ordoppcantkg = (obj_ordoppcantkg)? obj_ordoppcantkg.value : '' ;
	var ordoppanchou = (obj_ordoppanchou)? obj_ordoppanchou.value : '' ;
	var ordoppanchot = 0;
	var ordoppanchou = 0;
	var ordoppcantkg = 0;
	//objetos de etiquetas a usar
	var lbl_ordoppanchot = document.getElementById('ordoppanchot_lb'); 
	//accion de la funcion
	for(i = 0;i < objs_arrop.length;i++)
	{
		//objetos label {span}
		var lbls_anchot = 'lb_anchot_' + objs_arrop[i];
		var lbl_anchot = document.getElementById(lbls_anchot);
		//variables a utilizar
		var objs_pista = 'pista_' + objs_arrop[i];		
		var objs_ancho = 'ancho_' + objs_arrop[i];
		var objs_anchot = 'anchot_' + objs_arrop[i];
		var objs_cantid = 'cantid_' + objs_arrop[i];
		//objetos a utilizar	 
		var obj_pista = document.getElementById(objs_pista);
		var obj_ancho = document.getElementById(objs_ancho);
		var obj_anchot = document.getElementById(objs_anchot);
		var obj_cantid = document.getElementById(objs_cantid);
		//valor de los objetos
		var pista_ = (obj_pista)? obj_pista.value : '' ;
		var ancho = (obj_ancho)? obj_ancho.value : '' ;
		var anchot = (obj_anchot)? obj_anchot.value : '' ;
		var cantid = (obj_cantid)? Number(obj_cantid.value) : '' ;
		//validacion de numero entero
		var pista = (/^([0-9])*$/.test(pista_))? pista_ : '' ; 
		if(pista == '' || pista == 0)
			pista = 1;
		//accion del ciclo
		anchot = (Number(ancho) * Number(pista));
		ordoppanchot = ordoppanchot + anchot;
		ordoppcantkg = ordoppcantkg + cantid;
		ordoppanchou = ordoppanchou + anchot;
		//asignar valores a ancho total
		if(obj_anchot)
			obj_anchot.value = anchot;
		if(lbl_anchot)
			lbl_anchot.innerHTML = anchot;
		if(obj_pista && obj_pista.value == '')
			obj_pista.value = 1;
	}
	ordoppanchot = ordoppanchot + Number(ordopprefile);
	//asignar valores a objetos y labels
	if(obj_ordoppanchot) obj_ordoppanchot.value = ordoppanchot;
	if(obj_ordoppanchou) obj_ordoppanchou.value = ordoppanchou;
	if(obj_ordoppcantkg) obj_ordoppcantkg.value = ordoppcantkg;
	if(lbl_ordoppanchot) lbl_ordoppanchot.innerHTML = ordoppanchot;
	eventPorcen();
}
//evento para calcular los porcentajes de participacion , kilos metros.
function eventPorcen()
{
	//objetos a utilizar
	var obj_ordoppanchot = document.getElementById('ordoppanchot');
	var obj_ordoppanchou = document.getElementById('ordoppanchou');
	var obj_ordoppcantkg = document.getElementById('ordoppcantkg');
	var obj_ordoppcalibr = document.getElementById('ordoppcalibr');
	var obj_ordoppdensid = document.getElementById('ordoppdensid');
	var obj_ordoppcantmt = document.getElementById('ordoppcantmt');
	var obj_ordopprefile = document.getElementById('ordopprefile');
	var obj_arrop = document.getElementById('arrop');
	var objs_arrop = (obj_arrop)? obj_arrop.value.split(',') : '' ;
	//label
	var obj_ordoppcantmt_lb = document.getElementById('ordoppcantmt_lb');
	//valor de los objeto	
	var ordoppanchot = (obj_ordoppanchot)? obj_ordoppanchot.value : '' ;
	var ordoppanchou = (obj_ordoppanchou)? obj_ordoppanchou.value : '' ;
	var ordoppcantkg = (obj_ordoppcantkg)? obj_ordoppcantkg.value : '' ;
	var ordoppcalibr = (obj_ordoppcalibr)? obj_ordoppcalibr.value : '' ;
	var ordoppdensid = (obj_ordoppdensid)? obj_ordoppdensid.value : '' ;
	var ordoppcantmt = (obj_ordoppcantmt)? obj_ordoppcantmt.value : '' ;
	var ordopprefile = (obj_ordopprefile)? obj_ordopprefile.value : '' ;
	//accion de la funcion
	var ordoppcantkg_ = 0 ;
	for(i = 0;i < objs_arrop.length;i++)
	{
		//objetos label {span}
		var lbls_porcen = 'lb_porcen_' + objs_arrop[i];
		var lbls_cantid = 'lb_cantid_' + objs_arrop[i];
		var lbl_porcen = document.getElementById(lbls_porcen);
		var lbl_cantid = document.getElementById(lbls_cantid);
		//variables a utilizar
		var objs_porcen = 'porcen_' + objs_arrop[i];	
		var objs_anchot = 'anchot_' + objs_arrop[i];
		var objs_cantid = 'cantid_' + objs_arrop[i];
		//objetos a utilizar	 
		var obj_porcen = document.getElementById(objs_porcen);
		var obj_anchot = document.getElementById(objs_anchot);
		var obj_cantid = document.getElementById(objs_cantid);
		//valor de los objetos
		var porcen = (obj_porcen)? obj_porcen.value : '' ;
		var anchot = (obj_anchot)? obj_anchot.value : '' ;
		var cantid = (obj_cantid)? obj_cantid.value : '' ;
		//accion del ciclo		
		porcen = (Number(anchot) / Number(ordoppanchot - ordopprefile));		
		cantid = (Number(porcen) * Number(ordoppcantkg));
		ordoppcantkg_ = ordoppcantkg_ + cantid;
		//asignar valores a porcentahe y cantidad
		if(obj_porcen) obj_porcen.value = porcen;
		if(obj_cantid) obj_cantid.value = cantid;
		if(lbl_porcen) lbl_porcen.innerHTML = number_format((porcen * 100), 2, ',', '.');
		if(lbl_cantid) lbl_cantid.innerHTML = number_format(cantid, 2, ',', '.');
	}
	//$ordoppcantmt = $ordoppcantkg / ($ordoppanchot * ($ordoppdensid * $ordoppcalibr) ) * 1000000;
	ordoppcantkg = Number(ordoppcantkg_) + ( ( Number(ordopprefile) / Number(ordoppanchou) ) * Number(ordoppcantkg_) );
	ordoppcantmt = Number(ordoppcantkg) / ( Number(ordoppanchot) * ( Number(ordoppdensid) * Number(ordoppcalibr)) ) * 1000000;
	if(obj_ordoppcantkg)
		obj_ordoppcantkg.value = Math.round(ordoppcantkg * 100) / 100;
	if(obj_ordoppcantmt)
		obj_ordoppcantmt.value = ordoppcantmt;
	if(obj_ordoppcantmt_lb)
		obj_ordoppcantmt_lb.innerHTML = number_format(ordoppcantmt, 2, ',', '.');
}
//evento para recargar la bandaje de acuerdo a los filtros seleccionados
function ajax_filtro()
{
	//objetos a utilizar
	var obj_plantacodigo = document.getElementById('plantacodigo');
	var obj_formulnumero = document.getElementById('formulnumero');
	var obj_ordprocalibr = document.getElementById('ordprocalibr');
	var obj_ordproanccxt = document.getElementById('ordproanccxt');
	var obj_paditecodigo = document.getElementById('paditecodigo');
	var obj_arrop = document.getElementById('arrop');
	//valor de los objetos
	var plantacodigo = (obj_plantacodigo)? obj_plantacodigo.value : '' ; 
	var formulnumero = (obj_formulnumero)? obj_formulnumero.value : '' ; 
	var ordprocalibr = (obj_ordprocalibr)? obj_ordprocalibr.value : '' ; 
	var ordproanccxt = (obj_ordproanccxt)? obj_ordproanccxt.value : '' ; 
	var paditecodigo = (obj_paditecodigo)? obj_paditecodigo.value : '' ; 
	var arrop = (obj_arrop)? obj_arrop.value : '' ; 
	//parametros de envio
	var parameters = '' ;
	parameters = (plantacodigo != '')? parameters + 'plantacodigo=' + plantacodigo : parameters + 'plantacodigo=' ;
	parameters = (formulnumero != '')? parameters + '&formulnumero=' + formulnumero : parameters + '&formulnumero=' ;
	parameters = (ordprocalibr != '')? parameters + '&ordprocalibr=' + ordprocalibr : parameters + '&ordprocalibr=' ;
	parameters = (ordproanccxt != '')? parameters + '&ordproanccxt=' + ordproanccxt : parameters + '&ordproanccxt=' ;
	parameters = (paditecodigo != '')? parameters + '&paditecodigo=' + paditecodigo : parameters + '&paditecodigo=' ;
	parameters = (arrop != '')? parameters + '&arrop=' + arrop : parameters + '&arrop=' ;
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "detallabandejacorteextrusion.php",
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('detallebandejacorteextrusion').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la bandeja.</img>';
			$('#detallebandejacorteextrusion').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga la bandeja.</img>'});
			document.getElementById('total_und_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('total_kgs_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('total_mts_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
		},
		success: function(requestData){
			document.getElementById('detallebandejacorteextrusion').innerHTML = requestData;
		},
		complete : function(requestData)
		{		
			$('#detallebandejacorteextrusion').unblock();
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
	var obj_formulnumero = document.getElementById('formulnumero_opp');
	var obj_ordprocalibr = document.getElementById('ordprocalibr_opp');
	var obj_ordproanccxt = document.getElementById('ordproanccxt_opp');
	var obj_paditecodigo = document.getElementById('paditecodigo_opp');
	var obj_arropp = document.getElementById('arropp');
	//valor de los objetos
	var plantacodigo = (obj_plantacodigo)? obj_plantacodigo.value : '' ; 
	var formulnumero = (obj_formulnumero)? obj_formulnumero.value : '' ; 
	var ordprocalibr = (obj_ordprocalibr)? obj_ordprocalibr.value : '' ; 
	var ordproanccxt = (obj_ordproanccxt)? obj_ordproanccxt.value : '' ; 
	var paditecodigo = (obj_paditecodigo)? obj_paditecodigo.value : '' ; 
	var arropp = (obj_arropp)? obj_arropp.value : '' ; 
	//parametros de envio
	var parameters = '' ;
	parameters = (plantacodigo != '')? parameters + 'plantacodigo=' + plantacodigo : parameters + 'plantacodigo=' ;
	parameters = (formulnumero != '')? parameters + '&formulnumero=' + formulnumero : parameters + '&formulnumero=' ;
	parameters = (ordprocalibr != '')? parameters + '&ordprocalibr=' + ordprocalibr : parameters + '&ordprocalibr=' ;
	parameters = (ordproanccxt != '')? parameters + '&ordproanccxt=' + ordproanccxt : parameters + '&ordproanccxt=' ;
	parameters = (paditecodigo != '')? parameters + '&paditecodigo=' + paditecodigo : parameters + '&paditecodigo=' ;
	parameters = (arropp != '')? parameters + '&arropp=' + arropp : parameters + '&arropp=' ;
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "detallaordencorteextrusion.php",
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('detalleordencorteextrusion').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga las ordenes de produccion.</img>';
			$('#detalleordencorteextrusion').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga las ordenes de produccion.</img>'});
			document.getElementById('totalopp_und_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('totalopp_kgs_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('totalopp_mts_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
		},
		success: function(requestData){
			document.getElementById('detalleordencorteextrusion').innerHTML = requestData;
		},
		complete : function(requestData)
		{		
			$('#detalleordencorteextrusion').unblock();
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

//evento que crear los animatedcollapse en la bandeja de flexografia
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
//evento para actualizar el programa de corteextrusion
function update_programa(arr_programa)
{
	//objetos a usar
	var obj_arroppview = document.getElementById('arroppview');
	//valor de los objetos
	var arroppview = (obj_arroppview)? obj_arroppview.value : '' ;
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_editarprogramacxt.php",
		data: 'arr_programa=' + arr_programa + '&arroppview=' + arroppview ,
		beforeSend: function(data){ 
			$( "#editaprograma_cxt" ).button( "option", "disabled", true );
			$( "#cancelarprograma_cxt" ).button( "option", "disabled", true );
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
			$( "#editaprograma_cxt" ).button( "option", "disabled", false );
			$( "#cancelarprograma_cxt" ).button( "option", "disabled", false );
		}
	});
}
//funcion que inicializa los autocomplete 
function event_producatc(indice)
{
	//variables a usar
	var objs_itedescodigo = 'itedescodigo_' + indice;
	//autocomplete material para item de produccion en corteextrusion
	$("#" + objs_itedescodigo).autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/programacion/jquery.atcitemproduccion.php",
		minLength: 0
	});
}
//evento para recargar velocidades por maquina
function reladlistVelocidadpn()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.velocidadpn.php", 	
		data: 'arrvelocidadpn=&equipocodigo=' + document.getElementById('equipocodigo').value + '&tipsolcodigo=1',
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
		data: 'arrajustepn=&equipocodigo=' + document.getElementById('equipocodigo').value + '&tipsolcodigo=1',
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
			data: 'ordoppcodigo=' + idordenproduccion + '&equipocodigo=' + idequipo + '&tipsolcodigo=1' ,
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