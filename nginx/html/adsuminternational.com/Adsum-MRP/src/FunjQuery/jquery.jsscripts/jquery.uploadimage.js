$(document).ready(function(){
	new Ajax_upload('#examinar_imagen', {
		action: '../src/FunjQuery/jquery.phpscripts/upload.image.php?ruth=usuarios', // I disabled uploads in this example for security reaaons
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
				document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Solo se permiten Archivos Formato de Imagen [.jpg|.jpeg|.gif|.png|.bmp]';
				$('#msgwindow').dialog('open');
				// cancel upload
				return false;				
			}
		},
		onComplete : function(file, response){
			if(response == 'error_exist')
			{
				document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>El archivo con el nombre "' + file + '" ya existe';
				$('#msgwindow').dialog('open');
			}
			else
			{
				if (response == 'error')
				{
					document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Ocurri&oacute; un error mientras se sub&iacute;a el archivo al servidor, int&eacute;ntelo de nuevo m&aacute;s tarde';
					$('#msgwindow').dialog('open');
				}
				else
				{
					if(document.getElementById('usuaimage').value != '')
						accionDeleteImage(document.getElementById('usuaimage').value);
					
					document.getElementById('usuaimage').value = file;
					document.form1.fotoimage.src = '../img/pics_usuarios/' + file;
				}
			}
		}
	});
});