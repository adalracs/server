<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos m�todos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : ariascos - lfolaya - mstroh
Fecha           : 25-abr-2005
*/
/*
incluimos rsServer.php que contiene la class rs_server que ser� la que "extenderemos"
*/
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerPriNiv/pktblnormaseguri.php');
include ( '../src/FunGen/rsServer.php');
class procesos_admin extends rs_server
{

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarNorSegselec
	Decripcion      : realiza la consulta a la base de datos
	Parametros      : $paramaters		el valor del atributo del formulario
	Retorno         : $str --- > Lista los servicios seleccionados
	Autor           : ariascos - lfolaya - mstroh
	Fecha           : 27-DIC-2005
	*/
	function mostrarNorSegselec($paramaters)
	{
		$idcon = fncconn();
		$valposic = explode(",", $paramaters[0]);
		$numposic = count($valposic);
		
		for($i = 0; $i < $numposic; $i++)
		{
			$arrnorseg = loadrecordnormaseguri($valposic[$i],$idcon);
			$str = $str.$arrnorseg["norsegcodigo"].",".$arrnorseg["norsegnombre"].",";
		}
		
		if ($str)
		{
			return $str;
		}
		else
		{
			fncclose($idcon);
			return $str;
		}
		fncclose($idcon);
	}
}
/*
cuando creamos el objeto que tiene los procesos debemos indicar como �nico par�metro un
array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
a cualquier m�todo del objeto.

*/
$oRS = new procesos_admin( array('mostrarNorSegselec'));
// el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
$oRS->action();
?>