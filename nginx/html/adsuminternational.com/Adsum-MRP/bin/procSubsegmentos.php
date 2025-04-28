<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos m�todos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : ariascos - lfolaya - jcortes
Fecha           : 25-abr-2005
*/
    /*
    incluimos rsServer.php que contiene la class rs_server que ser� la que "extenderemos" 
    */
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerPriNiv/pktblsubsegmentos.php');
	include ( '../src/FunGen/rsServer.php');
	class procesos_admin extends rs_server
	{

		/*
		Propiedad intelectual de adsum (c).
		Funcion         : mostrarSubsegmentos
		Decripcion      : realiza la consulta a la base de datos
		Parametros      : $paramaters		el valor del atributo del formulario
		Retorno         : $str		lista de los hijos de planta
		Autor           : cbedoya
		Fecha           : 22-Nov-2007
		*/	
		function mostrarSubsegmentos($paramaters){
			$idcon = fncconn();
			$str = loadrecordsubsegmentosproc($paramaters,$idcon);
			
			if ($str){
				return $str;
			}
			else{
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
    
    $oRS = new procesos_admin(array('mostrarSubsegmentos'));
    // el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
    $oRS->action();
?>