<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabausuagrupcapa 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegusuagrupcapa         Arreglo de datos. 
    $flagnuevousuagrupcapa    Bandera de validación 
    $campnomb    			  Nombre del campo que esta generando problemas para grabar
    $bandera					  Bandera de validación
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versión 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha 		| Motivo															| Autor 	| 
	13-jul-2005	 Modificar condicion para mostrar mensaje de grabado exitoso 		 jcortes	*/
  
include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktblusuagrupcapa.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabausuagrupcapa($iRegusuagrupcapa,&$flagnuevousuagrupcapa,&$campnomb,&$bandera)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",6); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9); 
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordusuagrupcapa($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegusuagrupcapa[usugrucodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegusuagrupcapa) 
	{ 
		while($elementos = each($iRegusuagrupcapa)) 
	{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevousuagrupcapa = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetausuagrupcapa($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevousuagrupcapa = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = insrecordusuagrupcapa($iRegusuagrupcapa,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevousuagrupcapa=1; 
			} 
			if($result > 0)
			{ 
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				if ($bandera == 1)
				{
					fncmsgerror(grabaEx);
				}
			} 
			fncclose($nuconn); 
		} 
	} 
}
//Validación
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : validacupo
Decripcion      : Valida que el empleado no este en el grupo. 
Autor           : lfolaya
Escrito con     : WAG Adsum versión 3.1.1 
Fecha           : 15112004 
Historial de modificaciones 
| Fecha  | Motivo																	| Autor 	| 
 05072005  La validación se realiza	por cada usuario y no por el grupo entero 		 jcortes
 			
*/ 
function validacupo($grupo,$colab,$contcolb,$nucon,&$accionnuevoemplgrupo)
{
	$result = loadrecordvalidagrupo($grupo,$nucon);
	if ($result > 0)
	{
		$numReg = fncnumreg($result);
		for ($x = 0 ;$x < $numReg;$x++)
		{
			$arr = fncfetch($result,$x);
			if($arr[usuacodi] == $colab)
			{
				$result1 = loadrecordusuario($colab[$i],$nucon);
				$idval = 0;
				return $idval;
			}
		}
	}
	$idval = 1;
	$accionnuevoemplgrupo = 1;
	return $idval;
}

//Borrar colboradores que no estan en la lista a grabar
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : borrausuagrupcapa
Decripcion      : Borra del grupo a los colaboradores que no estan en la nueva lista a guardar.
Parametros      : Descripicion
    $grupo         Codigo del grupo de capacitación.
    $colab         Arreglo con los codigos de los colaboradores a asignar al grupo.
    $contcolb      Numero de posiciones del arreglo colab.
    $nucon         Conexión con la base de datos.
    $flagborrar    Bandera que indica que se borró al menos un registro.
Retorno         : 
		No retorna respuestas
Autor           : jcortes
Fecha           : 05072005 
Historial de modificaciones 
| Fecha 	| Motivo						| Autor 	| 
 13-jul-2005 Nuevo parametro $flagborrar	 jcortes
*/ 
function borrausuagrupcapa($grupo,$colab,$contcolb,$nucon,&$flagborrar)
{
	$result = loadrecordvalidagrupo($grupo,$nucon);
	if ($result > 0)
	{
		$numReg = fncnumreg($result);
		for ($x = 0 ;$x < $numReg;$x++)
		{
			$arr = fncfetch($result,$x);
			$existe=0;
			for($i = 0; $i < $contcolb; $i++)
			{
				if($arr[usuacodi] == $colab[$i])
				{
					$existe=1;
				}
			}
			if(!$existe)
			{
				$flagborrar=1;
				delrecordusuagrupcapaporgrupo($arr[usuacodi],$grupo,$nucon);
			}
		}
	}
}

if($grucapcodigo)
{
	if($arreglo1)
	{
		$valposic = explode(",",$arreglo1);
		$numposic = count($valposic);
		$idcon = fncconn();
		$flagborrar=0;
		borrausuagrupcapa($grucapcodigo,$valposic,$numposic,$idcon,$flagborrar);
		$x = 0;
		for($i = 0; $i < $numposic; $i++)
		{
			$idval = validacupo($grucapcodigo,$valposic[$i],$numposic,$idcon,$accionnuevoemplgrupo);
			if($idval ==1)
			{
				$auxusuacodi = $valposic[$i];
				$iRegusuagrupcapa[usugrucodigo] = $usugrucodigo;
				$iRegusuagrupcapa[grucapcodigo] = $grucapcodigo;
				$iRegusuagrupcapa[usuacodi] = $auxusuacodi;
				$x++;
				grabausuagrupcapa($iRegusuagrupcapa,$flagnuevousuagrupcapa,$campnomb,$x);
				$accionnuevoemplgrupo = 0;
			}
		}
		if(!$x)
		{
			if($flagborrar)
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Grabado exitoso")';
				echo '//-->'."\n";
				echo '</script>';
			}
			else
			{
				echo '<script language= "javascript">';
				echo '<!--//'."\n";
				echo 'alert("Los colaboradores asignados ya existen en el grupo seleccionado")';
				echo '//-->'."\n";
				echo '</script>';
			}
		}
	}
	else
	{
		$flagnuevousuagrupcapa = 1;
		echo '<script language= "javascript">';
		echo '<!--//'."\n";
		echo 'alert("Seleccionar uno o mas colaboradores")';
		echo '//-->'."\n";
		echo '</script>';
	}
}
else
{
	$flagnuevousuagrupcapa = 1;
	echo '<script language= "javascript">';
	echo '<!--//'."\n";
	echo 'alert("Seleccionar un grupo")';
	echo '//-->'."\n";
	echo '</script>';
}
?> 
