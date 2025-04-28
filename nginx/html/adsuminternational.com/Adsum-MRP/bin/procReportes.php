<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos m�todos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : ariascos - lfolaya - jcortes
Fecha           : 25-abr-2005
Modificaci�n:
|Autor		|Motivo												|Fecha
jcortes		|Se agreg� el metodo mostrarUsuagrupcapaBusqueda	|07-jul-2005
*/
/*
incluimos rsServer.php que contiene la class rs_server que ser� la que "extenderemos"
*/
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( 'pagina/rsServer.php');
class procesos_admin extends rs_server
{
	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarCampos
	Decripcion      : Trae los campos de la tabla indicada
	ingresados por el usuario en un Array
	Parametros      : $paramaters Array de parametros de busqueda
	Retorno         : $str		Lista de campos pertenecientes a la tabla
	Autor           : mstroh
	Fecha           : 25-oct-2005
	*/
	function mostrarCampos($paramaters)
	{
		$nuconn = fncconn();
		$foo = explode("|", $paramaters[0]);		
		$sbregTabla = loadrecordtablaproc($foo[1], $nuconn);
		$nuResult = dinamicscancampo($sbregTabla,$nuconn);
		
		if($nuResult > 0)
			$nuCantRow = fncnumreg($nuResult);
		
		if($nuCantRow > 0)
		{
			for($i = 0; $i < $nuCantRow; $i++)
			{
				$sbregArray = fncfetch($nuResult,$i);
				$str = $str.$sbregArray["campdesc"].",".$sbregArray["campnomb"]."|".$sbregArray["tablcodi"]."�";
			}
		}	
		if($str)
		{
			return $str;
		}
		else
		{
			fncclose($nuconn);
			return "";
		}
		fncclose($nuconn);
	}
}

/*
cuando creamos el objeto que tiene los procesos debemos indicar como �nico par�metro un
array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
a cualquier m�todo del objeto.
*/

$oRS = new procesos_admin( array('mostrarClientes'));
// el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
$oRS->action();
?>