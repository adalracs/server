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
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunGen/rsServer.php');
	class procesos_admin extends rs_server
	{

		/*
		Propiedad intelectual de adsum (c).
		Funcion         : mostrarEquipos
		Decripcion      : realiza la consulta a la base de datos
		Parametros      : $paramaters		el valor del atributo del formulario
		Retorno         : $str		lista de los hijos de planta
		Autor           : ariascos - lfolaya - jcortes
		Fecha           : 25-abr-2005
		*/	
		function mostrarEquipos($paramaters)
		{
			$idcon = fncconn();
			$str = loadrecordequipoproc($paramaters,$idcon);
			
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
		Funcion         : mostrarEquipo
		Decripcion      : Consulta la informacion de un equipo en la table equipo y se la manda al formulario 
		en consultartimedrep.php para consultar el tiempo medio de reparacion de ese equipo en un periodo
		determinado.
		Parametros      : $paramaters		el valor del atributo del formulario
		Retorno         : $str		Datos del equipo a cargar en el formulario desde es invocado el método
		Autor           : jcortes
		Fecha           : 15-sep-2005
		*/	
		function mostrarEquipo($valor)
		{
			$idcon = fncconn();
			
		    $sbregtabla[tablnomb]="equipo";
		    $result=dinamicscantabla($sbregtabla,$idcon);
		    $num = fncnumreg($result);
		    for($i=0;$i<$num;$i++)
		    {
			    $sbregtabla = fncfetch($result,$i);
			    if($sbregtabla[tablnomb]=="equipo")
			    {
				    $tablcodi=$sbregtabla['tablcodi'];
			    }
		    }
			$ircRecord[tablcodi]=$tablcodi;
			$valor=trim($valor[0]);
			$sbregEquipo = loadrecordequipo($valor,$idcon);
			
			$str="";
			if($sbregEquipo>0)
			{
				while($elementos = each($sbregEquipo))
				{
						$str = $str."@".$elementos[0]."Ç".$elementos[1];
				}
				return $str;
			}
			else
			{
				$nuresultcampo = dinamicscancampo($ircRecord,$idcon);
				$num = fncnumreg($nuresultcampo);
				for($i=0;$i<$num;$i++)
				{
					$sbregcampo=fncfetch($nuresultcampo,$i);
					$str = $str."@".$sbregcampo['campnomb']."Ç";
				}
				fncclose($idcon);
				return "-1,".$valor.",".$str;
			}			
			fncclose($idcon);
		}
	}
    /* 
        cuando creamos el objeto que tiene los procesos debemos indicar como único parámetro un 
        array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
        a cualquier método del objeto.    
    */
    
    $oRS = new procesos_admin(array('mostrarEquipos','mostrarEquipo'));
    // el metodo action es el que recoge los datos (POST) y actua en consideración ;-)
    $oRS->action();
?>