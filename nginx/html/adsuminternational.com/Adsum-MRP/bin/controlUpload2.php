<!--<html>
	<head>
		<title>Ajax File Upload - uploadControl2.php</title>
		<link rev="made" href="mailto:rdsuarez@gmail.com" />
		<link rel="shortcut icon" href="../favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body> -->
	<?php
		//	Script Que copia el archivo temporal subido al servidor en un directorio.
		$tipo = substr($_FILES['file']['type'], 0, 5);
	
		//	Definimos Directorio donde se guarda el archivo
		$dir = '../img/fotos_equipos/';
	
		//	Intentamos Subir Archivo
		//	(1) Comprovamos que existe el nombre temporal del archivo
		if (isset($_FILES['file']['tmp_name'])) {
			//	(2) - Comprovamos que se trata de un archivo de imágen
			if ($tipo == 'image') {
				//	(3) Por ultimo se intenta copiar el archivo al servidor.
				if (!copy($_FILES['file']['tmp_name'], $dir.$_FILES['file']['name']))
					echo '<script> alert("Error al Subir el Archivo");</script>';
				else 
					echo '<script> alert("El archivo '.$_FILES['file']['name'].' se ha copiado con Exito");</script>';
			}
			else echo '<script> alert("El Archivo que se intenta subir NO ES del tipo Imagen.");</script>';
		}
		else echo '<script> alert("El Archivo no ha llegado al Servidor.");</script>';
	?>
<!--	</body>
</html>-->