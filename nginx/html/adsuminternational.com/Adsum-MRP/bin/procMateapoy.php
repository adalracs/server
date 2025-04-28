<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos métodos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : ariascos - lfolaya - jcortes
Fecha           : 25-abr-2005
Modificación:
|Autor		|Motivo												|Fecha
jcortes		|Se agregó el metodo mostrarUsuagrupcapaBusqueda	|07-jul-2005
*/
/*
incluimos rsServer.php que contiene la class rs_server que será la que "extenderemos"
*/
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerPriNiv/pktblcursogrupo.php');
include ( '../src/FunPerPriNiv/pktblmateapoy.php');
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/rsServer.php');
class procesos_admin extends rs_server
{

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarMateapoy
	Decripcion      : realiza la consulta en la base de datos acerca de cuales usuarios están en
	el grupo de capacitación
	Parametros      : $paramaters el valor de la llave primaria del curso
	Retorno         : $str		lista de los usuarios en el grupo de capacitación
	Autor           : ariascos - lfolaya - jcortes
	Fecha           : 22-jun-2005
	*/
	function mostrarMateapoy($paramaters)
	{	
		$idcon = fncconn();
		$str = loadrecordcursogrupoproc($paramaters,$idcon);
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
	function mostrarMateapoyCursoGrupo($paramaters)
	{
		$idcon = fncconn();
		$str = loadrecordcursogrupo2proc($paramaters,$idcon);
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
	Funcion         : mostrarMateapoyBusqueda
	Decripcion      : Busca en la base de datos los registros de la tabla mateapoy cumplen con los parametros
	ingresados por el usuario en un Array
	Parametros      : $paramaters Array de parametros de busqueda
	Retorno         : $str		lista de los usuarios en el grupo de capacitación
	Autor           : jcortes
	Fecha           : 07-jul-2005
	*/
	function mostrarMateapoyBusqueda($paramaters)
	{
		$param = explode(".",$paramaters[0]);
		//
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

		if($flag==0)
		{
			$nuResult = call_user_func('fullscan'.$isbtabla,$nuconn);
			if($nuResult > 0)
			{
				$nuCantRow = fncnumreg ($nuResult);
			}
		}
		else if($flag==1)
		{
			$nuResult = call_user_func('dinamicscan'.$isbtabla,$irecarreglo,$nuconn);
			if($nuResult > 0)
			{
				$nuCantRow = fncnumreg ($nuResult);
			}
		}

		if($nuCantRow > 0)
		{
			for($i=0;$i<$nuCantRow;$i++)
			{
				$sbregArray = fncfetch($nuResult,$i);
				$str = $str.$sbregArray["matapocodigo"].",".$sbregArray["mataponombre"].",";
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
cuando creamos el objeto que tiene los procesos debemos indicar como único parámetro un
array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
a cualquier método del objeto.
*/

$oRS = new procesos_admin( array( 'mostrarMateapoy','mostrarMateapoyCursoGrupo','mostrarMateapoyBusqueda'));
// el metodo action es el que recoge los datos (POST) y actua en consideración ;-)
$oRS->action();
?>