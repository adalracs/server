<?php 
include ( '../src/FunPerPriNiv/pktblcursogrupo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editacursogrupo($iRegcursogrupo,&$flageditarcursogrupo,&$campnomb,&$bandera)
{
	$nuconn = fncconn();
	define("id",45);
	define("existe",-3);
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
	define("errorGruFec",28);
	define("errorIng",35);

	if ($bandera != "editar")
	{
		$nuidtemp = fncnumact(id,$nuconn);
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
	}

	if ($iRegcursogrupo)
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
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
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
								$flageditarcursogrupo = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}

			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				$flageditarcursogrupo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			$validresult = consulmetacursogrupo($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarcursogrupo = 1;
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
				$foo = date("Y-m-d");
				$compararfec = datecmp($iRegcursogrupo[curgrufecini], $foo);
				if ($compararfec <= 0)
				{
					fncmsgerror(errorGruFec);
					$flageditarcursogrupo = 1;
					unset($comparafec);
				}
				$comparar = datecmp($iRegcursogrupo[curgrufecini], $iRegcursogrupo[curgrufecfin]);

				if ($comparar == 0)
				{
					if ($iRegcursogrupo[curgruhorini] and $iRegcursogrupo[curgruhorfin])
					{
						$timecmp = fnchourcmp($iRegcursogrupo[curgruhorini],$iRegcursogrupo[curgruhorfin]);
						if ($timecmp >= 0)
						{
							if ($bandera == 1)
							{
								fncmsgerror(errorTimeValid);
								$flagnuevocursogrupo = 1;
								$campnomb["curgruhorini"] = 1;
								unset($comparar);
							}
						}
					}
				}
				else if ($comparar >= 1)
				{
					if (($bandera == 1) || ($bandera == "editar"))
					{
						fncmsgerror(errorFecValid);
						$flagnuevocursogrupo = 1;
						$campnomb["curgrufecini"] = 1;
						unset($comparar);
					}
				}
				else if ($comparar == -1)
				{
					($bandera != "editar") ? $result = insrecordcursogrupo($iRegcursogrupo,$nuconn) : $result = uprecordcursogrupo($iRegcursogrupo,$nuconn);
					if($result < 0 )
					{
						ob_end_clean();
						fncmsgerror(errorReg);
						$flageditarcursogrupo=1;
					}
					if($result > 0)
					{
						if ($bandera != "editar")
							$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
						if (($bandera == 1) || ($bandera == "editar"))
						{
							fncmsgerror(editaEx);
							echo '<script language="javascript">';
							echo '<!--//'."\n";
							echo 'location = "maestablcursogrupo.php?codigo='.$codigo.';"';
							echo '//-->'."\n";
							echo '</script>';
						}
					}
				}
				fncclose($nuconn);
			}
		}
	}
}
//editacursogrupo($iRegcursogrupo,$flageditarcursogrupo,$campnomb,$codigo);
//Validaci�n
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : validacupo
Decripcion      :
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 15112004
Historial de modificaciones
| Fecha  | Motivo																	| Autor 	|
05072005  La validaci�n se realiza	por cada usuario y no por el grupo entero 		 jcortes
07222005  Implementacion para la tabla cursogrupo									 mstroh
*/
function validacupo($curso,$grupo,$arrmate,$arrmatecant,$nucon/*,&$accioneditaremplgrupo*/)
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
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : borracursogrupo
Decripcion      :
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
13-jul-2005 editar parametro $flagborrar	 jcortes
22-jul-2005 Implementacion para CursoGrupo	 mstroh
*/
function borracursogrupo($curso,$grupo,$arrmate,$arrmatecant,$nucon,&$flagborrar)
{
	$result = loadrecordvalidamaterial($curso,$grupo,$nucon);
	if ($result > 0)
	{
		$numReg = fncnumreg($result);
		for ($x = 0 ;$x < $numReg;$x++)
		{
			$arr = fncfetch($result,$x);
			$existe=0;
			for($i = 0; $i < $arrmatecant; $i++)
			{
				if($arr[matapocodigo] == $arrmate[$i])
				{
					$existe=1;
				}
			}
			if(!$existe)
			{
				$flagborrar=1;
				delrecordcursogrupomat($arr[matapocodigo],$curso,$grupo,$nucon);
			}
		}
		$flageditarcursogrupo = 1;
	}
}
// Nombre del "select":
if($cursocodigo)
{
	if($arreglo1)
	{

		$valposic = explode(",",$arreglo1);
		$numposic = count($valposic);
		$idcon = fncconn();
		$flagborrar=0;
		borracursogrupo($cursocodigo,$grucapcodigo,$valposic,$numposic,$idcon,$flagborrar);
		$x = 0;
		for($i = 0; $i < $numposic; $i++)
		{
			$idval = validacupo($cursocodigo,$grucapcodigo,$valposic[$i],$numposic,$idcon/*,$accioneditaremplgrupo*/);
			if($idval == 1)
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
				editacursogrupo($iRegcursogrupo,$flageditarcursogrupo,$campnomb,$x);
			}
		}
		if(!$x)
		{
			if($flagborrar)
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Proceso existoso");';
				echo 'location = "maestablcursogrupo.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			else
			{
				$foo1 = explode(":",$curgruhorini);
				$foo2 = explode(":",$curgruhorfin);
				if($pasadmerini)
				{
					if($foo1[0] != 12)
					$curgruhorini = ($foo1[0] + 12).":".$foo1[1];
				}
				elseif($foo1[0] == 12)
				$curgruhorini = "00:".$foo1[1];
				if($pasadmerfin)
				{
					if($foo2[0] != 12)
					$curgruhorfin = ($foo2[0] + 12).":".$foo2[1];
				}
				elseif($foo2[0] == 12)
				$curgruhorfin= "00:".$foo2[1];
				$auxmatapocodigo = $valposic[0];
				$iRegcursogrupo[curgrucodigo] = $curgrucodigo;
				$iRegcursogrupo[cursocodigo] = $cursocodigo;
				$iRegcursogrupo[grucapcodigo] = $grucapcodigo;
				$iRegcursogrupo[matapocodigo] = $auxmatapocodigo;
				$iRegcursogrupo[curgrufecini] = $curgrufecini;
				$iRegcursogrupo[curgrufecfin] = $curgrufecfin;
				$iRegcursogrupo[curgruhorini] = $curgruhorini;
				$iRegcursogrupo[curgruhorfin] = $curgruhorfin;
				$iRegcursogrupo[curgruhorari] = $curgruhorari;
				$x = "editar";
				editacursogrupo($iRegcursogrupo,$flageditarcursogrupo,$campnomb,$x);
			}
		}
	}
	else
	{
		$flageditarcursogrupo = 1;
		echo '<script language= "javascript">';
		echo '<!--//'."\n";
		echo 'alert("Seleccione uno o mas materiales de apoyo")';
		echo '//-->'."\n";
		echo '</script>';
	}
}
else
{
	$flageditarcursogrupo = 1;
	echo '<script language= "javascript">';
	echo '<!--//'."\n";
	echo 'alert("Seleccione un curso")';
	echo '//-->'."\n";
	echo '</script>';
}
?>