$(function(){

	//Msgbox Caja de mensajes
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

	//Msgbox Caja de mensajes => devolucion de pedidos de venta
	$('#msgwindowdevolver').dialog({
		autoOpen: false,
		width: 350,
		height: 200,
		modal: true,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close");
				document.form1.mov.value = 'primero';
				document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
				document.form1.submit();
			}
		}
	});

	$('#msgwindowanalisis').dialog({
		autoOpen: false,
		width: 350,
		height: 200,
		modal: true,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close");
				document.form1.mov.value = 'primero';
				document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
				document.form1.submit();
			}
		}
	});

	////Msgbox Caja de mensajes => devolucion de pedidos de venta
	$('#windowdevolver').dialog({
		autoOpen: false,
		width: 400,
		height: 300,
		modal: true,
		buttons: {
			"Salir": function() { 
				$(this).dialog("close"); 
			},
			"Devolver PV": function() {
				var objsRdobutt = document.getElementById('rdobutt' + document.form1.seltack.value).value;
				var objRdobutt = objsRdobutt.split('|');
				var idusuario = $('#idusuario').val();
				var modulocodigodes = $('#modulocodigodes').val();
				var modulocodigoorg = $('#modulocodigoorg').val();
				var prosegdescri = $('#textmotivo').val();
				
				if( $.trim(prosegdescri) && modulocodigodes > 0 ){
					accionDevolver(objRdobutt[0], idusuario , modulocodigodes , modulocodigoorg , prosegdescri );
				}else{
					document.getElementById('erredit').style.display = 'block';
				}

			}						
		}
	});

	$('#windowcerraranalisis').dialog({
		autoOpen: false,
		width: 400,
		height: 300,
		modal: true,
		buttons: {
			"Salir": function() { 
				$(this).dialog("close"); 
			},
			"Cerrar Analisis": function() {
				
				var data = document.getElementById('rdobutt' + document.form1.seltack.value).value;
				var idusuario = document.getElementById('idcodigo').value;
				var cierredescri = document.getElementById('cierredescri').value;
				var data2 = data.split('|');	
				var idcierre = $("#idcierre").val();
				if(data2[0] && idusuario && cierredescri && idcierre){
					accionCerrarAnalisis(data2[0], idusuario, cierredescri,idcierre);
				}else{
					document.getElementById('erredit').style.display = 'block';
				}
			}						
		}
	});

});