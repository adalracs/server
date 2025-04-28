<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos métodos como funciones queremos que nuestro servidor tenga a su disposicion
Parametros      : null
Retorno         : null
Autor           : jcortes
Fecha           : 15-jul-2005
Modificación:
|Autor		|Motivo												|Fecha
*/
/*
incluimos rsServer.php que contiene la class rs_server que será la que "extenderemos"
*/
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktblreportot.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/rsServer.php');
class procesos_admin extends rs_server
{

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarReporteot
	Decripcion      : realiza la consulta en la base de datos de los datos de un
	reporte de OT de acuerdo al codigo recibido
	Parametros      : $paramaters el valor de la llave primaria del reporte de OT
	Retorno         : $str		Datos de el reporte de OT
	Autor           : jcortes
	Fecha           : 15-jul-2005
	*/
	function mostrarReporteot($paramaters)
	{
		if($paramaters)
		{
			$idcon = fncconn();
			$sbregReportot = loadrecordreportot($paramaters[0],$idcon);
			if($sbregReportot['reportcodigo'])
			{
				$str = $str."@reportcodigoÇ".$sbregReportot['reportcodigo'];
				$str = $str."@reportfechaÇ".$sbregReportot['reportfecha'];
				$str = $str."@reportdescriÇ".$sbregReportot['reportdescri'];
			}
			if($sbregReportot['tipmancodigo'])
			{
				$sbregtipomant = loadrecordtipomant($sbregReportot['tipmancodigo'],$idcon);
				$str = $str."@tipmannombreÇ".$sbregtipomant['tipmannombre'];
			}
			if($sbregReportot['prioricodigo'])
			{
				$sbregpriorida = loadrecordpriorida($sbregReportot['prioricodigo'],$idcon);
				$str = $str."@priorinombreÇ".$sbregpriorida['priorinombre'];
			}
			if($sbregReportot['tiptracodigo'])
			{
				$sbregtipotrab = loadrecordtipotrab($sbregReportot['tiptracodigo'],$idcon);
				$str = $str."@tiptranombreÇ".$sbregtipotrab['tiptranombre'];
			}
			if($sbregReportot['tareacodigo'])
			{
				$sbregtarea = loadrecordtarea($sbregReportot['tareacodigo'],$idcon);
				$str = $str."@tareanombreÇ".$sbregtarea['tareanombre'];
			}
			if($str)
			{
				return $str;
			}
			else
			{
				fncclose($idcon);
				return "";
			}
			fncclose($idcon);
		}
		else
		{
			return "";
		}
	}
}

/*
cuando creamos el objeto que tiene los procesos debemos indicar como único parámetro un
array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
a cualquier método del objeto.
*/

$oRS = new procesos_admin( array('mostrarReporteot'));
// el metodo action es el que recoge los datos (POST) y actua en consideración ;-)
$oRS->action();
?>