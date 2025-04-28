function accionDeleteFiel(filename, to)
{
	$.ajax( 
	{	   
	    dataType: "html",
	    type: "POST",        
	    url: "../bin/deletefile.php", 	 // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
        data: "filename=" + filename + "&to=" + to, //El id del pais seleccionado en la lista paises (si enviarás mas de un parametro los separas con &.
        beforeSend: function(data){ },        
         success: function(requestData){  	//Llamada exitosa
         },         
         error: function(requestData, strError, strTipoError){   
        	 alert("Error " + strTipoError +': ' + strError); //En caso de error mostraremos un alert
         },
         complete: function(requestData, exito){  
        	 return false;
        	 // En caso de usar una gif (cargando...) aqui quitas la imagen
         }                                      
     });
}

//Solo si agregaste el jQuery.noConflict(); 
(function($) { 
  $(function() {
    // El codigo de la funcion cargarRegionesPais()
  });
})(jQuery);