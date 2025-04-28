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
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerPriNiv/pktbltipocomponen.php');
include ( '../src/FunGen/rsServer.php');

class procesos_admin extends rs_server
{

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarTipocomponen
	Decripcion      : realiza la consulta a la base de datos
	Parametros      : $paramaters		el valor del atributo del formulario
	Retorno         : $str --- > Lista el tipo de equipo seleccionado
	Autor           : ariascos - lfolaya - mstroh
	Fecha           : 27-DIC-2005
	*/
	function mostrarTipocomponen($paramaters)
	{
		if($paramaters[0] != "")
		{
			$idcon = fncconn();
			
			if(is_numeric($paramaters[0]))
			{
				$arr_tipocomponen = loadrecordtipocomponen($paramaters[0], $idcon);
				
				if(is_array($arr_tipocomponen))
					return $arr_tipocomponen["tipcomacroni"];
				else 
				{
					fncclose($idcon);
					return -1;
				}
			}
			else 
			{
				$iRegtipocomponen["tipcomacroni"] = $paramaters[0];
				$idrestipocomponen = dinamicscantipocomponen($iRegtipocomponen, $idcon);
				
				if(!is_numeric($idrestipocomponen))
				{
					$numtipocomponen = fncnumreg($idrestipocomponen);
					
					for($i=0; $i<$numtipocomponen; $i++)
					{
						$arr_tipocomponen = fncfetch($idrestipocomponen, $i);
						
						if($arr_tipocomponen["tipcomacroni"] == $iRegtipocomponen["tipcomacroni"])
						{
							$cod_tipocomponen = $arr_tipocomponen["tipcomcodigo"];
							break;
						}
					}
					fncclose($idcon);
					return $cod_tipocomponen;
				}
				else 
				{
					fncclose($idcon);
					return -1;
				}
			}
		}
	}
}
/*
cuando creamos el objeto que tiene los procesos debemos indicar como �nico par�metro un
array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
a cualquier m�todo del objeto.
*/

$oRS = new procesos_admin( array('mostrarTipocomponen'));
// el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
$oRS->action();
?>