$(function(){
	/**
	 * For bodega
	 */
	var negosel = '';
	
	if(document.getElementById('negocicodigo'))
		negosel = document.getElementById('negocicodigo').value;
		
	$("#usuacodigo").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_usuario.php?type=usuacodigo&filter=" + negosel,
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
				document.getElementById('usuanombre').value = ui.item.id; 
			else
				document.getElementById('usuanombre').value = "";
		}
	});
	
	$("#usuanombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_usuario.php?type=usuanombre&filter=" + negosel,
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
				document.getElementById('usuacodigo').value = ui.item.id; 
			else
				document.getElementById('usuacodigo').value = "";
		}
	});
	
	/**
	 * For TransItem
	 */
	$("#itemnombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_item.php",
			minLength: 1,
			select: function(event, ui) {
			ui.item ? document.getElementById('itemcodigo').value = ui.item.id : document.getElementById('itemcodigo').value = "";
			accionLoadTransCont(ui.item.id, 'item','filtritem');
		}
	});
	
	
	/**
	 * For TransHerramie
	 */
	
	$("#herramnombre").autocomplete({
			source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_herramie.php",
			minLength: 1,
			select: function(event, ui) {
			ui.item ? document.getElementById('herramcodigo').value = ui.item.id : document.getElementById('herramcodigo').value = "";
			accionLoadTransCont(ui.item.id, 'herramie','filtrherramie');
		}
	});
	
	/**
	 * For Bodega
	 */
	
	$("#bodeganombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_bodega.php",
		minLength: 1,
		select: function(event, ui) {
			ui.item ? document.getElementById('bodegacodigo').value = ui.item.id : document.getElementById('bodegacodigo').value = "";
		}
	});

	
	/*
	
	$("#nitusuacodi").autocomplete({
		source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_cliente.php",
		minLength: 1,
		select: function(event, ui) {
			ui.item ? document.getElementById('solserclient').value = ui.item.id : document.getElementById('solserclient').value = "";
			accionLoadContent('content_client','usuario',document.getElementById('solserclient').value);
			$('#editar_cliente').button("enable");
		},
		focus: function(event, ui) {
			ui.item ? document.getElementById('solserclient').value = ui.item.id : document.getElementById('solserclient').value = "";
			accionLoadContent('content_client','usuario',document.getElementById('solserclient').value);
			$('#editar_cliente').button("enable");
		}
	});
	
	$("#codsistema").autocomplete({
		source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_ac_sistema.php",
		minLength: 1,
		select: function(event, ui) {
			ui.item ? document.getElementById('sistemcodigo').value = ui.item.id : document.getElementById('sistemcodigo').value = "";
			accionLoadContent('content_sistema','sistema',document.getElementById('sistemcodigo').value);
		},
		focus: function(event, ui) {
			ui.item ? document.getElementById('sistemcodigo').value = ui.item.id : document.getElementById('sistemcodigo').value = "";
			accionLoadContent('content_sistema','sistema',document.getElementById('sistemcodigo').value);
		}
	});
	
	$("#clientnombre").autocomplete({
			source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_ac_cliente.php",
			minLength: 1,
			select: function(event, ui) {
			ui.item ? document.getElementById('cliente').value = ui.item.id : document.getElementById('cliente').value = "";
		},
		focus: function(event, ui) {
			ui.item ? document.getElementById('cliente').value = ui.item.id : document.getElementById('cliente').value = "";
		}
	});
	
	$("#usuanombre").autocomplete({
			source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_ac_usuario.php",
			minLength: 1,
			select: function(event, ui) {
			ui.item ? document.getElementById('usuacodigo').value = ui.item.id : document.getElementById('usuacodigo').value = "";
		},
		focus: function(event, ui) {
			ui.item ? document.getElementById('usuacodigo').value = ui.item.id : document.getElementById('usuacodigo').value = "";
		}
	});

	$("#solserennomb").autocomplete({
		source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_ac_ventas.php",
		minLength: 1,
		select: function(event, ui) {
		ui.item ? document.getElementById('solserencarg').value = ui.item.id : document.getElementById('solserencarg').value = "";
	},
	focus: function(event, ui) {
		ui.item ? document.getElementById('solserencarg').value = ui.item.id : document.getElementById('solserencarg').value = "";
	}
	});

	$("#equiponombre1").autocomplete({
			source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_ac_equipo.php",
			minLength: 1,
			select: function(event, ui) {
			ui.item ? document.getElementById('equipocodigo').value = ui.item.id : document.getElementById('equipocodigo').value = "";
		},
		focus: function(event, ui) {
			ui.item ? document.getElementById('equipocodigo').value = ui.item.id : document.getElementById('equipocodigo').value = "";
		}
	});

	$("#tecniconombre").autocomplete({
			source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_ac_tecnico.php",
			minLength: 1,
			select: function(event, ui) {
			ui.item ? document.getElementById('usuacodigo').value = ui.item.id : document.getElementById('usuacodigo').value = "";
		},
		focus: function(event, ui) {
			ui.item ? document.getElementById('usuacodigo').value = ui.item.id : document.getElementById('usuacodigo').value = "";
		}
	});

	$("#itemnombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_ac_item.php",
			minLength: 1,
			select: function(event, ui) {
			ui.item ? document.getElementById('itemcodigo').value = ui.item.id : document.getElementById('itemcodigo').value = "";
			accionLoadTransCont(document.getElementById('itemcodigo').value, 'item','filtritem');
		},
		focus: function(event, ui) {
			ui.item ? document.getElementById('itemcodigo').value = ui.item.id : document.getElementById('itemcodigo').value = "";
			accionLoadTransCont(document.getElementById('itemcodigo').value, 'item','filtritem');
		}
	});
	
	$("#herramnombre").autocomplete({
			source: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_ac_herramie.php",
			minLength: 1,
			select: function(event, ui) {
			ui.item ? document.getElementById('herramcodigo').value = ui.item.id : document.getElementById('herramcodigo').value = "";
			accionLoadTransCont(document.getElementById('herramcodigo').value, 'herramie','filtrherramie');
		},
		focus: function(event, ui) {
			ui.item ? document.getElementById('herramcodigo').value = ui.item.id : document.getElementById('herramcodigo').value = "";
			accionLoadTransCont(document.getElementById('herramcodigo').value, 'herramie','filtrherramie');
		}
	});*/
});