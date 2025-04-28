<?php
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos m�todos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : ariascos - lfolaya - mstroh
Fecha           : 04-ene-2006
*/
/*
incluimos rsServer.php que contiene la class rs_server que ser� la que "extenderemos"
*/
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/rsServer.php');
include ('consultaconfotestado.php');

class procesos_admin extends rs_server
{
	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarOtestado
	Decripcion      : realiza la consulta a la base de datos
	Parametros      : $parameters		el valor del atributo del formulario
	Retorno         : $str
	Autor           : mstroh
	Fecha           : 04-ene-2006
	*/
	function mostrarCampos($parameters)
	{
		if(!empty($parameters[0]))
		{
			$idcon = fncconn();

			$arr_tabla = loadrecordtabla($parameters[0], $idcon);

			$iRegcampo['tablcodi'] = $parameters[0];
			$idrescampo = dinamicscancampo($iRegcampo, $idcon);

			if(!is_numeric($idrescampo))
			{
				$numcampo = fncnumreg($idrescampo);

				for($i=0; $i<$numcampo; $i++)
				{
					$arr_campo = fncfetch($idrescampo, $i);

					if($arr_campo['tablcodi'] == $iRegcampo['tablcodi'])
						$campos_carga[] = $arr_campo['campcodi'].",".$arr_campo['campdesc'];
				}
			}

			$campos = implode("||", $campos_carga);

			return $campos;
		}
	}
}
$oRS = new procesos_admin(array('mostrarCampos'));
// el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
$oRS->action();
?>