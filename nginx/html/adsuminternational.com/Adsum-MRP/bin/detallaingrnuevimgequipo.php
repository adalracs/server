<?php
	if($rutafoto)
		$rutafoto1 = $rutafoto;
	if($_FILES['file']['name']){
		$tipo = substr($_FILES['file']['type'], 0, 5);
		$dir = '../img/picequipos/tmp/';
		if (isset($_FILES['file']['tmp_name'])) {
			if ($tipo == 'image') {
				$exten = substr($_FILES['file']['name'],strlen($_FILES['file']['name'])- 4);
				//if ($rutafoto1)
					//unlink($rutafoto1);
				$numtemp = 0;
				for(;;){		
					if(@fopen($dir."tmp".$numtemp.$exten,"r") == false)
						break;
					$numtemp++;
				}
				if (!copy($_FILES['file']['tmp_name'], $dir."tmp".$numtemp.$exten)){
					echo '<script> alert("Error al anexar el Archivo");</script>';
				}else{ 
					//echo '<script> alert("El archivo '.$_FILES['file']['name'].' se ha copiado con Exito");</script>';
					$rutafoto1 = $dir."tmp".$numtemp.$exten;
				}
			}
			else echo '<script> alert("El Archivo que se intenta anexar NO ES del tipo Imagen.");</script>';
		}
		else echo '<script> alert("El servidor no reconoce la imagen.");</script>';
	}
?>

<html>
	<head>
		<title>Imagen equipo</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<style type="text/css">
			.estilo1 {font-size: 95%; font-family : Arial } 
		</style>
	</head>
	<body bgcolor="FFFFFF" text="#000000">
		<form method="post" name="form2" enctype="multipart/form-data">
			<table width="90%" border="1" cellspacing="1" cellpadding="0" align="center">
				<tr><td width="100%" bgcolor="White"><iframe src="<?php if($rutafoto1) {echo $rutafoto1;} ?>" frameborder="0" name="equipo_foto"  height="156" width="100%" align="absmiddle"></iframe></td>
                            			</tr>
                            		<tr><td><small><input type="file" name="file" size="10" onchange=" submit()"></small></td></tr>
                            							
                		</table>
			<input type="hidden" name="rutafoto" value="<?php echo $rutafoto1; ?>">
		</form>
		<SCRIPT LANGUAGE="JavaScript"> 
			window.parent.document.form1.rutafoto.value = document.form2.rutafoto.value;
		</script> 
	</body>
</html>
