<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos métodos como funciones queremos que nuestro servidor "sirva"
Parametros      : null
Retorno         : null
Autor           : ariascos - lfolaya - jcortes
Fecha           : 25-abr-2005
*/
    /*
    incluimos rsServer.php que contiene la class rs_server que será la que "extenderemos" 
    */
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerPriNiv/pktblherramie.php');
	include ( '../src/FunGen/rsServer.php');
	class procesos_admin extends rs_server
	{

		/*
		Propiedad intelectual de adsum (c).
		Funcion         : mostrarSistemas
		Decripcion      : realiza la consulta a la base de datos
		Parametros      : $paramaters		el valor del atributo del formulario
		Retorno         : $str		lista de los hijos de planta
		Autor           : ariascos - lfolaya - jcortes
		Fecha           : 25-abr-2005
		*/	
		function mostrarTransacherram($paramaters)
		{
			$idcon = fncconn();
			$valposic = explode(",",$paramaters[0]);
			
			for($j = 0; $j < count($valposic); $j++)
			{
				$tok = explode("-",$valposic[$j]);
				$straux = loadrecordherramieproc($tok[0],$tok[1],$idcon);
				$str = $str.$straux;
				
			}
			/*echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("'.$str.'")';
			echo '//-->'."\n";
			echo '</script>';*/
			fncclose($idcon);
			if ($str)
			{
				return $str;
			}
			else
			{
				return "";
			}
			
		}
	}
    /* 
        cuando creamos el objeto que tiene los procesos debemos indicar como único parámetro un 
        array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
        a cualquier método del objeto.
    
    */
    
    $oRS = new procesos_admin( array( 'mostrarTransacherram'));
    // el metodo action es el que recoge los datos (POST) y actua en consideración ;-)
    $oRS->action();
?>