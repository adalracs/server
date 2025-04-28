$(function(){
	$("#capacifecini").datepicker({showOn: "button", buttonImage: "temas/themes/redmond/images/calendar.png", buttonImageOnly: true, changeMonth: true, changeYear: true});
	$("#capacifecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#capacifecini").datepicker($.datepicker.regional['es']);

	$("#departnombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_departam.php",
		minLength: 1,
		select: function(event, ui) {
			ui.item ? document.getElementById('departcodigo1').value = ui.item.id : document.getElementById('departcodigo1').value = "";
		}
	});
	
	
	/**
	 * Objetos para session de Instructor
	 */
	
	$("#usuanombre2").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_usuatecnico.php",
		minLength: 1,
		select: function(event, ui) {
			ui.item ? document.getElementById('usuacodigo2').value = ui.item.id : document.getElementById('usuacodigo2').value = "";
		}
	});	
	
	
	var dates = $( "#curgrufecini, #curgrufecfin" ).datepicker({
		changeMonth: true,
		changeYear: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			var option = this.id == "curgrufecini" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});

	$("#curgrufecini").datepicker({changeMonth: true,changeYear: true});
	$("#curgrufecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#curgrufecini").datepicker($.datepicker.regional['es']);

	$("#curgrufecfin").datepicker({changeMonth: true,changeYear: true});
	$("#curgrufecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
	$("#curgrufecfin").datepicker($.datepicker.regional['es']);

	/**
	 * Boton Anexar Tecnicos
	 */
	$('#anxottecnico').button({ icons: { primary: "ui-icon-plus" },  text: false }).click(function() {
		var arrTecnicos = document.getElementById('lsttecnicoot').value.split(',');
		var enc = 0;

		for(var a = 0; a < (arrTecnicos.length); a++)
		{
			if(document.getElementById('usuacodigo2').value == '')
			{
				enc = 1;
				break;
			}
		}

		if(enc == 0)
		{
			if(document.getElementById('lsttecnicoot').value != '')
				document.getElementById('lsttecnicoot').value = document.getElementById('lsttecnicoot').value + ',' + document.getElementById('usuacodigo2').value;
			else
				document.getElementById('lsttecnicoot').value = document.getElementById('usuacodigo2').value;

			var objparams = 'lsttecnicoot=' + document.getElementById('lsttecnicoot').value;
			
			for(var a = 0; a < (arrTecnicos.length); a++)
			{
				if(document.getElementById('depart_' + arrTecnicos[a]))
					objparams = objparams + '&depart_' + arrTecnicos[a] + '=' + document.getElementById('depart_' + arrTecnicos[a]).value;
			}

			ajaxListaInstructor(objparams);
		}

		document.getElementById('usuacodigo2').value = '';
		document.getElementById('usuanombre2').value = '';
		
		return false;
	});
	
	/**
	 * Boton ingresar grupo
	 */
	$('#anxotgrupo').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
		ajaxEmpleadoFilter('');
		ajaxGrupoEmpleado();
		$("#msgwindowformc").dialog("open");
		return false;
	});
	
	/**
	 * Boton Retirar Tecnico
	 */
	$('#retottecnico').button({ icons: { primary: "ui-icon-minus" }, text: false }).click(function() {
		reLoadListEmpleado(document.getElementById('lsttecnicoot').value,'');
		return false;
	});
	
	$('#curgruhorini').timepicker({});
	$('#curgruhorfin').timepicker({});
	$("#curgruhorini").datepicker({
		showOn: 'both',
		buttonImageOnly : 'true',
		changeYear : 'true',
		numberOfMonths : 1,
		dateFormat : 'yy-mm-dd'
		});

	$("#curgruhorfin").datepicker({
		showOn: 'both',
		buttonImageOnly : 'true',
		changeYear : 'true',
		numberOfMonths : 1,
		dateFormat : 'yy-mm-dd'
		});
	
	$("#msgwindowformc").dialog({
		autoOpen: false,
		width: 580,
		height: 340,
		modal: true,
		buttons: {
			"Adicionar": function() { 
				reLoadGrupoEmpleado();
				$(this).dialog("close"); 
			}
		}
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * Objetos para session de Instructor
	 */
	
	 //* Filtro
	$("#usuanombre1").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_usuatecnico.php",
		minLength: 1,
		select: function(event, ui) {
			ui.item ? document.getElementById('usuacodigo1').value = ui.item.id : document.getElementById('usuacodigo1').value = "";
		}
	});

	 //* Boton Ingresar
	$('#anxinstructor').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
		if(document.getElementById('usuacodigo1').value)
		{
			var numRow = 1;
			var flagOut = 0;
			var idInstructor = document.getElementById('usuacodigo1').value;

			if(document.getElementById('lstinstructor').value != '')
			{
				var arrPersona = document.getElementById('lstinstructor').value.split(',');

				while (flagOut == 0)
				{
					var key = numRow + '_' + idInstructor;				
					flagOut = 1;

					for(var a = 0; a < (arrPersona.length); a++)
					{
						if(arrPersona[a] == key)
						{
							flagOut = 0;
							break;
						}
					}
					numRow++;
				}
				
				document.getElementById('lstinstructor').value = document.getElementById('lstinstructor').value + ',' + key;
			} 
			else
				document.getElementById('lstinstructor').value = numRow + '_' + idInstructor;
			
			
			alert(document.getElementById('lstinstructor').value);
			loadListinstructor();
		}

		document.getElementById('usuacodigo1').value = '';
		document.getElementById('usuanombre1').value = '';
		
		return false;
	});
	
	 //* Boton Quitar
	$('#retinstructor').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		loadListinstructor();
		return false;
	});

	$('#anxcontratrista').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
		$("#msgwindowcont").dialog('open');
		return false;
	});

	$("#msgwindowcont").dialog({
		autoOpen: false,
		width: 400,
		height: 320,
		modal: true,
		buttons: {
			"Adicionar": function() { 
				validaCapacitador();
			}
		}
	});

	$("#msgwindowerror").dialog({
		autoOpen: false,
		width: 350,
		height: 250,
		modal: true,
		buttons: {
			"OK": function() { 
				$(this).dialog("close"); 
				
			}
		}
	});
});



