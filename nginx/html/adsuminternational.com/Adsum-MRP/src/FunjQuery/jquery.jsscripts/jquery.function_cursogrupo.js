/**
 * Propiedad intelectual de Adsum (c).
 * Autor           : ralvear
 * Fecha           : 10-enero-2012  
 */

$(function(){
	/**
	 * Window para asignar cuadrillas/usuarios a la orden
	 */
	//Botones Visor Tecnicos
	/**
	 * Boton Anexar Cuadrilla
	 */
	$('#anxotcuadrilla').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
		document.getElementById('typesource').value = 'cuadrilla';
		window.open('maestablcuadrillagen.php?id=' + document.getElementById('lsttecnicoot').value + '&typesource=cuadrilla&negocicodigo=' + document.getElementById('negocicodigo').value + '&codigo=' + document.getElementById('codigo').value,'','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
		$( "#retottecnico" ).button({ disabled: true });
		return false;
	});

	/**
	 * Boton Anexar Tecnicos
	 */
	$('#anxottecnico').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
		document.getElementById('typesource').value = 'user';
		window.open('consultarcuadrillausuario.php?id=' + document.getElementById('lsttecnicoot').value + '&typesource=cuadrilla&negocicodigo=' + document.getElementById('negocicodigo').value + '&codigo=' + document.getElementById('codigo').value,'','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
		$( "#retottecnico" ).button({ disabled: false });
		return false;
	});
	
	/**
	 * Boton Retirar Tecnico
	 */
	$('#retottecnico').button({ icons: { primary: "ui-icon-minus" } }).click(function() {
		loadlist_tecncuadrilla(document.getElementById('lsttecnicoot').value, document.getElementById('typesource').value, '');
		return false;
	});
	
	/**
	 * Boton Aceptar
	 */
	$('#aceptarot').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
		carga();
		
		document.getElementsByName('accion' + document.form1.sourceaction.value + document.form1.sourcetable.value)[0].value = 1;
		if(document.form1.sourceaction.value == 'consultar' || document.form1.sourceaction.value == 'detallar' || document.form1.sourceaction.value == 'borrar')
			document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
		
		document.form1.submit();
		
		return false;
	});

	// Obj Fechas
	/**
	 * Fecha Parada equipos
	 */
	$("#parprofecini").datepicker({changeMonth: true,changeYear: true});
	$("#parprofecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#parprofecini").datepicker($.datepicker.regional['es']);

	
	/**
	 * Fecha inicio y Fecha fin
	 */
	var dates = $( "#ordtrafecini, #ordtrafecfin" ).datepicker({
		changeMonth: true,
		changeYear: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			var option = this.id == "ordtrafecini" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );

			loadlist_tecncuadrilla(document.getElementById('lsttecnicoot').value, document.getElementById('typesource').value, '');
		}
	});

	$("#ordtrafecini").datepicker({changeMonth: true,changeYear: true});
	$("#ordtrafecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#ordtrafecini").datepicker($.datepicker.regional['es']);
	
	$("#ordtrafecfin").datepicker({changeMonth: true,changeYear: true});
	$("#ordtrafecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#ordtrafecfin").datepicker($.datepicker.regional['es']);

	$("#ordtrafecgen").datepicker({changeMonth: true,changeYear: true});
	$("#ordtrafecgen").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#ordtrafecgen").datepicker($.datepicker.regional['es']);
	

	/**
	 * Window Show View Novedades
	 */
	$("#windowusuanovedad").dialog({
		autoOpen: false,
		width: 670,
		height: 300,
		modal: true,
		buttons: {
			"Cancelar": function() { 
				$(this).dialog("close"); 
			},
			"Grabar": function() { 
				var arFecini = document.getElementById('usunovfecini').value.split('-');
				var arFecfin = document.getElementById('usunovfecfin').value.split('-');
				var arHorini = document.getElementById('usunovhorini').value.split(':');
				var arHorfin = document.getElementById('usunovhorfin').value.split(':');

				if(arFecini != "" && arFecfin != "" && arHorini != "" && arHorfin != "")
				{
					var dateFrom = new Date();
					var dateTo = new Date();
					
					dateFrom.setDate(parseInt(arFecini[2]));
					dateFrom.setMonth(parseInt(arFecini[1])-1);
					dateFrom.setFullYear(parseInt(arFecini[0]));
					dateFrom.setHours(parseInt(arHorini[0]));
					dateFrom.setMinutes(parseInt(arHorini[1]));
					dateFrom.setSeconds(parseInt(0));

					dateTo.setDate(parseInt(arFecfin[2]));
					dateTo.setMonth(parseInt(arFecfin[1])-1);
					dateTo.setFullYear(parseInt(arFecfin[0]));
					dateTo.setHours(parseInt(arHorfin[0]));
					dateTo.setMinutes(parseInt(arHorfin[1]));
					dateTo.setSeconds(parseInt(0));

					if(dateTo > dateFrom)
					{
						if(document.getElementById('estnovcodigo').value == '')									
						{
							document.getElementById('msg2').innerHTML = 'No es posible guardar, debe seleccionar la novedad del listado de novedades';
							$('#msgwindow').dialog('open');
						}
						else	
						{
							showSaveNovedad();
							$(this).dialog("close");
						} 
					}
					else
					{
						document.getElementById('msg2').innerHTML = 'No es posible guardar, la fecha de inicio debe ser mayor a la fecha fin';
						$('#msgwindow').dialog('open');
					}
				}
				else
				{
					document.getElementById('msg2').innerHTML = 'Debe especificar la fecha/hora de inicio y fecha/hora fin';
					$('#msgwindow').dialog('open');
				}
			}
		}
	});

	$("#usunovfecfin").datepicker({changeMonth: true,changeYear: true, onSelect: function( selectedDate ) { calculeDiff(); }});
	$("#usunovfecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#usunovfecfin").datepicker($.datepicker.regional['es']);
	
	$("#usunovfecini").datepicker({changeMonth: true,changeYear: true, onSelect: function( selectedDate ) { calculeDiff(); }});
	$("#usunovfecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#usunovfecini").datepicker($.datepicker.regional['es']);
});

