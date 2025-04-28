	$(document).ready(function(){
		new Ajax_upload('#examinar_manual', {
			action: 'uploadfilemanual.php', // I disabled uploads in this example for security reaaons
			data : {
				'key1' : "This data won't",
				'key2' : "be send because",
				'key3' : "we will overwrite it"
			},
			onSubmit : function(file , ext){
				if (ext && /^(txt|xls|xlsx|pdf|doc|docx)$/.test(ext))
				{
					/* Setting data */
					this.set_data({ 'key': 'This string will be send with the file' });
					$('#lista_manuales .text').text('Archivo: ' + file);	
				}
				else
				{
					// extension is not allowed
					alert('Error:' + '\n' + 'Solo se permiten Archivos Formato' + '\n' + '[.txt] Texto' + '\n' + '[.doc] Documento Word 97-2003' + '\n' + '[.docx] Documento Word 2007' + '\n' + '[.xls] Hoja de Calculo Excel 97-2003' + '\n' + '[.xlsx] Hoja de Calculo Excel 2007' + '\n' + '[.pdf] Portable Document File');
//					document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Solo se permiten Archivos Formato<br>[.txt] Texto<br>[.doc] Documento Word 97-2003<br>[.docx] Documento Word 2007<br>[.xls] Hoja de Calculo Excel 97-2003<br>[.xlsx] Hoja de Calculo Excel 2007<br>[.pdf] Portable Document File';
//					$('#msgwindow').dialog('open');
					// cancel upload
					return false;				
				}
			},
			onComplete : function(file, response){
				if(response == 'error_exist')
				{
					alert('Error:' + '\n' + 'El archivo con el nombre "' + file + '" ya existe');
//					document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>El archivo con el nombre "' + file + '" ya existe';
//					$('#msgwindow').dialog('open');
				}
				else
				{
					if (response == 'error')
					{
						alert('Error:' + '\n' + 'Ocurrio un error mientras se subia el archivo al servidor, intentelo de nuevo mas tarde');
//						document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Ocurri&oacute; un error mientras se sub&iacute;a el archivo al servidor, int&eacute;ntelo de nuevo m&aacute;s tarde';
//						$('#msgwindow').dialog('open');
					}
					else
					{
						if(document.getElementById('file_manual').value != '')
							var arr_file = document.getElementById('file_manual').value + file;
						else
							var arr_file = file;

						var arr_doufile = '';
						var html_code = '';

						arr_doufile = arr_file.split(':-:');

						if (arr_doufile != "")
						{
							for(var i=0; i < (arr_doufile.length); i++)
							{
								if(arr_doufile[i] != '')
									html_code = html_code + '<li><b>' + arr_doufile[i] + '</b>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="list_files(' + "document.getElementById('file_manual').value,'lista_manuales', 'file_manual', '../doc/manuales/', '" + i +"'" + ');">Quitar</a></li>';
							}
						}
						document.getElementById('file_manual').value = arr_file + ':-:';
						document.getElementById('lista_manuales').innerHTML = html_code;
					}
				}
			}
		});
			
		new Ajax_upload('#examinar_plano', {
			action: 'uploadfileplano.php', // I disabled uploads in this example for security reaaons
			data : {
				'key1' : "This data won't",
				'key2' : "be send because",
				'key3' : "we will overwrite it"
			},
			onSubmit : function(file , ext){
				if (ext && /^(txt|pdf|gif|jpg|jpeg|dwg|png|bmp)$/.test(ext))
				{
					/* Setting data */
					this.set_data({ 'key': 'This string will be send with the file' });
					$('#lista_planos .text').text('Archivo: ' + file);	
				} 
				else 
				{
					// extension is not allowed
					alert('Error:' + '\n' + 'Solo se permiten Archivos Formato' + '\n' + '[.txt] Texto' + '\n' + '[.doc] Documento Word 97-2003' + '\n' + '[.txt] texto' + '\n' + '[.pdf] Portable Document File' + '\n' + '[.dwg] Drawing' + '\n' + '[.jpg|.jpeg|.gif|.png|.bmp] Archivos Formato de Imagen');
//					document.getElementById('msg').innerHTML = '="color:red;">Error:</span><br>Solo se permiten Archivos Formato<br>';
//					$('#msgwindow').dialog('open');
					// cancel upload
					return false;				
				}
			},
			onComplete : function(file, response){
				if(response == 'error_exist')
				{
					alert('Error:' + '\n' + 'El archivo con el nombre "' + file + '" ya existe');
//					document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>El archivo con el nombre "' + file + '" ya existe';
//					$('#msgwindow').dialog('open');
				}
				else
				{
					if (response == 'error')
					{
						alert('Error:' + '\n' + 'Ocurrio un error mientras se subia el archivo al servidor, intentelo de nuevo mas tarde');
//						document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Ocurri&oacute; un error mientras se sub&iacute;a el archivo al servidor, int&eacute;ntelo de nuevo m&aacute;s tarde';
//						$('#msgwindow').dialog('open');
					}
					else
					{
						if(document.getElementById('file_plano').value != '')
							var arr_file = document.getElementById('file_plano').value + file;
						else
							var arr_file = file;

						var arr_doufile = '';
						var html_code = '';

						arr_doufile = arr_file.split(':-:');

						if (arr_doufile != "")
						{
							for(var i=0; i < (arr_doufile.length); i++)
							{
								if(arr_doufile[i] != '')
									html_code = html_code + '<li><b>' + arr_doufile[i] + '</b>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="list_files(' + "document.getElementById('file_plano').value,'lista_planos', 'file_plano', '../img/planos/', '" + i +"'" + ');">Quitar</a></li>';
							}
						}
						document.getElementById('file_plano').value = arr_file + ':-:';
						document.getElementById('lista_planos').innerHTML = html_code;
					}
				}
			}
		});
		
		new Ajax_upload('#cargar', {
			action: '../src/FunjQuery/jquery.phpscripts/upload.image.php?ruth=equipos', // I disabled uploads in this example for security reaaons
			data : {
				'key1' : "This data won't",
				'key2' : "be send because",
				'key3' : "we will overwrite it"
			},
			onSubmit : function(file , ext){
				if (ext && /^(gif|jpg|jpeg|png|bmp)$/.test(ext)){
					/* Setting data */
					this.set_data({
						'key': 'This string will be send with the file'
					});
				} else {
					// extension is not allowed
					alert('Error:' + '\n' + 'Solo se permiten Archivos Formato de Imagen [.jpg|.jpeg|.gif|.png|.bmp]');
//					document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Solo se permiten Archivos Formato de Imagen [.jpg|.jpeg|.gif|.png|.bmp]';
//					$('#msgwindow').dialog('open');
					// cancel upload
					return false;				
				}
			},
			onComplete : function(file, response){
				if(response == 'error_exist')
				{
					alert('Error:' + '\n' + 'El archivo con el nombre "' + file + '" ya existe');
//					document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>El archivo con el nombre "' + file + '" ya existe';
//					$('#msgwindow').dialog('open');
				}
				else
				{
					if (response == 'error')
					{
						alert('Error:' + '\n' + 'Ocurrio un error mientras se subia el archivo al servidor, intentelo de nuevo mas tarde');
//						document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Ocurri&oacute; un error mientras se sub&iacute;a el archivo al servidor, int&eacute;ntelo de nuevo m&aacute;s tarde';
//						$('#msgwindow').dialog('open');
					}
					else
					{
						if(document.getElementById('rutafoto').value != '')
							accionDeleteImage(document.getElementById('rutafoto').value, 'equipos');
						
						document.getElementById('rutafoto').value = file;
						document.form1.fotoimage.src = '../img/pics_equipos/' + file;
					}
				}
			}
		});
	});
	
	function list_files(arr_file, lista, tipo, ruta, del_reg)
	{
		var new_arr = '';
		var arr_doufile = '';
		var html_code = '';
		var contnew = 0;

		arr_doufile = arr_file.split(':-:');
		
		if (arr_doufile != "")
		{
			for(var i=0; i < (arr_doufile.length); i++)
			{
				if(del_reg == i)
				{
					accionDeleteFiel(ruta + arr_doufile[i], tipo);
					alert('Archivo borrado.');
//					document.getElementById('msg').innerHTML = 'Archivo borrado.';
//					$('#msgwindow').dialog('open');
				}
				else
				{
					if(arr_doufile[i] != '')
					{
						html_code = html_code + '<li><b>' + arr_doufile[i] + '</b>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="list_files(' + "document.getElementById('" + tipo +"').value,'" + lista + "', '" + tipo + "', '" + ruta + "', '" + contnew +"'" + ');">Quitar</a></li>';
						contnew ++;

						if(new_arr == '')
							new_arr = arr_doufile[i];
						else
							new_arr = new_arr + ':-:' + arr_doufile[i];
					}
				}
			}
			if(new_arr != '')
				document.getElementById(tipo).value = new_arr + ':-:';
			else
				document.getElementById(tipo).value = '';
			document.getElementById(lista).innerHTML = html_code;
		}
	}
	
	function list_files_view(arr_file, lista, tipo, ruta, del_reg)
	{
		var new_arr = '';
		var arr_doufile = '';
		var html_code = '';
		var contnew = 0;
		
		arr_doufile = arr_file.split(':-:');
		
		if (arr_doufile != "")
		{
			for(var i=0; i < (arr_doufile.length); i++)
			{
				if(del_reg == i)
					accionDeleteFiel(ruta + arr_doufile[i], tipo);
				else
				{
					if(arr_doufile[i] != '')
					{
						html_code = html_code + '<li><b>' + arr_doufile[i] + '</b>&nbsp;&nbsp;<a target="_blank" href="' + ruta + arr_doufile[i] + '">Ver</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="list_files_view(' + "document.getElementById('" + tipo +"').value,'" + lista + "', '" + tipo + "', '" + ruta + "', '" + contnew +"'" + ');">Quitar</a></li>';
						contnew ++;
						
						if(new_arr == '')
							new_arr = arr_doufile[i];
						else
							new_arr = new_arr + ':-:' + arr_doufile[i];
					}
				}
			}
			if(new_arr != '')
				document.getElementById(tipo).value = new_arr + ':-:';
			else
				document.getElementById(tipo).value = '';
			document.getElementById(lista).innerHTML = html_code;
		}
	}