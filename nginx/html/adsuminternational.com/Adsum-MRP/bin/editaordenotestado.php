<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editaordenotestado
Decripcion      : Valida la data al editar y la lleva al paquete.
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
function editaordenotestado($iRegorden,$otinitemp,$otfintemp)
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
				$flag = 1;
				fncmsgerror(errorValord);
				break;
			}
			
		}
		if(!$flag)
		{
			for($m = 0;$m < count($arrlog); $m++)
			{
				if(rtrim($arrlog[$m]) == $otinitemp."-".$otfintemp)
					fwrite($file,rtrim($iRegorden[otestacodini]."-".$iRegorden[otestacodfin])."\n");
				else 
					fwrite($file,rtrim($arrlog[$m])."\n");
			}
		}
		else 
			for($n = 0;$n < count($arrlog); $n++)
				fwrite($file,rtrim($arrlog[$n])."\n");
				
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
editaordenotestado($iRegorden,$otinitemp,$otfintemp);
?> 