/**
 * function anxPersona
 * @param idxArray
 * @param idxCodigo
 * @param idxNombre
 * @return
 */
function anxPersona(idxArray, idxCodigo, idxNombre)
{
	if(document.getElementById(idxCodigo).value != '')
	{
		var lstpersona = document.getElementById(idxArray);
		var arrPersona = lstpersona.value.split(',');
		var enc = 0;
			
		for(var a = 0; a < (arrPersona.length); a++)
		{
			if(arrPersona[a] == document.getElementById(idxCodigo).value)
			{
				enc = 1;
				break;
			}
		}

		if(enc == 0)
			lstpersona.value = ((lstpersona.value != '') ? lstpersona.value + ',' : '') + document.getElementById(idxCodigo).value;
			
		document.getElementById(idxCodigo).value = '';
		document.getElementById(idxNombre).value = '';
		return 1;
	}
	return 0;
}

/**
 * function loadListinstructor
 * @return
 */
function loadListinstructor(){
	
	var arrObjItems = document.getElementById('lstinstructor').value.split(','); //el comodin ',' es separador de filas
	var objparams = 'lstinstructor=' + document.getElementById('lstinstructor').value + '&arrcontratista=' + document.getElementById('arrcontratista').value;
	
	for( i = 0; i < arrObjItems.length; i++ )
	{
		if(document.getElementById('curcontema_' + arrObjItems[i] + '_' + i))
			objparams = objparams + '&curcontema_' + arrObjItems[i] + '_' + i + '=' + document.getElementById('curcontema_' + arrObjItems[i] + '_' +i).value + '&curconhora_' + arrObjItems[i] + '_' + i + '=' + document.getElementById('curconhora_' + arrObjItems[i] + '_' + i).value + '&curconvalor_' + arrObjItems[i] + '_' + i + '=' + document.getElementById('curconvalor_' + arrObjItems[i] + '_' + i).value + '&tipohora_' + arrObjItems[i] + '_' + i + '=' + document.getElementById('tipohora_' + arrObjItems[i] + '_' + i).value; 
			
	}
	accionLoadlistinstructor(objparams);
}

