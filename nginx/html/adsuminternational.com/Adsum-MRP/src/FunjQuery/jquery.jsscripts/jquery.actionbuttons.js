$(function(){
	/**
	 * Boton Nuevo
	 */
	$('#nuevo').button({ icons: { primary: "ui-icon-document" } }).click(function() {
		if(document.getElementById('vistares'))
		{
			if(document.form1.selstar.value != 1){
				document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.';
				$('#msgwindow').dialog('open');
			}
			else
			{
				document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
				document.form1.submit();
			}
		}
		else
		{
			document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		
		return false;
	});
	
	/**
	 * Boton Consultar
	 */
	$('#consultar').button({ icons: { primary: "ui-icon-search" } }).click(function() {
		document.form1.action = 'consultar' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Detallar
	 */
	$('#detallar').button({ icons: { primary: "ui-icon-clipboard" } }).click(function() {
		if(document.form1.selstar.value == 1)
		{
			document.form1.action = 'detallar' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
		}
		
		return false;
	});
	
	/**
	 * Boton Borrar
	 */
	$('#borrar').button({ icons: { primary: "ui-icon-trash" } }).click(function() {
		if(document.form1.selstar.value == 1)
		{
			document.form1.action = 'borrar' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
		}
		
		return false;
	});
	
	/**
	 * Boton Borrar Seleccion
	 */
	$('#borrarselect').button({ icons: { primary: "ui-icon-trash" } }).click(function() {
		cargarcheck(this.form);
		document.form1.action = 'maestablborrgen.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Editar
	 */
	$('#editar').button({ icons: { primary: "ui-icon-pencil" } }).click(function() {
		if(document.form1.selstar.value == 1)
		{
			document.form1.action = 'editar' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
		}
		
		return false;
	});
	
	/**
	 * Boton Atras A
	 */
	$('#back_a').button({ icons: { primary: "ui-icon-seek-prev" }, text: false }).click(function() {
		if(document.form1.flagcheck.value != '')
			cargarcheck(this.form);
		
		document.form1.mov.value = 'menos';
		document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Atras B
	 */
	$('#back_b').button({ icons: { primary: "ui-icon-seek-prev" }, text: false }).click(function() {
		if(document.form1.flagcheck.value != '')
			cargarcheck(this.form);
		
		document.form1.mov.value = 'menos';
		document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Adelante A
	 */
	$('#forward_a').button({ icons: { primary: "ui-icon-seek-next" }, text: false }).click(function() {
		if(document.form1.flagcheck.value != '')
			cargarcheck(this.form);
		
		document.form1.mov.value = 'mas';
		document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Adelante B
	 */
	$('#forward_b').button({ icons: { primary: "ui-icon-seek-next" }, text: false }).click(function() {
		if(document.form1.flagcheck.value != '')
			cargarcheck(this.form);
		
		document.form1.mov.value = 'mas';
		document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Primero A
	 */
	$('#first_a').button({ icons: { primary: "ui-icon-seek-first" }, text: false }).click(function() {
		if(document.form1.flagcheck.value != '')
			cargarcheck(this.form);
		
		document.form1.mov.value = 'primero';
		document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Ultimo A
	 */
	$('#last_a').button({ icons: { primary: "ui-icon-seek-end" }, text: false }).click(function() {
		if(document.form1.flagcheck.value != '')
			cargarcheck(this.form);
		
		document.form1.mov.value = 'ultimo';
		document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Primero B
	 */
	$('#first_b').button({ icons: { primary: "ui-icon-seek-first" }, text: false }).click(function() {
		if(document.form1.flagcheck.value != '')
			cargarcheck(this.form);
		
		document.form1.mov.value = 'primero';
		document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Ultimo B
	 */
	$('#last_b').button({ icons: { primary: "ui-icon-seek-end" }, text: false }).click(function() {
		if(document.form1.flagcheck.value != '')
			cargarcheck(this.form);
		
		document.form1.mov.value = 'ultimo';
		document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	
	
	/**
	 * Boton Aceptar
	 */
	$('#aceptar').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		$( "#aceptar" ).button( "option", "disabled", true );
		$( "#cancelar" ).button( "option", "disabled", true );
		document.getElementsByName('accion' + document.form1.sourceaction.value + document.form1.sourcetable.value)[0].value = 1;
		
		if(document.form1.sourceaction.value == 'consultar' || document.form1.sourceaction.value == 'detallar' || document.form1.sourceaction.value == 'borrar')
			document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		document.form1.submit();
		
		return false;
	});
	
	/**
	 * Boton Cancelar
	 */
	$('#cancelar').button({ icons: { primary: "ui-icon-circle-close" } }).click(function() {
		$( "#cancelar" ).button( "option", "disabled", true );
		$( "#aceptar" ).button( "option", "disabled", true );
		if(document.form1.sourcetable.value == 'offset')
			window.close();
		else
		{
			document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		
		return false;
	});
	
	/**
	 * Boton Aceptar grupos y permisos
	 */
	$('#aceptargr').button({ icons: { primary: "ui-icon-circle-check" }}).click(function() {
		sig();
		
		return false;
	});
	
	
	
	//Botones Visor Tecnicos
	/**
	 * Boton Anexar Tecnico
	 */
	$('#anxtecnico').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
		
		return false;
	});
	
	/**
	 * Boton Anexar Tecnico
	 */
	$('#rettecnico').button({ icons: { primary: "ui-icon-minus" } }).click(function() {
		
		return false;
	});
	
	$('#filtroequipo').button({ icons: { primary: "ui-icon-filter" }, text: false }).click(function() {
		
		return false;
	});

	$('#gestionar').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		if(document.form1.selstar.value == 1)
		{
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

	$('#analizar').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		if(document.form1.selstar.value == 1)
		{
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

	$('#calificar').button({ icons: { primary: "ui-icon-check" } }).click(function() {
					
		if(document.form1.selstar.value == 1)
		{
			document.form1.action = 'calificar' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		else
		{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
		}
					
		return false;

	});

	$('#devolver').button({ icons: { primary: "ui-icon-cancel" } }).click(function() {
		if(document.form1.selstar.value == 1){
			accionFormDevolver( $("#usuacodi" ).val(), $("#modulocodigo" ).val() );
			return false;
		}else{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
			return false;
		}
	});


	//Boton cerrar analisis de materias primas
	$('#cierreamp').button({ icons: { primary: "ui-icon-locked" }}).click(function() {
		if(document.form1.selstar.value == 1){
			accionFormCerrarAnalisis(document.form1.usuacodigo.value, 1);
			return false;
		}else{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
			return false;
		}
		return false;
	});

	//Boton cerrar analisis de producto en proceso
	$('#cierreappr').button({ icons: { primary: "ui-icon-locked" }}).click(function() {
		if(document.form1.selstar.value == 1){
			accionFormCerrarAnalisis(document.form1.usuacodigo.value, 2);
			return false;
		}else{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
			return false;
		}
		return false;
	});

	$('#gnoconformemp').button({ icons: { primary: "ui-icon-pencil" } }).click(function() {
		if(document.getElementById('vistares'))
		{
			if(document.form1.selstar.value != 1){
				document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.';
				$('#msgwindow').dialog('open');
			}
			else
			{
				document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
				document.form1.submit();
			}
		}
		else
		{
			document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		
		return false;
	});


	$('#gnoconformepr').button({ icons: { primary: "ui-icon-pencil" } }).click(function() {
		if(document.getElementById('vistares'))
		{
			if(document.form1.selstar.value != 1){
				document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.';
				$('#msgwindow').dialog('open');
			}
			else
			{
				document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
				document.form1.submit();
			}
		}
		else
		{
			document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
			document.form1.submit();
		}
		
		return false;
	});

	//Boton cerrar analisis de materias primas
	$('#cierregppr').button({ icons: { primary: "ui-icon-locked" }}).click(function() {
		if(document.form1.selstar.value == 1){

			document.form1.action = 'ingrnuevcierre' + document.form1.sourcetable1.value + '.php';
			document.form1.submit();

		}else{
			document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
			$('#msgwindow').dialog('open');
			return false;
		}
		return false;
	});



});

/*boton de busque de pedidos de venta */

function openMensajePV(mensaje, bandera){

	$("form").after( '<div id="msgwindow-pv" title="Adsum Kallpa"><span id="msg-pv"></span></div>' );

	//Msgbox Caja de mensajes
	$("#msgwindow-pv").dialog({
		autoOpen: false,
		width: 750,
		modal: true,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close"); 
			}
		}
	});

	$("#msgwindow-pv").dialog("open");

	$("#msg-pv").html( bandera > 0 ? "No se encontro PV No." + mensaje : mensaje );
	//alert("No se encontro PV No." + mensaje);

}