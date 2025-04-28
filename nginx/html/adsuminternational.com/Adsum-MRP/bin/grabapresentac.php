<?php
$iRegpresentac[presenbarra]= cargaimagen($_FILES['presenbarra'],'Barra de encabezado',$sbreg['presenbarra'],'adsumbarraimg',$err);
$iRegpresentac[presenloggra]= cargaimagen($_FILES['presenloggra'],'Logo (grande)',$sbreg['presenloggra'],'adsumloggraimg',$err);
$iRegpresentac[presenlogpeq]= cargaimagen($_FILES['presenlogpeq'],'Logo (peque&ntilde;o)',$sbreg['presenlogpeq'],'adsumlogpeqimg',$err);
$iRegpresentac[presenemppre]= $presenemppre;
$iRegpresentac[presenempcop]= $presenempcop;

grabapresentac($iRegpresentac,$err);
if($err)
	echo '<script language="javascript"> alert("Error: \n '.$err.'"); </script>';


function cargaimagen($nuevaimgen, $tag, $oldimagen, $imgnombre, &$iError){
	
	if($nuevaimgen['name']){
		$tipo = substr($nuevaimgen['type'], 0, 5);
		$dir = '../img/';
		if (isset($nuevaimgen['tmp_name'])) {
			if ($tipo == 'image'){
				$exten = substr($nuevaimgen['name'],strlen($nuevaimgen['name']) - 4);
				if(@fopen($oldimagen,"r") != false){
					if(!@unlink($oldimagen)){
						$iError = $iError."- ".$tag.": No tiene permisos para realizar la acci&oacute;n"."\n";
						return $oldimagen;
					}
				}
				if (!copy($nuevaimgen['tmp_nam1e'], $dir.$imgnombre.$exten)){
					$iError = $iError."- ".$tag.": No es posible subir el archivo al servidor"."\n";
					return $oldimagen;
				}else{
					return $dir.$imgnombre.$exten;
				}
			}else{
				$iError = $iError."- ".$tag.": El archivo no es una imagen valida"."\n";
				return $oldimagen;				
			}
		}else{
			$iError = $iError."- ".$tag.": El servidor no reconoce el archivo"."\n";
			return $oldimagen;			
		}
	}else{
		return $oldimagen;		
	}
}


/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion		:	grabapresentac
Decripcion		:	Valida la data a grabar y la lleva al paquete.
Parametros		: 			Descripicion
			$iRegpresentac         		Arreglo de datos.
			$iError
Retorno         	:
Autor           		:	cbedoya
Fecha           		:	23-jun-2008
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
include ('../src/FunGen/fncmsgerror.php');
function grabapresentac($iRegpresentac, $iError){

		$file = fopen('../etc/display.conf',"w+");
		fwrite($file,"##"."\n");
		fwrite($file,"# Propiedad intelectual de Adsum (c)."."\n");
		fwrite($file,"# Todos los derechos reservados"."\n");
		fwrite($file,"#"."\n");
		fwrite($file,"# Aqui se encuentran definidos los parametros de presentacion"."\n");
		fwrite($file,"# generales de la aplicacion."."\n");
		fwrite($file,"# Toda modificacion realizada en este archivo afectara el"."\n");
		fwrite($file,"# buen funcionamiento de la aplicacion."."\n");
		fwrite($file,"##"."\n");
		fwrite($file,"\n");
		fwrite($file,"presenbarra=".$iRegpresentac['presenbarra']."\n");
		fwrite($file,"presenloggra=".$iRegpresentac['presenloggra']."\n");
		fwrite($file,"presenlogpeq=".$iRegpresentac['presenlogpeq']."\n");
		fwrite($file,"presenemppre=".$iRegpresentac['presenemppre']."\n");
		fwrite($file,"www.adsuminternational.com"."\n");
		fwrite($file,"presenempcop=".$iRegpresentac['presenempcop']."\n");
		fwrite($file,"empresa=Adsum"."\n");
		fclose($file);

		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="ingrnuevpresentac.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
}
?>
