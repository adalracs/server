function accionLoadContent(content, table, value)
{
	$.ajax({	   
	    	dataType: "html",
	    	type: "POST",        
	    	url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_loadcontent.php", 	
        		data: "content=" + content + "&tabla=" + table + "&id="  + value,
         		beforeSend: function(data){ },        
         		success: function(requestData){
        			document.getElementById(content).innerHTML = requestData;
         		},         
         		error: function(requestData, strError, strTipoError){   
        	 		alert("Error " + strTipoError +': ' + strError);
         		},
         		complete: function(requestData, exito){ }                                      
     	});
}

(function($) { $(function() {}); })(jQuery);