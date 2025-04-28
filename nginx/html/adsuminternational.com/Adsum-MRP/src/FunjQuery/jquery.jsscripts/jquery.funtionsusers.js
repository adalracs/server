function accionChangepassword(id)
{
	$.ajax( 
	{	   
	    dataType: "html",
	    type: "POST",        
	    url: "../src/FunjQuery/jquery.phpscripts/jquery.changepassword.php", 	
        data: "usuacodigo=" + id ,
         beforeSend: function(data){ },        
         success: function(requestData){
        	document.getElementById('formulario').innerHTML = requestData;
        	$('#windowpassword').dialog('open');
         },         
         error: function(requestData, strError, strTipoError){   
        	 alert("Error " + strTipoError +': ' + strError);
         },
         complete: function(requestData, exito){ }                                      
     });
}

function accionLoadNameUser(id)
{
	$.ajax( 
	{	   
	    dataType: "html",
	    type: "POST",        
	    url: "../src/FunjQuery/jquery.phpscripts/jquery.loadnameuser.php", 	
        data: "usuacodigo=" + id ,
         beforeSend: function(data){ },        
         success: function(requestData){
        	document.getElementById('usuarionombre').value = requestData;
         },         
         error: function(requestData, strError, strTipoError){   
        	 alert("Error " + strTipoError +': ' + strError);
         },
         complete: function(requestData, exito){ }                                      
     });
}

function accionSavepassword(id, password)
{
	$.ajax({	   
			dataType: "html",
			type: "POST",        
			url: "../src/FunjQuery/jquery.phpscripts/jquery.savepassword.php",
			data: "usuacodigo=" + id + '&pass=' + password,
			beforeSend: function(data){},        
			success: function(requestData){
				$('#windowpassword').dialog('close');
				
				if(requestData == '1')
				{
					document.getElementById('msg').innerHTML = '<p><font color="red">Error</font><br>Ocurrio un error al momento de guardar los cambios, por favor cierre la ventana e intentelo mas tarde</p>';
					$('#msgwindow').dialog('open');
				}
				else
				{
					document.getElementById('msg').innerHTML = '<p>El cambio fue exitoso</p>';
					$('#msgwindow').dialog('open');
				}
			},         
			error: function(requestData, strError, strTipoError){   
				alert("Error " + strTipoError +': ' + strError);
			},
			complete: function(requestData, exito){ }                                      
	});
}

function accionSavepassword1(id, password)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.savepassword.php",
		data: "usuacodigo=" + id + '&pass=' + password,
		beforeSend: function(data){},        
		success: function(requestData){
			if(requestData == '1')
			{
				document.getElementById('msg').innerHTML = '<p><font color="red">Error</font><br>Ocurrio un error al momento de guardar los cambios, por favor cierre la ventana e intentelo mas tarde</p>';
				$('#msgwindow').dialog('open');
			}
			else
			{
				document.getElementById('msg').innerHTML = '<p>El cambio fue exitoso</p>';
				$('#msgwindow').dialog('open');
			}
		},         
		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError);
		},
		complete: function(requestData, exito){ }                                      
	});
}

function accionComprobardisponibilidad(usuanomb)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.compdisponlogin.php",
		data: "usuanomb=" + usuanomb,
		beforeSend: function(data){},        
		success: function(requestData){
	 		document.getElementById('compdispon').innerHTML=requestData;
		},         
		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError);
		},
		complete: function(requestData, exito){ }                                      
	});
}

(function($) { $(function() {}); })(jQuery);