/**
 * Function accionLoadlistinstructor
 * @param objparams
 * @return
 */
function accionLoadlistinstructor(objparams)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.instructor.php",
		data: objparams,
		beforeSend: function(data){},        
		success: function(requestData){
			document.getElementById('instructor').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){}                                      
	});
}

    		

function validaCapacitador()
{
	var cedula = document.getElementById('usuadocume');
	var nombre = document.getElementById('usuanombree');
	var priapellido = document.getElementById('usuapriape');
	var segapellido = document.getElementById('usuasegape');
	var telefono = document.getElementById('usuatelefo');
	var telefonos = document.getElementById('usuatelef2');
	var contacto = document.getElementById('usuacontac');
	var direccion = document.getElementById('usuadirecc');
	var mail = document.getElementById('usuamail');
	var error = '';

	if(cedula.value == '')
		error = error + '* Debe Ingresar Cedula' + '<br>';

	if(nombre.value == '')
		error = error + '* Debe Ingresar Nombre' + '<br>';

	if(priapellido.value == '')
		error = error + '* Debe Ingresar Primer Apellido' + '<br>';

	if(telefono.value == '')
		error = error + '* Debe Ingresar Telefono #1' + '<br>';

	if(contacto.value == '')
		error = error + '* Debe Ingresar Contacto' + '<br>';

	if(direccion.value == '')
		error = error + '* Debe Ingresar Direccion' + '<br>';

	if(error != '')
	{
		document.getElementById('msgerror').innerHTML = error;
		$("#msgwindowerror").dialog('open');
		return false;
	}

	validarUsario();
}

/**
 * Function validarUsario
 * @return
 */
function validarUsario()
{
	$.ajax({	   
		dataType: "json",
		type: "POST",        
		url: "validacontratista.php",
		data: "idcontratista= " + document.getElementById('usuadocume').value,
		beforeSend: function(data){},        
		success: function(JSON){
			document.getElementById('valcontratista').value = (JSON['respuesta'] == -3)? 'OK': '' ;
			agregarContratista();
		}                                     
	});
}

/**
 * Function agregarContratista
 * @return
 */
function agregarContratista()
{
	var cedula = document.getElementById('usuadocume');
	var nombre = document.getElementById('usuanombree');
	var priapellido = document.getElementById('usuapriape');
	var segapellido = document.getElementById('usuasegape');
	var telefono = document.getElementById('usuatelefo');
	var telefonos = document.getElementById('usuatelef2');
	var contacto = document.getElementById('usuacontac');
	var direccion = document.getElementById('usuadirecc');
	var mail = document.getElementById('usuamail');
	
	if(document.getElementById('valcontratista').value == 'OK')
	{
		var objLsttecnicoot = document.getElementById('lstinstructor');
		objLsttecnicoot.value = (objLsttecnicoot.value)? objLsttecnicoot.value + ',N_' + cedula.value : 'N_' + cedula.value ;
		var objContratista = document.getElementById('arrcontratista');
		var arrContratista = cedula.value + ':-:' + cedula.value + ':-:' + nombre.value + ':-:' + priapellido.value;
		arrContratista = arrContratista + ':-:' + segapellido.value + ':-:' + telefono.value;
		arrContratista = arrContratista + ':-:' + (telefonos.value)? arrContratista + ':-:' + telefonos.value :  arrContratista + ':-:' +'N/A';
		arrContratista = arrContratista + ':-:' + contacto.value + ':-:' +direccion.value + ':-:' + mail.value;
		objContratista.value = (objContratista.value)? objContratista.value + ':|:' + arrContratista : arrContratista ;
		loadListinstructor();
		cedula.value = '';nombre.value = '';priapellido.value = '';segapellido.value = '';telefono.value = '';
		telefonos.value = '';contacto.value = '';direccion.value = '';mail.value = '';
		
		$("#msgwindowcont").dialog('close');
	}
	else
	{
		document.getElementById('usuadocume').value= '';
		document.getElementById('msgerror').innerHTML = '* (Error) Cedula Ya Se Encuentra Registrada';
		$("#msgwindowerror").dialog('open');
		return false;
	}
}

