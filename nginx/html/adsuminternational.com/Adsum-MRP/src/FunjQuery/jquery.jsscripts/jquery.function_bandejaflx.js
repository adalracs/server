$(function(){

	$("a[title]").qtip({
       //content: '<?php echo str_replace("\r",'', str_replace("\n",'<br>', $value)) ?>',
       show: 'mouseover',
       hide: 'mouseout',
       style: {  border: { width: 5, radius: 5 }, padding: 2, textAlign: 'left', tip: true, name: 'green' }
       //position: { corner: { target: 'leftMiddle', tooltip: 'rightMiddle' } }
    });
	//tab's para la bandeja general de flexo
	$("#bandejaotgeneral").tabs({
		ajaxOptions: {
			error: function(xhr, status, index, anchor) {
				$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	//tab's para el programa de flexografia
	$("#programaflexo").tabs({
		ajaxOptions: {
		error: function(xhr, status, index, anchor) {
		$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});
	//venta modal para mensajes
	$("#msgwindowform").dialog({
		autoOpen: false,
		width: 'auto',
		modal: true,
		hide: "explode",
		position: [50,50],
		draggable: false,
		resizable: false
	});
	//boton para evento de simular opp de flexografia
	$('#simularopp_flx').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#simularopp_flx" ).button( "option", "disabled", true );
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
			document.form1.action='simularopp_flx.php';
			document.form1.submit();
		}
		else
		{
			//mensaje de error
			$( "#simularopp_flx" ).button( "option", "disabled", false );
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		return false;
	});
	//boton con evento para geneer opp de flexografia
	$('#generaropp_flx').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#generaropp_flx" ).button( "option", "disabled", true );
		$( "#backward_flx" ).button( "option", "disabled", true );
		//validacion de error
		var err = "";
		//objetos a utilizar
		var arrop = $("#arrop").val();
		var vcriterio = $("#criterio").val();
		var arrmatplan = $("#arrmatplan").val();
		var arrmaterial = $("#arrmaterial").val();
		var vcant_planea = $("#cant_planea").val();
		var objsarrop = (arrop)? arrop.split(",") : "";
		var objsarrmaterial = (arrmaterial)? arrmaterial.split(":|:") : "";
		var objsarrmatplan = (arrmatplan)? arrmatplan.split(":|:") : "";
		//validacion
		var cant_planea = ( /^([0-9])*$/.test( vcant_planea ) )? vcant_planea : 0 ;

		if( cant_planea  < 1){
			err += "*** Debe ingresar valor numerico en cantidad planeada." + "<br>";
		}

		var criterio = ( /^([0-9])*$/.test( vcriterio ) )? vcriterio : 0 ;

		if( criterio  < 1){
			err += "*** Debe seleccionar criterio." + "<br>";
		}
		
		for(a = 0; a < objsarrop.length; a++){

			var objsPista = "pista_" + objsarrop[a];
			var vpista = $("#" + objsPista).val();
			var pista = ( /^([0-9])*$/.test( vpista ) )? vpista : 0 ;

			if( pista < 1){
				err += "*** Debe ingresar valor numerico en pistas." + "<br>";
				break;
			}

		}

		for(a = 0; a < objsarrmaterial.length; a++){

			var objsRefile = "refile_"+ objsarrmaterial[a] + (a + 1)
			var vrefile = $("#" + objsRefile).val();			
			var refile = ( /^([0-9])*$/.test( vrefile ) )? vrefile : -1 ;

			if( refile < 0){
				err += "*** Debe ingresar valor numerico en refile." + "<br>";
				break;
			}

		}

		if( arrmaterial == "" || objsarrmatplan.length == 0){

			err += "*** Debe asignar materiales a las ordenes." + "<br>";
		}

		for(a = 0; a < objsarrmatplan.length; a++){	

			var objsConsumo = "consumo_" + objsarrmatplan[a];
			var objConsumo = document.getElementById(objsConsumo);
			var vconsumo = (objConsumo)? objConsumo.value : "" ;
			var consumo = ( /^([0-9])*$/.test( vconsumo ) )? vconsumo : -1 ;

			if( consumo < 1){
				err += "*** Debe ingresar valor numerico en consumo." + "<br>";
				break;
			}

		}
		
		if(err == "")
		{
			//acccion del boton
			document.form1.action="ingrnuevopp_flx.php";
			document.form1.submit();	
		}
		else
		{
			//mensaje de error
			document.getElementById("msg").innerHTML = "***Advertencia : Ocurrio algun error." + "<br>" + err;
			$("#msgwindow").dialog("open");
			$( "#generaropp_flx" ).button( "option", "disabled", false );
			$( "#backward_flx" ).button( "option", "disabled", false );
		}
		return false;
	});
	//boton de atras para retornar a la bandeja de flexografia
	$('#backward_flx').button({ icons: { primary: "ui-icon-seek-prev" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#generaropp_flx" ).button( "option", "disabled", true );
		$( "#backward_flx" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action="maestablbandejaflexo.php";
		document.form1.submit();
		return false;
	});
	//boton para ingresar a editar el programa de flexografia		
	$('#editarprograma_flx').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editarprograma_flx" ).button( "option", "disabled", true );
		//acccion del boton	
		document.form1.action='_editarprogramaflexo.php';
		document.form1.submit();
		return false;
	});
	//Boton Adicionar Materia prima pv
	$('#anxmaterial').button().click(function() {
		//objetos a utilzar
		var obj_idmaterial = document.getElementById('idmaterial');
		//valores 
		var idmaterial = (obj_idmaterial)? obj_idmaterial.value : '' ;
		var err = '';
		
		//validaciones 
		if(idmaterial == '')
			err = err + 'Advertencia : *** Debe seleccionar material.';
		
		//evento del boton
		if(err == '')
		{
			openPlaneacion(idmaterial);
			$("#msgwindowform").dialog("open");
			$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() { EventPlaneacionGMT();} } ] });
			$("#msgwindowform").dialog( "option", "width", "auto" );
			$("#msgwindowform").dialog( "option", "height", "auto" );
			$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Asignar Materiales]" );
			$("#msgwindowform").dialog("open");
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		//limpiar objetos
		obj_idmaterial.value = '' ;
		return false;
	});
	//Boton Quitar Materia prima pv
	$('#retmaterial').button().click(function() {
		loadArraylistdelete('arrmatplan', ':|:');
		accionReloadListMat_Planeacion();		
		return false;
	});
	//evento para accion de graba la orden de produccion
	$('#aceptaropp_flx').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#aceptaropp_flx" ).button( "option", "disabled", true );
		$( "#cancelaropp_flx" ).button( "option", "disabled", true );
		//acccion del boton
		//console.log('accion' + document.form1.sourceaction.value + 'opp');
		document.getElementsByName('accion' + document.form1.sourceaction.value + 'opp')[0].value = 1;
