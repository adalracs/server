<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaordenotestado
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegorden         Arreglo de datos.
Retorno         :
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 13072005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
include ('../src/FunGen/fncmsgerror.php');
include ('consultaconfotestado.php');
function grabaordenotestado($iRegorden)
{
	$nuconn = fncconn();
	define("errorValord",24);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if ($iRegorden)
	{
		consultaconfotestado($arrval,$arrlog);
		$file = fopen('../etc/ot.conf',"w+");
		fwrite($file,"#Aqui se encuentran las reglas definidas por el usuario"."\n");
		fwrite($file,"#Toda modificacion realizada en este archivo afectara el"."\n");
		fwrite($file,"#buen funcionamiento de la aplicacion."."\n");
		fwrite($file,"#"."\n");
		fwrite($file,"[Orden logico]"."\n");
		for($j = 0;$j < count($arrlog); $j++)
		{
			if(rtrim($arrlog[$j]) == $iRegorden[otestacodini]."-".$iRegorden[otestacodfin])
			{
				fwrite($file,rtrim($arrlog[$j])."\n");
				$flag = 1;
				fncmsgerror(errorValord);
			}
			else
				fwrite($file,rtrim($arrlog[$j])."\n");
		}
		if(!$flag)
			fwrite($file,$iRegorden[otestacodini]."-".$iRegorden[otestacodfin]."\n");
		fwrite($file,"[/Orden logico]"."\n");
		
		fwrite($file,"[Valor por estado]"."\n");
		for($k = 0;$k < count($arrval); $k++)
		{
			fwrite($file,rtrim($arrval[$k])."\n");
		}
		fwrite($file,"[/Valor por estado]"."\n");
		fclose($file);
		if(!$flag)
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'location ="ingrnuevregotestado.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
		}
	}
}
$iRegorden[otestacodini] = $otestacodini;
$iRegorden[otestacodfin] = $otestacodfin;
grabaordenotestado($iRegorden);
?> 
