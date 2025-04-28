<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos m�todos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : ariascos - lfolaya - jcortes - mstroh
Fecha           : 25-abr-2005
Modificaci�n:
|Autor		|Motivo												|Fecha
*/
/*
incluimos rsServer.php que contiene la class rs_server que ser� la que "extenderemos"
*/
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/rsServer.php');
include ( '../src/FunPerPriNiv/pktblherramie.php');
class procesos_admin extends rs_server
{

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarHerramtransac
	Decripcion      : realiza la consulta en la base de datos acerca un item segun el parametro recibido
	Parametros      : $bar el valor de la llave primaria de la herramienta
	Retorno         : $str -> datos necesarios de la herramienta. $arr -> en caso de algun error
	Autor           : lfolaya
	Fecha           : 16-01-2006
	*/
	function mostrarHerramtransac($bar)
	{	
		$idcon = fncconn();
		$arr = loadrecordherramie($bar[0],$idcon);
		if ($arr)
		{
			if($arr < 0)
				return $arr;
			else 
			{
				$str = $arr["herramnombre"].",".$arr["herramdispon"].",".$arr["herramvalor"];
				return $str;
			}
		}
		else
		{
			fncclose($idcon);
			return "";
		}
		fncclose($idcon);
	}
}

/*
cuando creamos el objeto que tiene los procesos debemos indicar como �nico par�metro un
array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
a cualquier m�todo del objeto.
*/

$oRS = new procesos_admin( array('mostrarHerramtransac'));
// el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
$oRS->action();
?>