//		document.getElementsByName('accionnuevoopp_')[0].value = 1;
		document.form1.submit();	
		return false;
	});
	//evento para accion de cancelar la orden de produccion	
	$('#cancelaropp_flx').button({ icons: { primary: "ui-icon-circle-close" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#aceptaropp_flx" ).button( "option", "disabled", true );
		$( "#cancelaropp_flx" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablbandejaflexo.php';
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
	
	//evento para editar el programa de flexografia
    $('#editaprograma_flx').button({ icons: { primary: "ui-icon-pencil" } }).click(function() {
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
	$('#cancelarprograma_flx').button({ icons: { primary: "ui-icon-seek-prev" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editaprograma_flx" ).button( "option", "disabled", true );
		$( "#cancelarprograma_flx" ).button( "option", "disabled", true );
		//acccion del boton
		document.form1.action='maestablprogramaflexo.php';
		document.form1.submit();
		return false;
	});
	//boton para evento de simular opp de flexografia
	$('#editaropp_flx').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//evento de desactivar botones mientras realiza el submit
		$( "#editaropp_flx" ).button( "option", "disabled", true );
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
			document.form1.action='editaropp_flx.php';
			document.form1.submit();
		}
		else
		{
			$( "#editaropp_flx" ).button( "option", "disabled", false );
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
//evento para calcular la formulacion del ancho a extruir
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
//evento para abrir mensaje con lista de materiales
function openPlaneacion(data)
{
	ajaxItemsPlaneacion(data);
	$("#msgwindowform").dialog("open");
	return false;
}
//evento para cargar la lista de materiales
function ajaxItemsPlaneacion(data)
{
	//objetos a utilizar
	var obj_arrmatplan = document.getElementById("arrmatplan");
	var obj_arrrutaitem = document.getElementById("arrrutaitem");
	var obj_arrmatlaminar = document.getElementById("arrmatlaminar");
	//valor de los objetos
	var arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value : "" ;
	var arrrutaitem = (obj_arrrutaitem)? obj_arrrutaitem.value : "" ;
	var arrmatlaminar = (obj_arrmatlaminar)? obj_arrmatlaminar.value : "" ;
	//parametros
	var parameters;
	parameters = (data != "")? "paditecodigo=" + data : "paditecodigo=";
	parameters += (data != "")? "&arrrutaitem=" + arrrutaitem : "&arrrutaitem=";
	parameters += (data != "")? "&arrmatlaminar=" + arrmatlaminar : "&arrmatlaminar=";
	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.simularopp_flx.php",
		data: parameters,
		beforeSend: function(data){
			document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>';
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
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
//evento para actualizar el programa de flexo
function update_programa(arr_programa)
{
	//objetos a usar
	var obj_arroppview = document.getElementById('arroppview');
	//valor de los objetos
	var arroppview = (obj_arroppview)? obj_arroppview.value : '' ;
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_editarprogramaflx.php",
		data: 'arr_programa=' + arr_programa + '&arroppview=' + arroppview ,
		beforeSend: function(data){ 
			$( "#editaprograma_flx" ).button( "option", "disabled", true );
			$( "#cancelarprograma_flx" ).button( "option", "disabled", true );
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
			$( "#editaprograma_flx" ).button( "option", "disabled", false );
			$( "#cancelarprograma_flx" ).button( "option", "disabled", false );
		}
	});
}
//evento para recargar la bandaje de acuerdo a los filtros seleccionados
function ajax_filtro()
{
	//objetos a utilizar
	var obj_plantacodigo = document.getElementById('plantacodigo');
	var obj_ordprorodill = document.getElementById('ordprorodill');
	var obj_ordprocalibr = document.getElementById('ordprocalibr');
	var obj_ordproestruc = document.getElementById('ordproestruc');
	var obj_arrop = document.getElementById('arrop');
	//valor de los objetos
	var plantacodigo = (obj_plantacodigo)? obj_plantacodigo.value : '' ; 
	var ordprorodill = (obj_ordprorodill)? obj_ordprorodill.value : '' ; 
	var ordprocalibr = (obj_ordprocalibr)? obj_ordprocalibr.value : '' ; 
	var ordproestruc = (obj_ordproestruc)? obj_ordproestruc.value : '' ; 
	var arrop = (obj_arrop)? obj_arrop.value : '' ; 
	//parametros de envio
	var parameters = '' ;
	parameters = (plantacodigo != '')? parameters + 'plantacodigo=' + plantacodigo : parameters + 'plantacodigo=' ;
	parameters = (ordprorodill != '')? parameters + '&ordprorodill=' + ordprorodill : parameters + '&ordprorodill=' ;	
	parameters = (ordprocalibr != '')? parameters + '&ordprocalibr=' + ordprocalibr : parameters + '&ordprocalibr=' ;	
	parameters = (ordproestruc != '')? parameters + '&ordproestruc=' + ordproestruc : parameters + '&ordproestruc=' ;	
	parameters = (arrop != '')? parameters + '&arrop=' + arrop : parameters + '&arrop=' ;
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "detallabandejaflexografia.php",
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('detallebandejaflexografia').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la bandeja.</img>';
			$('#detallebandejaflexografia').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga la bandeja.</img>'});
			document.getElementById('total_und_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('total_kgs_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('total_mts_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
		},
		success: function(requestData){
			document.getElementById('detallebandejaflexografia').innerHTML = requestData;
		},
		complete : function(requestData)
		{	
			$('#detallebandejaflexografia').unblock();
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
	var obj_ordprorodill = document.getElementById('ordprorodill_opp');
	var obj_ordprocalibr = document.getElementById('ordprocalibr_opp');
	var obj_ordproestruc = document.getElementById('ordproestruc_opp');
	var obj_arrop = document.getElementById('arrop');
	//valor de los objetos
	var plantacodigo = (obj_plantacodigo)? obj_plantacodigo.value : '' ; 
	var ordprorodill = (obj_ordprorodill)? obj_ordprorodill.value : '' ; 
	var ordprocalibr = (obj_ordprocalibr)? obj_ordprocalibr.value : '' ; 
	var ordproestruc = (obj_ordproestruc)? obj_ordproestruc.value : '' ; 
	var arrop = (obj_arrop)? obj_arrop.value : '' ; 
	//parametros de envio
	var parameters = '' ;
	parameters = (plantacodigo != '')? parameters + 'plantacodigo=' + plantacodigo : parameters + 'plantacodigo=' ;
	parameters = (ordprorodill != '')? parameters + '&ordprorodill=' + ordprorodill : parameters + '&ordprorodill=' ;	
	parameters = (ordprocalibr != '')? parameters + '&ordprocalibr=' + ordprocalibr : parameters + '&ordprocalibr=' ;	
	parameters = (ordproestruc != '')? parameters + '&ordproestruc=' + ordproestruc : parameters + '&ordproestruc=' ;	
	parameters = (arrop != '')? parameters + '&arrop=' + arrop : parameters + '&arrop=' ;
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "detallaordenflexo.php",
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('detalleordenflexo').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga las ordenes de produccion.</img>';
			$('#detalleordenflexo').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga las ordenes de produccion.</img>'});
			document.getElementById('totalopp_und_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('totalopp_kgs_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
			document.getElementById('totalopp_mts_lbl').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras los totales.</img>';
		},
		success: function(requestData){
			document.getElementById('detalleordenflexo').innerHTML = requestData;
		},
		complete : function(requestData)
		{		
			$('#detalleordenflexo').unblock();
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
		data: 'arrvelocidadpn=&equipocodigo=' + document.getElementById('equipocodigo').value + '&tipsolcodigo=3',
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
		data: 'arrajustepn=&equipocodigo=' + document.getElementById('equipocodigo').value + '&tipsolcodigo=3',
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
//evento para abrir orden y modificar los tiempos
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
			data: 'ordoppcodigo=' + idordenproduccion + '&equipocodigo=' + idequipo + '&tipsolcodigo=3',
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
//funcion que actualiza la orden de produccion
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
			err = 'Advertencia : *** Debe Seleccionar proceso.';
			document.getElementById(objs_procedimiento).className = 'ui-state-highlight';
		}
	}
	
	if(err == '')
	{
		var obj_arrplan = document.getElementById('arrplan');
		var arrplan = (obj_arrplan)? obj_arrplan.value : '' ;
		var objs_arrplan = (arrplan)? arrplan.split(',') : '' ;
		var arrmatplan = '';
		
		for( i=0; i < objs_arrplan.length; i++)
		{
			//objeto adicional
			var objs_procedimiento = 'procedimiento_' + objs_arrplan[i];
			//objetos 
			var obj_procedimiento = document.getElementById(objs_procedimiento);
			//valor de los objetos
			var procedimiento = (obj_procedimiento)? obj_procedimiento.value : '' ;
			if(procedimiento)
				arrmatplan = (arrmatplan)? arrmatplan + ':|:' + objs_arrplan[i] + ':-:' + procedimiento : objs_arrplan[i] + ':-:' + procedimiento ;
		}
		
		loadArraylist(arrmatplan,'arrmatplan',':|:');
		accionReloadListMatplaneacion();
		document.getElementById('msgform').innerHTML = '' ;
		$("#msgwindowform").dialog("close");
	}
	else
	{
		document.getElementById('mensaje').innerHTML = err;
		document.getElementById('mensaje').className = 'ui-state-highlight';
	}
}
//recargar material
function accionReloadListMatplaneacion()
{
	//objetos a utilizar
	var obj_arrplan = document.getElementById("arrplan");
	var obj_arrmatplan = document.getElementById("arrmatplan");
	var obj_arrmatlaminar = document.getElementById("arrmatlaminar");
	//valor de los objetos
	var arrplan = (obj_arrplan)? obj_arrplan.value : "" ;
	var arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value : "" ;
	var arrmatlaminar = (obj_arrmatlaminar)? obj_arrmatlaminar.value : "" ;
	var objs_arrmatplan = (arrmatplan)? arrmatplan.split(":|:") : "" ;
	
	//parametros
	var parameters = "";
	//parametros de objetos adicionales
	for(i=0;i<objs_arrmatplan.length;i++)
	{
		var rows_arrmatplan = objs_arrmatplan[i].split(":-:");		
		var objs_consumo = "consumo_" + objs_arrmatplan[i];
		var obj_consumo = document.getElementById(objs_consumo);
		var consumo = (obj_consumo)? obj_consumo.value : "" ;
		(consumo != "")? parameters += "&" + objs_consumo + "=" + consumo : parameters += "&" + objs_consumo + "=";
	}
	
	parameters += (arrmatplan != "")? "&arrmatplan=" + arrmatplan : "&arrmatplan=";
	parameters += (arrmatlaminar != "")? "&arrmatlaminar=" + arrmatlaminar : "&arrmatlaminar=";

	//evento ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.mat_planeacion_.php", 	
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById("listamateriales').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>';
			$('#listamateriales').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listamateriales').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 
			$('#listamateriales').block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){ 
			$('#listamateriales').unblock();
		}   
	});
}
//AJAX - Load or Reload list
function accionReloadListMat_Planeacion()
{
	//objetos a utilizar
	var obj_arrmatplan = document.getElementById('arrmatplan');
	var objs_arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value.split(':|:') : '' ;
	//valor de los objetos
	var arrmatplan = (obj_arrmatplan)? obj_arrmatplan.value : '' ;
	//parametros
	var parameters;
	parameters = (arrmatplan != '')? 'arrmatplan=' + arrmatplan : 'arrmatplan=';
	
	//parametros de objetos adicionales
	for(i=0;i<objs_arrmatplan.length;i++)
	{
		//objeto adicional
		var objs_consumo = 'consumo_' + objs_arrmatplan[i];
		//objetos a utilizar
		var obj_consumo = document.getElementById(objs_consumo);
		//valor de los objetos
		var consumo = (obj_consumo)? obj_consumo.value : '' ;
		//parametros adicionales
		(consumo != '')? parameters += '&' + objs_consumo + '=' + consumo : parameters += '&' + objs_consumo + '=';
	}

	
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.mat_planeacion_.php", 	
		data: parameters,
		beforeSend: function(data){ 
			//document.getElementById('listamateriales').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se cargan los materiales.</img>';
			$('#listamateriales').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras se cargan los materiales.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listamateriales').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ 
			$('#listamateriales').block({ theme : true , message : 'Error'});
		},
		complete: function(requestData, exito){
			$('#listamateriales').unblock();
		 }                                      
	});
}

function eventAnchoBobina1()//se genera para calcular x kilogramos
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
	if(lbl_ordoppanchot) lbl_ordoppanchot.innerHTML = ordoppanchot;
	eventPorcen1();
}
//evento para calcular los porcentajes de participacion , kilos metros.
function eventPorcen1()//se genera para calcular x kilogramos
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
	if(obj_ordoppcantmt)
		obj_ordoppcantmt.value = ordoppcantmt;
	if(obj_ordoppcantmt_lb)
		obj_ordoppcantmt_lb.innerHTML = number_format(ordoppcantmt, 2, ',', '.');
}


function accionReloadAjax_planeacion(){

	var totalgramaje = $("#totalgramaje").val();
	var totalcalibre = $("#totalcalibre").val();
	var tipprocodigo = $("#tipprocodigo").val();
	var ordoppanchot = $("#ordoppanchot").val();
	var cant_planea = $("#cant_planea").val();
	var arrmaterial = $("#arrmaterial").val();
	var arrcalibre = $("#arrcalibre").val();
	var unimedi = $("#unimedi").val();
	var arrop = $("#arrop").val();
	//parametros de envio 
	var parameters = "";
	parameters += (totalgramaje != '')? 'totalgramaje=' + totalgramaje : 'totalgramaje=';
	parameters += (totalcalibre != '')? '&totalcalibre=' + totalcalibre : '&totalcalibre=';
	parameters += (tipprocodigo != '')? '&tipprocodigo=' + tipprocodigo : '&tipprocodigo=';
	parameters += (ordoppanchot != '')? '&ordoppanchot=' + ordoppanchot : '&ordoppanchot=';
	parameters += (arrmaterial != '')? '&arrmaterial=' + arrmaterial : '&arrmaterial=';
	parameters += (cant_planea != '')? '&cant_planea=' + cant_planea : '&cant_planea=';
	parameters += (arrcalibre != '')? '&arrcalibre=' + arrcalibre : '&arrcalibre=';
	parameters += (unimedi != '')? '&unimedi=' + unimedi : '&unimedi=';
	parameters += (arrop != '')? '&arrop=' + arrop : '&arrop=';

	var objsarrmaterial = (arrmaterial)? arrmaterial.split(":|:") : "";

	for( a = 0; a < objsarrmaterial.length; a++){

		var obsjrefile = "refile_" + objsarrmaterial[a] + (a + 1);
		var refile = $("#" + obsjrefile).val();
		parameters += (refile != '')? '&' + obsjrefile + '=' + refile : '&' + obsjrefile + '=';

	}

	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_planeacion1.php", 	
		data: parameters,
		beforeSend: function(data){ 
			$('#filtrlistaplaneacion').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga la explosion de materiales.</img>'});
		},        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('filtrlistaplaneacion').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){
			$('#filtrlistaplaneacion').block({ theme : true , message : 'Error'});
		 },
		complete: function(requestData, exito){ 
			$('#filtrlistaplaneacion').unblock();
		}                                      
	});

}

