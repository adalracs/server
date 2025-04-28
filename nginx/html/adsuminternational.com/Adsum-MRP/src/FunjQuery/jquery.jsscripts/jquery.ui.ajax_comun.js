/**
 * Function accionListTecnicos
 * 
 * @param paramet
 * @param content
 * @return
 */
function accionListTecnicos(paramet, content)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.grupusuario.php", 	
		data: paramet,
		beforeSend: function(data){ },        
		success: function(requestData){
			if(requestData != '')
				document.getElementById(content).innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError);
		},
		complete: function(requestData, exito){ }                                      
	});
}



/**
 * Function accionDeleteFileNormal
 * Funcion Ajax para eliminar archivos segun la ubicacion 'file'
 * @param file
 */
function accionDeleteFileNormal(file)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/delete.file.php", 	
		data: "file=" + file,
		beforeSend: function(data){ },        
		success: function(requestData){ },         
		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError);
		},
		complete: function(requestData, exito){ }                                      
	});
}

/**
 * Function accionDeleteFiel
 * Funcion exclusiva para la eliminacion de manuales y planos
 * @param filename
 * @param to
 * @return
 */
function accionDeleteFiel(filename, to)
{
	$.ajax( 
	{	   
	    dataType: "html",
	    type: "POST",        
	    url: "../bin/deletefile.php", 	 
        data: "filename=" + filename + "&to=" + to, 
        beforeSend: function(data){ },        
         success: function(requestData){  	
         },         
         error: function(requestData, strError, strTipoError){   
        	 alert("Error " + strTipoError +': ' + strError);
         },
         complete: function(requestData, exito){  
        	 return false;
        	 // En caso de usar una gif (cargando...) aqui quitas la imagen
         }                                      
     });
}


/**
 * Function accionDeleteImage
 * Funcion Ajax para eliminar la imagen temporal que se encuentra en el programa
 * @param image
 */
function accionDeleteImage(image, ruth)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/delete.image.php", 	
		data: "image=" + image + "&ruth=" + ruth,
		beforeSend: function(data){ },        
		success: function(requestData){ },         
		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError);
		},
		complete: function(requestData, exito){ }                                      
	});
}


/**
 * Funtion accionCamposPer
 * @param codigo
 * @param origen
 * @param acronimo
 * @return string html
 */
function accionCamposPer(codigo, origen, acronimo)
{
	$.ajax( 
	{	   
	    dataType: "html",
	    type: "POST",        
	    url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_camppersonalizado.php",
        data: "origen=" + origen + "&acron=" + acronimo + "&codigo=" + codigo, 	 //
         beforeSend: function(data){ },        
         success: function(requestData){
        	 if(requestData != '')
        		 document.getElementById('camppersonalizado').innerHTML = requestData;
         },         
         error: function(requestData, strError, strTipoError){   
        	 alert("Error " + strTipoError +': ' + strError);
         },
         complete: function(requestData, exito){ }                                      
     });
}


/**
 * Funtion accionCmbxAreaFuncio
 * @param departcodigo
 * @param arefuncodigo
 * @return string html
 */
function accionCmbxAreaFuncio(departcodigo, arefuncodigo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_areafuncio.php",
				data: "departcodigo=" + departcodigo + "&arefuncodigo=" + arefuncodigo, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById('cmbxareafuncio').innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}


/**
 * Funtion accionLoadTransCont
 * @param codigo
 * @param origen
 * @param space
 * @return
 */
function accionLoadTransCont(codigo, origen, space)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_trans_" + origen + ".php",
				data: "id=" + codigo, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById(space).innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funcion accionLoadAlerts
 * @param indice
 * @param alerta
 * @param planta
 * @param tipotrab
 * @param tipo
 * @return
 */
