$(function(){
	
	$("#material").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atcpadreitem.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('idmaterial').value = ui.item.id;
			}
			else
			{
				document.getElementById('idmaterial').value = "";
			}
		}
	});

	$('#ingresarpadreitem').button().click(function() {
		//objetos a usar
		var obj_material = document.getElementById('material');
		var obj_idmaterial = document.getElementById('idmaterial');
		var obj_arrpatronestruc = document.getElementById('arrpatronestruc');
		//valor de los objetos a usar
		var idmaterial = (obj_idmaterial)? obj_idmaterial.value : '' ;
		var arrpatronestruc = (obj_arrpatronestruc)? obj_arrpatronestruc.value : '' ;
		var objs_arrpatronestruc = (obj_arrpatronestruc)? obj_arrpatronestruc.value.split(':|:') : '' ;
		//validacion de error
		var err = '';
		var newRow = '';
		
		if(idmaterial == '')
			err = err + 'Advertencia: *** Debe seleccionar material. <br>';
		
		if(err == '')
		{
			var index = (arrpatronestruc == '')? 1 : (objs_arrpatronestruc.length) + 1 ;
			newRow = (newRow)? newRow + index + ':-:' + idmaterial : index + ':-:' + idmaterial ;
			loadArraylist(newRow, 'arrpatronestruc', ':|:');
			accionReloadListEstructura();
		}
		else
		{
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
			return false;
		}
		
		if(obj_idmaterial)
			obj_idmaterial.value = '';
		
		if(obj_material)
			obj_material.value = '';
		return false;
	});

	$('#quitarpadreitem').button().click(function() {
		loadArraylistdelete('arrpatronestruc', ':|:');
		accionReloadListEstructura();
		return false;
	});
	
});

//evento ajax 
function accionReloadListEstructura()
{
	//objetos a utilizar
	var arrObjpatronestruc = document.getElementById('arrpatronestruc').value.split(','); //el comodin ',' es separador de filas
	var obj_arrpatronestruc = document.getElementById('arrpatronestruc');
	//valor de los objeto
	var arrpatronestruc = (obj_arrpatronestruc)? obj_arrpatronestruc.value : '' ; 
	//parametros de envio
	var parameters = '';
	(arrpatronestruc != '')? parameters = parameters + '&arrpatronestruc=' + arrpatronestruc : parameters = parameters + '&arrpatronestruc=';
	//evento ajax
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.patronestruc.php", 	
		data: parameters,
		beforeSend: function(data){ },        
		success: function(requestData){
			if(requestData != '')
				document.getElementById('listapatronestruc').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
}