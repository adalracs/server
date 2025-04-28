function accionBandejaOt(usuacodi){
	$.ajax({	   

	    dataType: "html",
	    type: "POST",        
	    url: "../bin/grabacontrolbandejaot.php", 	 // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
        data: "enabled=1&usuacodi=" + usuacodi, //El id del pais seleccionado en la lista paises (si enviarás mas de un parametro los separas con &.
        beforeSend: function(data){ },        
         success: function(requestData){  	//Llamada exitosa
         },         
         error: function(requestData, strError, strTipoError){   
        	 alert("Error: Se perdio la conexion con el servidor"); //En caso de error mostraremos un alert
         },
         complete: function(requestData, exito){  
        	 return false;
        	 // En caso de usar una gif (cargando...) aqui quitas la imagen
         }                                      
     });
}

function accionWsitemCronn(usuacodi){
	
	$.ajax({	   

	    dataType: "html",
	    type: "POST",        
	    url: "../src/FunWebSer/Wsitem.php",
        data: "usuacodi=" + usuacodi, 
        beforeSend: function(data){ },        
         success: function(requestData){  	
         },         
         error: function(requestData, strError, strTipoError){   
        	 alert("Error: Se perdio la conexion con el servidor");
         },
         complete: function(requestData, exito){  
        	 return false;
        	 // En caso de usar una gif (cargando...) aqui quitas la imagen
         }                                      
     });
     
}

function accionCalificacionAuto(usuacodi){
    
    $.ajax({      

        dataType: "html",
        type: "POST",        
        url: "../bin/grabaautocalot.php",
        data: "usuacodi=" + usuacodi, 
        beforeSend: function(data){ },        
        success: function(requestData){    },         
        error: function(requestData, strError, strTipoError){alert("Error: Se perdio la conexion con el servidor");},
        complete: function(requestData, exito){  
            return false;
        }                                      
     });
     
}

//Solo si agregaste el jQuery.noConflict(); 
(function($) { 
  $(function() {
    // El codigo de la funcion cargarRegionesPais()
  });
})(jQuery);