$(function(){
	//Vetana de referencia de equipos
    $("#windowreferencia").dialog({
    	autoOpen: false,
    	width: 715,
    	modal: true    	
    });
    //boton anexar referencia
    $('#anxlistref').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
    	openWinreferencia();
    	return false;
    });    
    //Boton retirar referencia
    $('#retlistref').button({ icons: { primary: "ui-icon-minus" } }).click(function() {
    	var strparam = "arrfabricanteprovee=" + $("#arrfabricanteprovee").val();
		loadReprefFabricante(strparam);	
    	return false;
    });          
});

//funcion openWinreferencia
function openWinreferencia()
{
	$.ajax({
		url: '../src/FunjQuery/jquery.visors/jq.vlistareferfabricante.php',
		type: 'POST',
		dataType: 'html',
		data: { arrlistreffabricante: $("#arrfabricanteprovee").val()},
		beforeSend: function(data){ 
			$("#contreferencia").html('<img src="../img/loading.gif">&nbsp;Espere mientras cargan los equipos.</img>');
		},  
		complete: function(xhr, textStatus) {
			//called when complete
		},
		success: function(data, textStatus, xhr) {
			//called when successful
			$("#contreferencia").html(data);
			eventWindowreferencia();
		},
		error: function(xhr, textStatus, errorThrown) {
			//called when there is an error
		}
	});
}
//funcion loadReprefequipo
function loadReprefFabricante(strparam)
{
	$.ajax({
		url: '../src/FunjQuery/jquery.visors/jq.vproveedorfabricante.php',
		type: 'POST',
		dataType: 'html',
		data: strparam,
		beforeSend: function(data){ 
			$("#listreprefefabricante").html('<img src="../img/loading.gif">&nbsp;Espere mientras cargan los equipos.</img>');
		},  
		complete: function(xhr, textStatus) {
			//called when complete
		},
		success: function(data, textStatus, xhr) {
			//called when successful	
			$("#listreprefefabricante").html(data);
		},
		error: function(xhr, textStatus, errorThrown) {
			//called when there is an error
		}
	});
}

//funcion eventWindowreferencia
function eventWindowreferencia()
{
	$("#windowreferencia").dialog("open");
	$("#windowreferencia").dialog({ 
		buttons: [ { text: "Asignar seleccion", 
		click: function() {
			$( "#arrfabricanteprovee" ).val( $("#arrlistreffabricante").val() );
			var strparam = "arrfabricanteprovee=" + $("#arrfabricanteprovee").val() ;
			loadReprefFabricante(strparam);	
			$(this).dialog("close");
		} }] 
	});
}	


