 function accionInOutBuffer(filename, row, actionbuffer, forms, elementforms, usuacodi)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.buffervisors.php", 	 // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
		data: "filename=" + filename + "&row=" + row + "&action=" + actionbuffer + "&usuacodi=" + usuacodi, // los parametros que se enviaran a nuestro action para realizar la funcion (si enviarás mas de un parametro los separas con '&')
		beforeSend: function(data){ },        
		success: function(requestData){  	//Llamada exitosa
			document.getElementById('buff_filename').value = requestData;
			document.getElementById(elementforms).src= forms + "?form_data=" + elementforms + "&filename=" + requestData;
		},         
        		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError); //En caso de error mostraremos un alert
		},
		complete: function(requestData, exito){  
			return false; // En caso de usar una gif (cargando...) aqui quitas la imagen
		}                                      
	});
}
 
//Solo si agregaste el jQuery.noConflict(); 
(function($){ $(function(){ }); })(jQuery);