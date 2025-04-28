function accionLoadListSistema(id, planta)
{
	$.ajax({	   
	    	dataType: "html",
	    	type: "POST",        
	    	url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_sistema.php", 	
        		data: "sistemcodigo=" + id + "&plantacodigo="  + planta,
         		beforeSend: function(data){ },        
         		success: function(requestData){
        			document.getElementById('lista_sistema').innerHTML = requestData;
         		},         
         		error: function(requestData, strError, strTipoError){   
        	 		alert("Error " + strTipoError +': ' + strError);
         		},
         		complete: function(requestData, exito){ }                                      
     	});
}

function accionLoadListEquipo(id, sistema)
{
	$.ajax({	   
	    	dataType: "html",
	    	type: "POST",        
	    	url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_equipo.php", 	
        		data: "equipocodigo=" + id + "&sistemcodigo=" + sistema,
         		beforeSend: function(data){ },        
         		success: function(requestData){
        			document.getElementById('lista_equipo').innerHTML = requestData;
         		},         
         		error: function(requestData, strError, strTipoError){   
        	 		alert("Error " + strTipoError +': ' + strError);
         		},
         		complete: function(requestData, exito){ }                                      
     	});
}

function accionLoadListGen(id, father, contendor)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_list_" + contendor + ".php", 	
		data: "id=" + id + "&father=" + father,
		beforeSend: function(data){ },        
		success: function(requestData){
			document.getElementById(contendor).innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError);
		},
		complete: function(requestData, exito){ }                                      
	});
}

(function($) { $(function() {}); })(jQuery);