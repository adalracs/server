<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos métodos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : ariascos - lfolaya - jcortes - mstroh
Fecha           : 25-abr-2005
Modificación:
|Autor		|Motivo												|Fecha
jcortes		|Se agregó el metodo mostrarUsuagrupcapaBusqueda	|07-jul-2005
mstroh		|Se agregó el metodo mostrarItemtransac				|21-Sep-2005
*/
/*
incluimos rsServer.php que contiene la class rs_server que será la que "extenderemos"
*/
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/rsServer.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
class procesos_admin extends rs_server
{

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarItemtransac
	Decripcion      : realiza la consulta en la base de datos acerca un item segun el parametro recibido
	Parametros      : $bar el valor de la llave primaria del item
	Retorno         : $str -> datos necesarios del item. $arr -> en caso de algun error
	Autor           : ariascos - lfolaya - jcortes - mstroh
	Fecha           : 22-jun-2005
	*/
	function mostrarItemtransac($bar)
	{	
		$idcon = fncconn();
		$arr = loadrecorditem($bar[0],$idcon);
		if ($arr)
		{
			if($arr < 0)
				return $arr;
			else 
			{
				$str = $arr["itemnombre"].",".$arr["itemcanmin"].
				",".$arr["itemcanmax"].",".$arr["itemdispon"].",".$arr["itemvalor"];
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
cuando creamos el objeto que tiene los procesos debemos indicar como único parámetro un
array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
a cualquier método del objeto.
*/

$oRS = new procesos_admin( array('mostrarItemtransac'));
// el metodo action es el que recoge los datos (POST) y actua en consideración ;-)
$oRS->action();
?>