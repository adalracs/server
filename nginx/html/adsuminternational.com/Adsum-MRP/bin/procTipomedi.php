<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos m�todos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : lfolaya
Fecha           : 13-dic-2005
*/
    /*
    incluimos rsServer.php que contiene la class rs_server que ser� la que "extenderemos" 
    */
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	include ( '../src/FunGen/rsServer.php');
	class procesos_admin extends rs_server
	{

		/*
		Propiedad intelectual de adsum (c).
		Funcion         : mostrarComponen
		Decripcion      : realiza la consulta a la base de datos
		Parametros      : $paramaters		el valor del atributo del formulario
		Retorno         : $str		lista de los hijos de planta
		Autor           : lfolaya
		Fecha           : 13-dic-2005
		*/	
		function mostrartipomedi($paramaters)
		{
			$idcon = fncconn();
			$sbregtipm = loadrecordtipomedi($paramaters[0],$idcon);
			
			if ($sbregtipm)
			{
				return $sbregtipm[tipmedacra];
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
    
    $oRS = new procesos_admin( array( 'mostrarmostrartipomedi'));
    // el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
    $oRS->action();
?>