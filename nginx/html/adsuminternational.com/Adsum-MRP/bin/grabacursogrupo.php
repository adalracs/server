<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacursogrupo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcursogrupo         Arreglo de datos.
$flagnuevocursogrupo    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblcursogrupo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
//include ( '../src/FunPerPriNiv/pktblmateapoy.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
include( '../src/FunGen/datecmp.php');
include( '../src/FunGen/fnchourcmp.php');
function grabacursogrupo($iRegcursogrupo,&$flagnuevocursogrupo,&$campnomb,&$bandera)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",45);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorGruExs",20);
	define("errorFecValid",25);
	define("errorTimeValid",26);
	define("errorIng",35);

	$nuidtemp = fncnumact(	id,$nuconn);
	do
	{
		$nuresult = loadrecordcursogrupo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcursogrupo[curgrucodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}
	while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if($iRegcursogrupo)
	{
		$iRegtabla["tablnomb"] = "cursogrupo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "cursogrupo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegcursogrupo))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "curgrucodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevocursogrupo = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocursogrupo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetacursogrupo($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocursogrupo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			if ($iRegcursogrupo[curgrufecini] and $iRegcursogrupo[curgrufecfin])
			{
				$comparar = datecmp($iRegcursogrupo[curgrufecini], $iRegcursogrupo[curgrufecfin]);

				if ($comparar == 0)
				{
					$timecmp = fnchourcmp($iRegcursogrupo[curgruhorini],$iRegcursogrupo[curgruhorfin]);

					if ($timecmp >= 0)
					{
						fncmsgerror(errorTimeValid);
						$flagnuevocursogrupo = 1;
						$campnomb["curgruhorini"] = 1;
						unset($comparar);
					}
					else
					{
						$result = insrecordcursogrupo($iRegcursogrupo,$nuconn);
						if($result < 0 )
						{
							ob_end_clean();
							fncmsgerror(errorReg);
							$flagnuevocursogrupo=1;
						}
						if($result > 0)
						{
							$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
							if ($bandera == 1)
							{
								fncmsgerror(grabaEx);
							}
						}
					}
				}
				else if ($comparar >= 1)
				{
					fncmsgerror(errorFecValid);
					$flagnuevocursogrupo = 1;
					$campnomb["curgrufecini"] = 1;
					unset($comparar);
				}
				else if ($comparar == -1)
				{
					//Valida que la hora de inicio sea menor la hora final
					//Esta parte de codigo también se debe realizar al editar
					$timecmp = fnchourcmp($iRegcursogrupo[curgruhorini],$iRegcursogrupo[curgruhorfin]);

					if ($timecmp >= 1)
					{
						//Error
						fncmsgerror(errorTimeValid);
						$flagnuevocursogrupo = 1;
						$campnomb["curgruhorini"] = 1;
						unset($comparar);
					}else
					{
						$result = insrecordcursogrupo($iRegcursogrupo,$nuconn);
						if($result < 0 )
						{
							ob_end_clean();
							fncmsgerror(errorReg);
							$flagnuevocursogrupo=1;
						}
						if($result > 0)
						{
							$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
							if ($bandera == 1)
							{
								fncmsgerror(grabaEx);
							}
						}
					}
				}
				fncclose($nuconn);
			}
		}
	}
}//Validaci�n
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : validacupo
Decripcion      : Valida que el empleado no este en el grupo.
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 15112004
Historial de modificaciones
| Fecha  | Motivo																	| Autor 	|
05072005  La validaci�n se realiza	por cada usuario y no por el grupo entero 		 jcortes

*/
function validacupo($curso,$grupo,$arrmate,$arrmatecant,$nucon/*,&$accionnuevoemplgrupo*/)
{
	$result = loadrecordvalidamaterial($curso,$grupo,$nucon);
	if ($result > 0)
	{
		$numReg = fncnumreg($result);
		for ($x = 0 ;$x < $numReg;$x++)
		{
			$arr = fncfetch($result,$x);
			if($arr[matapocodigo] == $arrmate)
			{
				$result1 = loadrecordmateapoy($arrmate[$i],$nucon);
				$idval = 0;
				return $idval;
			}
		}
	}
	$idval = 1;
	return $idval;
}