function accionLoadAlerts(indice, alerta, planta, tipotrab, tipo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.alertas/jquery." + alerta + ".php",
				data: "type=" + tipo + "&arrusuaplanta=" + planta + "&arrusuatipotrab=" + tipotrab, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById(indice).innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){   
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funcion accionSaveRutina
 * @param arrRutina
 * @param tiptracodigo
 * @param tipmancodigo
 * @param equipocodigo
 * return
 */
function accionSaveRutina(arrRutina, tiptracodigo, tipmancodigo, equipocodigo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "editaprogramacion.php",
				data: "arrRutina=" + arrRutina,
				beforeSend: function(data){ },        
				success: function(requestData){
					accionLoadListRutina(tiptracodigo, tipmancodigo, equipocodigo)
				},         
				error: function(requestData, strError, strTipoError){   
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funcion accionLoadListRutina
 * @param tiptracodigo
 * @param tipmancodigo
 * @param equipocodigo
 * return
 */
function accionLoadListRutina(tiptracodigo, tipmancodigo, equipocodigo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.visors/jquery.programacionequipos.php",
				data: "tiptracodigo=" + tiptracodigo + "&tipmancodigo=" + tipmancodigo + "&equipocodigo=" + equipocodigo,
				beforeSend: function(data){},        
				success: function(requestData){
					document.getElementById('listarutinas').innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){},
				complete: function(requestData, exito){ }                                      
			});
}

function accionFormDevolver(idusuario, idmodulo )
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_formdevolver.php",
		data: { idusuario : idusuario , modulocodigoorg : idmodulo },
		beforeSend: function(data){},        
		success: function(requestData){
			$('#msg2').html(requestData);
			$('#windowdevolver').dialog('open');
		}, 
		error:function(xhr,err){
		    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\nstatusText: "+xhr.statusText+"\nresponseText: "+xhr.responseText);
		    return false;
		},
		complete: function(requestData, exito){ }                                      
	});
}

function accionDevolver(rdobutt, idusuario , modulocodigodes , modulocodigoorg , prosegdescri )
{

	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_devolver.php",
		data: {rdobutt: rdobutt, usuacodi: idusuario, modulocodigodes: modulocodigodes, modulocodigoorg: modulocodigoorg, prosegdescri: prosegdescri},
		beforeSend: function(data){},        
		success: function( requestData ){
			$('#windowdevolver').dialog('close');
			if(requestData != ''){
					document.getElementById('msg1').innerHTML = requestData;
			}else{
				document.getElementById('msg1').innerHTML = '<p><font color="red">Error</font><br>Ocurrio un error al momento de realizar la acci&oacute;n, por favor cierre la ventana e intentelo mas tarde</p>';
			}
			
			$('#msgwindowdevolver').dialog('open');
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});

}

function accionFormCerrarAnalisis(id, idcierre)
{
	$.ajax({	
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.formcierreanalisis.php",
		data: {id : id, idcierre : idcierre},
		beforeSend: function(data){},        
		success: function(requestData){
			document.getElementById('msg2').innerHTML = requestData;
			$('#windowcerraranalisis').dialog('open');
		}, 
		error:function(xhr,err){
		    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\nstatusText: "+xhr.statusText+"\nresponseText: "+xhr.responseText);
		    return false;
		},
		complete: function(requestData, exito){ }                                      
	});
}

function accionCerrarAnalisis(id, idusuario, descripcion, idcierre)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_cerraranalisis.php",
		data :{ cierrecodigo : id, idusuario : idusuario, cierredescri : descripcion, idcierre : idcierre },
		beforeSend: function(data){},        
		success: function(requestData){
			$('#windowcerraranalisis').dialog('close');
			
			if(requestData < 0){
				document.getElementById('msg1').innerHTML = '<p><font color="red">Error</font><br>Ocurrio un error al momento de realizar la acci&oacute;n, por favor cierre la ventana e intentelo mas tarde</p>';
			}else{

				var stringanalisis = (idcierre == 1)? "Materia prima" : "Producto en proceso" ;
				document.getElementById('msg1').innerHTML = "<p>Analisis " + stringanalisis +"  No. " + id + " se cerro satisfactoriamente</p>";
			}
			
			$('#msgwindowanalisis').dialog('open');
		},         
		error: function(requestData, strError, strTipoError){   
		},
		complete: function(requestData, exito){ }                                      
	});
}

//(function($) { $(function() {}); })(jQuery);