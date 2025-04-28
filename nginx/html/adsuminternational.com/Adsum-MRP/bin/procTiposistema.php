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
include ( '../src/FunPerPriNiv/pktbltiposistema.php');
include ( '../src/FunGen/rsServer.php');

class procesos_admin extends rs_server
{

	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarTiposistema
	Decripcion      : realiza la consulta a la base de datos
	Parametros      : $paramaters		el valor del atributo del formulario
	Retorno         : $str --- > Lista el tipo de equipo seleccionado
	Autor           : ariascos - lfolaya - mstroh
	Fecha           : 27-DIC-2005
	*/
	function mostrarTiposistema($paramaters)
	{
		if($paramaters[0] != "")
		{
			$idcon = fncconn();
			
			if(is_numeric($paramaters[0]))
			{
				$arr_tiposistema = loadrecordtiposistema($paramaters[0], $idcon);
				
				if(is_array($arr_tiposistema))
					return $arr_tiposistema["tipsisacroni"];
				else 
				{
					fncclose($idcon);
					return -1;
				}
			}
			else 
			{
				$iRegtiposistema["tipsisacroni"] = $paramaters[0];
				$idrestiposistema = dinamicscantiposistema($iRegtiposistema, $idcon);
				
				if(!is_numeric($idrestiposistema))
				{
					$numtiposistema = fncnumreg($idrestiposistema);
					
					for($i=0; $i<$numtiposistema; $i++)
					{
						$arr_tiposistema = fncfetch($idrestiposistema, $i);
						
						if($arr_tiposistema["tipsisacroni"] == $iRegtiposistema["tipsisacroni"])
						{
							$cod_tiposistema = $arr_tiposistema["tipsiscodigo"];
							break;
						}
					}
					fncclose($idcon);
					return $cod_tiposistema;
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

$oRS = new procesos_admin( array('mostrarTiposistema'));
// el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
$oRS->action();
?>