//Borrar colboradores que no estan en la lista a grabar
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : borrausuagrupcapa
Decripcion      : Borra del grupo a los colaboradores que no estan en la nueva lista a guardar.
Parametros      : Descripicion
$curso         Codigo del curso.
$arrmate       Arreglo con los codigos de los materiales a asignar al curso.
$arrmatecant   Numero de posiciones del arreglo arrmate.
$nucon         Conexi�n con la base de datos.
$flagborrar    Bandera que indica que se borr� al menos un registro.
Retorno         :
No retorna respuestas
Autor           : jcortes
Fecha           : 05072005
Historial de modificaciones
| Fecha 	| Motivo						| Autor 	|
13-jul-2005 Nuevo parametro $flagborrar	 jcortes
*/
function borracursogrupo($curso,$grupo,$arrmate,$arrmatecant,$nucon)
{
	$result = loadrecordvalidamaterial($curso,$grupo,$nucon);
	if ($result > 0)
	{
		$flagnuevocursogrupo = 1;
	}
}
if($cursocodigo)
{
	if($arreglo1)
	{

		$valposic = explode(",",$arreglo1);
		$numposic = count($valposic);
		$idcon = fncconn();
		$flagborrar=0;
		borracursogrupo($cursocodigo,$grucapcodigo,$valposic,$numposic,$idcon);
		$x = 0;
		for($i = 0; $i < $numposic; $i++)
		{
			$idval = validacupo($cursocodigo,$grucapcodigo,$valposic[$i],$numposic,$idcon/*,$accionnuevoemplgrupo*/);
			if($idval ==1)
			{
				//Convierte la hora en formato de 24 horas
				$foo1 = explode(":",$curgruhorini);
				$foo2 = explode(":",$curgruhorfin);
				if($pasadmerini)
				{
					if($foo1[0] != 12)
					$curgruhorini = ($foo1[0] + 12).":".$foo1[1];
				}elseif($foo1[0] == 12)
				$curgruhorini = "00:".$foo1[1];
				if($pasadmerfin)
				{
					if($foo2[0] != 12)
					$curgruhorfin = ($foo2[0] + 12).":".$foo2[1];
				}elseif($foo2[0] == 12)
				$curgruhorfin= "00:".$foo2[1];

				$auxmatapocodigo = $valposic[$i];
				$iRegcursogrupo[curgrucodigo] = $curgrucodigo;
				$iRegcursogrupo[cursocodigo] = $cursocodigo;
				$iRegcursogrupo[grucapcodigo] = $grucapcodigo;
				$iRegcursogrupo[matapocodigo] = $auxmatapocodigo;
				$iRegcursogrupo[curgrufecini] = $curgrufecini;
				$iRegcursogrupo[curgrufecfin] = $curgrufecfin;
				$iRegcursogrupo[curgruhorini] = $curgruhorini;
				$iRegcursogrupo[curgruhorfin] = $curgruhorfin;
				$iRegcursogrupo[curgruhorari] = $curgruhorari;
				$x++;
				grabacursogrupo($iRegcursogrupo,$flagnuevocursogrupo,$campnomb,$x);
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
				echo 'alert("El curso seleccionado ya existe en el grupo")';
				echo '//-->'."\n";
				echo '</script>';
			}
		}
	}
	else
	{
		$flagnuevocursogrupo = 1;
		echo '<script language= "javascript">';
		echo '<!--//'."\n";
		echo 'alert("Seleccione uno o mas materiales de apoyo")';
		echo '//-->'."\n";
		echo '</script>';
	}
}
else
{
	$flagnuevocursogrupo = 1;
	echo '<script language= "javascript">';
	echo '<!--//'."\n";
	echo 'alert("Seleccione un curso")';
	echo '//-->'."\n";
	echo '</script>';
}

?> 