function cargaCriterio( idcriterio ){

	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_cargacriterio.php", 	
		data: 'critercodigo=' + idcriterio,
		beforeSend: function(data){ 
			//$('#filtrlistaplaneacion').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga la explosion de materiales.</img>'});
		},        
		success: function(jSonData){
			if(jSonData != '')
				reloadCriterio(jSonData);
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});

}

function reloadCriterio(DataJson)
{
	var porcentaje = (DataJson)? parseInt(DataJson.criterporcen) / 100 : "" ;
	
	var cant_planea_ = $("#cant_planea_");
	var cant_planea = $("#cant_planea");
	var criterioval = $("#criterio_val");

	var cantidadplaneada = 0;
	cantidadplaneada = parseInt( cant_planea_.val() );
	
	if(!porcentaje){

		cant_planea.val( cantidadplaneada );

	}else{
		
		cant_planea.val( cantidadplaneada + parseInt( cantidadplaneada * porcentaje ) );
		if(criterioval)
			criterioval.val(DataJson.criterporcen);

	}
	
	accionReloadAjax_planeacion();
	accionReloadAjax_similacionflx();
	
}

function accionReloadAjax_similacionflx(){

	var arrop = $("#arrop").val();
	var ordoppanchot = 0;
	var cant_planea = $("#cant_planea").val();
	var totalgramaje = $("#totalgramaje").val();
	var totalcalibre = $("#totalcalibre").val();
	//parametros de envio 
	var parameters = "";
	parameters += (totalgramaje != '')? 'totalgramaje=' + totalgramaje : 'totalgramaje=';
	parameters += (totalcalibre != '')? '&totalcalibre=' + totalcalibre : '&totalcalibre=';
	parameters += (arrop != "")? "&arrop=" + arrop : "&arrop=";
	parameters += (cant_planea != "")? "&cant_planea=" + cant_planea : "&cant_planea";

	var  objsarrop = (arrop)? arrop.split(",") : "";

	for( a = 0; a < objsarrop.length; a++){

		var objsAncho = "ancho_" + objsarrop[a];
		var objsPista = "pista_" + objsarrop[a];
		var pista = $("#" + objsPista).val();
		var ancho  = $("#" + objsAncho).val();
		parameters += (pista != '')? '&' + objsPista + '=' + pista : '&' + objsPista + '=';
		ordoppanchot += parseInt( ancho ) * parseInt( pista);
	}

	parameters += (ordoppanchot != "")? "&ordoppanchot=" + ordoppanchot : "&ordoppanchot";

	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jq_ajaxsimulacionflx.php", 	
		data: parameters,
		beforeSend: function(data){ 
			$('#filtrlistasimulacionflx').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga la explosion de materiales.</img>'});
		},        
		success: function(requestData){

			if(requestData != ''){
				$("#ordoppanchot").val(ordoppanchot);
				document.getElementById('filtrlistasimulacionflx').innerHTML = requestData;
				accionReloadAjax_planeacion();
			}

		},         
		error: function(requestData, strError, strTipoError){
			$('#filtrlistasimulacionflx').block({ theme : true , message : 'Error'});
		 },
		complete: function(requestData, exito){ 
			$('#filtrlistasimulacionflx').unblock();
		}                                      
	});

}