/**
 * funcion showWindow 
 * @param usuacodi
 * @return none
 */
function showWindow(usuacodi)
{
	var param = 'usuacodigo=' + usuacodi;
	accionLoadWindowView(param,'jquery.ajax_ingrNovedad','usuanovmsg','windowusuanovedad');
}

/**
 * funcion showSaveNovedad
 * @return none
 */
function showSaveNovedad()
{
	var vestnovcodigo = document.getElementById('estnovcodigo').value; 
	var vusuacodi = document.getElementById('usuacodigo').value; 
	var vusunovfecini = document.getElementById('usunovfecini').value; 
	var vusunovfecfin = document.getElementById('usunovfecfin').value; 
	var vusunovhorini = document.getElementById('usunovhorini').value; 
	var vusunovhorfin = document.getElementById('usunovhorfin').value; 
	var vusunovdescri = document.getElementById('usunovdescri').value;
	
	var strsave = "&usuacodigo=" + vusuacodi + "&estnovcodigo=" + vestnovcodigo + "&usunovfecini=" + vusunovfecini + "&usunovfecfin=" + vusunovfecfin + "&usunovdescri=" + vusunovdescri; 
	strsave+= "&usunovhorini=" + vusunovhorini + "&usunovhorfin=" + vusunovhorfin; 
	accionGrabaDataNovedad(strsave, 'functionot');
}

/**
 * funcion LoadDetalleequipo
 * @param equipocodigo
 * @param usuaplanta
 * @return none
 */
function LoadDetalleequipo(equipocodigo,usuaplanta)
{
	document.getElementById("detalleotequipo").src="detallarotequipo.php?equipocodigo="+ equipocodigo + "&usuaplanta=" + usuaplanta;
}

/**
 * funcion LoadDetallecomponen
 * @param componcodigo
 * @param usuaplanta
 * @return
 */
function LoadDetallecomponen(componcodigo,usuaplanta)
{
	var index = form1.equipotexto.value;
	
	if(index == 0)
		document.getElementById("detalleotcomponen").src="detallarotcomponen.php?componcodigo="+ componcodigo + "&equipocodigo="+ form1.equipocodigo.value + "&usuaplanta=" + usuaplanta;
	else
		document.getElementById("detalleotcomponen").src="detallarotcomponen.php?componcodigo="+ componcodigo + "&equipocodigo="+ form1.equipocodigo_auto.value + "&usuaplanta=" + usuaplanta;
}

/**
 * funcion viewFilter
 * @return
 */
function viewFilter()
{
	var selectlist = document.getElementById('selectlist');
	var filtrolist = document.getElementById('filtrolist');
	var filterindex = document.getElementById('filterindex');
	
	if(selectlist.style.display == 'block')
	{
		filtrolist.style.display = 'block';
		selectlist.style.display = 'none';
		filterindex.value = "1";
		if(document.getElementById('componcodigo'))
			cargarComponen(document.getElementById('equipocodigocmbx').value);
	}
	else
	{
		filtrolist.style.display = 'none';
		selectlist.style.display = 'block';
		filterindex.value = "";
		if(document.getElementById('componcodigo'))
			cargarComponen(document.getElementById('equipocodigo').value);
	}
}

function setEquCompleteSource()
{
    $("#equiponombre").autocomplete({ source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_equipo.php?id=" + document.getElementById('idusua').value + "&plantacodigo=" + document.getElementById('plantacodigo').value + "&sistemcodigo="  + document.getElementById('sistemcodigo').value });
}

/**
 * Funtion accionRevEquipoEstado
 * @param equipocodigo
 * @return
 */
function accionLoadTransCont(equipocodigo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.phpscripts/jquery.verdisponequipo.php",
				data: "equipocodigo=" + equipocodigo, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData == '')
					{
						$( "#aceptarot" ).button({ disabled: false });
						document.getElementById('equipoerror').style.display = 'none';
					}
					else
					{
						$( "#aceptarot" ).button({ disabled: true });
						document.getElementById('equipoerror').style.display = 'block';
						document.getElementById('equipoestado').innerHTML = requestData;
					}
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}