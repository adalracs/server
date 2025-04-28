$(document).ready(function(){
	
	new Ajax_upload('#cargarEmbobinado', {
		action: '../src/FunjQuery/jquery.phpscripts/upload.image.php?ruth=embobinados', // I disabled uploads in this example for security reaaons
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
//				document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Solo se permiten Archivos Formato de Imagen [.jpg|.jpeg|.gif|.png|.bmp]';
//				$('#msgwindow').dialog('open');
				// cancel upload
				return false;				
			}
		},
		onComplete : function(file, response){
			if(response == 'error_exist')
			{
				alert('Error:' + '\n' + 'El archivo con el nombre "' + file + '" ya existe');
//				document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>El archivo con el nombre "' + file + '" ya existe';
//				$('#msgwindow').dialog('open');
			}
			else
			{
				if (response == 'error')
				{
					alert('Error:' + '\n' + 'Ocurrio un error mientras se subia el archivo al servidor, intentelo de nuevo mas tarde');
//					document.getElementById('msg').innerHTML = '<span style="color:red;">Error:</span><br>Ocurri&oacute; un error mientras se sub&iacute;a el archivo al servidor, int&eacute;ntelo de nuevo m&aacute;s tarde';
//					$('#msgwindow').dialog('open');
				}
				else
				{
					if(document.getElementById('rutafoto').value != '')
						accionDeleteImage(document.getElementById('rutafoto').value, 'embobinados');
					
					document.getElementById('rutafoto').value = file;
					document.form1.fotoimage.src = '../img/pics_embobinados/' + file;
				}
			}
		}
	});
});

function loadpicture(direccionpiv)
{
	document.form1.rutafoto.value = direccionpiv; 
}