/**
 * Function calculahoras
 * @return
 */
function calculahoras()
{
	var arrObjItems = document.getElementById('lstinstructor').value.split(','); //el comodin ',' es separador de filas
	var totalhoras = 0;
	var totalmin = 0;
			
	for( i = 0; i < arrObjItems.length; i++ )
	{
		if(document.getElementById('tipohora_' + arrObjItems[i] + '_' + i).value == 1)
			totalhoras = totalhoras + parseInt(document.getElementById('curconhora_' + arrObjItems[i] + '_' + i).value);
		else
			totalmin = totalmin + parseInt(document.getElementById('curconhora_' + arrObjItems[i] + '_' + i).value); 
	}
	document.getElementById('totalhoras').innerHTML = 'Total tiempo: ' + parseInt(totalhoras) + ' hr. / ' + parseInt(totalmin) + ' min.'; 
}


function ajaxListaInstructor(objparams)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.emplecapaci.php",
		data: objparams,
		beforeSend: function(data){},        
		success: function(requestData){
			document.getElementById('involucrados').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){}                                      
	});
	
}

function reLoadListEmpleado(cdgcuadri,strindex){
	
	var arr_cdgcuadri = cdgcuadri.split(strindex);
	var nstrtecn = "";
	
	for(var a = 0; a < (arr_cdgcuadri.length); a++)
		nstrtecn = nstrtecn + arr_cdgcuadri[a];

	(strindex == '')? document.getElementById('lsttecnicoot').value = cdgcuadri : document.getElementById('lsttecnicoot').value = nstrtecn;
	
	document.getElementById('arrgrupcapa').value = document.getElementById('lsttecnicoot').value;
	var arrObjItems = document.getElementById('lsttecnicoot').value.split(','); //el comodin ',' es separador de filas
	var objparams = 'lsttecnicoot=' + document.getElementById('lsttecnicoot').value;
	
	ajaxListaInstructor(objparams);
}

function ajaxGrupoEmpleado(datapost)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.formgrupcapa.php",
		beforeSend: function(data){
		document.getElementById('msgformc').innerHTML = '';
		},        
		success: function(requestData){
			document.getElementById('msgformc').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}

function reLoadGrupoEmpleado(arrgrupcapa){
	var arrObjItems = document.getElementById('arrgrupcapa').value.split(','); //el comodin ',' es separador de filas
	var arrItem = document.getElementById('lsttecnicoot').value.split(',');
	ajaxFusion(arrObjItems,arrItem);
	var objparams = 'lsttecnicoot=' + document.getElementById('lsttecnicoot').value;
	ajaxListaInstructor(objparams);
}

function ajaxFusion(arr,arrg){
	var arremp;
	var valid;
	if(arr && arrg)
	{
		for(var i=0; i < (arr.length); i++)
		{
			valid = 0;
			for(var j=0; j < (arrg.length); j++)
			{
				if(arr[i] == arrg[j])
					var valid = valid + 1;	
			}
			
			if(valid < 1)
			{
				if(!arremp)
				{
					if(document.getElementById('lsttecnicoot').value == '')
					{
						arremp = arr[i]; 
					}
					else
					{
						arremp = ',' + arr[i]; 
					}
						
				}
				else
				{
					arremp = arremp + ',' + arr[i];
				}
					
			}
			
		}
	}	
	document.getElementById('lsttecnicoot').value = document.getElementById('lsttecnicoot').value + arremp; 
}

function ajaxEmpleadoFilter(grucapcodigo)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.listaempleado.php",
		data: 'grucapcodigo=' + grucapcodigo + '&arrgrupcapa=' + document.getElementById('arrgrupcapa').value,
		beforeSend: function(data){},        
		success: function(requestData){
			document.getElementById('filtergrupcapa').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}