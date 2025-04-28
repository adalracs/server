$(function(){
	//ventana de dialogo items
	$("#msgwindowform").dialog({    
		autoOpen: false,
		modal: true,
		position: { my: "left top", at: "left top", of: window }
	});
	//Boton Ingresar Material
	$('#ingresaritem').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
		ajaxItems();
		$("#msgwindowform").dialog("open");
		$("#msgwindowform").dialog({ buttons: [ { text: "Adicionar", click: function() { reLoadListItems();$(this).dialog("close");  } } ] });
		$("#msgwindowform").dialog( "option", "width", "auto" );
		$("#msgwindowform").dialog( "option", "height", "auto" );
		$("#msgwindowform").dialog( "option", "title", "Adsum Kallpa [Materiales]" );
		return false;
	});
	
	//Boton Quitar Material
	$('#quitaritem').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
		loadArraylistdelete('arrlistaempaque', ',');
		reLoadListItems();
		return false;
	});
});
//ventana de reporte de bobinas 
function ajaxItems()
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jq.ajx.listlistaempaque.php",
		data:	"arrlistaempaque=" + document.getElementById('arrlistaempaque').value +
				"&ordoppcodigo=" + document.getElementById('ordoppcodigo').value +
				"&solprocodigo=" + document.getElementById('solprocodigo').value +
				"&procednombre=" + document.getElementById('procednombre').value +
				"&produccoduno=" + document.getElementById('produccoduno').value +
				"&producnombre=" + document.getElementById('producnombre').value,
		beforeSend: function(data){
			document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}
//selecciona y  envia variables adiconales en el filtro
function reLoadListItems(){	
	var arrObjItems = document.getElementById('arrlistaempaque').value.split(','); //el comodin ',' es separador de filas
	var objparams = "arrlistaempaque=" + document.getElementById('arrlistaempaque').value +
					"&ordoppcodigo=" + document.getElementById('ordoppcodigo').value +
					"&solprocodigo=" + document.getElementById('solprocodigo').value +
					"&procednombre=" + document.getElementById('procednombre').value +
					"&produccoduno=" + document.getElementById('produccoduno').value +
					"&producnombre=" + document.getElementById('producnombre').value;
	ajaxListaListaEmpaque(objparams);
}
//evento ajax para recargar items asignados
function ajaxListaListaEmpaque(objparams)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jq.vlistaempaque.php",
		data: objparams,
		beforeSend: function(data){
			document.getElementById('listlistaempaque').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga el formulario.</img>';		
		},         
		success: function(requestData){
			document.getElementById('listlistaempaque').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){}                                      
	});
	
}
