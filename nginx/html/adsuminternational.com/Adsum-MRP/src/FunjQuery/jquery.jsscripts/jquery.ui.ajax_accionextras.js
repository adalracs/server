/**
 * Function accionListTecnicoOt
 * 
 * @param paramet
 * @param content
 * @return
 */
function accionListTecnicoOt(paramet, content)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_loadUsuaOt.php", 	
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
 * Funtion accionLoadWindowView
 * 
 * @param parameter
 * @param jqueryfile
 * @param content
 * @param window
 * @return
 */
function accionLoadWindowView(parameter, jqueryfile, content, window)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.accionextras/" + jqueryfile + ".php",
				data: parameter, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById(content).innerHTML = requestData;
					$("#" + window).dialog("open");
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}



//==== Horas Extras 

/**
 * Funtion accionLoadListHE
 * @param usuacodigo
 * @return string html
 */
function accionLoadListHE(usuacodigo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_loadHourExt.php",
				data: "usuacodigo=" + usuacodigo, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById('listahoraextra').innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funtion accionLoadListHEot
 * @param usuacodigo
 * @return string html
 */
function accionLoadListHEot(param)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_loadHEot.php",
				data: param, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById('listahoraextraot').innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funtion accionLoadWindowHEot
 * @param usuacodigo
 * @return string html
 */
function accionLoadWindowHEot(horextcodigo, jqueryfile)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.accionextras/" + jqueryfile + ".php",
				data: "horextcodigo=" + horextcodigo, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById('hextmsg').innerHTML = requestData;
					
					if(jqueryfile == 'jquery.ajax_editHExtra')
						calculeDiff();
					
					$("#windowhoraextra").dialog("open");
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funtion accionEditDataHE
 * @param strVarData
 * @return string html
 */
function accionEditDataHE(strVarData, usuacodigo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../bin/editahorasextra.php",
				data: strVarData, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					accionReLoadListHE(usuacodigo);
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funtion accionReLoadListHE
 * @param usuacodigo
 * @return string html
 */
function accionReLoadListHE(usuacodigo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_loadHourExt.php",
				data: "usuacodigo=" + usuacodigo, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById('listahoraextra').innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

//==== Horas Extras

//==== Novedades

/**
 * Funtion accionLoadListNovedad
 * @param usuacodigo
 * @return string html
 */
function accionLoadListNovedad(usuacodigo)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_loadNovedad.php",
				data: "usuacodigo=" + usuacodigo, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById('listanovedades').innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funtion accionEditDataNovedad
 * @param strVarData
 * @return string html
 */
function accionEditDataNovedad(strVarData)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../bin/editausuanovedad.php",
				data: strVarData, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					showReloadList();
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funtion accionGrabaDataNovedad
 * @param strVarData
 * @return string html
 */
function accionGrabaDataNovedad(strVarData, optfunction)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../bin/grabausuanovedad2.php",
				data: strVarData, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(optfunction == 'functionot')
						loadlist_tecncuadrilla(document.getElementById('lsttecnicoot').value, document.getElementById('typesource').value, '');
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

/**
 * Funtion accionLoadListHEotNov
 * @param usuacodigo
 * @return string html
 */
function accionLoadListHEotNov(param)
{
	$.ajax( 
			{	   
				dataType: "html",
				type: "POST",        
				url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_loadExtrasNov.php",
				data: param, 	 //
				beforeSend: function(data){ },        
				success: function(requestData){
					if(requestData != '')
						document.getElementById('listahoraextraot').innerHTML = requestData;
				},         
				error: function(requestData, strError, strTipoError){   
					alert("Error " + strTipoError +': ' + strError);
				},
				complete: function(requestData, exito){ }                                      
			});
}

//Novedades

(function($) { $(function() {}); })(jQuery);