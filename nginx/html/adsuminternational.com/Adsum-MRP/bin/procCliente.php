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
include ( '../src/FunPerPriNiv/pktblcliente.php');
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( 'pagina/rsServer.php');
class procesos_admin extends rs_server
{

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarUsuagrupcapa
	Decripcion      : realiza la consulta en la base de datos acerca de cuales usuarios est�n en
	el grupo de capacitaci�n
	Parametros      : $paramaters el valor de la llave primaria del grupo
	Retorno         : $str		lista de los usuarios en el grupo de capacitaci�n
	Autor           : ariascos - lfolaya - jcortes
	Fecha           : 22-jun-2005
	*/
	function mostrarUsuagrupcapa($paramaters)
	{
		$idcon = fncconn();
		$str = loadrecordusuagrupcapaproc($paramaters,$idcon);

		if ($str)
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

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarUsuagrupcapaBusqueda
	Decripcion      : Busca en la base de datos los registros de la tabla usuario cumplen con los parametros
	ingresados por el usuario en un Array
	Parametros      : $paramaters Array de parametros de busqueda
	Retorno         : $str		lista de los usuarios en el grupo de capacitaci�n
	Autor           : jcortes
	Fecha           : 07-jul-2005
	*/
	function mostrarClientes($paramaters)
	{
		$param = explode(".",$paramaters[0]);
		/////
		$isbtabla = $param[0];
		$flag = $param[1];

		$array = explode(",",$param[2]);
		$num = count($array);

		for($i=0;$i<$num;$i++)
		{
			$irecarreglo[$array[$i]] = $array[$i+1];
			$i= $i+1;
		}

		$nuconn = fncconn();
		
		$nuResult = call_user_func('dinamicscan'.$isbtabla,$irecarreglo,$nuconn);
		if($nuResult > 0)
		{
			$nuCantRow = fncnumreg ($nuResult);
		}
		if($nuCantRow > 0)
		{
			for($i=0;$i<$nuCantRow;$i++)
			{
				$sbregArray = fncfetch($nuResult,$i);
				$str = $str.$sbregArray["clientemail"].",";
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

$oRS = new procesos_admin( array( 'mostrarUsuagrupcapa','mostrarClientes'));
// el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
$oRS->action();
?>