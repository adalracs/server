function accionVerificaCode(tabla, campo, camposrh, value)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_verifica_registro.php",
		data: "tabla=" + tabla + "&campo=" + camposrh + "&campocode=" + campo + "&value=" + value,
		beforeSend: function(data){},        
		success: function(requestData){
	 		document.getElementById(campo).value = requestData;
		},         
		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError);
		},
		complete: function(requestData, exito){ }                                      
	});
}
(function($) { $(function() {}); })(jQuery);